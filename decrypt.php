<?php
error_reporting(0);
function encrypt($str, $offset) {
$encrypted_text = "";
$offset = $offset % 26;
if($offset < 0) {
$offset += 26;
}
$i = 0;
while($i < strlen($str)) {
$c = strtoupper($str{$i}); 
if(($c >= "A") && ($c <= 'Z')) {
if((ord($c) + $offset) > ord("Z"))
{
$encrypted_text .= chr(ord($c) + $offset - 26);
} 
else {
$encrypted_text .= chr(ord($c) + $offset);
}
}
else {
$encrypted_text .= " ";
}
$i++;
}
return $encrypted_text;
}
function decrypt($str, $offset) {
$decrypted_text = "";
$offset = $offset % 26;
if($offset < 0) {
$offset += 26;
}
$i = 0;
while($i < strlen($str)) {
$c = strtoupper($str{$i}); 
if(($c >= "A") && ($c <= 'Z')) {
if((ord($c) - $offset) < ord("A")) {
 $decrypted_text .= chr(ord($c) - $offset + 26);
} 
else {
$decrypted_text .= chr(ord($c) - $offset);
}}
else {
 $decrypted_text .= " ";
}
$i++;
}
return $decrypted_text;
}
function decvigenere($pswd, $enctext)
{
	// change key to lowercase for simplicity
	$pswd = strtolower($pswd);
	
	// intialize variables
	$code = "";
	$ki = 0;
	$kl = strlen($pswd);
	$length = strlen($enctext);
	
	// iterate over each line in text
	for ($i = 0; $i < $length; $i++)
	{
		// if the letter is alpha, decrypt it
		if (ctype_alpha($enctext[$i]))
		{
			// uppercase
			if (ctype_upper($enctext[$i]))
			{
				$x = (ord($enctext[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));
				
				if ($x < 0)
				{
					$x += 26;
				}
				
				$x = $x + ord("A");
				
				$enctext[$i] = chr($x);
			}
			
			// lowercase
			else
			{
				$x = (ord($enctext[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));
				
				if ($x < 0)
				{
					$x += 26;
				}
				
				$x = $x + ord("a");
				
				$enctext[$i] = chr($x);
			}
			
			// update the index of key
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}
	}
	
	// return the decrypted text
	return $enctext;
}

if(isset($_POST['submit']))
{
$text = $_POST['teksti'];
$offset =  $_POST['key'];
$value;
$option=$_POST['algoritmet'];
$cezardefaultkey=3;

switch($option){
    case 'CEZAR':
	if(empty($offset)){
		$dec = decrypt($text, $cezardefaultkey);
		$value=$dec;
	}
	else{
		
		
		$dec=decrypt($text, $offset);
		$value=$dec;
	}
    break;
    case 'VIGENERE':
    $otp = decvigenere($offset,$text);
    $value=$otp;
    break;
   
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Decrypt Now !</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post">
				<span class="contact100-form-title">
					Dekripto !
				</span>

			

				<div class="wrap-input100 input100-select">
					<span class="label-input150">Algoritmi</span><br>
					<div>
						<select name="algoritmet" class="selection-2" name="service" id="listaalgoritmeve">
                        <option>Zgjedh </option>
                        <option value="CEZAR">CEZAR</option>
                        <option value="VIGENERE">VIGENERE</option>
                       
                            
							
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required" id="enckey">
					<span class="label-input150">Çelesi</span><br>
					<input type="text" class="input100" name="key" placeholder="Çelesi" id="enckeyy">
					<span class="focus-input100"></span>
                </div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input150">Teksti</span><br>
					<textarea class="input100" name="teksti" placeholder="Teksti për dekriptim"></textarea>
					<span class="focus-input100"></span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input150">Dekriptuar (<?php echo ucfirst($option )?>)</span>
					<textarea class="input100" name="message" placeholder="Teksti për dekriptim"><?php echo $value ?> </textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button name="submit" class="contact100-form-btn">
							<span>
								Dekripto
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
            </form>
            <br>
            <span class="label-input200"> &copy Encrypt Now ! 2018 </span>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript"  src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 30,
			dropdownParent: $('#dropDownSelect1')
		});
    </script>
    <script>
	
	var d = new Date();
   var n = d.getFullYear();
   var k="&copy Encrypt Now ! "+n;
   $( "#info" ).html( k );
		$( "#enckey" ).hide();
   $( "#listaalgoritmeve" ).change(function() {
	   $("#encrypted").val("");
	   var val1 = $('#listaalgoritmeve option:selected').val();
	  if(val1 !="CEZAR" && val1 !="VIGENERE" ){
	   $( "#enckey" ).hide();
	
	  }
	  else{
	   $( "#enckey" ).show();
	  }
});

   </script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>



</body>
</html>
