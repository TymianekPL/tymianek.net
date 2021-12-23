<?php
if ($mode !== "User") {
     http_response_code(401);
     echo '{"error": "Unauthorized", "code": 401}';
     die();
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
     $css = $user->getCSS();
     $css = $css != NULL ? $css : "";
     echo '{"css": ' . json_encode($css) . '}';
} else if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
     $_PATCH = json_decode(file_get_contents("php://input"), true);
     if (isset($_PATCH["css"])) {
          $name = $_PATCH["css"];
          $user->setCSS($name);
          http_response_code(200);
          echo '{"response": "success", "code": 200}';
     } else {
          http_response_code(422);
          echo '{"error": "Parameter is missing", "code": 422}';
     }
} else {
     http_response_code(405);
     echo '{"error": "We don\' accept ' . $_SERVER["REQUEST_METHOD"] . ' requests here", "code": 405}';
}
