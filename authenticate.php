<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Nepřipojeno k MySQL: ' . mysqli_connect_error());
}
// Pokud dojde k chybě připojení, zastaví se skript a zobrazí chybu.


// Příprava SQL příkazu zabrání vkládání SQL.
if ($stmt = $con->prepare('SELECT UserID, Password FROM users WHERE Username = ?')) {
    // Svázání parametrů (s = řetězec, i = int, b = blob atd.), uživatelské jméno je řetězec, takže použijeme "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Uložení výsledku, abychom mohli zkontrolovat, zda účet existuje v databázi.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Účet existuje, teď ověření hesla.
        // Je použit password_hash pro hašování hesla
        if (password_verify($_POST['password'], $password)) {
            // Ověření bylo úspěšné a uživatel se přihlásil
            // Vytváření relace pro zjištění, že je uživatel přihlášen (soubory cookie), ale pamatují si data na serveru.
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: Hlavni_stranka.php');
        } else {
            // špatné heslo
            echo 'Nesprávné heslo!';
        }
    } else {
        // špatné jméno
        echo 'Nesprávné jméno!';
    }

    $stmt->close();
}

?>