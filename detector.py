from sys import argv
from scipy import ndimage
import numpy as np
import scipy

def returnObjects (file):
    im = scipy.misc.imread(file, flatten=1)
    im = np.where(im > 180, 0, 1)
    label_im, num = ndimage.label(im)
    slices = ndimage.find_objects(label_im)

    print '['

    counter = 0;
    for s in slices:
        height, width = label_im[s].shape

        if width > 300 and height > 300:
            prefix = ',' if counter > 0 else ''

            print '%s{"x":%d,"y":%d,"width":%d,"height":%d}' % (prefix, s[1].start, s[0].start, width, height)

            # Increase counter
            counter += 1

    print ']'

# If-test to ensure code only executed if ran as stand-alone app.
if __name__ == "__main__":
     returnObjects(argv[1])