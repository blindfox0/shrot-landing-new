<?php
header('Content-Type: application/json');

$dir = "./gigs/";

function cleanDirs($var) {
  return(
    (is_file("./gigs/" . $var) && !(str_ends_with($var, '~')))
  );
}

$a = scandir($dir);
$aFiltered = array_values(array_filter($a, "cleanDirs"));
$aFilteredJSON = json_encode($aFiltered);

echo $aFilteredJSON;
