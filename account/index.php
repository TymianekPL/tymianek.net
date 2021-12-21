<?php
include $_SERVER["DOCUMENT_ROOT"] . "/header.php";
?>
<style>
     .tablink {
          background-color: #555;
          color: white;
          border: none;
          cursor: pointer;
          padding: 14px 16px;
          font-size: 17px;
          width: 25%;
          float: left;
          min-height: 8vh;
          font-family: 'Poppins', sans-serif;
          -webkit-text-stroke-width: 0.3px;
          transition: background-color 200ms linear;
     }

     body[theme=light] .tablink {
          background-color: #eee;
          color: #101010;
     }

     body[acrylic=true] .tablink {
          background-color: rgba(50, 50, 50, .3);
          backdrop-filter: blur(10px);
     }

     body[theme=light][acrylic=true] .tablink {
          background-color: rgba(230, 230, 230, .3);
          backdrop-filter: blur(10px);
     }

     .tablink:hover {
          background-color: #aaa;
     }

     body[acrylic=true] .tablink:hover {
          background-color: rgba(170, 170, 170, .3);
          backdrop-filter: blur(10px);
     }

     body[theme=light] .tablink:hover {
          background-color: #e0e0e0;
     }


     body[acrylic=true][theme=light] .tablink:hover {
          background-color: rgba(224, 224, 224, .3);
          backdrop-filter: blur(10px);
     }

     /* Style the tab content */
     .tabcontent {
          color: white;
          display: none;
          padding: 50px;
          margin-top: 50px;
          text-align: center;
          animation: animate-tab 1000ms;
     }

     body[theme=light] .tabcontent {
          color: #101010;
          display: none;
          padding: 50px;
          text-align: center;
     }

     .after::after {
          display: block;
          top: 100%;
          left: 0px;
          content: "\00a0";
          height: 3px;
          background: linear-gradient(90deg, red, blue);
          animation: animate-link 500ms;
     }

     @keyframes animate-link {
          from {
               max-width: 1%;
          }

          to {
               max-width: 100%;
          }
     }

     @keyframes animate-tab {
          from {
               padding-left: 0px;
               padding-right: 100px;
          }

          to {
               padding-left: 50px;
               padding-right: 50px;
          }
     }

     @media (max-width: 800px) {
          .tablink {
               height: 10vh;
               font-size: 15px;
          }
     }

     input[type="checkbox"] {
          width: 0;
          height: 0;
          visibility: hidden;
     }

     .switch {
          width: 100px;
          height: 30px;
          display: inline-block;
          background-color: red;
          border-radius: 100px;
          position: relative;
          cursor: pointer;
          transition: 0.5s;
          box-shadow: 0 0 20px #477a8550;
     }

     .switch::after {
          content: "";
          width: 25px;
          height: 25px;
          background-color: #eee;
          position: absolute;
          border-radius: 70px;
          top: 3.1px;
          left: 15px;
          transition: 0.5s;
     }

     input[type=checkbox]:checked+label:after {
          left: calc(100% - 10px);
          transform: translateX(-100%);
     }

     input[type=checkbox]:checked+label {
          background-color: lime;
     }

     .switch:active:after {
          width: 75px;
     }

     input {
          width: 100%;
          display: block;
          padding: 3px;
          border: 1px #505050 solid;
          border-radius: 3.5px;
          margin-bottom: 4px;
          height: 39px;
          background-color: inherit;
          color: inherit;
          white-space: nowrap;
          --inherits: .no-select;
          padding: 0.375rem 0.75rem;
          font-size: 1rem;
          line-height: 1.5;
          border-radius: 0.25rem;
          transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
          -webkit-text-stroke-width: 0.3px;
     }

     body[theme=light] input {
          border: 1px #303030 solid;
     }

     input:-webkit-autofill,
     input:-webkit-autofill:hover,
     input:-webkit-autofill:focus,
     input:-webkit-autofill:active,
     input:-webkit-autofill::first-line {
          box-shadow: 0 0 0px 1000px #1e1e1e inset !important;
          -webkit-text-fill-color: snow !important;
          font-family: 'Cascadia Code', bold !important;
          -webkit-font-smoothing: antialiased !important;
          -webkit-text-stroke-width: 0.3px !important;
          -moz-osx-font-smoothing: grayscale !important;
     }

     body[theme=light] input:-webkit-autofill,
     body[theme=light] input:-webkit-autofill:hover,
     body[theme=light] input:-webkit-autofill:focus,
     body[theme=light] input:-webkit-autofill:active,
     body[theme=light] input:-webkit-autofill::first-line {
          box-shadow: 0 0 0px 1000px snow inset !important;
          -webkit-text-fill-color: snow !important;
          font-family: 'Cascadia Code', bold !important;
          -webkit-font-smoothing: antialiased !important;
          -webkit-text-stroke-width: 0.3px !important;
          -moz-osx-font-smoothing: grayscale !important;
          color: #101010 !important;
     }

     input[type="file"] {
          display: none;
     }

     .file-upload {
          border: 1px solid #ccc;
          display: inline-block;
          padding: 6px 12px;
          cursor: pointer;
     }

     #snackbar {
          visibility: hidden;
          min-width: 500px;
          margin-left: -250px;
          background-color: #FF5050;
          color: #fff;
          text-align: center;
          border-radius: 2px;
          padding: 16px;
          position: fixed;
          z-index: 1;
          left: 50%;
          top: 30px;
          font-size: 17px;
     }

     #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
     }

     @-webkit-keyframes fadein {
          from {
               top: 0;
               opacity: 0;
          }

          to {
               top: 30px;
               opacity: 1;
          }
     }

     @keyframes fadein {
          from {
               top: 0;
               opacity: 0;
          }

          to {
               top: 30px;
               opacity: 1;
          }
     }

     @-webkit-keyframes fadeout {
          from {
               top: 30px;
               opacity: 1;
          }

          to {
               top: 0;
               opacity: 0;
          }
     }

     @keyframes fadeout {
          from {
               top: 30px;
               opacity: 1;
          }

          to {
               top: 0;
               opacity: 0;
          }
     }
