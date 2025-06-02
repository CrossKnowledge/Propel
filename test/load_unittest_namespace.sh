# Add the use statement for PHPUnit\Framework\TestCase to files that don't have it
find test/ -name "*.php" -type f -exec grep -l "extends PHPUnit_Framework_TestCase" {} \; | while read file; do
    if ! grep -q "use PHPUnit\\\\Framework\\\\TestCase" "$file"; then
        # Add the use statement after the first <?php tag
        sed -i '/<\?php/a\
use PHPUnit\\Framework\\TestCase;' "$file"
    fi
done

# Replace PHPUnit_Framework_TestCase with TestCase
find test/ -name "*.php" -type f -exec sed -i 's/extends PHPUnit_Framework_TestCase/extends TestCase/g' {} \;

# Also handle any direct references to PHPUnit_Framework_TestCase::
find test/ -name "*.php" -type f -exec sed -i 's/PHPUnit_Framework_TestCase::/TestCase::/g' {} \;