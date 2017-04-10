<?php
function generateRandomPassword(){
	$SMALLalphabets = array("a", "b", "c","d", "e", "f","g", "h", "i","j", "k", "l","m", "n", "o","p", "q", "r","s", "t", "u","v", "w", "x","y","z");
	$BIGalphabets = array("A", "B", "C","D", "E", "F","G", "H", "I","J", "K", "L","M", "N", "O","P", "Q", "R","S", "T", "U","V", "W", "X","Y","Z");
	$specialcharacters= array("!","@","#","$","%","/","?","&","=","-");
	$numbers= array("0","1","2","3","4","5","6","7","8","9");
	$one=$SMALLalphabets[rand(0,25)];
	$one .=$BIGalphabets[rand(0,25)];
	$one .=$specialcharacters[rand(0,9)];
	$one .=$BIGalphabets[rand(0,25)];
	$one .=$SMALLalphabets[rand(0,25)];
	$one .=$BIGalphabets[rand(0,25)];
	$one .=$specialcharacters[rand(0,9)];
	$one .=$numbers[rand(0,9)];
	$one .=$SMALLalphabets[rand(0,25)];
	return $one;
}
function generateActivationCode(){
	$activation_code=rand(1000, 9999);
	return $activation_code;
}
function taketoindex(){
	header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/index.php');
	exit;
}
function authenticate(){
	//$cookie_name = "";
	$cookie_value = "John Doe";
	setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day 
	header('Location: http://androidapplication.esy.es/Online%20Exam%20Portal/database/authenticate.php'); //page which will authenticate the user
	exit;
}

?>