</style>

<div id="snackbar"></div>
<h1>Account management</h1>

<div class="no-select">
     <button class="tablink" id="gen-btn" onclick="opentab('general', this)">General</button>
     <button class="tablink" id="sec-btn" onclick="opentab('security', this)">Privacy & security</button>
     <button class="tablink" id="app-btn" onclick="opentab('apperence', this)">Apperence</button>
     <button class="tablink" id="adv-btn" onclick="opentab('advanced', this)">Advanced</button>
</div>

<div class="tabcontent" id="general">
     <h1>General</h1>
     <p>
          <label for="name-in">Change name</label>
          <input type="text" id="name-in" onkeyup="changeName(this, event)">
          <button class="btn-green" onclick="changeName(document.getElementById('name-in'), {key: 'Enter'})" style="width: 100%;">Save (or press Enter)</button>
     </p>
</div>

<div class="tabcontent" id="security">
     <h1>Privacy & security</h1>
     <p>
          <label for="password-in">Change password</label>
          <input type="password" id="password-in" value="**********" onkeyup="changePass(this, event)">
          <button class="btn-green" onclick="changePass(document.getElementById('password-in'), {key: 'Enter'})" style="width: 100%;">Save (or press Enter)</button>
     </p>
</div>
<div class="tabcontent" id="apperence">
     <h1>Apperence</h1>
     <p>
     <h4 style="font-size: 30px; display: inline-block;">Light mode <span class="text-red">(danger)</span></h4>
     <input type="checkbox" name="switch" id="light-switch" onchange="changeLight(this);">
     <label for="light-switch" class="switch"></label>
     </p>
     <p>
          <label for="custombackground-in" class="file-upload">
               Custom Background Image
          </label><input type="file" id="custombackground-in">
          <script>
               // Select your input type file and store it in a variable
               const input = document.getElementById('custombackground-in');
               // This will upload the file after having read it
               const upload = (file) => {
                    const formData = new FormData();
                    formData.append('background', file);
                    fetch('/api/v1/account/settings/background', { // Your POST endpoint
                         method: 'POST',
                         headers: {
                              authorization: window.localStorage.getItem("token")
                         },
                         body: formData // This is your file object
                    }).then(
                         async (response) => {
                              setTimeout(async () => {
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
                              }, 150);

                              const j = await response.json()
                              console.log(response);
                              if (response.status != 200) {
                                   var x = document.getElementById("snackbar");
                                   x.innerHTML = j.error;
                                   x.className = "show";
                                   setTimeout(function() {
                                        x.className = x.className.replace("show", "");
                                   }, 3000);
                              }
                              return j;
                         }
                    ).then(
                         success => console.log(success) // Handle the success response object
                    ).catch(
                         error => console.log(error) // Handle the error response object
                    );
               };

               // Event handler executed when a file is selected
               const onSelectFile = () => upload(input.files[0]);

               // Add a listener on your input
               // It will be triggered when a file will be selected
               input.addEventListener('change', onSelectFile, false);
          </script>
     </p>
     <p>
     <h4 style="font-size: 30px; display: inline-block;">Enable acrylic</h4>
     <input type="checkbox" name="switch" id="acrylic-switch" onchange="changeAcrylic(this);">
     <label for="acrylic-switch" class="switch"></label>
     <div class="text-red">Working with custom background image only</div>
     </p>
     <p>
     <h4 style="font-size: 30px; display: inline-block;">Custom CSS</h4>
     <input type="checkbox" name="switch" id="acrylic-switch" onchange="changeAcrylic(this);">
     <label for="acrylic-switch" class="switch"></label>
     <div class="text-red">Working with custom background image only</div>
     </p>
