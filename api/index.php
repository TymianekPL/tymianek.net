<?php

header("Access-Control-Allow-Origin: *", true);
header("Access-Control-Allow-Headers: *", true);
header("content-type: application/json", true);
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
     die();
}
if (!isset($_GET["api"])) {
     http_response_code(404);
     echo '{"error": "Not found", "code": 404}';
} else if ($_GET["api"] !== '/') {

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
          $version = str_replace("v", "", explode("/", $_GET["api"])[1]);
          if (!in_array($version, [1, 2])) {
               http_response_code(426);
               echo '{"error": "You are using unsupported version on API!", "code": 426}';
               die();
          }
          if (file_exists($api)) {
               //$file = fopen($api, "r");
               //echo (fread($file, filesize($api)));
               //fclose($file);
               if (!isset(getallheaders()['authorization'])) {
                    http_response_code(401);
                    echo '{"error": "Please add authorization header to your request", "code": 401}';
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
               if ($version == 1) {
                    header("Warning: You are using outdated version, we recommend to use v2!");
                    if (
                         $auth !== "no-token"
                    ) {
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
               } else if ($version == 2) {
                    if (
                         $auth !== "no-token"
                    ) {
                         if ($_GET["api"] == "/media") {
                              $sql = "SELECT * FROM users WHERE Token='$auth'";
                              $res = $db->query($sql);
                              if ($res->num_rows > 0) {
                                   $row = $res->fetch_assoc();
                                   $exp = time() + 10;
                                   $sql = "INSERT INTO media_tokens (Token, AccountToken, expirity) VALUES ($token, $auth, $exp)";
                                   $db->query($sql);
                                   http_response_code(401);
                                   echo '{"error": "Unathorized", "code": 401}';
                                   die();
                              } else {
                                   http_response_code(401);
                                   echo '{"error": "Unathorized", "code": 401}';
                                   die();
                              }
                         } else {
                              $sql = "SELECT * FROM media_tokens WHERE Token='$auth'";
                              $res = $db->query($sql);
                              if ($res->num_rows > 0) {
                                   $row = $res->fetch_assoc();
                                   if (
                                        $row["expirity"] > time()
                                   ) {
                                        $sql = "DELETE FROM media_tokens WHERE Token='$auth';";
                                        $db->query($sql);
                                        http_response_code(401);
                                        echo '{"error": "Unathorized", "code": 401}';
                                        die();
                                   } else {
                                        $token = $row["AccountToken"];
                                        $sql = "SELECT * FROM users WHERE Token = '$token';";
                                        $res = $db->query($sql);
                                        if ($res->num_rows > 0) {
                                             $user = new User($res->fetch_assoc()["ID"]);
                                             $mode = "User";
                                        } else {
                                             http_response_code(401);
                                             echo '{"error": "Invalid Media Token", "code": 401}';
                                             die();
                                        }
                                   }
                              } else {
                                   http_response_code(401);
                                   echo '{"error": "Unathorized", "code": 401}';
                                   die();
                              }
                         }
                    } else {
                         $mode = "no-token";
                    }
               } else {
                    http_response_code(426);
                    echo '{"error": "You are using unsupported version on API!", "code": 426}';
               }
               try {
                    include $api;
                    if (!in_array($version, [2])) {
                         $json["warning"] = "You are using deprecated version of API";
                    }
                    print json_encode($json);
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