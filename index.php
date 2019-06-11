<?php
/* R2D2 Button Controls */
/* eventually going to break this up properly */
# sounds dir
$sounds = '/var/www/html/sounds';
$soundsdir = '/sounds'; # for html link
# load sound bytes into array  -- was going to json encode this for the sound bytes to play, but GOOGLE BLOCKS AUDIO loaded via javascript, ugh.  So, php it is -- you'll
# get different/random sound bytes on page load.
$soundbytes = preg_grep('/^([^.])/', scandir($sounds));
$count = count($soundbytes);
// var_dump(print_r($soundbytes));
function fromRGB($R, $G, $B) {
    $R = dechex($R);
    if (strlen($R) < 2)
        $R = '0' . $R;
    $G = dechex($G);
    if (strlen($G) < 2)
        $G = '0' . $G;
    $B = dechex($B);
    if (strlen($B) < 2)
        $B = '0' . $B;
    return '#' . $R . $G . $B;
}
function getColor() {
    $rgb_arr = [];
    $cp = $_GET['cp'];
    $rgb = preg_replace("/[^0-9,]/", '', $cp);
    $rgb_arr = preg_split("/\,/", $rgb);
    $r = $rgb_arr[0];
    $g = $rgb_arr[1];
    $b = $rgb_arr[2];
    $rgb_return['rgb'] = $r . ',' . $g . ',' . $b;
    $rgb_return['r'] = $r;
    $rgb_return['g'] = $g;
    $rgb_return['b'] = $b;
    $rgb_return['hex'] = fromRGB($r, $g, $b);
    return $rgb_return;
}
if (isset($_GET['action'])) {
    shell_exec('sudo /var/www/html/scripts/cleanup.sh'); // kill all current processes before launching a new one
    switch ($_GET['action']):
        case($_GET['action'] == 'colorchange'):
            $cp = $_GET['action'];
            $rgb = getColor();
            shell_exec('sudo /var/www/html/scripts/rgb.py ' . $rgb[r] . ' ' . $rgb[g] . ' ' . $rgb[b]);
            break;
        case($_GET['action'] == 'cheerlights'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/cheerlights.py');
            break;
        case($_GET['action'] == 'rainbow'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/rainbowbright.py');
            break;
        case($_GET['action'] == 'pulse'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/blinkybright.py');
            break;
        case($_GET['action'] == 'snow'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/sparkle.py');
            break;
        case($_GET['action'] == 'flicker'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/flicker.py');
            break;        
        case($_GET['action'] == 'spiral'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/spiral.py');
            break;        
        case($_GET['action'] == 'off'):
            $cp = $_GET['action'];
            shell_exec('sudo /var/www/html/scripts/rgb.py 0 0 0');
            break;
        default:
            break;
    endswitch;
}
?>
<head>
    <title>R2D2 Light</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cyborg/bootstrap.min.css" rel="stylesheet" integrity="sha384-mtS696VnV9qeIoC8w/PrPoRzJ5gwydRVn0oQ9b+RJOPxE1Z1jXuuJcyeNxvNZhdx" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js" integrity="sha256-Y27a5HlqZwshkK8xfNfu6Y0c6+GGX9wTiRe8Xa8ITGY=" crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" integrity="sha256-iu+Hq7JHYN0rAeT3Y+c4lEKIskeGgG/MpAyrj6W9iTI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!------ Include the above in your HEAD tag ---------->
</head>
<style>  
    body {
        background-image: url('/img/swars.png');
        background-repeat: repeat;
    }   
    @media screen and (max-width: 1024px) {
        body {
            font-size: xx-large !important;
        }
        .button {
            height: 200px !important;
            font-size: 50px !important;
        }
        .button2 {
            font-size: 35px !important;
            height: 225px !important;
            width:225px !important;
        }    
        .music {
            visibility: hidden;
            display: none;
        }
    }
    .btn-white{
        background-color: #fff;
        color: black !important;
    }
    .btn-white:hover{
        background-color: gainsboro;
    }    
    .btn-pink{
        background-color: pink;
        color: white !important;
    }
    .btn-pink:hover{
        background-color: plum;
    }   
    .btn-gold{
        background-color: gold;
        color: white !important;
    }
    .btn-gold:hover{
        background-color: goldenrod;
    }    
    .btn-neon{
        background-color: #00cccc;
        color: white !important;
    }
    .btn-neon:hover{
        background-color:#009999;
    }      
    .colorpicker.colorpicker-2x {
        width: 272px;
    }
    .colorpicker-alpha {display:none !important;} .colorpicker{ min-width:128px !important;}
    .colorpicker-2x .colorpicker-saturation {
        width: 200px;
        height: 200px;
    }
    .colorpicker-2x .colorpicker-hue,
    .colorpicker-2x .colorpicker-alpha {
        width: 30px;
        height: 200px;
    }
    .colorpicker-2x .colorpicker-alpha,
    .colorpicker-2x .colorpicker-preview {
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
    .colorpicker-2x .colorpicker-preview,
    .colorpicker-2x .colorpicker-preview div {
        height: 30px;
        font-size: 16px;
        line-height: 160%;
    }
    .colorpicker-saturation .colorpicker-guide {
        height: 10px;
        width: 10px;
        border-radius: 10px;
        margin: -5px 0 0 -5px;
    }
    .color-box {position: absolute; width: 50px; height: 50px; padding: 5px; vertical-align: middle; alignment-baseline: middle;}  
    .modal-backdrop.in {
        opacity: 0.9;
    }    
</style>

<script>
    var isMobile = false; //initiate as false  
    $(document).ready(function () {
        var is_mobile = false;
        $('#phonemodalshow').hide();
        $('#computermodalshow').hide();
        if ($('#music').css('display') == 'none') {
            $('#phonemodalshow').show();
        } else {
            $('#computermodalshow').show();
        }
        // now i can use is_mobile to run javascript conditionally
        $('#cppick').click(function () {            
            
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
            $('#cpModal').show();
        
        });
        $(".alert").click(function () {
            $(".alert").fadeOut("1000");
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });
        $(".modal button").click(function () {
            $(".modal").fadeOut("slow");
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });
        $("#cheerlights").click(function () {          
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
            alert('Cheerlights clicked.  Please be patient while we communicate with the API.  R2D2 will be updated when we receive a response from the server.');
        });
        $("#rainbow").click(function () {
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });
        $("#pulse").click(function () {
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });
        $("#spiral").click(function () {
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });    
        $("#flicker").click(function () {
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });          
        $("#snow").click(function () {
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });   
        $("#off").click(function () {
            alert('Shutting lights off.  Choose any action to turn them back on.');
            new Audio('<?= $soundsdir."/".$soundbytes[rand(0, $count-1)]?>').play();
        });        
    });
</script>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal" id="cpModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="computermodalshow">
            <form id="colorup" method="get" action="#">
                <input type="hidden" name="action" value="colorchange">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Color for R2D2</h5>
                    <button type="submit" class="btn btn-primary" id="save" data-action="save">Save & Update</button>
                </div>
                <div class="modal-body" style='font-size: 16px !important;'>
                    Use the color picker to choose an RGB color for R2D2.  Click on the input field below, then choose a color.  Once you have selected a color, click the save and
                    update button to dismiss the color picker and set the color.  Default is set to black, which will turn the lights off.

                    <input id="cp" name="cp" type="text" class="form-control input-lg" value="rgb(0, 0, 0)"/>
                </div>
                <div class="modal-footer text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; Close</span>
                    </button>  

                </div>
            </form>
        </div>
        <!-- phone or tablet show this -->
        <div class="modal-content" id="phonemodalshow">
            <form id="colorup2" method="get" action="#">
                <input type="hidden" name="action" value="colorchange">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Color for R2D2</h5>
                </div>
                <div class="modal-body">

                    <div class="row button-group">
                        <div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: black; color: white;" value="rgb(0, 0, 0)"/>Black (off)</button>
                        </div>
                        <div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-default-outline btn-block close" style="background-color: white important!; color: black;" value="rgb(255, 255, 255)"/>White</button>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: red; color: white;" value="rgb(255, 0, 0)"/>Red</button>
                        </div><div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: pink; color: white;" value="rgb(255, 96, 208)"/>Pink</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: orange; color: black;" value="rgb(255, 160, 16)"/>Orange</button></div>


                        <div class="col-md-6">
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: yellow; color: black;" value="rgb(255, 255, 0)"/>Yellow</button>


                        </div></div>
                    <div class="row">
                        <div class="col-md-6"> 
                            <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: green; color: white;" value="rgb(0, 0, 0)"/>Green</button>


                        </div>
                        <div class="col-md-6"> <button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: blue; color: white;" value="rgb(0, 0, 255)"/>Blue</button>
                        </div></div>
                    <div class="row">
                        <div class="col-md-6"><button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: lightskyblue; color: black;" value="rgb(0, 255, 255)"/>Cyan</button>
                        </div>
                        <div class="col-md-6"><button name="cp" type="submit" class="button2 btn btn-block close" style="background-color: purple; color: white;" value="rgb(99, 22, 115)"/>Purple</button>  
                        </div>
                    </div>

                </div>
                <div class="modal-footer text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; Close</span>
                    </button>  

                </div>
            </form>
        </div>     
    </div>
</div>

<script>
    $(function () {
        $('#cp').colorpicker({
            useAlpha: false,
            format: "rgb",
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
    });
</script>
<!DOCTYPE html>
<div class="text-center center pt-2"></div>
    <div class="container pt-2">
        <div>
            <h1 class="text-center"><img src="img/r2d2.png" style="height: 55px;"> Lamp Control  <img src="img/r2d2.png" style="height: 55px;"> </h1>    
</h1>    
            <hr style="background-color: white;">
        </div>
        <div class="form-group pt-2">
            <h4 class="text-center">This little dashboard controls all the actions available to the R2-D2 LED lamp.</h4>
            <button type="button" class="btn btn-primary button  btn-block action pt-2" id="cppick" data-action="solid" data-toggle="modal" data-target="#cpModal"><i class="fa fa-fill-drip"></i> Set Solid Color</button>  

            <a  href="?action=cheerlights"><button type="button" id='cheerlights' class="btn btn-secondary button btn-block action pt-2" data-action="cheerlights"><i class="fa fa-lightbulb"></i> Launch Cheerlights</button></a>

            <a  href="?action=rainbow"><button type="button" id="rainbow" class="btn btn-success  button btn-block action pt-2"  data-action="rainbow"><i class="fa fa-rainbow"></i> Make Rainbows</button></a>

            <a  href="?action=pulse"><button type="button" id="pulse" class="btn btn-info button  btn-block action pt-2"  data-action="pulse"><i class="fa fa-wave-square"></i> Pulse</button></a>
            <a  href="?action=spiral"><button type="button" id="spiral" class="btn btn-pink button  btn-block action pt-2"  data-action="spiral"><i class="fa fa-spinner"></i> Random Color Spiral</button></a>
            <a  href="?action=flicker"><button type="button" id="flicker" class="btn btn-neon button  btn-block action pt-2"  data-action="flicker"><i class="fa fa-flash"></i> Random Color Flash</button></a>
            <a  href="?action=snow"><button type="button" id="snow" class="btn btn-white button  btn-block action pt-2"   data-action="snow"><i class="fa fa-snowflake"></i> Hoth Mode - let it snow!</button></a>
            <a  href="?action=off"><button type="button" id="off" class="btn btn-danger button  btn-block action pt-2"   data-action="off"><i class="fa fa-power-off"></i> Turn off R2-D2</button></a>


        </div>
        <div class="text-center music" id="music">
            Some theme music for the occasion:<br>
            <audio controls>
                <source src="starwars.mp3" type="audio/ogg">
                <source src="horse.mp3" type="audio/mpeg">
            </audio>
        </div>
        <hr style="background-color: white;">
    </div></body>
<!-- Footer -->
<footer class="page-footer font-small blue pt-2">
    <!-- hyperjoule.io -->
    <div class="footer-copyright text-center">© 2019
        <a href="http://hyperjoule.io">j.stainbrook hyperjoule.io</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
