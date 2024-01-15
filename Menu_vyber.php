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
    <title>Výběr jazyka</title>
    <style>
        body {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 1.1em;
            background-color: #f5f5f5;
        }

        header{

        background-image: url("background-modified.png");
        height: 100vh;
        background-size: cover;
        background-position: center;

      }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        .title{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.logo img{
       float: right;
       margin-left: 3%;
       margin-top: 10%;
       width: 55px;
       height: auto;
}


.title h1{
    text-transform: uppercase;
    color: white;
    font-size: 50px;
    background-color: #3B3B3B;
    border-radius: 20px;
    padding: 10px 10px;

     
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
  font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
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
  .navbar a:not(:first-child) {display: none;}
  .navbar a.icon {
    float: left;
    display: block;
  }
}

@media screen and (max-width: 820px) {
  .navbar.responsive {position: relative;}
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

.button-container {
            display: grid;
          
            gap: 10px;
            margin-top: 20px;
        }

        .w3-btn {
            font-size: 2.5em;
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .w3-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

    </style>
</head>
<body>
    <header>

    <div>

<div style=" float: right; margin-right: 3%;" class="logo">
  <a href="hlavni_stranka.php">
  <img src="logo.png" alt="logo">
</a>
</div>


<div class="navbar" id="menu">
  <a href="Hlavni_stranka.php" class="active"><b>Domů</b></a>
  <a href="Menu_vyber.php"><b>Kurzy</b></a>
  <a href="Testy.php"><b>Testy</b></a>
  <a href="informace.php"><b>Informace o IT</b></a>
  <a href="login.html"><b>Přihlášení</b></a>
  <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
    <i class="fa fa-bars"></i>

  </a>
</div>

    <div class="title" class="w3-container"> 
         <h1><b>Vyberte, jaký jazyk se chcete naučit.</b></h1>

         <div class="button-container">
    <a href="Kurz_JS.php" class="w3-btn w3-black w3-hover-white w3-round">JavaScript</a>
    <a href="Kurz_HTML.php" class="w3-btn w3-black w3-hover-white w3-round">HTML</a>
    <a href="Kurz_PHP.php" class="w3-btn w3-black w3-hover-white w3-round">PHP</a>
</div>

                 
     </diV>

        
 
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

        </script>

</body>
</html>