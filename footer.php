</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.html";
?>
<script src="/static/assets/js/main.js" async defer></script>
<script type="module" async>
     window.onload = async function() {
          const User = (await import("/static/assets/js/user.js")).User;
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
               const _ = await import("/static/assets/js/api/index.js")
               const json_light = await _.get("/api/v1/account/settings/light", window.localStorage.getItem("token"));
               document.body.setAttribute("theme", json_light.enabled == 1 ? "light" : "dark");
               const json_acrylic = await _.get("/api/v1/account/settings/acrylic", window.localStorage.getItem("token"));
               document.body.setAttribute("acrylic", json_acrylic.enabled == 1 ? "true" : "false");

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

               const res3 = await fetch("/api/v1/account/settings/background", {
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               });
               const dataJson3 = await res3.text();
               const avatars = document.getElementsByClassName("func-avatar");
               for (const key in avatars) {
                    if (Object.hasOwnProperty.call(avatars, key)) {
                         const obj = avatars[key];
                         obj.style.height = "500px";
                    }
               }
               if (!new String(dataJson3).includes("{")) {
                    if (dataJson3 != "{}") {
                         const enc = dataJson3; //`url(data:image/png;base64,${dataJson3})`;
                         for (const key in avatars) {
                              if (Object.hasOwnProperty.call(avatars, key)) {
                                   const obj = avatars[key];
                                   obj.style.backgroundImage = enc;
                                   obj.style.backgroundRepeat = "no-repeat";
                                   obj.style.backgroundSize = "500px 500px";
                                   obj.style.backgroundPosition = "center";
                              }
                         }
                    }
               } else {
                    const res4 = await fetch("/static/assets/img/user.png&type=base64");
                    const data = await res4.text();
                    const enc = `url(data:image/png;base64,${data})`;
                    for (const key in avatars) {
                         if (Object.hasOwnProperty.call(avatars, key)) {
                              const obj = avatars[key];
                              obj.style.backgroundImage = enc;
                              obj.style.backgroundRepeat = "no-repeat";
                              obj.style.backgroundSize = "500px 500px";
                              obj.style.backgroundPosition = "center";
                         }
                    }
               }

               const res2 = await fetch("/api/v1/account/settings/css", {
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               });
               const datajson_light = await res2.json();
               const style = document.createElement("style");
               style.innerHTML = `${datajson_light.css}`;
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