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

     .tablink:hover {
          background-color: #777;
     }

     /* Style the tab content */
     .tabcontent {
          color: white;
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
</style>

<h1>Account management</h1>

<button class="tablink" onclick="opentab('general', this)" id="defaultOpen">General</button>
<button class="tablink" onclick="opentab('security', this)">Privacy & security</button>
<button class="tablink" onclick="opentab('apperence', this)">Apperence</button>
<button class="tablink" onclick="opentab('apperence', this)">Danger</button>

<div class="tabcontent" id="general">
     <h1>General</h1>
     <p>London is the capital city of England.</p>
</div>

<div class="tabcontent" id="security">
     <h1>Privacy & security</h1>
     <p>Paris is the capital of France.</p>
</div>

<div class="tabcontent" id="apperence">
     <h1>Apperence</h1>
     <p>Tokyo is the capital of Japan.</p>
</div>


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