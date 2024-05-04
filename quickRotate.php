<?php

    error_reporting(E_ALL);

    $rotateAll = 1; // 0: Rotate all images; 1: Rotate only even images; 2: Rotate only odd images;
    $pattern = array("*.[Jj][Pp][Gg]", "*.[Jj][Pp][Ee][Gg]"); // pattern (or multiple patterns) of the files you want to rotate
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
            if ($number % 2 == 0) { // Is it even?
                if ($rotateAll == 0 || $rotateAll == 1) { // all, or only even images
                    $image = imagerotate($image, $degrees, $transparency); // rotate the image
                    echo("         Rotating ${filename}\n");
                } else {
                    echo("     Not Rotating ${filename}\n");
                }
            } else { // or is it odd?
                if ($rotateAll == 0 || $rotateAll == 2) { // all, or only odd images
                    $image = imagerotate($image, $degrees, $transparency); // rotate the image
                    echo("         Rotating ${filename}\n");
                } else {
                    echo("     Not Rotating ${filename}\n");
                }
            }

            imagejpeg($image, $filename, 100); // write image back to the file
            unset($image); // free memory by deleting the variable
        }
    }

?>
