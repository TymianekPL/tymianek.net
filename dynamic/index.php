<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header("Content-Type: application/json");

date_default_timezone_set("Europe/Warsaw");

function error404($file = "/")
{
     http_response_code(404);
     echo '{"error": "Not found", "code": 404, "path": "' . $file . '"}';
     die();
}

function get_mime_type($filename, $mimePath = '.')
{
     $fileext = substr(strrchr($filename, '.'), 1);
     if (empty($fileext)) return (false);
     $regex = "/^([\w\+\-\.\/]+)\s+(\w+\s)*($fileext\s)/i";
     $lines = file("$mimePath/mime.types");
     foreach ($lines as $line) {
          if (substr($line, 0, 1) == '#') continue; // skip comments
          $line = rtrim($line) . " ";
          if (!preg_match($regex, $line, $matches)) continue; // no match to the extension
          return ($matches[1]);
     }
     return (false); // no match at all
}

if (!isset($_GET["file"])) {
     error404();
} else if ($_GET["file"] !== '/') {
     $file = __DIR__ . "/data" . str_replace("..", "", $_GET["file"]);
     if (file_exists($file) && !is_dir($file)) {
          $type = get_mime_type($file);
          include "./minify.php";
          $h = fopen($file, "r");
          $output = fread($h, filesize($file));
          if (preg_match('/css/', $type)) {
               $output = minify_css($output);
          } else if (preg_match("/javascript/", $type)) {
               $output = minify_js($output);
          }
          header("Content-Type: $type", true);

          print $output;
          fclose($h);
     } else {
          error404($_GET["file"]);
     }
} else {
     error404($_GET["file"]);
}
