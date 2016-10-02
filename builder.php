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

$filter = new Twig_SimpleFilter('bobber', function ($string) {
    $g = intval('0x'.dechex(127397 + ord("G")));
    $b = "\u".dechex(127397 + ord("B"));
    
    if (!is_int($g)) {
        exit("$g is not integer\n");
    }

    // UTF-8 prohibits characters between U+D800 and U+DFFF
    // https://tools.ietf.org/html/rfc3629#section-3
    //
    // Q: Are there any 16-bit values that are invalid?
    // http://unicode.org/faq/utf_bom.html#utf16-7

    if ($g < 0 || (0xD7FF < $g && $g < 0xE000) || 0x10FFFF < $g) {
        exit("$cp is out of range\n");
    }

    if ($g < 0x10000) {
        return json_decode('"\u'.bin2hex(pack('n', $g)).'"');
    }
    $lead = 0xD800 - (0x10000 >> 10) + ($g >> 10);
    echo(bin2hex(pack('n', $lead)));
    $trail = 0xDC00 + ($g & 0x3FF);
    return json_decode('"\u'.bin2hex(pack('n', $lead)).'\u'.bin2hex(pack('n', $trail)).'"'); 
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
