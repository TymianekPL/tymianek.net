<?php
if (!function_exists("getUserName")) {

     function getUserName(int $id): string|null
     {
          $conn = OpenDB();
          $sql = "SELECT * FROM users WHERE ID=$id";
          $res = $conn->query($sql);
          if ($res->num_rows > 0) {
               $row = $res->fetch_assoc();
               return $row["Name"];
          } else {
               return null;
          }
     }

     define('USERGET_SESSION', 0);


     function isUserLogin(int $method): bool
     {

          if (!isset($_SESSION["id"])) {
               return false;
          }
          if ($method === USERGET_SESSION) {
               $user = $_SESSION["id"];
               return getUserName($user) !== null;
          }
          return false;
     }

     function getUser(): User|null
     {
          if (!isset($_SESSION["id"])) {
               return null;
          }
          return new User($_SESSION["id"]);
     }

     class User
     {
          static function get_current_user(): User|null
          {
               if (isset($_SESSION["id"])) {
                    return new User($_SESSION["id"]);
               } else {
                    return NULL;
               }
          }

          function setName(string $name)
          {
               $db = OpenDB();
               $name = mysqli_escape_string($db, $name);
               $sql = "UPDATE users SET Name='$name' WHERE ID=$this->ID;";
               $db->query($sql);
          }

          function isDeveloper(): bool
          {
               $conn = OpenDB();
               $sql = "SELECT Developer FROM users WHERE id=$this->ID";
               $res = $conn->query($sql);
               if ($res->num_rows > 0) {
                    return $res->fetch_assoc()["Developer"];
               } else {
                    return NULL;
               }
          }

          function setDeveloper(bool $enabled)
          {
               $db = OpenDB();
               $newpassword = mysqli_escape_string($db, $enabled ? "1" : "0");
               $sql = "UPDATE users SET Developer='$newpassword' WHERE ID=$this->ID;";
               $db->query($sql);
               return $sql;
          }

          function isLight(): bool
          {
               $conn = OpenDB();
               $sql = "SELECT Light FROM users WHERE id=$this->ID";
               $res = $conn->query($sql);
               if ($res->num_rows > 0) {
                    return $res->fetch_assoc()["Light"];
               } else {
                    return NULL;
               }
          }

          function setLight(bool $enabled)
          {
               $db = OpenDB();
               $newpassword = mysqli_escape_string($db, $enabled ? "1" : "0");
               $sql = "UPDATE users SET Light='$newpassword' WHERE ID=$this->ID;";
               $db->query($sql);
               return $sql;
          }

          function setPass(string $newpassword)
          {
               $db = OpenDB();
               $newpassword = sha1(mysqli_escape_string($db, $newpassword));
               $sql = "UPDATE users SET PasswordSHA1='$newpassword' WHERE ID=$this->ID;";
               $db->query($sql);
          }

          public int $ID;
          function __construct(int $id)
          {
               $this->ID = $id;
          }

          function getName(): string|null
          {
               return getUserName($this->ID);
          }


          function getToken(): string | NULL
          {
               $conn = OpenDB();
               $sql = "SELECT Token FROM users WHERE id=$this->ID";
               $res = $conn->query($sql);
               if ($res->num_rows > 0) {
                    return $res->fetch_assoc()["Token"];
               } else {
                    return NULL;
               }
          }
     }
}
