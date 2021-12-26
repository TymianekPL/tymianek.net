<?php
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
          header("Expires: on, " . date("D, d M Y H:i:s", time() + 240) . " GMT"); // 4 minutes
          header("Last-Modified: " . date("D, d M Y H:i:s", filemtime($file)) . " GMT");
          header('Cache-Control: max-age=86400');
          header("Content-Type: $type", true);
          $etag = md5($_GET["file"] . ":" . filemtime($file));
          header('ETag: ' . $etag);

          // Check whether browser had sent a HTTP_IF_NONE_MATCH request header
          if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
               // If HTTP_IF_NONE_MATCH is same as the generated ETag => content is the same as browser cache
               // So send a 304 Not Modified response header and exit
               if ($_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
                    header('HTTP/1.1 304 Not Modified', true, 304);
                    exit();
               }
          }

          $h = fopen($file, "r");
          $output = fread($h, filesize($file));
          include "./minify.php";
          if (preg_match('/css/', $type)) {
               $output = minify_css($output);
          } else if (preg_match("/javascript/", $type)) {
               $output = minify_js($output);
          }
          print $output;
          fclose($h);
     } else {
          error404($_GET["file"]);
     }
} else {
     error404($_GET["file"]);
}
