<?php
http_response_code(404);
$url = strtok($_SERVER["REQUEST_URI"], '?');
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
     <title>Tymianek.net</title>
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="/assets/css/style.css">
     <link rel="stylesheet" href="/assets/css/responsive.css">
     <style>
          h1.error {
               margin-top: 1em;
               font-size: 7em;
               font-weight: 500;
          }
     </style>
</head>

<body class="container">
     <!--[if lt IE 7]>
               <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->

     <h1 class="error">404</h1>
     <h2>Error 404 - Not Found</h2>
     <p class="lead"><code><?= $url ?></code> wasn't found on this server</p>
     <span href="javascript:window.history.go(-1)">Go back</span>

     <script src="/assets/js/main.js" async defer></script>
</body>

</html>