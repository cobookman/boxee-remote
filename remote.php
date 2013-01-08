<?php
$boxeeIP = "192.168.1.103";

if(empty($_POST['command'])) {
  return false;
}
$command = "";
//Send the requested Command
switch($_POST['command']) {
  case 'up' :
    $command = "SendKey(270)";
    break;
  case 'down' :
    $command = "SendKey(271)";
    break;
  case 'left' :
    $command = "SendKey(272)";
    break;
  case 'right' :
    $command = "SendKey(273)";
    break;
  case 'enter' :
    $command = "SendKey(256)";
    break;
  case 'pause'  :
    $command = "Pause";
    break;
  case 'mute'  :
    $command = "Mute";
    break;
  case 'home'  :
    $command = "SendKey(275)";
    break;
  case 'char' :
    //Check if ASCII String is set
    if(empty($_POST['asscii'])) {
      return false;
    } else {
      //Send char
      $value = ord($_POST['ascii'][0]) + 61696;
      $command = "SendKey($value)";
    }
    break;
  case 'volume' :
    if(empty($_POST['volume']) ) {
      return false;
    } elseif(isPercent($_POST['volume'])) {
      $command = "SetVolume(".$_POST['volume'].")";
    }
    break;
  case 'getVolume' : 
    $command = "GetVolume";
    break;
  case 'SEEK' :
    if(empty($_POST['seek'])) {
      return false;
    } elseif(isPercent($_POST['seek'])) {
      $command = "SeekPercentage(".$_POST['seek'].")";
    }
    break;
  default:
    return false;
}


echo file_get_contents("http://$boxeeIP:8800/xbmcCmds/xbmcHttp?command=$command");

function isPercent($percent) {
  if($percent <= 100 && $percent >= 0) {
    return true;
  } else {
    return false;
  }

}
?>
