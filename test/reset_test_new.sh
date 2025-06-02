#!/bin/bash

# Assumes this script is at: /var/www/test/reset_tests.sh
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
FIXTURES_DIR="$ROOT/test/fixtures"
PROPEL="$ROOT/generator/bin/propel-gen-working"

function check_permissions {
    local path="$1"
    if [ ! -w "$path" ]; then
        echo "  ❌ Directory not writable: $path"
    fi
}

function rebuild {
    local dir=$1
    local full_dir="$FIXTURES_DIR/$dir"

    echo "[ $dir ]"

    if [ ! -f "$full_dir/build.properties" ]; then
        echo "  -> Skipping (no build.properties)"
        return
    fi

    local build_dir="$full_dir/build"
    local sql_dir="$build_dir/sql"
    local classes_dir="$build_dir/classes"
    local conf_dir="$build_dir/conf"

    rm -rf "$build_dir"
    mkdir -p "$sql_dir" "$classes_dir" "$conf_dir"

    check_permissions "$sql_dir"
    check_permissions "$classes_dir"

    echo "  -> Scanning for schema files..."
    local schema_files=$(find "$full_dir" -maxdepth 1 -type f \( -name '*-schema.xml' -o -name 'schema.xml' \))
    if [ -z "$schema_files" ]; then
        echo "  ⚠️  No schema XML files found in $full_dir"
    else
        echo "$schema_files" | sed 's/^/     - /'
    fi

    echo "  -> Generating SQL..."
    bash "$PROPEL" "$full_dir" sql -verbose 2>&1 | tee "$sql_dir/generation.log"

    if [ -z "$(find "$sql_dir" -name '*.sql')" ]; then
        echo "  ⚠️  No SQL files generated in $sql_dir"
        echo "  -> Trying fallback target 'main'..."
        php "$PROPEL" "$full_dir" main -verbose 2>&1 | tee -a "$sql_dir/generation.log"
    fi

    if [ -f "$sql_dir/sqldb.map" ]; then
        echo "  -> Inserting SQL..."
        php "$PROPEL" "$full_dir" insert-sql -verbose | tee -a "$sql_dir/insertion.log"
    else
        echo "  ⚠️  No sqldb.map found. Skipping insert-sql."
    fi
}

echo
echo "Resetting test fixtures..."
echo "=========================="
echo

for d in $(ls "$FIXTURES_DIR"); do
    if [ -d "$FIXTURES_DIR/$d" ]; then
        rebuild "$d"
        echo
    fi
done

# Handle reverse fixtures if they exist
if [ -d "$FIXTURES_DIR/reverse/mysql" ]; then
    echo "Processing reverse fixtures..."
    echo "============================="
    echo "[ reverse/mysql ]"
    php "$PROPEL" "$FIXTURES_DIR/reverse/mysql" insert-sql
    echo
fi

echo "Fixture reset complete!"
