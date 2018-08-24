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
function vigenere($pswd, $enctext)
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
		// if the letter is alpha, encrypt it
		if (ctype_alpha($enctext[$i]))
		{
			// uppercase
			if (ctype_upper($enctext[$i]))
			{
				$enctext[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($enctext[$i]) - ord("A")) % 26) + ord("A"));
			}
			
			// lowercase
			else
			{
				$enctext[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($enctext[$i]) - ord("a")) % 26) + ord("a"));
			}
			
			// update the index of key
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}
	}
	
	// return the encrypted code
	return $enctext;
}
if(isset($_POST['submit']))
{
$text = $_POST['teksti'];
$offset =  $_POST['key'];
$value;
$option=$_POST['algoritmet'];
$selected="(".$option.")";
$cezardefaultkey=3;

switch($option){
	case 'CEZAR':
	if(empty($offset)){
		$enc = encrypt($text, $cezardefaultkey);
		$value=$enc;
	}
	else{
		$enc = encrypt($text, $offset);
		$value=$enc;
		$dec=decrypt($enc, $offset);
	}
    
    break;
    case 'VIGENERE':
    $otp = vigenere($offset,$text);
    $value=$otp;
    break;
    case 'CRC32':
    $value=hash('crc32',$text);
    break;
    case 'CRC32B':
    $value=hash('crc32b',$text);
    break;
    case 'GOST':
   $value=hash('gost',$text);
   break;
    case 'MD2':
   $value=hash('md2',$text);
   break;
   case 'MD4':
   $value=hash('md4',$text);
   break;
    case 'MD5':
   $value=md5($text);
   break;
   case 'SHA-1':
   $value=sha1($text);
   break;
   case 'SHA-224':
   $value=hash('sha224',$text);
   break;
   case 'SHA-256':
   $value=hash('sha256',$text);
   break;
   case 'SHA-384':
   $value=hash('sha384',$text);
   break;
   case 'SHA-512':
   $value=hash('sha512',$text);
   break;
   case 'WHIRLPOOL':
   $value=hash('whirlpool',$text);
   break;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Encrypt Now !</title>
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
					Enkripto !
				</span>

			

				<div class="wrap-input100 input100-select">
					<span class="label-input150">Algoritmi</span><br>
					<div>
						<select name="algoritmet" class="selection-2" name="service" id="listaalgoritmeve">
                        <option>Zgjedh </option>
                        <option value="CEZAR">CEZAR</option>
                        <option value="VIGENERE">VIGENERE</option>
                        <option value="CRC32">CRC32</option>
                        <option value="CRC32B">CRC32B</option>
                        <option value="GOST">GOST</option>
                        <option value="MD2">MD2</option>
                        <option value="MD4">MD4</option>
                        <option value="MD5">MD5</option>
                            <option value="SHA-1">SHA-1</option>
                            <option value="SHA-224">SHA-224</option>
                            <option value="SHA-256">SHA-256</option>
                            <option value="SHA-384">SHA-384</option>
                            <option value="SHA-512">SHA-512</option>
                            <option value="WHIRLPOOL">WHIRLPOOL</option>
                            
							
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
					<textarea class="input100" name="teksti" placeholder="Teksti për enkriptim"></textarea>
					<span class="focus-input100"></span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input150">Enkriptuar <?php echo ucfirst($selected )?></span>
					<textarea disabled="disabled" class="input100" name="message" placeholder="Teksti i enkriptuar !" id="encrypted"><?php echo $value ?> </textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button name="submit" class="contact100-form-btn">
							<span>
								Enkripto
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
            </form>
            <br>
            <span id="info" class="label-input200">  </span>
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
