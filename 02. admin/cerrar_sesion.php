<?php
	session_start();
	session_destroy();
	header("Location: ../01. login_signup/login.html");
?>