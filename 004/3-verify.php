<?php
// STEP 3 - VERIFY THE CAPTCHA
require "captcha.php";
$verified = $libCap->verify($_POST['captcha']);

// DO YOUR PROCESSING HERE
if ($verified) {
  // DO SOMETHING
  // REGISTER USER TO NEWSLETTER OR SOMETHING
  // RESPONSE
  unset ($_SESSION['captcha']);
  echo json_encode([
    "status" => 1,
    "message" => "OK"
  ]);
}

// INVALID CAPTCHA
else {
  // CREATE A NEW CAPTCHA IF YOU WANT
  $libCap->prime();
  echo json_encode([
    "status" => 0,
    "message" => "Invalid captcha"
  ]);
}