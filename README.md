# Image-in-image detector
Detects images in images

## Installation
In order to use the tool, you need to have the following installed;

- PHP
- Python
- tesseract-ocr
- tesseract-ocr-nor

## Usage
```sh
python detector.py images/
FILE:: images/page2.jpg
  OBJECTSTART::
    upper left: 533 , 103
    lower right: 602 , 143
  OBJECTEND::

  OBJECTSTART::
    upper left: 552 , 144
    lower right: 603 , 177
  OBJECTEND::

  OBJECTSTART::
    upper left: 518 , 179
    lower right: 622 , 240
  OBJECTEND::

  OBJECTSTART::
    upper left: 518 , 295
    lower right: 624 , 435
  OBJECTEND::

  OBJECTSTART::
    upper left: 520 , 494
    lower right: 625 , 627
  OBJECTEND::

  OBJECTSTART::
    upper left: 519 , 679
    lower right: 625 , 820
  OBJECTEND::
  ```
