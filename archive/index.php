<?php
// Set vars
setlocale(LC_ALL, 'en_US.UTF-8');
date_default_timezone_set("Europe/Warsaw");

function error404($file = "/")
{
     http_response_code(404);
     echo '{"error": "Not found", "code": 404, "path": "' . $file . '"}';
     die();
}

function humanFileSize($size, $unit = "")
{
     if ((!$unit && $size >= 1 << 30) || $unit == "GB")
          return number_format($size / (1 << 30), 2) . "GB";
     if ((!$unit && $size >= 1 << 20) || $unit == "MB")
          return number_format($size / (1 << 20), 2) . "MB";
     if ((!$unit && $size >= 1 << 10) || $unit == "KB")
          return number_format($size / (1 << 10), 2) . "KB";
     return number_format($size) . " bytes";
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

function GetDirectorySize($path)
{
     $bytestotal = 0;
     $path = realpath($path);
     if ($path !== false && $path != '' && file_exists($path)) {
          foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
               $bytestotal += $object->getSize();
          }
     }
     return $bytestotal;
}

if (!isset($_GET["file"])) {
     error404();
} else {
     $path = str_replace("..", "", $_GET["file"]);
     $file = __DIR__ . "/data" . $path;
     if (file_exists($file)) {
          if (is_dir($file)) {
?>

               <!DOCTYPE html>
               <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
               <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
               <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
               <!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
               <html lang="en">

               <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>
                         Index of <?= $path ?>
                    </title>
                    <meta name="description" content="Index of <?= $path ?> - Tymianek archive">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="/static/assets/css/style.css">
               </head>

               <body class="container">
                    <!--[if lt IE 7]>
                              <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
                         <![endif]-->
                    <h1>Index of <code><?= $path ?></code></h1>
                    <table style="margin-bottom: 10px;">
                         <thead>
                              <tr>
                                   <th>Name</th>
                                   <th>Size</th>
                                   <th>Type</th>
                                   <th>Modified</th>
                                   <th>Download</th>
                              </tr>
                         </thead>
                         <tbody style="letter-spacing: 2px; font-size: 1em;">
                              <?php
                              $directories = array();
                              $files_list  = array();
                              $files = scandir($file);
                              $p = $file;
                              $filesC = 0;
                              $dirsC = 0;

                              foreach ($files as $file) {
                                   if ($path != "/" || $file != '..') {
                                        if (is_dir($p . '/' . $file)) {
                                             $directories[]  = $file;
                                        } else {
                                             $files_list[]    = $file;
                                        }
                                   }
                              }
                              if ($path == "/") {
                                   $files = array_diff($files, [".."]);
                              }
                              foreach ($directories as $fl) {
                                   $dirsC++;
                                   $realFl = "data/$path/$fl";
                                   $type = "[DIR]";
                                   $size = humanFileSize(GetDirectorySize($realFl));
                                   $fileHref = $fl;
                                   if ($fl == "..") {
                                        $newarr = explode("/", str_replace("\\", "/", "/archive/$path"));
                                        array_pop($newarr);
                                        $fileHref = join("/", $newarr);
                                   }
                              ?>
                                   <tr>
                                        <td href="<?= $fileHref ?>"><?= $fl ?></td>
                                        <td><?= $size ?></td>
                                        <td><?= $type ?></td>
                                        <td><?= date("g:i A d/n/Y", filemtime($realFl)) ?></td>
                                        <td class="no-select" style="color: lightgray; cursor: not-allowed;">Not avaible</td>
                                   </tr>
                              <?php
                              }
                              foreach ($files_list as $fl) {
                                   $filesC++;
                                   $realFl = "data/$path/$fl";
                                   $type = "[FILE]";
                                   $size = "";
                                   if (str_contains($fl, ".")) {
                                        $type = substr(strrchr($fl, '.'), 1);
                                   } else {
                                        $type = "[FILE]";
                                   }
                                   $size = humanFileSize(filesize($realFl));
                                   $fileHref = $fl;
                                   if ($fl == "..") {
                                        $newarr = explode("/", str_replace("\\", "/", "/archive/$path"));
                                        array_pop($newarr);
                                        $fileHref = join("/", $newarr);
                                   }
                              ?>
                                   <tr>
                                        <td href="<?= $fileHref ?>"><?= $fl ?></td>
                                        <td><?= $size ?></td>
                                        <td><?= $type ?></td>
                                        <td><?= date("g:i A d/n/Y", filemtime($realFl)) ?></td>
                                        <td title="Download <?= $fl ?> file" href="<?= $fl ?>&download">Download</td>
                                   </tr>
                              <?php
                              }
                              ?>
                         </tbody>
                    </table>
                    <h4>
                         Found <span style="color:lime"><?= $filesC ?></span> files and <span style="color:lime"><?= $dirsC ?></span> directories
                         </div>
                         <script src=" /static/assets/js/main.js" async defer>
                         </script>
               </body>

               </html>

<?php
          } else {
               $type = get_mime_type($file);
               header("Expires: on, " . date("D, d M Y H:i:s", time() + 240) . " GMT"); // 4 minutes
               header("Last-Modified: " . date("D, d M Y H:i:s", filemtime($file)) . " GMT");
               header('Cache-Control: max-age=86400');
               if (isset($_GET["download"])) {
                    header("Content-Type: application/octet-stream", true);
                    header('Content-Disposition: attachment; filename="' . $file .  "\"", true);
               } else {
                    header("Content-Type: $type", true);
               }
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
               header("Content-Length: " . filesize($file), true);
               while (!feof($h)) {
                    $buffer = fgets($h, 1 << 24);
                    echo $buffer;
               }
               fclose($h);
          }
     } else {
          error404($_GET["file"]);
     }
}
