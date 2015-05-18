<?php
$ona = file_get_contents("data/ona_data/json/cultural_sites_earthquake_damage.json");
$osm = file_get_contents("data/osm_data/json/export.json");
$mockup = file_get_contents("data/mockup/mockup.json");
$json_ona = json_decode($ona, true);
$json_osm = json_decode($osm, true);
$json_mockup = json_decode($mockup, true);
$merge = array_merge($json_osm, $json_mockup);
$result = array_unique($merge, SORT_REGULAR);
//print_r($result);
$a=($merge['elements']);
foreach ($result as $key => $value){
$mb[]= ($value['name']);
$mr[] = $value['religion'];
}
for ($i=0;$i<count($mb);$i++){
$ab[] = array(
		array('name'=> $mb[$i]),
		array('religion' => $mr[$i])
);
}
foreach ($a as $key => $value){
if (array_key_exists('tags',$value)){
$tag = $value['tags'];
if (array_key_exists('name', $tag)){
$b[] = $value['tags']['name'];
if (array_key_exists('religion', $tag)){
$c[] = $value['tags']['religion'];
}
}
}
}
for ($i=0;$i<count($b);$i++){
$ac[] = array(
	array('name' => $b[$i]),
	array('religion' => $c[$i])
);
}
$merged = array_merge($ab,$ac);
//print_r($merged);
foreach ($merged as $key => $value)
{
$merged_name[] = $value[0]['name'];
$merged_religion[] = $value[1]['religion'];
}
foreach ($json_ona as $key=>$value){
$ona_name[] = $value[temple_name];
}
$n= [];
$r = [];
for ($i=0;$i<count($ona_name);$i++){
for($j=0;$j<count($merged_name);$j++){
similar_text($ona_name[$i],$merged_name[$j],$percent);
if ($percent> 80){
array_push($n,$ona_name[$i]);
array_push($r, $merged_religion[$j]);
}
}
}
?>
