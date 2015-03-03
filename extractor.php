<?php

if (count($argv) < 3) {
    echo 'Usage: extractor.php readdir writedir' . PHP_EOL;
    exit;
}

$readdir = $argv[1];
$writedir = $argv[2];

function execute($command) {
    exec($command, $output);

    return implode($output);
}

function getImageDataFromFile($file) {
    $json = execute('python detector.py ' . $file);

    return json_decode($json, true);
}

function getNamesFromFile($file) {
    $ocrResult = execute('tesseract ' . $file . ' stdout -l nor');

    return $ocrResult;
}

function extractImageRegions($imagePath, $data, $writedir) {
    $filename = basename($imagePath);
    $outdir = $writedir . DIRECTORY_SEPARATOR . $filename;

    if (!is_dir($outdir)) {
        mkdir($outdir);
    }

    foreach ($data as $i=>$detectedRegion) {
        $inFile = $imagePath;
        $outFile = $outdir . DIRECTORY_SEPARATOR . $i . '.jpg';

        $image = new Imagick($imagePath);

        $image->cropImage(
            $detectedRegion['width'],
            $detectedRegion['height'] + 45, // Add some below the image to get the name
            $detectedRegion['x'],
            $detectedRegion['y']
        );

        $image->writeImage($outFile);
        $image->clear();

        var_dump($inFile, getNamesFromFile($outFile));
    }
}

if ($handle = opendir($readdir)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }

        $imagePath = $readdir . DIRECTORY_SEPARATOR . $entry;

        // Get image data
        $imageData = getImageDataFromFile($imagePath);

        // Extract image areas
        extractImageRegions($imagePath, $imageData, $writedir);
    }

    closedir($handle);
}