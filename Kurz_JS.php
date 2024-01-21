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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře
    $title = $_POST["Title"];
    $obsah = $_POST["Obsah"];

    // Uložení dat do databáze
    $sql = "INSERT INTO UserContent (Title, Obsah) VALUES ('$title', '$obsah')";

    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Chyba: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/ff64eh8dhqc8jrxg2u6y012u6f30leosxjppmc0zxq5jpbvi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Učení HTML</title>
    <style>
        body {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 1.1em;
            background-color: grey;
        }

        #userText {
            margin-top: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
        }

        .logo img {
            float: right;
       margin-left: 3%;
       margin-top: 5%;
       width: 85%;
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
    scrollbar-width: thin; 
    scrollbar-color: darkgrey lightgrey; 
        }

        .sidebar::-webkit-scrollbar {
            width: 12px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #333333
}

.sidebar::-webkit-scrollbar-track {
    background-color: lightgrey;
}

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #555;
            color: white;
            font-size: 1.2em;
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        .content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 900%;
          
        }

        /* Styly pro editovatelný nadpis a obsah */
        .editable-title,
        .editable-content {
            padding: 8px; 
            clear: both;
            
        }
        .editable-title{
           
            
        }
        /* Skryj všechny obsahy a zobraz pouze vybraný */
        .content div {
            display: none;
        }

        /* Zobraz vybraný obsah */
        .content div.active {
            display: block;
        }

        /* Responzivní layout pro menší obrazovky */
        @media screen and (max-width: 600px) {
            .sidebar {
                width: 100%;
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        #code-container {
            background-color: #282c34;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 50%;
            margin: auto;
            
            
        }

        code {
            display: block;
           
        }

        /* Styly pro vyhledávací pole */
.search-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    
   
    
}

#searchInput {
    padding: 10px;
   
}

.search-container button {
    padding: 12px;
    background: #3B3B3B;
    color: white;
    border: none;
    cursor: pointer;
}

.comment{
    background-color:black;
    color: white;
}

.button-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
        }

        form {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            color:black;
            
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-size: 1,5em;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: black;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: grey;
            color: black;
        }


    </style>
</head>
<body>

<header>
    <div>
        <!-- Logo vpravo nahoře -->
        <div style=" float: right; margin-right: 1%;" class="logo">
				  <a href="hlavni_stranka.php">
				  <img src="logo-new-bílý.png" alt="logo">
			  </a>
			  </div>


        

        <!-- Boční panel s odkazy na stránky -->
        <div class="sidebar">
            <a style="background-color:#3B3B3B;" href="Hlavni_stranka.php"><b>DOMŮ</b></a>
             <a onclick="changeContent('JavaScript')" class="active">Javascript</a>
             <a onclick="changeContent('Uvod')">Úvod</a>
             <a onclick="changeContent('Syntaxe')">Syntaxe</a>
             <a onclick="changeContent('Operace')">Operace</a>
             <a onclick="changeContent('Funkce')">Funkce<a>
             <a onclick="changeContent('Objekty')">Objekty</a>
             <a onclick="changeContent('Udalosti')">Udalosti</a>
             <a onclick="changeContent('Pole')">Pole</a>
             <a onclick="changeContent('Matematicke_funkce')">Matematické funkce</a>
             <a onclick="changeContent('IF')">IF</a>
             <a onclick="changeContent('JSON')">JSON</a>
        </div>

        

        <div class="content">
            
            <!-- Obsah pro stránku s ID 'uvod' -->
            <div  class="active"  id="JavaScript">
                
                  <!-- Editovatelný nadpis -->
            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;" class="editable-title"  id="pageTitle">

            <div style="display:block" class="search-container">
                    <input type="text" id="searchInput" placeholder="Hledat...">
                    <button onclick="searchPage()">Hledat</button>
                          </div>

                    <h1 style="text-align: center;font-size: 4em">JavaScript</h1><br>
                  
                    <h2 style="text-align: center;">Vítejte v Kurzu JavaScript, naučíte se zde základy jazyku JavaScript</h2><br>
                    <h2 style="text-align: center;">Na levé straně si vyberte, jakou část JS se chcete naučit, nebo vyhledejte podle klíčového slova.</h2><br>
                           

                </div>
   
               
            
              
            </div>


            <div id="Uvod">
          
            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">

            <h1 style="text-align: center;font-size: 4em">Úvod</h1><br>
       
          
           
              </div>
            </div>


            <div id="Syntaxe">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
                     
            <h1 style="text-align: center;font-size: 4em">Syntaxe</h1><br>



            </div>
            </div>
             
          

            <div id="Operace">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Operace</h1><br>

  


    </div>
               
              
               
            </div>

            <div id="Funkce">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Funkce</h1><br>
  


    </div>
               
              
               
            </div>


            <div id="Objekty">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Objekty</h1><br>
  


    </div>
               
              
               
            </div>

            <div id="Udalosti">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Údálosti</h1><br>
  


    </div>
               
              
               
            </div>

            <div id="Pole">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Pole</h1><br>
  


    </div>
               
              
               
            </div>

            <div id="matematicke_funkce">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">Matematické funkce</h1><br>
  


    </div>
               
              
               
            </div>

            <div id="IF">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">IF</h1><br>
  


    </div>
               
              
               
            </div>

            <div id="JSON">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
          
            <h1 style="text-align: center;font-size: 4em">JSON</h1><br>
  


    </div>
               
              
               
            </div>

    </div>



</header>

<script>
    // Definice obsahu stránek
    const pages = [
            {id: 'JavaScript', title: 'JavaScript' },
            {id: 'Uvod', title: 'Uvod' },
            {id: 'Syntaxe', title: 'Syntaxe' },
            {id: 'Operace', title: 'Operace' },
            {id: 'Funkce', title: 'Funkce' },
            {id: 'Objekty', title: 'Objekty' },
            {id: 'Udalosti', title: 'Udalosti' },
            {id: 'Pole', title: 'Pole' },
            {id: 'Matematicke_funkce', title: 'Matematickee funkce' },
            {id: 'IF', title: 'IF' },
            {id: 'JSON', title: 'JSON' }     
        ];

    // Funkce pro změnu obsahu stránky
    function changeContent(pageId) {
        // Skryj všechny obsahy
        document.querySelectorAll('.content div').forEach(div => div.classList.remove('active'));
        
        // Zobraz vybraný obsah
        const pageElement = document.getElementById(pageId);
        if (pageElement) {
            pageElement.classList.add('active');
        }
    }
    


    function searchPage() {
    var searchTerm = document.getElementById('searchInput').value.toLowerCase();

    // Projdi pole stránek
    for (var i = 0; i < pages.length; i++) {
        
        var pageTitle = pages[i].title.toLowerCase();

        // Pokud nalezneme shodu, přepneme na stránku a zobrazíme její obsah
        if (pageTitle.includes(searchTerm)) {
            changeContent(pages[i].id);
            return;
            
        }
    }

    // Pokud není nalezena shoda, můžete zde přidat kód pro zprávu o nenalezení
    alert('Stránka nenalezena.');
}



</script>

</body>
</html>