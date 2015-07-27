<?php
/**
*  HELPERS
*  @nanodesigns
*  
*  All the necessary codes we need throughout
*   the project for various common purposes
*/



/**
*  COLOR: HEX VALUE TO RGB CONVERTER
*  Source: http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*  Thanks to: c.bavota
*
*  @returns: array()
*  three indexes with R-G-B
*
*  Usage:
*  $rgb = hex2rgb('#333');
*  $r = $rgb[0];
*  $g = $rgb[1];
*  $b = $rgb[2];
*
*  echo '<div style="background-color: rgba('. $r .','. $g .','. $b .',0.3);">Text Here</div>';
*/

function hex2rgb($hex) {
  $hex = str_replace("#", "", $hex);

  if(strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
  } else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
  }
  $rgb = array($r, $g, $b);
  //return implode(",", $rgb); // returns the rgb values separated by commas
  return $rgb; // returns an array with the rgb values
}



/**
*  COLOR: HEX VALUE TO LIGHTER HEX VALUE
*  Source: http://themes.goodlayers2.com/tourpackage/
*  Thanks to: Goodlayers
*
*  @returns: hex value of lighter color
*
*  Usage:
*  $background = #333;
*  gdl_hex_lighter( $background, 20 );
*/

function nanodesigns_hex_lighter($hex, $factor = 40) { 
  $new_hex = ''; 

  $base['R'] = hexdec($hex{1}.$hex{2}); 
  $base['G'] = hexdec($hex{3}.$hex{4}); 
  $base['B'] = hexdec($hex{5}.$hex{6}); 

  foreach ($base as $k => $v) 
    {
    $amount = 255 - $v; 
    $amount = $amount / 100; 
    $amount = round($amount * $factor); 
    $new_decimal = $v + $amount; 

    $new_hex_component = dechex($new_decimal); 
    if(strlen($new_hex_component) < 2) 
       { $new_hex_component = "0".$new_hex_component; } 
    $new_hex .= $new_hex_component; 
    }
       
   return '#' . $new_hex;     
}



/**
*  COLOR: HEX VALUE TO DARKER HEX VALUE
*  Source: http://themes.goodlayers2.com/tourpackage/
*  Thanks to: Goodlayers
*
*  @returns: hex value of darker color
*
*  Usage:
*  $background = #333;
*  gdl_hex_darker( $background, 20 );
*/

function nanodesigns_hex_darker($hex, $factor = 30){
    $new_hex = '';

    $base['R'] = hexdec($hex{1}.$hex{2});
    $base['G'] = hexdec($hex{3}.$hex{4});
    $base['B'] = hexdec($hex{5}.$hex{6});

    foreach ($base as $k => $v)
           {
           $amount = $v / 100;
           $amount = round($amount * $factor);
           $new_decimal = $v - $amount;

           $new_hex_component = dechex($new_decimal);
           if(strlen($new_hex_component) < 2)
                   { $new_hex_component = "0".$new_hex_component; }
           $new_hex .= $new_hex_component;
           }
           
    return '#' . $new_hex;        
 }