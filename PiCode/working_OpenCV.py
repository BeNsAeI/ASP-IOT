import cv2
import numpy as np
import time
import sys
from threading import Thread

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

def unwarp(img,xmap,ymap):
    output = cv2.remap(img,xmap,ymap,cv2.INTER_LINEAR)
    return output

class Threads:
    def  __init__(self, name, first):
        self.name = name
        self.img = None
        self.xmap = None
        self.ymap = None
        self.frames = None
        self.vc = []
        self.count = 0
        self.first=first
        self.thread = []

    def start(self):
        self.frames = cv2.VideoCapture("/home/pi/node-rtsp-rtmp-server/public/picam/stream/98.ts")
	#+str(self.first+self.count-1)+".ts")
        for i in range(0,20):
            success, frame = self.frames.read()
            self.vc.append(frame)
        self.img = self.vc[4]
        centerX = 410
        centerY = 282
        innerRadiusX = 508
        innerRadiusY = 268
        innerRadius = innerRadiusX-centerX
        outerRadiusX = 644
        outerRadiusY = 270
        outerRadius = outerRadiusX-centerX
        finalImageWidth = round(float(max(innerRadius, outerRadius)) * 2.0 * np.pi)
        finalImageHeight = (outerRadius-innerRadius)
        self.xmap,self.ymap = buildMap(finalImageWidth,finalImageHeight,innerRadius,outerRadius,centerX,centerY)
        for i in range(0,4):
            self.thread.append(Thread(target=self.run, name=self.name+str(i), args=[i]))
        for i in range(0,4):
            self.thread[i].start()
    def run(self,num):
        start = (self.first - 2) * 16 + 1
        i = num + 1
        while i <= 16:
            img = self.vc[3+i]
            result = unwarp(self.img,self.xmap,self.ymap)
            fname = "/home/ffmpeg/frames/FRAME{num:05d}.png".format(num=start + i)
            cv2.imwrite(fname,result)
            i += 4
#print cv2.__version__
myThreads = Threads("360_Came",int(sys.argv[1]))
myThreads.start()
