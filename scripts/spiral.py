#!/usr/bin/python
# -*- coding: utf-8 -*-

import unicornhat as unicorn
import time, datetime
import webcolors
from random import randint

unicorn.rotation(90)
unicorn.brightness(1)


def left(stop, start, row, colour):
    for x in range(start-1, stop-1, -1):
        unicorn.set_pixel(x, row, colour[0], colour[1], colour[2])
        unicorn.show()
        time.sleep(0.1)

def right(start, stop , row, colour):
    for x in range(start, stop, 1):
        unicorn.set_pixel(x, row, colour[0], colour[1], colour[2])
        unicorn.show()
        time.sleep(0.1)

def up(stop, start, column, colour):
    for y in range(start-1, stop, -1):
        unicorn.set_pixel(column, y, colour[0], colour[1], colour[2])
        unicorn.show()
        time.sleep(0.1)

def down(start, stop, column, colour):
    for y in range(start, stop, 1):
        unicorn.set_pixel(column, y, colour[0], colour[1], colour[2])
        unicorn.show()
        time.sleep(0.1)

def curlicue(start, stop, iterations):
  for z in range(iterations):
    right (start+z,stop-z,start+z,(randint(0, 255),randint(0, 255),randint(0, 255)))
    down  (start+z,stop-z,(stop-1)-z,(randint(0, 255),randint(0, 255),randint(0, 255)))
    left  (start+z,stop-z,(stop-1)-z,(randint(0, 255),randint(0, 255),randint(0, 255)))
    up    (start+z,stop-z,start+z,(randint(0, 255),randint(0, 255),randint(0, 255)))

while True:
    curlicue(1,7,1)
    time.sleep(5)