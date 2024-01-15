<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Učení HTML</title>
    <style>
      body {
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    margin: 0;
    padding: 0;
    font-size: 1.1em;
}

.logo img {
    float: right;
       margin-left: 3%;
       margin-top: 5%;
       width: 95%;
       height: auto;
}

.sidebar {
    margin: 0;
    padding: 0;
    width: 200px;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
    transition: 0.5s;
}

.sidebar a {
    display: block;
    color: black;
    padding: 16px;
    text-decoration: none;
}

.sidebar a.active {
    background-color: #3B3B3B;
    color: white;
    font-size: 1.2em;
}

.sidebar a:hover:not(.active) {
    background-color: #555;
    color: white;
}

div.content {
    margin-left: 200px;
    padding: 1px 16px;
    height: 1000px;
}

@media screen and (max-width: 700px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .sidebar a {
        float: left;
        width: 100%;
        text-align: center;
    }
    div.content {
        margin-left: 0;
    }
}

@media screen and (max-width: 400px) {
    .sidebar a {
        text-align: center;
        float: none;
    }
}

    </style>
</head>
<body>

        <div>

        <div style=" float: right; margin-right: 1%;" class="logo">
				  <a href="hlavni_stranka.php">
				  <img src="logo-new-bílý.png" alt="logo">
			  </a>
			  </div>


 <div class="sidebar">
  <a class="active">JavaScript</a>
  <a href="#news"></a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>

  <a class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
</div>




<div class="content">

</div>

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

<!-- Footer -->
<footer>
    <p>&copy; 2023 Učení HTML. Všechna práva vyhrazena.</p>
</footer>

</body>
</html>
