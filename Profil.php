<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    // echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    // echo '<a href="logout.php">Odhlásit se</a>';
    echo '<style>.navbar a[href="login.php"] { display: none; }</style>';
} else {
    echo '<style>.navbar a[href="login.php"] { display: block; }</style>';
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
    // Získání sumy otázek a správných odpovědí pro všechny úrovně testů
    $query = "SELECT 
     SUM(CASE WHEN test_level = '1' THEN total_questions ELSE 0 END) AS total_questions_level1,
     SUM(CASE WHEN test_level = '2' THEN total_questions ELSE 0 END) AS total_questions_level2,
     SUM(CASE WHEN test_level = '3' THEN total_questions ELSE 0 END) AS total_questions_level3,
     SUM(CASE WHEN test_level = '1' THEN total_correct ELSE 0 END) AS total_correct_level1,
     SUM(CASE WHEN test_level = '2' THEN total_correct ELSE 0 END) AS total_correct_level2,
     SUM(CASE WHEN test_level = '3' THEN total_correct ELSE 0 END) AS total_correct_level3,
     test_type
   FROM test_results 
   WHERE user_id = '$userId'";

    $result = mysqli_query($conn, $query);


    // Pokud jsou výsledky k dispozici, zapište je do PDF
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalQuestionsLevel1 = $row['total_questions_level1'];
        $totalQuestionsLevel2 = $row['total_questions_level2'];
        $totalQuestionsLevel3 = $row['total_questions_level3'];
        $totalCorrectLevel1 = $row['total_correct_level1'];
        $totalCorrectLevel2 = $row['total_correct_level2'];
        $totalCorrectLevel3 = $row['total_correct_level3'];
        $Type = $row['test_type'];



        $totalQuestions = $totalQuestionsLevel1 + $totalQuestionsLevel2 + $totalQuestionsLevel3;
        $totalCorrect = $totalCorrectLevel1 + $totalCorrectLevel2 + $totalCorrectLevel3;

        // Výpočet průměru procenta
        if ($totalQuestions > 0) {
            $percentage = round(($totalCorrect / $totalQuestions) * 100, 2);
        } else {
            $percentage = 0;
        }

        $username = $_SESSION['name'];



        $content = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Certifikát</title>
        </head>
        <body>
     
           <h1 style="text-align:center;">W3 SCHOOLS QUIZ</h1>
           <h1 style="text-align:center;">CERTIFIKAT</h1>
           <h1 style="text-align:center;">' . $Type . '</h1>   
           <hr>
           <h2><p>' . htmlspecialchars('Jméno: ', ENT_QUOTES, 'UTF-8') . $username . '</p></h2>
           <h1>Výsledky testu</h1>  
           <h3>Verze testu : 1.0</h3>  
           <hr>
           <h3>' . htmlspecialchars('Celkovy pocet otazek: ', ENT_QUOTES, 'UTF-8') . $totalQuestions . '</h3>
           <h3>' . htmlspecialchars('Celkovy pocet spravnych odpovedi: ', ENT_QUOTES, 'UTF-8') . $totalCorrect . '</h3>
           <h3>' . htmlspecialchars('Prumerne procenta: ', ENT_QUOTES, 'UTF-8') . $percentage . '%</h3>
           <h3 style="text-align:right;">Vedoucí W3SchoolsQuiz: </h3>
           <h3 style="text-align:right;">ing. Marek Danek</h3>  
           <hr>
        </body>
           </html>
           ';


        // Podmínka pro zobrazení výsledku "uspěl" nebo "neuspěl"
        if ($percentage >= 70) {
            $content .= '<h2 style="color: green;">Prospel -> Certifikát je platný</h2>';
        } else {
            $content .= '<h2 style="color: red;">Neuspel -> Certifikát je neplatný</h2>';
        }

        // Vložení obsahu do PDF
        $pdf->writeHTML($content, true, false, true, false, '');

        // Příklad vložení obrázku z externího zdroje
        $img_path = '';
        $pdf->Image($img_path, $x = 15, $y = 260, $w = 180, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false);
    } else {
        // Pokud nejsou v databázi žádné výsledky, zobrazte vhodnou zprávu
        $pdf->writeHTML('<p>žádný není nedostupný.</p>', true, false, true, false, '');
    }







    // Uzavření spojení s databází
    mysqli_close($conn);

    // Nastavení hlavičky pro stahování PDF souboru
    $pdfFileName = 'Certifikát.pdf';
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');

    // Výstup PDF do souboru
    $pdf->Output('php://output', 'F');
}


if (isset($_POST['download_html_pdf'])) {
    // Kontrola, zda uživatel splnil testy HTML
    $userId = $_SESSION['id'];
    $query = "SELECT COUNT(*) AS count FROM test_results WHERE user_id = '$userId' AND test_type = 'HTML'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count == 3) {
        // Pokud uživatel splnil testy HTML, generujeme a stahujeme HTML certifikát
        generateAndDownloadPDF($conn);
    } else {
        // Pokud uživatel nesplnil testy HTML, zobrazíme mu zprávu
        echo '<script>alert("Musíte splnit testy HTML, abyste mohli stáhnout certifikát.");</script>';
    }
}

