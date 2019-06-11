#!/usr/bin/env python

import colorsys
import time
from random import randint
from sys import exit

import unicornhat as unicorn

print("""Random Color Blinks
""")

unicorn.set_layout(unicorn.AUTO)
unicorn.rotation(0)
unicorn.brightness(1)

while True:

    r = int(randint(0, 255))
    g = int(randint(0, 255))
    b = int(randint(0, 255))
    unicorn.set_all(r, g, b)
    unicorn.show()
    time.sleep(5)
