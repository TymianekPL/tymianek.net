<?php
include $_SERVER["DOCUMENT_ROOT"] . "/header.php";
?>

<h1>Download Tools</h1>
<h1>Download extensions</h1>
<div class="controls">
     <h2>Core packages</h2>
     <div class="form-check form-check-inline">
          <input class="form-check-input ch" checked disabled type="checkbox" value="Tools.dll" id="Tools.dll">
          <label class="form-check-label" for="Tools.dll">
               Core
          </label>
     </div>
     <div class="form-check form-check-inline">
          <input class="form-check-input ch" checked type="checkbox" value="Tools.Net.dll" id="Tools.Net.dll">
          <label class="form-check-label" for="Tools.Net.dll">
               Core - Networking
          </label>
     </div>
     <div class="form-check form-check-inline">
          <input class="form-check-input ch" checked type="checkbox" value="Tools.Diagnostic.dll" id="Tools.Diagnostic.dll">
          <label class="form-check-label" for="Tools.Diagnostic.dll">
               Core - Diagnostic
          </label>
     </div>
     <div class="form-check form-check-inline">
          <input class="form-check-input ch" checked type="checkbox" value="Tools.Window.dll" id="Tools.Window.dll">
          <label class="form-check-label" for="Tools.Window.dll">
               Core - Window
          </label>
     </div>
     <h2>Optional components</h2>
     <div class="form-check form-check-inline">
          <input class="form-check-input ch" type="checkbox" value="Tools.Net.Extensions.WebSocket.dll" id="Tools.Net.Extensions.WebSocket">
          <label class="form-check-label" for="Tools.Net.Extensions.WebSocket">
               Tools.Net.Extensions.WebSocket
          </label>
     </div>
     <br />
     <script src="/static/assets/js/FileSaver.js"></script>
     <script src="/static/assets/js/jszip.js"></script>
     <button type="submit" class="btn btn-primary" onclick="download(this);">Download</button>
     <script>
          var zip = new JSZip();
          async function download(elem) {
               (async () => {
                    elem.disabled = true;
                    elem.innerHTML = "Collecting your files...";
                    const checkboxes = document.getElementsByClassName("ch");
                    let list = `List of downloaded libraries\n`;
                    let files = "";
                    for (const key in checkboxes) {
                         if (Object.hasOwnProperty.call(checkboxes, key)) {
                              const box = checkboxes[key];
                              if (box.checked) {
                                   list += `${box.id}\n`;
                                   files += `${box.value}\n`;
                              }
                         }
                    }
                    const lines = files.split('\n');
                    var libs = zip.folder("libs");
                    for (const key in lines) {
                         if (Object.hasOwnProperty.call(lines, key)) {
                              const e = lines[key];
                              list += `${e}\n`;
                              const blob = await fetch(`/archive/Tools/${e}`);
                              //.then(res => res.blob())
                              //.then(blob => {

                              //});
                              const b = await blob.blob();
                              const r = await b.arrayBuffer();
                              libs.file(e, r);
                         }
                    }
                    zip.file("list.txt", list);
                    zip.generateAsync({
                              type: "blob"
                         })
                         .then(function(content) {
                              elem.innerHTML = "Downloding...";
                              saveAs(content, "libraries.zip");
                              elem.innerHTML = "Download";
                              elem.disabled = false;
                         });
               })();
          }
     </script>
</div>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>