</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.html";
?>
<script src="/assets/js/main.js" async defer></script>
<script type="module" async>
     window.onload = async function() {
          const User = (await import("/assets/js/user.js")).User;
          const names = document.getElementsByClassName("func-username");
          const userhrefs = document.getElementsByClassName("func-user-href");
          const user = await User.getCurrent();

          if (user != false) {
               const username = await user.name;
               for (const key in names) {
                    if (Object.hasOwnProperty.call(names, key)) {
                         const name = names[key];
                         name.innerHTML = username;
                    }
               }
               for (const key in userhrefs) {
                    if (Object.hasOwnProperty.call(userhrefs, key)) {
                         const name = userhrefs[key];
                         name.setAttribute("href", "/account");
                    }
               }
               const _ = await import("/assets/js/api/index.js")
               const json2 = await _.get("/api/v1/account/settings/light", window.localStorage.getItem("token"));
               document.body.setAttribute("theme", json2.enabled == 1 ? "light" : "dark");
               const json3 = await _.get("/api/v1/account/settings/acrylic", window.localStorage.getItem("token"));
               document.body.setAttribute("acrylic", json3.enabled == 1 ? "true" : "false");

               const res = await fetch("/api/v1/account/settings/background", {
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               });
               const dataJson = await res.text();
               if (dataJson != "{}") {
                    const enc = `url(data:image/png;base64,${dataJson})`;
                    document.body.style.backgroundImage = enc;
                    document.body.style.backgroundRepeat = "no-repeat";
                    document.body.style.backgroundSize = "cover";
                    document.body.style.backgroundPosition = "center";
               }

               const res2 = await fetch("/api/v1/account/settings/css", {
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               });
               const dataJson2 = await res2.json();
               const style = document.createElement("style");
               style.innerHTML = `${dataJson2.css}`;
               document.head.appendChild(style);
          } else {
               for (const key in userhrefs) {
                    if (Object.hasOwnProperty.call(userhrefs, key)) {
                         const name = userhrefs[key];
                         name.setAttribute("href", "/login");
                    }
               }
               for (const key in names) {
                    if (Object.hasOwnProperty.call(names, key)) {
                         const name = names[key];
                         name.innerHTML = "Login";
                    }
               }
          }
     }
</script>
</body>

</html>