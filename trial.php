<?php
$mockup = file_get_contents("data/mockup/mockup.json");
$json_mockup = json_decode($mockup, true);
$ona = file_get_contents("data/ona_data/json/cultural_sites_earthquake_damage.json");
$json_ona = json_decode($ona, true);
//print_r($json_ona);
//print_r($json_mockup);
echo "<br/>";
$osm = file_get_contents("data/osm_data/json/export.json");
$json_osm = json_decode($osm, true);
//print_r($json_osm);
echo "<br/>";
foreach ($json_ona as $key=>$value){

$ona_name[] = $value[temple_name];

}
print_r($ona_name);
?>
