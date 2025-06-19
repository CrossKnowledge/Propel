#!/usr/bin/env bash
# Reset Propel tests fixtures (Improved for debugging)
# Original Author: William Durand <william.durand1@gmail.com>
# Enhanced by: ChatGPT for PHP 8.3 / namespace migration support

CURRENT=`pwd`

function check_permissions_and_namespaces {
    local path=$1

    if [ ! -w "$path" ]; then
        echo "  ⚠️  Directory not writable: $path"
    fi
}

function check_class_generated {
    local class=$1
    local path=$2

    if ! grep -q "class $class" "$path" 2>/dev/null; then
        echo "  ❌ Missing class definition for $class in: $path"
    fi
}

function rebuild {
    local dir=$1

    echo "[ $dir ]"

    if [ ! -f "$FIXTURES_DIR/$dir/build.properties" ]; then
        echo "  -> Skipping (no build.properties)"
        return
    fi

    local build_dir="$FIXTURES_DIR/$dir/build"
    local sql_file="$build_dir/sql/${dir}.sql"
    local map_file="$build_dir/sql/sqldb.map"
    local classes_dir="$build_dir/classes"

    if [ -d "$build_dir" ]; then
        rm -rf "$build_dir"
    fi

    mkdir -p "$build_dir/sql" "$build_dir/classes" "$build_dir/conf"
    check_permissions_and_namespaces "$build_dir"
    check_permissions_and_namespaces "$build_dir/sql"
    check_permissions_and_namespaces "$build_dir/classes"

    # Detect schema files
    echo "  -> Scanning for schema files..."
    local schema_files=$(find "$FIXTURES_DIR/$dir" -maxdepth 1 -type f -name '*schema.xml' -o -name 'schema.xml')
    if [ -z "$schema_files" ]; then
        echo "  ⚠️  No schema XML files found in $FIXTURES_DIR/$dir"
    else
        echo "  -> Found schema files:"
        echo "$schema_files" | sed 's/^/     - /'
    fi

    echo "  -> Generating SQL..."
    php "$ROOT/generator/bin/propel-gen" "$FIXTURES_DIR/$dir" sql -verbose 2>&1 | tee "$build_dir/sql/generation.log"

    if [ -z "$(find "$build_dir/sql" -name '*.sql')" ]; then
        echo "  ⚠️  No SQL files generated in $build_dir/sql/"
        echo "  -> Trying fallback target 'main'..."
        php "$ROOT/generator/bin/propel-gen" "$FIXTURES_DIR/$dir" main -verbose 2>&1 | tee -a "$build_dir/sql/generation.log"
    fi

    if [ -f "$map_file" ]; then
        echo "  -> Inserting SQL..."
        php "$ROOT/generator/bin/propel-gen" "$FIXTURES_DIR/$dir" insert-sql -verbose | tee -a "$build_dir/sql/insertion.log"
    else
        echo "  ⚠️  No sqldb.map found. Skipping insert-sql."
    fi

    # Check for known model class presence
    if [ -f "$classes_dir/${dir}/Table4.php" ]; then
        check_class_generated "Table4" "$classes_dir/${dir}/Table4.php"
    else
        echo "  ❌ Expected class file not found: $classes_dir/${dir}/Table4.php"
    fi
}


# Set base paths
if [ -d "$CURRENT/fixtures" ]; then
    ROOT=".."
    FIXTURES_DIR="$CURRENT/fixtures"
elif [ -d "$CURRENT/test/fixtures" ]; then
    ROOT="."
    FIXTURES_DIR="$CURRENT/test/fixtures"
else
    echo "❌ ERROR: No 'test/fixtures/' directory found!"
    exit 1
fi

echo "Resetting test fixtures..."
echo "=========================="

DIRS=`ls "$FIXTURES_DIR"`

for dir in $DIRS; do
    if [ -d "$FIXTURES_DIR/$dir" ] && [ "$dir" != "reverse" ]; then
        rebuild "$dir"
    fi
done

# Reverse fixtures
echo ""
echo "Processing reverse fixtures..."
echo "============================="

if [ -d "$FIXTURES_DIR/reverse" ]; then
    REVERSE_DIRS=`ls "$FIXTURES_DIR/reverse"`

    for dir in $REVERSE_DIRS; do
        if [ -f "$FIXTURES_DIR/reverse/$dir/build.properties" ]; then
            echo "[ reverse/$dir ]"
            echo "  -> Inserting SQL..."
            php "$ROOT/generator/bin/propel-gen" "$FIXTURES_DIR/reverse/$dir" insert-sql -verbose
        fi
    done
fi

echo ""
echo "✅ Fixture reset complete!"
