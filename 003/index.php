<form method="POST" action="index.php" onsubmit="return checkForm(this);">
<p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
<p><input type="text" size="6" maxlength="5" name="captcha" value=""><br>
<small>copy the digits from the image into this box</small></p>
</form>

<script type="text/javascript">
function checkForm(form)
{
	if(!form.captcha.value.match(/^\d{5}$/))
	{
		alert('Please enter the CAPTCHA digits in the box provided');
		form.captcha.focus();
		return false;
	}
	return true;
}
</script>

<?PHP
if(isset($_POST))
{
	session_start();
	if($_POST['captcha'] != $_SESSION['digit']) die("Sorry, the CAPTCHA code ("
	. $_POST['captcha'] . ") entered was incorrect!");
	else echo 'Yeah you correct!!! (' . $_POST['captcha'] . ')';
	session_destroy();
}

?>