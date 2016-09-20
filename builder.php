<?php

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


require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
));

$clubTemplate = $twig->loadTemplate('club.html');

$json = file_get_contents('test.json');
$data = json_decode($json, true);
$data = $data["clubs"];
usort($data, function($a, $b) {
    if ($a['country'] == $b['country']) {
        return strcmp($a["name"], $b["name"]);
    }
    return strcmp($a["country"], $b["country"]);
});

foreach($data as $club){
  $clubFile = "build/".$club["id"].".html"; // or .php
  $fh = fopen($clubFile, 'w'); // or die("error");
  $page = $clubTemplate->render(array('club' => $club));
  fwrite($fh, $page);
}

$indexFile = "build/index.html"; // or .php
$fh = fopen($indexFile, 'w'); // or die("error");
$indexTemplate = $twig->loadTemplate('index.html');
$index = $indexTemplate->render(array('clubs' => $data));
fwrite($fh, $index);
