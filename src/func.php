<?php

get($name){
	if(isset($_GET[$name])) return $_GET[$name];
	else return null;
}

post($name){
	if(isset($_POST[$name])) return $_POST[$name];
	else return null;
}

session($name,$value=false){
	if($value !== false) $_SESSION[$name] = $value;
	elseif(isset($_SESSION[$name])) return $_SESSION[$name];
	else return null;
}

req($name){
	if(isset($_REQUEST[$name])) return $_REQUEST[$name];
	else return null;
}

error($msg){
	echo '<h1>'.$msg.'</h1>';
}

loginError($msg){
	echo '<div>'.$msg.'</div>';
}
