</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.html";
?>
<script src="/assets/js/main.js" async defer></script>
<script type="module" async>
     //await fetch("/assets/js/login.mjs", {});
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

          } else {
               if (Object.hasOwnProperty.call(userhrefs, key)) {
                    const name = userhrefs[key];
                    name.setAttribute("href", "/login");
               }
          }
     }
</script>
</body>

</html>