<?php
session_start();
session_destroy();
header('Location: Hlavni_stranka.php');
?>