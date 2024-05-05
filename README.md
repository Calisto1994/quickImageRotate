### quickImageRotate PHP Script

quickImageRotate does exactly, what the name suggests: It rotates images. But it does more than this.

## Features
- Rotate images throughout a directory and all of its sub-directories
- Rotate only even or odd images (considering the images in the directories to be sorted in alpha-numerical order)
- Output JPEG files with a user-defined level of quality (you might even rotate by 0 degrees and just set quality to, e.g., 20% in order to compress images to a smaller size; )

## But how to use quickImageRotate?

Well, that's quite simple, see here:

```php
    $rotateAll = 0; // 0: Rotate all images; 1: Rotate only even images; 2: Rotate only odd images;
    $pattern = array("*.[Jj][Pp][Gg]", "*.[Jj][Pp][Ee][Gg]"); // pattern (or multiple patterns) of the files you want to rotate
    // Instead of using an array, you may also just use this: $pattern = "*.jpg"; –– if you just need a single pattern.
    $degrees = 180; // how many degrees should the files become rotated? 180 degrees would be upside down.
    $quality = 96; // desired quality level of the output images; Most images use compression and are set to 90-95% quality. Here, default is 96.
    $startPath = "./"; // default: the scripts very own directory ("./"), but can be set to any other.
```

This is the default configuration of the script. It will rotate ALL images (not only even or odd; see `$rotateAll` setting;
It also rotates all images ending on .jpg or .jpeg in a case-insensitive way using a specified pattern. That pattern may be edited to fit whatever file extensions desired; But remember: The script code is *only* prepared to read *JPEG* format files.
If you'd like the script to read *PNG* files (for example), some changes to the code would be required to make it happen - even though these changes would be minimal. (Will add this to the README later.)
Also, images are rotated by 180° - so they'll be upside-down once you launch the script. The quality will be 96%, so there's only little compression applied to the edited JPEG image. If there was more compression in the original image imported by the script, the file size may *grow* even though, of course, existing JPEG compression artifacts will remain.

And, last but not least: `$startPath` is where the script begins to do its magical trick. You may modify this to, e.g., rotate all images in your pictures folder on your computer. If you're on Linux, it might look like this:
`$startPath = "/home/username/Pictures/";`. The script defaults to using its own directory (e.g. if the script is in `/var/www/html/images/`, it might rotate all images of your website) to start.

So, if you want to use this tool, just take your hands on these settings and modify them to whatever you want it to do.

## Additional info!

Even if an image is *not* rotated (e.g. since you've enabled only rotating odd or even images), you might notice that *all* images are updated to use the configured quality. This is done intentional; All images are updated to the same quality level once they fit the pattern.
