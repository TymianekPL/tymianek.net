<?php
include $_SERVER["DOCUMENT_ROOT"] . "/header.php";
?>
<style>
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
<h1 id="res-msg"></h1>
<form id="login-form" autocomplete="off">
     <label for="login-name">Name</label><input type="text" id="login-name">
     <label for="login-url">URL</label><input type="text" id="login-url">
     <label for="login-email">Email</label><input type="email" id="login-email">
     <label for="login-password">Password</label><input type="password" id="login-password">
     <input type="submit" value="Register" id="login-submit" class="btn">
</form>
<script type="module">
     (async () => {
          const _ = await import("/static/assets/js/register.js")
          _.init();
     })();
</script>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/footer.php";
?>