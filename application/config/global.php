<?php

if (!defined('__SITE_PATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | MartensMVC GLobal config
  | -------------------------------------------------------------------
  | In this file you can put your global variables and define constants.
  | 
  | Constants that are reserved for the application:
  |	
  | __SITE_PATH				    Path of the root of website.
  | __APPLICATION_PATH		Path to the application.
  | __CONFIG_PATH			    Path to the configs.
  | __CONTROLLER_NAME     Name of the controller.
  |
 */
function datetimeToTimestamp($str) {
    if(substr($str, 0,1) == '0')
      return 0;

    list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);
    
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    
    return $timestamp;
}

function timestampToDatetime($str){
  if(!is_numeric($str))
      return "0000-00-00 00:00:00";

  return date('Y-m-d H:i:s', $str);
}

function calculateAge($date){
  if($date == 0)
    return 0;
  
  $birthdate = new DateTime($date);
  $today     = new DateTime();
  $interval  = $today->diff($birthdate);
  return $interval->format('%y');
}

/* End of file global.php */
/* Location: ./application/config/global.php */