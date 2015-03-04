# Downloader and image in image detector
Built as part of the *Våre helter* project at Verdens Gang. Takes care of downloading and stitching page tiles, detection of images in pages and OCR of names of the people in the pictures.

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
### Crawler/downloader
The script will fetch tiles from Nationalbiblioteket for the pages and stitch them together.

In order to download the pages from the four volumes, use the following command:

```sh
php crawler/crawler.php destinationDirectory volumeNumber fromPage toPage
```


### Extractor
Takes care of extracting images from pages and running OCR on the text under the pictures.

```sh
php extractor.php folderWithImages destinationForExtraction
```

## Licence
Copyright (c) 2015, [Kristoffer Brabrand](mailto:<kristoffer@brabrand.no>)

Licensed under the MIT License
