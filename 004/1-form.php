<?php
// STEP 1 - PRIME THE CAPTCHA
require "captcha.php";
$libCap->prime();
// DRAW YOUR HTML FORM ?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      PHP Captcha Demo
    </title>
    <style>
      /* [COSMETICS, DOES NOT MATTER] */
      html, body, input {
        font-family: arial, sans-serif;
      }
      form {
        max-width: 300px;
        padding: 20px;
        border-radius: 10px;
        margin: 0 auto;
        background: #f2f2f2;
      }
      label {
        display: block;
        width: 100%;
      }
      input[type=text], input[type=email] {
        box-sizing: border-box;
        width: 100%;
        padding: 5px;
        font-size: 1em;
        margin-bottom: 10px;
      }
      input[type=submit] {
        font-size: 1em;
        padding: 10px;
        background: #b73a3a;
        border: 0;
        color: #fff;
      }
    </style>
    <script src="3-form.js"></script>
  <body>
    <form onsubmit="return process();">
      <label for="name">Name:</label>
      <input id="name" type="text" required/>
      <label for="email">Email:</label>
      <input id="email" type="email" required/>

      <!-- [CAPTCHA HERE] -->
      <label for="captcha">Are you human?</label>
      <!-- [POINT IMAGE TAG TO PHP FILE] -->
      <img id="captcha-img" src="2-image.php"/>
      <input id="captcha" type="text" required/>

      <input type="submit" value="Go!"/>
    </form>
  </body>
</html>