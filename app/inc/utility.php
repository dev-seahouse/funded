<?php
require dirname(__DIR__)."/_config/config.php";
function debug_to_terminal( $data ,$log_type = LOG_INFO) {

  if ( is_array( $data ) )
    $output = "Debug Objects: " . implode( ',', $data) ;
  else
    $output = "Debug Objects: " . $data ;
  if(DEBUG_ON) {
    error_log($data, $log_type);
  }
}

