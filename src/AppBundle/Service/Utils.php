<?php
namespace AppBundle\Service;



class Utils
{

	 function __construct() {
    }
  // *********************************
  public  function fecha_to_es($fecha) {
    $arr = explode (" ", $fecha);
    $arrFecha = explode("-", $arr[0]);
    $newFecha = $arrFecha[2]."/".$arrFecha[1]."/".$arrFecha[0];
    if (isset($arr[1]))
        $newFecha .= " ".$arr[1];
    
    return $newFecha;
}
}