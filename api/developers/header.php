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
     <link rel="stylesheet" href="/static/assets/css/style.css">
     <link rel="stylesheet" href="/static/assets/css/responsive.css">
     <style>
          .dropdown {
               position: relative;
               display: inline-block;
               margin: none;
               padding: none;
               margin-top: -7px;
          }

          .dropdown-content {
               display: none;
               position: absolute;
               min-width: 160px;
               background-color: #2d2d2d;
               box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
               margin-top: 55px;
               z-index: 1;
          }

          .dropdown:hover .dropdown-content,
          .dropdown:active .dropdown-content {
               display: block;
          }
     </style>
</head>

<body>
     <nav class="menu no-select">
          <span href="/api/developers/" class="title no-link" style="cursor: pointer;" href="/api/developers/docs/">Developers portal</span>

          <span class="func-username func-user-location">Loading...</span>
          <div class="dropdown">
               <span>Mouse over me</span>
               <div class="dropdown-content">
                    <p>Hello World!</p>
               </div>
          </div>
     </nav>
     <div class="container">
