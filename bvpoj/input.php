<?php

//set_time_limit(1);

ini_set('max_execution_time', 3);

function files_are_equal($a, $b)
{
  // Check if filesize is different
  if(filesize($a) !== filesize($b))
      return false;

  // Check if content is different
  $ah = fopen($a, 'rb');
  $bh = fopen($b, 'rb');

  $result = true;
  while(!feof($ah))
  {
    if(fread($ah, 8192) != fread($bh, 8192))
    {
      $result = false;
      break;
    }
  }
    fclose($ah);
  fclose($bh);

  return $result;
}

$myfile = fopen("src.cpp", "w") or die("Unable to open file!");
$txt = $_POST["sCode"];
$lang = $_POST["lang"];
if($lang!="C++(gcc-4.3.2)")
{
	print_r("Compilation Error");
	return;
}
fwrite($myfile, $txt);
exec('g++ src.cpp 2>&1 -o src.out',$output,$status);
//print_r($output);
if($status!=0)
{
	print_r("Compilation Error");
	return;
}
//exec('sudo python checker.py',$output,$status);
//exec("time ./src.out > /dev/null &",$output,$status);
//print_r($output);
exec('./src.out <b.in >b.out',$output,$status);

$user = fopen("b.out", "r") or die("Unable to open file!");
$test = fopen("bTest.out", "r") or die("Unable to open file!");

exec("diff b.out bTest.out",$output,$status);
if(empty($output))
	print_r("Accepted");
else
	print_r("Wrong Answer");

//print_r(files_are_equal($user,$test));
//if(files_are_equal($user,$test)=="false"))
//	print_r("Wrong Answer");
//else
//	print_r("Accepted");

//print_r($status);
//echo str_replace('Array','',print_r($output,true));
fclose($myfile);
?>
