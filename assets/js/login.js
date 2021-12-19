export async function init() {
     const _ = await import("./user.js");
     (async () => {
          //if ((await _.User.getCurrent()) != false) window.location.href = "/";
     })();

     const loginBtn = document.getElementById("login-submit");
     loginBtn.onclick = async () => {
          const loginEmail = document.getElementById("login-email");
          const loginPassword = document.getElementById("login-password");
          const resHeader = document.getElementById("res-msg");
          const user = await _.User.login(
               loginEmail.value,
               loginPassword.value
          );
          console.log(user);
          if (user === false) {
               resHeader.className = "red";
               resHeader.innerHTML = "Incorrect email/password";
          } else {
               resHeader.className = "text-green";
               resHeader.innerHTML = "Success!";
               //window.location.href = "/";
          }
          return false;
     };

     const form = document.getElementById("login-form");
     form.onsubmit = () => false;
}
