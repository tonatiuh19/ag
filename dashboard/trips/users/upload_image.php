<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$viaje = $_POST["viaje"];

	$target_dir = "../../../trips/".$viaje."/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$viaje = $_POST["viaje"];
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	    	echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
			echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
			echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
			echo "</form>\n";
			echo "<script type=\"text/javascript\">\n"; 
			echo "alert('No puedes subir algo que no es una imagen.');    document.getElementById('btnSignIn').click();\n"; 
			echo "</script>\n";

	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $uploadOk = 0;
	    echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
		echo "</form>\n";
		echo "<script type=\"text/javascript\">\n"; 
		echo "alert('El archivo ya existe.');   document.getElementById('btnSignIn').click();\n"; 
		echo "</script>\n";
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    $uploadOk = 0;
	    echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
		echo "</form>\n";
		echo "<script type=\"text/javascript\">\n"; 
		
		echo "alert('El archivo es demssiado grande. Max 4.5 MB.');    document.getElementById('btnSignIn').click();\n"; 
		echo "</script>\n";

	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	    echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
		echo "</form>\n";
		echo "<script type=\"text/javascript\">\n"; 
		echo " alert('Solo jpg, png, gif, son permitidos.');   document.getElementById('btnSignIn').click();\n"; 
		echo "</script>\n";
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
			echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
			echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
			echo "</form>\n";
			echo "<script type=\"text/javascript\">\n"; 
			echo "    document.getElementById('btnSignIn').click();\n"; 
			echo "</script>\n"; 
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
	



}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>

		window.location.href='../';
		</SCRIPT>");
}



function get_random_string($length = 11){
	$pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}



function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>
