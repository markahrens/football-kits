<?php

// Building the style sheet

require "vendor/leafo/scssphp/scss.inc.php";
$scss = new scssc();
$scss->setImportPaths("scss");
$styles = $scss->compile('@import "styles.scss"');
if (!is_dir("build/css")){
  mkdir("build/css", 0755, true);
}
$cssFile = "build/css/styles.css";
$fh = fopen($cssFile, 'w'); // or die("error");
fwrite($fh, $styles);


// Building the Data File
$dataFile = "data.json";

$dataFileContents = '{"clubs":
  [';

if ($handle = opendir('data')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          $c = fopen("data/".$entry, "r") or die("Unable to open file!");
          $dataFileContents .= fread($c,filesize("data/".$entry)) . ',';
          fclose($c);
        }
    }
    closedir($handle);
}
$dataFileContents = rtrim($dataFileContents, ",");

$dataFileContents .= '  ]
}';

$fh = fopen($dataFile, 'w'); // or die("error");
fwrite($fh, $dataFileContents);


// Building the site

$json = file_get_contents('data.json');
$data = json_decode($json, true);
$data = $data["clubs"];
usort($data, function($a, $b) {
    if ($a['country'] == $b['country']) {
        return strcmp($a["name"], $b["name"]);
    }
    return strcmp($a["country"], $b["country"]);
});

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$filter = new Twig_SimpleFilter('flagify', function ($code) {
  $country = str_split($code);
  return json_decode('"'.letterLookup($country[0]).letterLookup($country[1]).'"'); 
 
});
$twig->addFilter($filter);



$clubTemplate = $twig->loadTemplate('club.html');

foreach($data as $club){
  if (!is_dir("build/".strtolower($club["country"])))
  {
      mkdir("build/".strtolower($club["country"]), 0755, true);
  }
  $clubFile = "build/".strtolower($club["country"])."/".$club["id"].".html"; // or .php
  $fh = fopen($clubFile, 'w'); // or die("error");
  $page = $clubTemplate->render(array('club' => $club));
  fwrite($fh, $page);
}

$indexFile = "build/index.html"; // or .php
$fh = fopen($indexFile, 'w'); // or die("error");
$indexTemplate = $twig->loadTemplate('index.html');
$index = $indexTemplate->render(array('clubs' => $data));
fwrite($fh, $index);

function letterLookup($letter){
  $letters = array(
    "A" => "\uD83C\uDDE6",
    "B" => "\uD83C\uDDE7",
    "C" => "\uD83C\uDDE8",
    "D" => "\uD83C\uDDE9",
    "E" => "\uD83C\uDDEA",
    "F" => "\uD83C\uDDEB",
    "G" => "\uD83C\uDDEC",
    "H" => "\uD83C\uDDED",
    "I" => "\uD83C\uDDEE",
    "J" => "\uD83C\uDDEF",
    "K" => "\uD83C\uDDF0",
    "L" => "\uD83C\uDDF1",
    "M" => "\uD83C\uDDF2",
    "N" => "\uD83C\uDDF3",
    "O" => "\uD83C\uDDF4",
    "P" => "\uD83C\uDDF5",
    "Q" => "\uD83C\uDDF6",
    "R" => "\uD83C\uDDF7",
    "S" => "\uD83C\uDDF8",
    "T" => "\uD83C\uDDF9",
    "U" => "\uD83C\uDDFA",
    "V" => "\uD83C\uDDFB",
    "W" => "\uD83C\uDDFC",
    "X" => "\uD83C\uDDFD",
    "Y" => "\uD83C\uDDFE",
    "Z" => "\uD83C\uDDFF",
  );
  return $letters[$letter];
}
