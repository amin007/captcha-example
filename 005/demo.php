<?php
session_start();
?>

    <title>demo.php</title>
    <body style="background-color:#ddd; ">

    <?php
	$flag = 5;

if (isset($_POST["flag"])) //  check that POST variable is not empty
{
    $input = $_POST["input"];
    $flag = $_POST["flag"];
}

if ($flag == 1) // submit has been clicked
{
    if (isset($_SESSION['captcha_string']) && $input == $_SESSION['captcha_string']) // user input and captcha string are same
    {

        ?>

        <div style="text-align:center;">
            <h1>Your answer is correct!</h1>

            <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> // refresh the page
                <input type="submit" value="refresh the page">
            </form>
        </div>

    <?php

    } else // incorrect answer, captcha shown again
    {

        ?>
        <div style="text-align:center;">
            <h1>Your answer is incorrect!<br>please try again </h1>
        </div>
        <?php
        create_image();
        display();
    }

} else // page has just been loaded
{
   create_image();
    display();
}	
    /***** definition of functions *****/
    function display()
    {
        ?>
        <div style="text-align:center;">
        <h3>TYPE THE TEXT YOU SEE IN THE IMAGE</h3>
        <b>This is just to check if you are a robot</b>

        <div style="display:block;margin-bottom:20px;margin-top:20px;">
            <img src="image.png">
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
        / >
        <input type="text" name="input"/>
        <input type="hidden" name="flag" value="1"/>
        <input type="submit" value="submit" name="submit"/>
        </form>

        <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="submit" value="refresh the page">
        </form>
    </div>
    <?php
    }
#--------------------------------------------------------------------------------------------------
	function create_image()
	{
		$image = imagecreatetruecolor(200, 50);
		imagepng($image, "image.png");
		#
		$background_color = imagecolorallocate($image, 255, 255, 255);  
		imagefilledrectangle($image,0,0,200,50,$background_color);
		$line_color = imagecolorallocate($image, 64,64,64); 
		for($i=0;$i<10;$i++) {
			imageline($image,0,rand()%50,200,rand()%50,$line_color);
		}
		$pixel_color = imagecolorallocate($image, 0,0,255);
		for($i=0;$i<1000;$i++) {
			imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
		}
		#
		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$len = strlen($letters);
		$letter = $letters[rand(0, $len-1)];

		$text_color = imagecolorallocate($image, 0,0,0);
		#
		$word = null;
		for ($i = 0; $i< 6;$i++) {
			$letter = $letters[rand(0, $len-1)];
			imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
			$word.=$letter;
		}
		$_SESSION['captcha_string'] = $word;
		#
	}
#--------------------------------------------------------------------------------------------------
?>
</body>
<?php
// https://www.sitepoint.com/simple-captchas-php-gd/
?>