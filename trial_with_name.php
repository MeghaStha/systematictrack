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
foreach ($value as $k => $v){
if ($k === 'name'){
$mb[]= $value['name'];
$mr[] = $value['religion'];
$mt[] = $value['tolename'];
}
}
}
for ($i=0;$i<count($mb);$i++){
$ab[] = array(
		array('name'=> $mb[$i]),
		array('religion' => $mr[$i]),
		array('tolename' => $mt[$i])
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
for ($i=0;$i<count($c);$i++){
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
if (array_key_exists(2, $value)){
$merged_tole[] = $value[2]['tolename'];
}
}
foreach ($json_ona as $key=>$value){
foreach ($value as $k => $v){
//echo "<br/>";
if ($k === 'temple_name'){
$ona_name[] = $value['temple_name'];
}
if ($k === 'tole_name'){
$ona_tole[] = $value['tole_name'];
}
}
}
for($j=0;$j<count($merged_name);$j++){
for ($i=0;$i<count($ona_name);$i++){
similar_text($ona_name[$i],$merged_name[$j],$percent);
similar_text($ona_tole[$i],$merged_tole[$j],$percent1);
//echo $ona_name[$i]."   ".$merged_name[$j]."   ".$merged_tole[$j]."  ".$ona_tole[$i]." ".$percent."  ".$percent1;

if (($percent> 80) &&($percent1>80)){
//echo $ona_name[$i].$merged_tole[$j].$percent;
echo "<br/>";
$final[] = array(
		array ('name' => $ona_name[$i]),
		array ('religion' => $merged_religion[$j]),
		array ('tolename' => $ona_tole[$i]),
		array ('surveyed' => 'yes')
		);

}
else {
$final1[] = array (
		array ('name' => $ona_name[$i]),
		array ('religion' => $merged_religion[$j]),
		array ('tolename' => $ona_tole[$i]),
		array ('surveyed' => 'no')
);
}
}
}
print_r($final);
?>
