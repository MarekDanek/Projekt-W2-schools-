<!-- <?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';
//Zkouška jestli je správně připojená databaze
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Nepřipojeno k MySql: ' . mysqli_connect_error());
}

// Pokud dojde k chybě připojení, zastaví se skript a zobrazí chybu.
if ( !isset($_POST['Username'], $_POST['Password']) ) {
	// nejsou data
	exit('Prosím vyplňte obě pole');
}

//Příprava SQL příkazu zabrání vkládání SQL.
if ($stmt = $con->prepare('SELECT UserID, Password FROM users WHERE Username = ?')) {
 // Svázání parametrů (s = řetězec, i = int, b = blob atd.), uživatelské jméno je řetězec, takže použijeme "s"
	$stmt->bind_param('s', $_POST['Username']);
	$stmt->execute();
	// Uložení výsledku, abychom mohl zkontrolovat, zda účet existuje v databázi.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Účet existuje, teď ověření hesla.
        // Je použit password_hash pro hašování hesla
        if (password_verify($_POST['Password'], $password)) {
            // Ověření bylo úspěšné a uživatel se přihlásil
            // Vytváření relace pro zjištění že je uživatel přihlášen (soubory cookie), ale pamatují si data na serveru.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['Username'];
            $_SESSION['UserID'] = $id;
            header('Location: Hlavni_stranka.php');
            exit;
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
?> -->



