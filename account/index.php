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
     }

     body[theme=light] .tablink {
          background-color: #eee;
          color: #101010;
     }

     .tablink:hover {
          background-color: #aaa;
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
          min-width: 100%;
          height: 3px;
          background: linear-gradient(90deg, red, blue);
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
</style>

<h1>Account management</h1>

<button class="tablink" onclick="opentab('general', this)" id="defaultOpen">General</button>
<button class="tablink" onclick="opentab('security', this)">Privacy & security</button>
<button class="tablink" onclick="opentab('apperence', this)">Apperence</button>
<button class="tablink" onclick="opentab('advanced', this)">Advanced</button>

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
     })();
</script>

<script>
     /**
      * @param {HTMLElement} elmnt
      */
     function opentab(cityName, elmnt) {
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
     // Get the element with id="defaultOpen" and click on it
     document.getElementById("defaultOpen").click();
</script>


<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>