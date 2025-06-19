#!/usr/bin/env bash
# Run Propel tests with proper setup

SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ROOT_DIR="$( cd "$SCRIPT_DIR/.." && pwd )"

echo "Setting up Propel tests..."
echo "========================="

# Change to root directory
cd "$ROOT_DIR"

# Make scripts executable
chmod +x generator/bin/propel-gen
chmod +x generator/bin/phing.php
chmod +x test/reset_tests.sh

# Reset fixtures
echo ""
echo "Resetting test fixtures..."
cd test && ./reset_tests.sh
cd ..

# Check if fixtures were generated
if [ ! -d "test/fixtures/bookstore/build" ] ; then
    echo ""
    echo "ERROR: Fixtures were not generated properly!"
    echo "Please check the output above for errors."
    exit 1
fi

# Set up autoloader for generated classes
echo ""
echo "Setting up autoloader for test classes..."
if [ -f "test/fixtures/bookstore/build/conf/bookstore-conf.php" ] ; then
    export PROPEL_CONF_DIR="$ROOT_DIR/test/fixtures/bookstore/build/conf"
fi

# Run PHPUnit tests
echo ""
echo "Running PHPUnit tests..."
echo "======================="

# You can run specific test suites or files:
# php vendor/bin/phpunit test/testsuite/generator/
# php vendor/bin/phpunit test/testsuite/runtime/

# Or run all tests (might take a while):
php vendor/bin/phpunit

echo ""
echo "Test run complete!"