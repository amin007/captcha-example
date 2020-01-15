function process() {
  // Append data
  var data = new FormData();
  data.append("name", document.getElementById("name").value);
  data.append("email", document.getElementById("email").value);
  data.append("captcha", document.getElementById("captcha").value);

  // Init AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', "3-verify.php", true);

  // When the process is complete
  // JSON decode the server response
  xhr.onload = function () {
    // console.log(this.response);
    var res = JSON.parse(this.response);
    if (res.status) {
      // ALL OK
      // Redirect user to thank you page or something
      // window.location.href = "thank-you.html";
      alert("OK");
    } else {
      // ERROR
      alert(res.message);
      // THIS WILL REFRESH THE CAPTCHA IF YOU WANT
      var cimg = document.getElementById("captcha-img");
      cimg.src = "2-image.php?" + new Date().getTime();
      document.getElementById("captcha").value = "";
    }
  };

  // Send
  xhr.send(data);
  return false;
}