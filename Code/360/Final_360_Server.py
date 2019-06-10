# --------------------------------------------------------
# Camera sample code for Tegra X2/X1
#
# This program could capture and display video from
# IP CAM, USB webcam, or the Tegra onboard camera.
# Refer to the following blog post for how to set up
# and run the code:
#   https://jkjung-avt.github.io/tx2-camera-with-python/
#
# 1st Written by JK Jung <jkjung13@gmail.com>
#------------------------------------------------------
# Edited By Sarahi Pelayo
#
# now this program uses only the on board camera to to 
# capture video and dewarps it so 360 video viewing is
# possible.
# --------------------------------------------------------


import sys
import argparse
import cv2
import numpy as np


WINDOW_NAME = 'CameraDemo'

centerX = 1980/2-165
centerY = 1080/2-65
#innerRadiusX = 0
#innerRadiusY = 0
innerRadius = 210 #innerRadiusX-centerX
#outerRadiusX = 350
#outerRadiusY = 270
outerRadius = 425 #outerRadiusX-centerX
finalImageWidth = round(float(max(innerRadius, outerRadius)) * 2.0 * np.pi)
finalImageHeight = (outerRadius-innerRadius)

def buildMap(finalImageWidth,finalImageHeight,innerRadius,outerRadius,centerX,centerY):
    map_x = np.zeros((int(finalImageHeight),int(finalImageWidth)),np.float32)
    map_y = np.zeros((int(finalImageHeight),int(finalImageWidth)),np.float32)
    rMap = np.linspace(innerRadius, innerRadius + (outerRadius - innerRadius), finalImageHeight)
    thetaMap = np.linspace(0, 0 + float(finalImageWidth) * 2.0 * np.pi, finalImageWidth)
    sinMap = np.sin(thetaMap)
    cosMap = np.cos(thetaMap)
    for y in xrange(0, int(finalImageHeight-1)):
       map_x[y] = centerX + rMap[y] * sinMap
       map_y[y] = centerY + rMap[y] * cosMap
    return map_x, map_y

def unwarp(img):
    global xmap, ymap
    output = cv2.remap(img,xmap,ymap,cv2.INTER_LINEAR)
    return output



def parse_args():
    # Parse input arguments
    desc = 'Capture and display live camera video on Jetson TX2/TX1'
    parser = argparse.ArgumentParser(description=desc)
    parser.add_argument('--width', dest='image_width',
                        help='image width [1920]',
                        default=1920, type=int)
    parser.add_argument('--height', dest='image_height',
                        help='image height [1080]',
                        default=1080, type=int)
    args = parser.parse_args()
    return args



def open_cam_onboard(width, height):
    # On versions of L4T prior to 28.1, add 'flip-method=2' into gst_str
    gst_str = ('nvcamerasrc ! '
               'video/x-raw(memory:NVMM), '
               'width=(int)2592, height=(int)1458, '
               'format=(string)I420, framerate=(fraction)30/1 ! '
               'nvvidconv ! '
               'video/x-raw, width=(int){}, height=(int){}, '
               'format=(string)BGRx ! '
               'videoconvert ! appsink').format(width, height)
    return cv2.VideoCapture(gst_str, cv2.CAP_GSTREAMER)


def open_window(width, height):
    cv2.namedWindow(WINDOW_NAME, cv2.WINDOW_NORMAL)
    cv2.resizeWindow(WINDOW_NAME, width, height)
    cv2.moveWindow(WINDOW_NAME, 0, 0)
    cv2.setWindowTitle(WINDOW_NAME, 'Camera Demo for Jetson TX2/TX1')


def read_cam(cap):
    show_help = True
    full_scrn = False
    help_text = '"Esc" to Quit, "H" for Help, "F" to Toggle Fullscreen'
    font = cv2.FONT_HERSHEY_PLAIN
    while True:
        if cv2.getWindowProperty(WINDOW_NAME, 0) < 0:
            # Check to see if the user has closed the window
            # If yes, terminate the program
            break
        _, img = cap.read() # grab the next image frame from camera
        #dewarp here
        #cv2.circle(img,(centerX,centerY), 10, (0,0,255))
        #cv2.circle(img,(centerX,centerY), innerRadius, (0,0,255))
        #cv2.circle(img,(centerX,centerY), outerRadius, (0,0,255))
        img = unwarp(img)
	#cv2.imwrite('test1.png',img) #saves the nextimage frame
        cv2.imshow(WINDOW_NAME, img)
        key = cv2.waitKey(10)
        if key == 27: # ESC key: quit program
            break
        elif key == ord('H') or key == ord('h'): # toggle help message
            show_help = not show_help
        elif key == ord('F') or key == ord('f'): # toggle fullscreen
            full_scrn = not full_scrn
            if full_scrn:
                cv2.setWindowProperty(WINDOW_NAME, cv2.WND_PROP_FULLSCREEN,
                                      cv2.WINDOW_FULLSCREEN)
            else:
                cv2.setWindowProperty(WINDOW_NAME, cv2.WND_PROP_FULLSCREEN,
                                      cv2.WINDOW_NORMAL)


def main():
    args = parse_args()
    print('Called with args:')
    print(args)
    print('OpenCV version: {}'.format(cv2.__version__))

    # by default, use the Jetson onboard camera
    cap = open_cam_onboard(args.image_width,
                          args.image_height)

    if not cap.isOpened():
        sys.exit('Failed to open camera!')

    open_window(args.image_width, args.image_height)
    global xmap, ymap
    xmap,ymap = buildMap(finalImageWidth,finalImageHeight,innerRadius,outerRadius,centerX,centerY)

    read_cam(cap)

    cap.release()
    cv2.destroyAllWindows()


if __name__ == '__main__':
    main()
