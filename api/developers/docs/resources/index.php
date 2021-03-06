<?php
include $_SERVER["DOCUMENT_ROOT"] . "/api/developers/header.php";
?>

<h1 title="Application Programming Interface">API</h1>
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
               $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/api/v2";
               ?>
               Base URL: <code><?php echo $url ?></code>

          </p>
          <p>
          <h2>API versions:</h2>
          <table>
               <thead>
                    <tr>
                         <th>Name</th>
                         <th>State</th>
                         <th>Current</th>
                         <th>Addictional informations</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>v1</td>
                         <td>Discontinued</td>
                         <td style="color: red;">&times;</td>
                         <td>It's unsecure, will be deleted in near future</td>
                    </tr>
                    <tr>
                         <td>v2</td>
                         <td>Current</td>
                         <td style="color: lime;">&checkmark;</td>
                         <td>It's using new media token system</td>
                    </tr>
               </tbody>
          </table>
          </p>
          <ul>
               <li id="response-codes-http">
                    <h2>HTTP common response codes</h2>
                    <table>
                         <thead>
                              <tr>
                                   <th>Code</th>
                                   <th>Name</th>
                                   <th>Description</td>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <td><code style="color: lime;">200</code></td>
                                   <td>Ok</td>
                                   <td>Everything is Ok!</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">404</code></td>
                                   <td>Not found</td>
                                   <td>Resource wasn't found</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">426</code></td>
                                   <td>Unsupported version</td>
                                   <td>You are using unsupported version of our API!</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">401</code></td>
                                   <td>Unathorized</td>
                                   <td>You didn't provide authorization token or it was incorrect</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">403</code></td>
                                   <td>Access denied</td>
                                   <td>Access to resource</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">422</code></td>
                                   <td>Parameter is missing</td>
                                   <td>You didn't provide important parameter</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">405</code></td>
                                   <td>Method not supported</td>
                                   <td>That method is not supported</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">400</code></td>
                                   <td>Bad request</td>
                                   <td>Your request is incorrect</td>
                              </tr>
                              <tr>
                                   <td><code style="color: red;">500</code></td>
                                   <td>Internal error</td>
                                   <td>Unknown internal error, that happens very rarely</td>
                              </tr>
                         </tbody>
                    </table>
               </li>
               <li id="response-code-json">
                    <h2>JSON common response codes</h2>
                    <span style="font-size:12px">Only with new API</span>
                    <table>
                         <thead>
                              <tr>
                                   <th>Code</th>
                                   <th>Name</th>
                                   <th>Description</th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   1000
                              </tr>
                         </tbody>
                    </table>
               </li>
               <li id="get-token">
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
               <li id="get-name">
                    <h2><code><span class="request-method">GET</span> /account/name</code></h2>
                    <p>
                         Get name
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-acrylic-get">
                    <h2><code><span class="request-method">GET</span> /account/settings/acrylic</code></h2>
                    <p>
                         Check if acrylic mode is enabled
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-acrylic-set">
                    <h2><code><span class="request-method">PATCH</span> /account/settings/acrylic</code></h2>
                    <p>
                         Set acrylic mode
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
                                   <td>enabled</td>
                                   <td>boolean</td>
                                   <td>Is enabled</td>
                              </tr>
                              <tr>
                         </tbody>
                    </table>
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-background-get">
                    <h2><code><span class="request-method">GET</span> /account/settings/background</code></h2>
                    <p>
                         Get custom background
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-background-set">
                    <h2><code><span class="request-method">PATCH</span> /account/settings/background</code></h2>
                    <p>
                         Check if acrylic mode is enabled
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
                                   <td>background</td>
                                   <td>BLOB</td>
                                   <td>Image data</td>
                              </tr>
                         </tbody>
                    </table>
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-css-get">
                    <h2><code><span class="request-method">GET</span> /account/settings/css</code></h2>
                    <p>
                         Get custom CSS
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-css-set">
                    <h2><code><span class="request-method">PATCH</span> /account/settings/css</code></h2>
                    <p>
                         Set custom CSS
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
                                   <td>css</td>
                                   <td>string</td>
                                   <td>New CSS to overwrite</td>
                              </tr>
                         </tbody>
                    </table>
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-developer-get">
                    <h2><code><span class="request-method">GET</span> /account/settings/developer</code></h2>
                    <p>
                         Check if is developer
                    </p>
                    <p>
                         Authentation: <span href="#token">Token</span>
                    </p>
               </li>
               <li id="settings-developer-set">
                    <h2><code><span class="request-method">PATCH</span> /account/settings/developer</code></h2>
                    <p>
                         Set developer mode
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
                                   <td>enabled</td>
                                   <td>boolean</td>
                                   <td>Is enabled</td>
                              </tr>
                         </tbody>
                    </table>
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