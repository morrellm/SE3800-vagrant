<?php
//general install function
function install($src, $destFilename)
{
    $handle = @fopen($src, "r");
    if ($handle === false)
    {
        echo "Failed to install $destFilename...";
    }
    else
    {
        $content = stream_get_contents($handle);
        @fclose($handle);
        if ($content === false)
        {
            echo "Failed to read $destFilename";
        }
        else
        {
            $destHandle = @fopen($destFilename, "c+");
            if ($destHandle === false)
            {
                echo "Failed to create $destFilename file to write downloaded content.";
            }
            else
            {
                $result = fwrite($destHandle, $content);

                if ($result === false)
                {
                    echo "Failed to write downloaded $destFilename to a file";
                }
                else
                {
                    @fclose($destHandle);
                }

            }
        }
    }
}

//codeception install
install("http://codeception.com/codecept.phar", "web/vendor/codecept.phar");

?>