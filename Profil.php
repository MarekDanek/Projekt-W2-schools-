<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    echo '<a href="logout.php">Odhlásit se</a>';
} else {
    // Pokud uživatel není přihlášen, přesměrujte ho na přihlašovací stránku
    header("Location: login.php");
    exit();
}

// Připojení k databázi
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    echo "Nepodařilo se připojit k MySQL: " . mysqli_connect_errno();
    exit();
}



require_once ('TCPDF-main/tcpdf.php');

// Funkce pro generování a stahování PDF
function generateAndDownloadPDF($conn)
{
    // Vytvoření nové instance třídy TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Nastavení informací o PDF
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($_SESSION['name']); // Nastavte autora podle jména přihlášeného uživatele
    $pdf->SetTitle('Test Results');
    $pdf->SetSubject('Test Results');
    $pdf->SetKeywords('Test, Results, PDF');

    // Nastavení písma
    $pdf->SetFont('helvetica', '', 12);

    // Dodatečné informace
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Vytvoření nové stránky
    $pdf->AddPage();

    // Načtení posledních výsledků testu z databáze
    $userId = $_SESSION['id'];
    $query = "SELECT * FROM test_results WHERE user_id = '$userId' AND test_level = '1' ORDER BY result_id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Pokud jsou výsledky k dispozici, zapiš je do PDF
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalQuestions = $row['total_questions'];
        $totalCorrect = $row['total_correct'];
        $percentage = $row['percentage'];
        $date = $row['test_date'];
        $username = $_SESSION['name'];

        // Vložení obsahu do PDF
        $content = '
        <h1>Výsledky testu</h1>
        <h2><p>Jméno: ' . $username . '</p></h2>
        <h3>Datum splneni: ' . $date . '</h3>
        <h3>Pocet otázek: ' . $totalQuestions . '</h3>
        <h3>Pocet správných odpovedi: ' . $totalCorrect . '</h3>
        <h3>Procenta: ' . round($percentage, 2) . '%</h3>
        ';
        $pdf->writeHTML($content, true, false, true, false, '');
    } else {
        // Pokud nejsou v databázi žádné výsledky, zobrazte vhodnou zprávu
        $pdf->writeHTML('<p>žádný není nedostupný.</p>', true, false, true, false, '');
    }



    // Uzavření spojení s databází
    mysqli_close($conn);

    // Nastavení hlavičky pro stahování PDF souboru
    $pdfFileName = 'test_results.pdf';
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');

    // Výstup PDF do souboru
    $pdf->Output('php://output', 'F');
}

// Ověření, zda bylo kliknuto na tlačítko pro stahování PDF
if (isset($_POST['download_pdf'])) {
    generateAndDownloadPDF($conn); // Zavolání funkce pro generování a stahování PDF
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<style>
    body {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .profile-info {
        margin-top: 20px;
    }

    .profile-info p {
        margin: 10px 0;
        color: #666;
    }

    .profile-info label {
        font-weight: bold;
    }

    .profile-info a {
        color: #007bff;
        text-decoration: none;
    }

    .profile-info a:hover {
        text-decoration: underline;
    }

    .logout-btn {
        display: block;
        margin-top: 20px;
        text-align: center;
    }

    .logout-btn a {
        padding: 10px 20px;
        background-color: #555;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .logout-btn a:hover {
        background-color: #555;
    }

    .button-link {
        display: inline-block;
        padding: 10px 15px;
        background-color: #555;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
    }

    header {
        background-image: url("background-modified.png");
        height: 100vh;
        background-size: cover;
        background-position: center;
    }

    .navbar {
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 25px;
        text-decoration: none;
        font-size: 25px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        background-color: #525252;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    .navbar a.active {
        background-color: #3B3B3B;
        color: white;

    }

    .navbar .icon {
        display: none;
    }

    @media screen and (max-width: 820px) {
        .navbar a:not(:first-child) {
            display: none;
        }

        .navbar a.icon {
            float: left;
            display: block;
        }
    }

    @media screen and (max-width: 820px) {
        .navbar.responsive {
            position: relative;
        }

        .navbar.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;

        }

        .navbar.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
    }

    .dropdown {
        display: inline-block;
        float: left;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;

    }
</style>

<body>
    <header>
        <!-- Logo vpravo nahoře -->
        <div style=" float: right; margin-right: 1%;" class="logo">
            <a href="hlavni_stranka.php">
                <img src="logo-new-bílý.png" alt="logo">
            </a>
        </div>

        <div class="navbar" id="menu">
            <a href="Hlavni_stranka.php" class="active"><b>Domů</b></a>
            <div class="dropdown">
                <a href="javascript:void(0);" onclick="showDropdown()"><b>Kurzy</b></a>
                <div class="dropdown-content" id="kurzyDropdown">
                    <a href="Kurz_HTML.php">HTML</a>
                    <a href="Kurz_JS.php">JavaScript</a>
                    <a href="Kurz_PHP.php">PHP</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0);" onclick="showDropdown()"><b>Testy</b></a>
                <div class="dropdown-content" id="kurzyDropdown">
                    <a href="Testy_HTML.php">Testy HTML</a>
                    <a href="Testy_JS.php">Testy JavaScript</a>
                    <a href="Testy_PHP.php">Testy PHP</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0);" onclick="showDropdown()"><b>Info</b></a>
                <div class="dropdown-content" id="kurzyDropdown">
                    <a href="Informace_IT.php">Obecné Informace</a>
                    <a id="showFormBtn">Poznatek</a>
                </div>
            </div>
            <a href="login.php"><b>Přihlášení</b></a>
            <a href="Profil.php"><b>Profil</b></a>
            <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
                <i class="fa fa-bars"></i>

            </a>
        </div>

        <div class="container" style="display:block;background-color:black;opacity: 0.9;color:white;padding: 5%;">

            <div class="content">

                <p>
                <p style="text-align: left;font-size : 3em">Profil</p>
                <label style="font-size : 2em">Jméno:</label>
                <span style="font-size: 2em;">
                    <?php echo $_SESSION['name']; ?>
                </span>

                </p>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label style="font-size : 2em" for="submit"> Certikát : </label>
                    <button class="button-link" type="submit" name="download_pdf">Stáhnout</button>
                </form>
                <div class="logout-btn">
                    <a href="logout.php">Logout</a>
                </div>
            </div>


        </div>
    </header>
</body>

</html>