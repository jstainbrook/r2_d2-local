<h2>Intranet controlled R2-D2 nightlight</h2>
<h2>
<div><p>Greetings!  This is the repository for a local version of the R2-D2 nightlight that lives here: <a href='http://r2d2.hyperjoule.io'>http://r2d2.hyperjoule.io</a></p></div>
  <div><p>To make this nightlight, you will need the following supplies:
    <ul>
      <li>A raspberry pi zero-w (available here:  <a href='https://www.adafruit.com/product/3400'>https://www.adafruit.com/product/3400</a></i>
    <li>A set of 40 pin headers: <a href='https://www.adafruit.com/product/2822'>https://www.adafruit.com/product/2822</a></li>
    <li>A Pimoroni UNICORN PHAT: <a href='https://www.adafruit.com/product/3181'>https://www.adafruit.com/product/3181</a></li>
    <li>A micro sd card: <a href='https://www.amazon.com/Kingston-16GB-microSDHC-microSD-SDCS/dp/B079H6PDCK'>https://www.amazon.com/Kingston-16GB-microSDHC-microSD-SDCS/dp/B079H6PDCK</a></li>
    <li>A power supply for your raspberry pi: <a href='https://www.amazon.com/CanaKit-Raspberry-Supply-Adapter-Listed/dp/B00MARDJZ4'>https://www.amazon.com/CanaKit-Raspberry-Supply-Adapter-Listed/dp/B00MARDJZ4</a></li>
    <li>And of course, your nightlight.  I used an R2-D2, but this could easily be ported to a different nightlight -- just have to change the html file to reflect. <a href='https://www.amazon.com/Awaken-Change-Multicolored-Living-Designed/dp/B01HRA2RN8'>https://www.amazon.com/Awaken-Change-Multicolored-Living-Designed/dp/B01HRA2RN8</a></li></ul>
<p>The nighlight itself, you are going to pretty much gut - take the bottom off completely, use wire cutters to cut everything out except the base that supports the acrylic, and you might even need to trim that down.   You are also going to need to widen the hole in the back of the base in order to get that usb power cable through to the pi. Throw away all the existing electronics -- you don't need them, the only thing you need for this project is the round base and acrylic.
      </p>
</div>
<div><p>This README.md only covers the R2-D1 nightlight in LOCAL MODE (setting up a web server on EC2, creating ssh keys back and forth to your home network, host port forwarding -- it is a bit of a process) on your home network.  For that reason, I suggest setting your pi-zero-w to have a static IP on your network.  Read your router configuration manual on how to set up a static IP.</p></div>
<div><p>Burn a copy of raspbian to an sd card and set up your pi-zero-w on your local network.  Make sure the following interfaces are enabled on your pi
  <pre>sudo raspi-config</pre>
  <ul><li>SSH</li>
    <li>SPI</li>
    <li>I2C</li>
    <li>Remote GPIO</li>
  </ul>
  <p>Also, while in the configuration screen, make sure your keyboard settings and localization settings are correct.  You might want to change your hostname from the default as well</p>   
 <p>There are some things you are going to need to install on your raspberry pi in order to run this code.</p></div>
<div><p>Once your raspberry pi is setup on your home network, ssh to it on your home network with pi@127.0.[whatever the rest of the local ip is] or by ssh pi@hostname.local if you have bonjour service installed.</p></div>
<div><p>Run:<br>
<pre>
sudo apt-get update
sudo apt-get upgrade
</pre>
<div>Now that that's done, we need to make some changes on the pi itself.  Run the following command:
<pre>
sudo visudo
</pre>
Select 2 nano as your editor.  Add this line:
<pre>
# Members of the admin group may gain root privileges
%admin  ALL=(ALL) NOPASSWD:ALL
</pre>
 CTRL-X to save.  Now we need to edit our user groups:
<pre>
sudo vigr
</pre>
Confirm 2 as your editor again.  Scroll to where the admin group is listed and change the line to this:
<pre>
admin:x:1001:pi,www-data
</pre>
CTRL-X to save.  What you have just done is allow www-data to execute sudo commands -- necessary to run the python scripts that drive the UNICORN pHAT.
<div>
<p>Next step is to configure the pi to talk to the unicorn pHat.
  <pre>sudo raspi-config</pre>
  
Now you are ready to install your webserver.  Follow this guide here: <a href='https://howtoraspberrypi.com/how-to-install-web-server-raspberry-pi-lamp/'>https://howtoraspberrypi.com/how-to-install-web-server-raspberry-pi-lamp/</a></p></div>
<div><p>The next step is to install the packages and dependencies your nightlight is going to need to run.  The documentation for the unicorn pHat is here.  Pimoroni has made a really great nifty little install tool that makes setting up the unicorn pHat a breeze. <a href='https://learn.pimoroni.com/tutorial/sandyj/getting-started-with-unicorn-phat'>https://learn.pimoroni.com/tutorial/sandyj/getting-started-with-unicorn-phat</a>.
<pre>
curl https://get.pimoroni.com/unicornhat  | bash
</pre>
There are also some additional libraries required for some of the python scripts:
<pre>
sudo apt-get install python-pip
sudo pip install requests
sudo pip install numpy
sudo pip install webcolors
</pre>
<p>
Move all the files in this repo to /var/www/html.  Make sure your permissions are correct and everything in /var/www/html/scripts is executable:
<pre>
cd ~/scripts
sudo chmod 755 *
</pre>
 And... reboot your pi:
 <pre>
 sudo reboot
 </pre>
 Once your pi has rebooted, point your web browser to its IP on your network or hostname.local and have fun!
 </p>
 </div>
 <div>
  <p>Todo:  Clean up mobile - having issues closing the bootstrap color changing modal on my phone</p>
 </div>
 <div>
  <p>-- hyperjoule.io</p>
  
  
