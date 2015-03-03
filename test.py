import os
from sys import argv
import numpy as np
import scipy
from scipy import ndimage

def returnObjects (file):
    print ''
    print 'FILE::', file

    im = scipy.misc.imread(file, flatten=1)
    im = np.where(im > 150, 0, 1)
    label_im, num = ndimage.label(im)
    slices = ndimage.find_objects(label_im)
    centroids = ndimage.measurements.center_of_mass(im, label_im, xrange(1,num+1))

    angles = []
    for s in slices:
        height, width = label_im[s].shape

        if width > 35:
            print '  OBJECTSTART::'
            print '    upper left:', s[1].start, ',', s[0].start
            print '    lower right:', s[1].start + width, ',', s[0].start+height
            print '  OBJECTEND::'
            print ''

# If-test to ensure code only executed if ran as stand-alone app.
if __name__ == "__main__":
     rootdir = argv[1];

     for subdir, dirs, files in os.walk(rootdir):
        for file in files:
            returnObjects(os.path.join(subdir, file))