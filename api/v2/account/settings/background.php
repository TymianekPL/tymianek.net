<?php
if ($mode !== "User") {
     http_response_code(401);
     echo '{"error": "Unauthorized", "code": 401}';
     die();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
     $db = OpenDB();
     $sql = "SELECT * FROM users WHERE ID=$user->ID;";
     $res = $db->query($sql);
     if ($res->num_rows > 0) {
          $row = $res->fetch_assoc();
          if ($row["CustomBackground"] == NULL) {
               echo '{}';
          } else {
               header("Content-Type: image/png", true);
               echo ($row["CustomBackground"]);
          }
     } else {
          echo '{"response": "Unknow error", "code": 500}';
          http_response_code(500);
     }
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
     $_PATCH = json_decode(file_get_contents("php://input"), true);
     if (isset($_FILES["background"])) {
          $imageFileType = strtolower(pathinfo(basename($_FILES["background"]["name"]), PATHINFO_EXTENSION));
          if ($_FILES["background"]["size"] > 10000000) {
               http_response_code(400);
               die('{"error": "Your file is too large", "code": 400}');
          } else if (
               $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
               && $imageFileType != "gif"
          ) {
               http_response_code(400);
               die('{"error": "Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "code": 400}');
          } else {
               $db = OpenDB();
               $file = base64_encode(file_get_contents($_FILES["background"]["tmp_name"]));
               $sql = "UPDATE users SET CustomBackground='$file' WHERE ID=$user->ID;";
               $res = $db->query($sql);
               if ($res) {
                    echo '{"response": "Success!", "code": 200}';
                    http_response_code(200);
               } else {
                    echo '{"code": 500, "response": ' . json_encode($res) . ', "sql": "' . $sql . '"}';
                    http_response_code(500);
               }
          }
     } else {
          $db = OpenDB();
          $sql = "UPDATE users SET CustomBackground='' WHERE ID=$user->ID;";
          $res = $db->query($sql);
          if ($res) {
               echo '{"response": "Success!", "code": 200}';
               http_response_code(200);
          } else {
               echo '{"code": 500, "response": ' . json_encode($res) . ', "sql": "' . $sql . '"}';
               http_response_code(500);
          }
     }
} else {
     http_response_code(405);
     echo '{"error": "We don\' accept ' . $_SERVER["REQUEST_METHOD"] . ' requests here", "code": 405}';
}
