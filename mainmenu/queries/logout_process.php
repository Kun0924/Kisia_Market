<?php
session_start();
session_unset();
session_destroy();

header("Location: /mainmenu/login.php");
exit;