</div>

<div class="tabcontent" id="advanced">
     <h1>Advanced</h1>
     <p>
     <h4 style="font-size: 30px; display: inline-block;">Developer mode</h4>
     <input type="checkbox" name="switch" id="dev-switch" onchange="changeDev(this);">
     <label for="dev-switch" class="switch"></label>
     </p>
</div>

<script>
     /**
      * @param {HTMLInputElement} elem
      */
     async function changeDev(elem) {
          await fetch("/api/v1/account/settings/developer", {
               method: "PATCH",
               body: JSON.stringify({
                    enable: elem.checked ? "true" : "false",
               }),
               headers: {
                    authorization: window.localStorage.getItem("token")
               }
          })
     }

     /**
      * @param {HTMLInputElement} elem
      * @param {Event} e
      */
     async function changePass(elem, e) {
          if (elem.value == "**********") return;
          if (e.key === "Enter") {
               await fetch("/api/v1/account/settings/password", {
                    method: "PATCH",
                    body: JSON.stringify({
                         password: elem.value,
                    }),
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               })
          }
     }

     /**
      * @param {HTMLInputElement} elem
      * @param {Event} e
      */
     async function changeName(elem, e) {
          if (elem.value == "**********") return;
          if (e.key === "Enter") {
               await fetch("/api/v1/account/name", {
                    method: "PATCH",
                    body: JSON.stringify({
                         name: elem.value,
                    }),
                    headers: {
                         authorization: window.localStorage.getItem("token")
                    }
               });
               const arr = document.getElementsByClassName("func-username");
               for (const key in arr) {
                    if (Object.hasOwnProperty.call(arr, key)) {
                         const element = arr[key];
                         element.innerHTML = elem.value;
                    }
               }
          }
     }

     /**
      * @param {HTMLInputElement} elem
      */
     async function changeLight(elem) {
          await fetch("/api/v1/account/settings/light", {
               method: "PATCH",
               body: JSON.stringify({
                    enable: elem.checked ? "true" : "false",
               }),
               headers: {
                    authorization: window.localStorage.getItem("token")
               }
          });
          document.body.setAttribute("theme", elem.checked == 1 ? "light" : "dark");
     }

     /**
      * @param {HTMLInputElement} elem
      */
     async function changeAcrylic(elem) {
          await fetch("/api/v1/account/settings/acrylic", {
               method: "PATCH",
               body: JSON.stringify({
                    enable: elem.checked ? "true" : "false",
               }),
               headers: {
                    authorization: window.localStorage.getItem("token")
               }
          });
          document.body.setAttribute("acrylic", elem.checked == 1 ? "true" : "false");
     }
</script>
<script type="module">
     (async () => {
          const _ = await import("/assets/js/api/index.js")
          const json = await _.get("/api/v1/account/settings/developer", window.localStorage.getItem("token"));
          const elem = document.getElementById("dev-switch");
          elem.checked = json.enabled == 1 ? true : false;

          const json2 = await _.get("/api/v1/account/settings/light", window.localStorage.getItem("token"));
          const elem2 = document.getElementById("light-switch");
          elem2.checked = json2.enabled == 1 ? true : false;

          const json3 = await _.get("/api/v1/account/name", window.localStorage.getItem("token"));
          const elem3 = document.getElementById("name-in");
          elem3.value = json3.name;

          const json4 = await _.get("/api/v1/account/settings/acrylic", window.localStorage.getItem("token"));
          const elem4 = document.getElementById("acrylic-switch");
          elem4.checked = json4.enabled == 1 ? true : false;
     })();
</script>

<script>
     /**
      * @param {HTMLElement} elmnt
      */
     function opentab(cityName, elmnt) {
          window.history.pushState({}, "", `?${cityName}`);
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
               tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < tablinks.length; i++) {
               tablinks[i].classList.remove("after");
          }

          document.getElementById(cityName).style.display = "block";
          elmnt.classList.add("after");
     }


     var type = window.location.search.substr(1);
     console.log(type);
     switch (type) {
          case "general":
               opentab("general", document.getElementById("gen-btn"));
               break;
          case "security":
               opentab("security", document.getElementById("sec-btn"));
               break;
          case "apperence":
               opentab("apperence", document.getElementById("app-btn"));
               break;
          case "advanced":
               opentab("advanced", document.getElementById("adv-btn"));
               break;

          default:
               opentab("general", document.getElementById("gen-btn"));
               break;
     }
</script>


<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>