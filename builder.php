<?php

$json = file_get_contents('data.json');
$data = json_decode($json, true);

foreach($data["clubs"] as $club){
  $clubFile = $club["id"].".html"; // or .php
  $fh = fopen($clubFile, 'w'); // or die("error");
  fwrite($fh, $club["name"]);
}
