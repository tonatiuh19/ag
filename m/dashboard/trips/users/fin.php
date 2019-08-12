<?php
	session_start();
	session_unset();
	session_destroy();
	header("location: https://www.agustirri.com/");
?>