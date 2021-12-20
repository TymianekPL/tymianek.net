<?php
header("Access-Control-Allow-Origin: *", true);
header("Access-Control-Allow-Headers: *", true);
header("content-type: application/json", true);
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
     die();
}
if ($_GET["api"] !== '/') {
     $api = __DIR__ . $_GET["api"] . ".php";
     if (str_starts_with("user", $_GET["api"])) {
          if (file_exists($api)) {
               $file = fopen($api, "r");
               echo fread($file, filesize($api));
               fclose($file);
          } else {
               http_response_code(404);
               $file = fopen(__DIR__ . "/404.php", "r");
               echo fread($file, filesize($api));
               fclose($file);
          }
     } else {
          if (file_exists($api)) {
               //$file = fopen($api, "r");
               //echo (fread($file, filesize($api)));
               //fclose($file);
               if (!isset(getallheaders()['authorization'])) {
                    http_response_code(401);
                    echo '{"error": "Please add authorization header to your request", "code": 401, "headers": ' . json_encode(getallheaders()) . '}';
                    die();
               }
               $auth = getallheaders()['authorization'];
               include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
               include $_SERVER["DOCUMENT_ROOT"] . "/users.php";
               $db = OpenDB();
               $auth = mysqli_escape_string($db, $auth);
               $mode = "Unknown";
               $user = null;
               $integration = null;
               $applicaton = null;
               if ($auth !== "no-token") {
                    $sql = "SELECT * FROM users WHERE Token = '$auth';";
                    $res = $db->query($sql);
                    if ($res->num_rows > 0) {
                         $user = new User($res->fetch_assoc()["ID"]);
                         $mode = "User";
                    } else {
                         http_response_code(401);
                         echo '{"error": "authorization header is invalid", "code": 401}';
                         die();
                    }
               } else {
                    $mode = "no-token";
               }
               try {
                    include $api;
               } catch (Exception $e) {
                    http_response_code(500);
                    echo '{"code": 500}';
               }
          } else {
               http_response_code(404);
               echo '{"error": "Not found", "code": 404}';
          }
     }
} else {
     echo '{"response": "Redirecting..."}';
     header("location:/api/developers", true);
}
