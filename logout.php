<?php
session_start();

session_destroy();

header("Location: formPassword.php");
exit();
?>
