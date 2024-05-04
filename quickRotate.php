<?php
    error_reporting(E_ALL);

    $pattern = array("*.jpg"); // pattern (or multiple patterns) of the files you want to rotate
    $degrees = 180; // how many degrees should the files become rotated?
    $startPath = "./"; // default: the scripts very own directory ("./"), but can be set to any other.

    echo("Rotating images...\n");

    _readDir($startPath);

    echo ("Done.\n");



    function _readDir ($path) {
        global $pattern;
        echo("--- Directory ${path}\n");
        
        if (is_array($pattern)) { // multiple patterns?
            foreach ($pattern as $glob)
                rotateAllJPEG($path, $glob);    // rotate them all.
        } else
            rotateAllJPEG($path, "*.jpg");

        foreach (glob("${path}*/") as $dirname) {
            _readDir($dirname); // join into sub-directories and repeat what we're doing here;
        }
    }

    function rotateAllJPEG ($path, $glob) {
        global $degrees;

        foreach (glob($path.$glob) as $filename) {
            $image = imagecreatefromjpeg($filename); // open image file
            $transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
            // Transparency might be required if you're rotating not in 90-degrees steps but e.g. 45 degrees
            $image = imagerotate($image, $degrees, $transparency); // rotate the image
            echo("     ${filename} is being rotated...\n");

            imagejpeg($image, $filename); // write image back to the file
            unset($image); // free memory by deleting the variable
        }
    }

?>
