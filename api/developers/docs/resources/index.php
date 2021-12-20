<?php
include $_SERVER["DOCUMENT_ROOT"] . "/api/developers/header.php";
?>

<h1 title="Application Programming Interface">API</h1>
<style>
     li {
          padding: 10px;
          margin: 2px;
     }

     li li {
          list-style: none;
     }

     .request-method {
          color: yellow;
     }

     table {
          border-collapse: collapse;
          width: 100%;
     }

     table td,
     table th {
          border: 1px solid #2e2e2e;
          padding: 8px;
     }

     table tr:nth-child(even) {
          background-color: #191919;
     }

     table tr:hover {
          background-color: #2e2e2e;
     }

     table th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #3e3e3e;
     }
</style>
<ul class="list-unstyled res">
     <li id="token">
          <h2>User Token</h2>
          <p>
               App token is token that can you can use to access application functions. You must put in into <code>authorization</code> header to make an request.
          </p>
          <p>
               If you want to access part of API that doesn't accept token (Like <code>/token/account</code>) provide <var>no-token</var> to <code>authorization</code> header!
          </p>
     </li>
     <li>
          <h2>Requests</h2>
          <p>
               <?php
               $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/api/v1";
               ?>
               Base URL: <code><?php echo $url ?></code>
          </p>
          <ul>
               <li class="get-token">
                    <h2><code><span class="request-method">POST</span> /token/account</code></h2>
                    <p>
                         Get token for account
                    </p>
                    <p>
                    <table>
                         <thead>
                              <tr>
                                   <th>Name</th>
                                   <th>Type</th>
                                   <th>Description</th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <td>Email</td>
                                   <td>string</td>
                                   <td>Your email</td>
                              </tr>
                              <tr>
                                   <td>Password</td>
                                   <td>string</td>
                                   <td>Your password</td>
                              </tr>
                         </tbody>
                    </table>
                    </p>
                    <p>
                         Authentation: None
                    </p>
               </li>
               <li class="get-name">
                    <h2><code><span class="request-method">GET</span> /account/name</code></h2>
                    <p>
                         Get name
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
          </ul>
     </li>
</ul>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/api/developers/footer.php";
?>