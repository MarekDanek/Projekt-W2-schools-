<?php

session_start();

// Zkontrolujte, zda je uživatel přihlášen
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // // Uživatel je přihlášen, můžete zobrazit například jeho jméno
  // echo 'Vítejte, ' . $_SESSION['name'] . '!';
  // // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
  // echo '<a href="logout.php">Odhlásit se</a>';
} else {
  // Pokud uživatel není přihlášen, můžete zobrazit odkaz na přihlašovací stránku nebo nějaké jiné akce
  // echo 'Prosím, přihlaste se <a href="login.php">zde</a>.';
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
  echo "Nepodařilo se připojit k MySql: " . mysqli_connect_errno();
  exit();

} else {
  // echo "je pripojeno";
}

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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="css-hlavni_stranka.css">
  <link rel="icon" href="icon.png">
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");


    * {
      margin: 0;
      padding: 0;

    }

    header {

      background-image: url("background.png");
      height: 100vh;
      background-size: cover;
      background-position: center;

    }

    .logo img {
      float: right;
      margin-left: 3%;
      margin-top: 5%;
      width: 85%;
      height: auto;
    }


    .title {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }

    .title h1 {
      text-transform: uppercase;
      color: white;
      font-size: 50px;
      background-color: #3B3B3B;
      border-radius: 20px;
      padding: 10px 10px;


    }

    .title b {
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

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
  <title>W2 Schools Quiz</title>
</head>

<body>

  <header>


    <div>

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

      <div class="title" class="w3-container">
        <h1><b>W2 Schools Quiz</b></h1>

      </diV>
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


  </header>

  <script>
    function ResponsiveNavbar() {
      var x = document.getElementById("menu");
      if (x.className === "navbar") {
        x.className += " responsive";
      } else {
        x.className = "navbar";
      }
    }


    function showDropdown() {
      document.getElementById("kurzyDropdown").classList.toggle("show");
    }

    // Zavřít dropdown, pokud uživatel klikne mimo něj
    window.onclick = function (event) {
      if (!event.target.matches('.dropdown')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

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