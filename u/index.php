<?php
include $_SERVER["DOCUMENT_ROOT"] . "/header.php";
if ($_GET["user"] == "") {
?>
     <div style="float: right;">
     <button class="btn-green" href="/settings">Settings</button>
     </div>
     <div style="text-align: center">
          <div class="func-avatar" style="margin: none;"></div>
          <h1 class="func-username" style="margin: none;"></h1>
     </div>
     <script type="module" async>
          (async () => {
               const _ = await import("/static/assets/js/user.js");
               const user = await _.User.getCurrent();
               if (user == false) {
                    window.location.href = "/login";
               }
          })();
     </script>
<?php
} else {
?>
     <div id="mainFrame"></div>
     <script type="module" async>
          (async () => {
               const _ = await import("/static/assets/js/api/index.js")
               const user = "<?= $_GET["user"] ?>";
               const res = await _.get(`/api/v2/user/name&ID=${user}`, "no-token");
               const mainFrame = document.getElementById("mainFrame");
               if (!res.name && res.code == 1000) {
                    mainFrame.innerHTML = "";
                    const errMsg = document.createElement("h1");
                    errMsg.className = "text-error";
                    errMsg.innerHTML = "User wasn't found";
                    mainFrame.append(errMsg);
               } else {
                    mainFrame.innerHTML = "";
                    const errMsg = document.createElement("h1");
                    errMsg.className = "text-error";
                    errMsg.innerHTML = "We had some internal error, maybe try again?";
                    mainFrame.append(errMsg);
               }
          })();
     </script>
<?php
}
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>