<?php
include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
if (isset($_GET["file"]) && $_GET["file"] != "" && isset($_GET["download"])) {
     $db = OpenDB();
     $uuid = mysqli_escape_string($db, $_GET["file"]);
     $sql = "SELECT * FROM tools_community WHERE UUID='$uuid';";
     $res = $db->query($sql);
     if ($res->num_rows > 0) {
          $row = $res->fetch_assoc();
          $file = "uploads/" . $uuid;
          $h = fopen($file, "r");
          header("Content-Length: " . filesize($file), true);
          header("Content-Type: application/octet-stream", true);
          header('Content-Disposition: attachment; filename="' . $row["Name"] .  ".dll\"", true);
          while (!feof($h)) {
               $buffer = fgets($h, 1 << 24);
               echo $buffer;
          }
          fclose($h);
     } else {
          http_response_code(404);
          die('{"error": "Not found", "code": 404}');
     }
     die();
}
include $_SERVER["DOCUMENT_ROOT"] . "/header.php";
if (isset($_GET["file"]) && $_GET["file"] != "") {
     include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
     include $_SERVER["DOCUMENT_ROOT"] . "/users.php";
     $db = OpenDB();
     $uuid = mysqli_escape_string($db, $_GET["file"]);
     $sql = "SELECT * FROM tools_community WHERE UUID='$uuid';";
     $res = $db->query($sql);
     if ($res->num_rows > 0) {
          $row = $res->fetch_assoc();
          $user = new User($row["Author"]);
?>
          <h1><?= $row["Name"] ?></h1>
          <h3>Author: <a href="/u/<?= $user->getUrl() ?>"><?= $user->getName() ?></a></h3>
          <button class="btn-green" href="/Tools/explore/<?= $uuid ?>&download"><span class="icon-download"></span> Download</button>
          <script>
               const icons = document.getElementsByClassName("icon-download");
               for (const key in icons) {
                    if (Object.hasOwnProperty.call(icons, key)) {
                         const icon = icons[key];
                         icon.innerHTML = `<\?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="25px" height="25px" viewBox="0 0 45.812 45.812" style="enable-background:new 0 0 45.812 45.812;"
	 xml:space="preserve">
		<path d="M21.407,34.002c0.367,0.37,0.944,0.573,1.521,0.573c0.515,0,1.153-0.203,1.52-0.572l11.399-11.481
			c0.561-0.563,0.726-1.408,0.418-2.139c-0.307-0.731-1.022-1.207-1.815-1.206l-3.72,0.03l0.054-16.288
			C30.777,1.306,29.469,0,27.854,0h-9.855c-1.612,0-2.922,1.306-2.929,2.919l0.054,16.284l-3.719-0.027
			c-0.794-0.002-1.512,0.474-1.816,1.206c-0.308,0.73-0.144,1.577,0.417,2.139L21.407,34.002z"/>
		<path d="M42.443,19.372c-1.623,0-2.947,1.315-2.947,2.938v16.392c0,0.678-0.521,1.217-1.203,1.217H7.471
			c-0.68,0-1.239-0.539-1.239-1.217V22.309c0-1.622-1.282-2.938-2.905-2.938c-1.622,0-2.905,1.315-2.905,2.938v16.392
			c0,3.918,3.131,7.111,7.05,7.111h30.821c3.92,0,7.098-3.193,7.098-7.111V22.309C45.391,20.687,44.064,19.372,42.443,19.372z"/>
</svg>`;
                    }
               }
          </script>
     <?php
     } else {
          echo "<h1>Project was not found!</h1>";
     }
} else {
     ?>
     <style>
          .grid-container {
               display: grid;
               grid-template-columns: auto auto auto;
               background-color: #3d3d3d;
               padding: 10px;
          }

          .grid-item {
               background-color: rgba(50, 50, 50, 0.8);
               border: 1px solid rgba(15, 15, 15, 0.8);
               padding: 20px;
               font-size: 30px;
               text-align: center;
          }
     </style>
     <h1>Explore community extensions for Tools library</h1>

     <div class="grid-container">
          <?php
          include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
          $db = OpenDB();
          $sql = "SELECT * FROM tools_community ORDER BY downloads DESC LIMIT 10";
          $res = $db->query($sql);
          while ($row = $res->fetch_assoc()) {
          ?>
               <div class="grid-item no-link" href="<?= $row["UUID"] ?>">
                    <div><?= $row["Name"] ?></div>
               </div>
          <?php
          }
          ?>
     </div>

<?php
}
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>