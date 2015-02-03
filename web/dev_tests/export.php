<?php
function dirMoveAllFiles($srcDir, $destDir)
{
    $src = opendir($srcDir);
    if ($src === false) {
        return false;
    }
    while($entry = readdir($src))
    {
        if (strpos($entry, ".") !== 0)
        {
            $contents = @file_get_contents("$srcDir/$entry");
            if ($contents !== false)
            {
                $result = @fopen("$destDir/$entry", "c+");
                $result = !!$result && fclose($result);
                $result &= @file_put_contents("$destDir/$entry", $contents);
            }
            else
            {
                $result = false;
            }
            if ($result === false)
            {
                echo "Failed to move: ";
            }
            else
            {
                echo "Moved: ";
            }

            echo "$srcDir/$entry to $destDir/$entry\n";
        }
    }
    closedir($src);

    return true;
}

$unitResult = dirMoveAllFiles("web/dev_tests/unit", "tests/unit");
$functResult = dirMoveAllFiles("web/dev_tests/functional", "tests/functional");
$acceptResult = dirMoveAllFiles("web/dev_tests/acceptance", "tests/acceptance");

if ($unitResult === false || $functResult === false || $acceptResult === false)
{
    echo "Failure to migrate one or more test directories!
        (Unit: " . $unitResult . ", Functional: " . $functResult . ", Acceptance: " . $acceptResult . ")\n";
}
?>