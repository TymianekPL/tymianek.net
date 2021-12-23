<?php
if ($mode !== "no-token") {
     http_response_code(401);
     echo '{"error": "Unauthorized", "code": 401}';
     die();
}
$method = $_SERVER["REQUEST_METHOD"];
if ($method === "POST") {
     $_POST = json_decode(file_get_contents('php://input'), true);
     if (isset($_POST["email"]) && isset($_POST["password"])) {
          $email = mysqli_escape_string($db, filter_var($_POST["email"]));
          $password = sha1(mysqli_escape_string($db, filter_var($_POST["password"])));
          $sql = "SELECT * FROM users WHERE Email = '$email' AND PasswordSHA1 = '$password';";
          $res = $db->query($sql);
          if ($res->num_rows > 0) {
               $row = $res->fetch_assoc();
               echo '{"token": ' . json_encode($row["Token"]) . ', "code": 200}';
          } else {
               http_response_code(422);
               echo '{"error": "Invalid email/password", "code": 422}';
          }
     } else {
          http_response_code(422);
          echo '{"error": "Parameter is missing", "code": 422}';
     }
} else {
     http_response_code(405);
     echo '{"error": "We don\' accept ' . $method . ' requests here", "code": 405}';
}
