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

.title h1{
    text-transform: uppercase;
    color: white;
    font-size: 50px;
    background-color: #3B3B3B;
    border-radius: 20px;
    padding: 10px 10px;

     
}

    </style>
</head>
<body>
    <header>

    <div class="title" class="w3-container"> 
         <h1><b>Vyberte, jaký jazyk se chcete naučit.</b></h1>

             <div style="text-align : center;">     
          <a href="Kurz_JS.php">  <button style="font-size: 2.5em;" class="w3-btn w3-black w3-hover-white w3-round">JavaScript</button></a>
          <a href="Kurz_HTML.php"> <button style="font-size: 2.5em" class="w3-btn w3-black w3-hover-white w3-round">HTML</button></a>
          <a href="Kurz_PHP.php"> <button style="font-size: 2.5em" class="w3-btn w3-black w3-hover-white w3-round">PHP</button></a>
            </div>
                 
     </diV>

        
 
    </header>
 

</body>
</html>