if (isset($_POST['download_php_pdf'])) {
    // Kontrola, zda uživatel splnil testy PHP
    $userId = $_SESSION['id'];
    $query = "SELECT COUNT(*) AS count FROM test_results WHERE user_id = '$userId' AND test_type = 'PHP'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count == 3) {
        // Pokud uživatel splnil testy PHP, generujeme a stahujeme PHP certifikát
        generateAndDownloadPDF($conn);
    } else {
        // Pokud uživatel nesplnil testy PHP, zobrazíme mu zprávu
        echo '<script>alert("Musíte splnit testy PHP, abyste mohli stáhnout certifikát.");</script>';
    }
}

if (isset($_POST['download_js_pdf'])) {
    // Kontrola, zda uživatel splnil testy JavaScript
    $userId = $_SESSION['id'];
    $query = "SELECT COUNT(*) AS count FROM test_results WHERE user_id = '$userId' AND test_type = 'JS'";
    ;
    ;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count == 3) {
        // Pokud uživatel splnil testy JavaScript, generujeme a stahujeme JavaScript certifikát
        generateAndDownloadPDF($conn);
    } else {
        // Pokud uživatel nesplnil testy JavaScript, zobrazíme mu zprávu
        echo '<script>alert("Musíte splnit testy JavaScript, abyste mohli získali certifikát.");</script>';
    }
}


// // Ověření, zda bylo kliknuto na tlačítko pro stahování PDF
// if (isset($_POST['download_pdf'])) {
//     generateAndDownloadPDF($conn); // Zavolání funkce pro generování a stahování PDF
// }


if (isset($_POST['Poznatek'])) {
    $poznatek = mysqli_real_escape_string($conn, $_POST['Poznatek']);
    $datum = date("Y-m-d H:i:s"); // Aktuální datum a čas
    $userId = $_SESSION['id'];

    // Příprava dotazu pro vložení nové poznámky do databáze
    $insert = "INSERT INTO usernotes (NoteText,UserID,DateCreated) VALUES('$poznatek','$userId','$datum')";
    mysqli_query($conn, $insert);

    header("Location: Hlavni_stranka.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="logo-new-bílý.png">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

    #noteFormContainer {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #525252;
        color: white;
    }


    #noteFormContainer.show {
        display: block;
    }

    .closeBtn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
        /* Nastavení kurzoru na pointer */
    }

    .closeBtn:hover {
        color: blue;
        /* Změna barvy kříže po najetí myší */
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
                    <a href="Info.php">Obecné Informace</a>
                    <a id="showFormBtn">Poznatek</a>
                </div>
            </div>
            <a href="login.php"><b>Přihlášení</b></a>
            <a href="Profil.php"><b>Profil</b></a>
            <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
                <i class="fa fa-bars"></i>

            </a>
        </div>

        <div id="noteFormContainer">
            <span style="float: right;" class="closeBtn" onclick="closeForm()">&times;</span>
            <h2>Napište poznatek</h2>
            <form id="noteForm" method="post">
                <label for="poznatek">Poznatky:</label><br>
                <textarea id="Poznatek" name="Poznatek" rows="8" cols="100"
                    style="max-block-size: 200px; max-width: 600px;"></textarea><br>
                <input
                    style="background-color: #3B3B3B; color: white;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size: 25px; padding : 10px"
                    type="submit" value="Odeslat">
            </form>
        </div>

        <div class="container" style="display:block;background-color:black;opacity: 0.9;color:white;padding: 5%;">

            <div class="content">



                <p style="text-align: left;font-size : 3em;text-align:center;">Profil</p>
                <label style="font-size : 2em">Jméno:</label>
                <span style="font-size: 2em;">
                    <?php echo $_SESSION['name']; ?>
                </span>



                <form style="text-align: center;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label style="font-size: 2em" for="submit">Certifikáty</label><br>
                    <button class="button-link" type="submit" name="download_html_pdf">HTML certifikát</button>
                    <button class="button-link" type="submit" name="download_php_pdf">PHP certifikát</button>
                    <button class="button-link" type="submit" name="download_js_pdf">JS certifikát</button>
                </form><br><br>
                <div class="logout-btn">
                    <a style="background-color: red" href="logout.php">Odhlásit se</a>
                </div>
            </div>


        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showFormBtn = document.getElementById('showFormBtn');
            const noteFormContainer = document.getElementById('noteFormContainer');

            // Přidání posluchače události pro zobrazení formuláře po kliknutí na tlačítko
            showFormBtn.addEventListener('click', function () {
                noteFormContainer.classList.toggle('show');
            });

            // Přidání posluchače události pro skrytí formuláře po odeslání
            const noteForm = document.getElementById('noteForm');
            noteForm.addEventListener('submit', function () {
                noteFormContainer.classList.remove('show');
            });
        });

        function closeForm() {
            document.getElementById('noteFormContainer').classList.remove('show');
        }
    </script>
</body>

</html>