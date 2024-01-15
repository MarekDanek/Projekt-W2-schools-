 <?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()){
    echo "Nepodařilo se připojit k MySql: ". mysqli_connect_errno();
    exit();
    
}else{
    // echo "je pripojeno";
}

//md5 hašuje
//mysqli_real_escape_string se používá k escapování znaků v řetězci, což umožňuje legální použití v příkazu SQL.
//Funkce stripslashes() odstraňuje zpětná lomítka přidaná funkcí addlashes().

if(isset($_POST['submit'])){
   
    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $password = mysqli_real_escape_string($conn,$_POST['Password']);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    

    $select = " SELECT * FROM users WHERE Username = '$username' && Password = '$password' && Email = '$email' ";

    $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

       $error[] = 'uživatel již existuje!';

   }else{
           $insert = "INSERT INTO users (Username, Password, Email) VALUES('$username','$hash','$email')";
         mysqli_query($conn, $insert);
        header('location:login.html');
        
     }
   };




?> 

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="icon_guitar.jpg">
    <style>

* {
  	box-sizing: border-box;
}
header{
	background-image: url("background-modified.png");
    height: 100vh;
    background-size: cover;
    background-position: center;
}

.Register {
  	width: 500px;
  	background-color: #ffffff;
  	box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
  	margin: 100px auto;
    border : solid black 4px;
}
.Register h1 {
  	text-align: center;
  	color: #5b6574;
  	font-size: 24px;
  	padding: 20px 0 20px 0;
  	border-bottom: 1px solid #dee0e4;
}
.Register form {
  	display: flex;
  	flex-wrap: wrap;
  	justify-content: center;
  	padding-top: 20px;
}
.Register form label {
  	display: flex;
  	justify-content: center;
  	align-items: center;
  	width: 50px;
  	height: 50px;
  	background-color: black;
  	color: #ffffff;
}
.Register form input[type="password"], .Register form input[type="text"], .Register form input[type="email"] {
  	width: 410px;
  	height: 50px;
  	border: 1px solid #dee0e4;
  	margin-bottom: 20px;
  	padding: 0 15px;
}
.Register form input[type="submit"] {
  	width: 100%;
  	padding: 15px;
 	margin-top: 20px;
  	background-color: black;
  	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
}
.Register form input[type="submit"]:hover {
	background-color: grey;
  	transition: background-color 0.2s;
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

.logo img{
  float: right;
       margin-left: 3%;
       margin-top: 5%;
       width: 95%;
       height: auto;
}

.dropdown {
            display: inline-block;
            float:left;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
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
   <title>Registrování</title>

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
            <a href="informace.php"><b>Informace o IT</b></a>
            <a href="login.html"><b>Přihlášení</b></a>
            <a href="javascript:void(0);" class="icon" onclick="ResponsiveNavbar()">
              <i class="fa fa-bars"></i>

            </a>
          </div>

  <body class="Registredin">
		
		<div class="Register">
			<h1>Registrování</h1>
			<form method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Jméno" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Heslo" id="password" required>
        <label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" name="submit" value="Registrovat">
			</form>
		</div>

      </form>

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
    window.onclick = function(event) {
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
        </script> 


</body>
</html>

