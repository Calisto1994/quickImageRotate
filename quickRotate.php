<?php
    error_reporting(E_ALL);

    $rotateAll = false; // if false, only even files are rotated (e.g. image 2, 4, 6, 8 and so on) per directory
    $pattern = array("*.JPG"); // pattern (or multiple patterns) of the files you want to rotate
    // Instead of using an array, you may also just use this: $pattern = "*.jpg"; –– if you just need a single pattern.
    $degrees = 180; // how many degrees should the files become rotated?
    $startPath = "./1927/"; // default: the scripts very own directory ("./"), but can be set to any other.

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
            rotateAllJPEG($path, $pattern);

        foreach (glob("${path}*/") as $dirname) {
            _readDir($dirname); // join into sub-directories and repeat what we're doing here;
        }
    }

    function rotateAllJPEG ($path, $glob) {
        global $degrees, $rotateAll;
        $number = 0;

        foreach (glob($path.$glob) as $filename) {
            $image = imagecreatefromjpeg($filename); // open image file
            $transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
            // Transparency might be required if you're rotating not in 90-degrees steps but e.g. 45 degrees
            $number++;
            if ($number % 2 == 0) {
                if ($rotateAll == true) {
                    $image = imagerotate($image, $degrees, $transparency); // rotate the image
                    echo("     ${filename} is being rotated...\n");
                } else 
                    echo("     ${filename} is NOT being rotated...\n");
            } else {
                $image = imagerotate($image, $degrees, $transparency); // rotate the image
                echo("     ${filename} is being rotated...\n");
            }

            imagejpeg($image, $filename); // write image back to the file
            unset($image); // free memory by deleting the variable
        }
    }

?>
