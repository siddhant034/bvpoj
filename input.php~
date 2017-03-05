<?php
$myfile = fopen("src.cpp", "w") or die("Unable to open file!");
$txt = $_POST["sCode"];
fwrite($myfile, $txt);
exec('g++ src.cpp -o src.out',$output,$status);
//exec('sudo python checker.py',$output,$status);
exec('./src.out',$output,$status);
echo str_replace('Array','',print_r($output,true));
fclose($myfile);
?>
