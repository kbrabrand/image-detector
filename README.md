# Image-in-image detector
Detects images in images

## Installation
In order to use the tool, you need to have the following installed;

- PHP
- Python
- tesseract-ocr
- tesseract-ocr-nor

## Preparations
Before running the extractor you should have a folder containing the images (obviously). The output is put in folders named the same as the input files – `sourcefolder/page1337.jpg` will result in `destinationfolder/page1337.jpg/0.jpg`.

The outputfolder needs to be writeable by the user running the PHP command.

## Usage
```sh
php extractor.php source destination
```

## Licence
Copyright (c) 2015, [Kristoffer Brabrand](mailto:<kristoffer@brabrand.no>)

Licensed under the MIT License