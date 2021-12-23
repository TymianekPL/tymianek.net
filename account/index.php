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
          border-radius: 0px;
     }

     .tablink-last {
          border-radius: 0px 7px 7px 0px;
     }

     .tablink-first {
          border-radius: 7px 0px 0px 7px;
     }

     .tabcontainer {
          background: #f4f4f4;
          border-radius: 15px;
     }

     body[theme=light] .tablink {
          background-color: #eee;
          color: #101010;
     }

     body[acrylic=true] .tablink {
          background-color: rgba(50, 50, 50, .3);
          backdrop-filter: blur(30px);
     }

     body[theme=light][acrylic=true] .tablink {
          background-color: rgba(230, 230, 230, .3);
          backdrop-filter: blur(30px);
     }

     .tablink:hover {
          background-color: #aaa;
     }

     body[acrylic=true] .tablink:hover {
          background-color: rgba(170, 170, 170, .3);
          backdrop-filter: blur(30px);
     }

     body[theme=light] .tablink:hover {
          background-color: #e0e0e0;
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

     input,
     textarea {
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

     textarea {
          min-height: 200px;
          max-height: 1000px;
          resize: none;
     }

     body[acrylic=true] textarea,
     body[acrylic=true] input {
          backdrop-filter: blur(30px);
     }

     body[acrylic=true] textarea::before,
     body[acrylic=true] input::before {
          content: " ";
          background: url("data:image/png;base64,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");
          background-repeat: repeat;
          background-attachment: fixed;
          position: absolute;
          left: 0;
          right: 0;
          top: 0;
          bottom: 0;
          filter: blur(15px);
          z-index: -1;
     }

     body[acrylic=false] input,
     body[acrylic=false] textarea {
          background: #2e2e2e;
     }

     body[acrylic=false][theme=light] input,
     body[acrylic=false][theme=light] textarea {
          background: #e0e0e0;
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

<div class="no-select tabcontainer">
     <button class="menu tablink tablink-first" id="gen-btn" onclick="opentab('general', this)">General</button>
     <button class="menu tablink" id="sec-btn" onclick="opentab('security', this)">Privacy & security</button>
     <button class="menu tablink" id="app-btn" onclick="opentab('apperence', this)">Apperence</button>
     <button class="menu tablink tablink-last" id="adv-btn" onclick="opentab('advanced', this)">Advanced</button>
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
     <h4 style="font-size: 30px; display: inline-block;">Light mode</h4>
     <input type="checkbox" name="switch" id="light-switch" onchange="changeLight(this);">
     <label for="light-switch" class="switch"></label>
     </p>
     <p>
          <label for="custombackground-in" class="file-upload">
               Custom Background Image
          </label><input type="file" id="custombackground-in">
          <button class="btn" onclick="removeImg()">Remove Background Image</button>
          <script>
               const input = document.getElementById("custombackground-in");

               async function removeImg() {
                    await fetch('/api/v1/account/settings/background', { // Your POST endpoint
                         method: 'POST',
                         headers: {
                              authorization: window.localStorage.getItem("token")
                         },
                    });
                    document.body.style.backgroundImage = null;
               }

               function upload(file) {
                    // Select your input type file and store it in a variable const input=document.getElementById('custombackground-in'); // This will upload the file after having read it const upload=(file)=> {
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
     <div class="text-red text-bold">Working with custom background image only</div>
     </p>
     <p>
          <label for="css-in">Custom CSS</label>
          <textarea type="css" id="css-in"></textarea>
          <button class="btn-green" style="width: 100%;" onclick="changeCSS(document.getElementById('css-in'), {key: 'Enter'})">Save (or press CTRL + S)</button>
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
     const tx = document.getElementsByTagName("textarea");
     for (let i = 0; i < tx.length; i++) {
          tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
          tx[i].addEventListener("input", OnInput, false);
     }

     function OnInput() {
          this.style.height = "auto";
          this.style.height = (this.scrollHeight) + "px";
     }


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
     async function changeCSS(elem, e) {
          if (e.key === "Enter") {
               await fetch("/api/v1/account/settings/css", {
                    method: "PATCH",
                    body: JSON.stringify({
                         css: elem.value,
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

          const json5 = await _.get("/api/v1/account/settings/css", window.localStorage.getItem("token"));
          const elem5 = document.getElementById("css-in");
          elem5.value = json5.css;
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