<?php
$cityState = array("81611" => "Aspen, Colorado","81411" => "Bedrock, Colorado");

$zip = $_GET["zip"];

if (array_key_exists($zip, $cityState)){
  print $cityState[$zip];
}else{
  print ",";
}

?>
