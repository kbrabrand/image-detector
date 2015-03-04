from sys import argv, exit
import Image
import os

# If-test to ensure code only executed if ran as stand-alone app.
if __name__ == "__main__":
    if len(argv) < 3:
        print "Usage python stitcher.py tilesfolder outputfile"
        exit(1)

    image00 = Image.open(os.path.join(argv[1], '0-0.jpg'));
    image01 = Image.open(os.path.join(argv[1], '0-1.jpg'));
    image02 = Image.open(os.path.join(argv[1], '0-2.jpg'));
    image10 = Image.open(os.path.join(argv[1], '1-0.jpg'));
    image11 = Image.open(os.path.join(argv[1], '1-1.jpg'));
    image12 = Image.open(os.path.join(argv[1], '1-2.jpg'));
    image20 = Image.open(os.path.join(argv[1], '2-0.jpg'));
    image21 = Image.open(os.path.join(argv[1], '2-1.jpg'));
    image22 = Image.open(os.path.join(argv[1], '2-2.jpg'));
    image30 = Image.open(os.path.join(argv[1], '3-0.jpg'));
    image31 = Image.open(os.path.join(argv[1], '3-1.jpg'));
    image32 = Image.open(os.path.join(argv[1], '3-2.jpg'));

    im = Image.new("RGB", (1024*3, 1024*4), "white")

    im.paste(image00, (1024*0, 1024*0))
    im.paste(image01, (1024*1, 1024*0))
    im.paste(image02, (1024*2, 1024*0))
    im.paste(image10, (1024*0, 1024*1))
    im.paste(image11, (1024*1, 1024*1))
    im.paste(image12, (1024*2, 1024*1))
    im.paste(image20, (1024*0, 1024*2))
    im.paste(image21, (1024*1, 1024*2))
    im.paste(image22, (1024*2, 1024*2))
    im.paste(image30, (1024*0, 1024*3))
    im.paste(image31, (1024*1, 1024*3))
    im.paste(image32, (1024*2, 1024*3))

    im.save(argv[2]);