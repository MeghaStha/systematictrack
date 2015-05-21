<?php
$ona = file_get_contents("data/ona_data/json/convertcsv.json");
$mockup = file_get_contents("data/mockup/mockup.json");
$json_ona = json_decode($ona, true);
$json_mockup = json_decode($mockup, true);



function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        //echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        //echo "ok!!";
        break;

    default:
        //echo "ok!!";
        break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}



set_error_handler("myErrorHandler");

foreach ($json_ona as $key=>$value){
$ona_id[] = $value['Id'];
$ona_name[] = $value['temple_name'];
$ona_tole[] = $value['tole_name'];
}
foreach ($json_mockup as $key => $value){
$mockup_id[] = $value['ID'];
$mockup_name[] = $value['name'];
$mockup_religion[] = $value['religion'];
$mockup_tole[] = $value['tolename'];
}
for($i=0;$i<count($ona_id);$i++){
if (in_array($ona_id[$i],$mockup_id)){
	$final[] = array(
		array ('id' => $ona_id[$i]),
		array ('name' => $ona_name[$i]),
		array ('tolename' => $ona_tole[$i]),
		array ('surveyed' => 'yes' )
	);
}
}
for($j=0;$j<count($mockup_id);$j++){
//try{
if(!($ona_id[$j])) echo "";
if (!(in_array($ona_id[$j],$mockup_id))){
$final1[] = array(
		array ('id' => $mockup_id[$j]),
		array ('name' => $mockup_name[$j]),
		array ('tolename' => $mockup_tole[$j]),
		array ('surveyed' => 'no' )
	);
}
//}
//catch(Exception $e){//do nothing
//}
}

$result = array_merge($final, $final1);

echo json_encode($result);

?>
