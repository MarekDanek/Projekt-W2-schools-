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

        header {
            background-image: url("background-modified.png");
            height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .logo img {
            float: right;
            margin-left: 3%;
            margin-top: 10%;
            width: 55px;
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

        .content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        /* Styly pro editovatelný nadpis a obsah */
        .editable-title,
        .editable-content {
            padding: 8px; 
            clear: both;
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
    </style>
</head>
<body>

<header>
    <div>
        <!-- Logo vpravo nahoře -->
        <div style=" float: right; margin-right: 3%;" class="logo">
            <a href="hlavni_stranka.php">
                <img src="logo.png" alt="logo">
            </a>
        </div>

        <!-- Boční panel s odkazy na stránky -->
        <div class="sidebar">
             <a class="active">HTML</a>
             <a onclick="changeContent('Uvod')">Úvod</a>
             <a onclick="changeContent('Prvky')">Prvky</a>
             <a onclick="changeContent('Atributy')">Atributy</a>
             <a onclick="changeContent('CSS')">CSS a Styly<a>
             <a onclick="changeContent('Obrazky')">Obrázky</a>
             <a onclick="changeContent('tabulky')">Tabulky</a>
             <a onclick="changeContent('Seznamy')">Seznamy</a>
             <a onclick="changeContent('Div')">Div</a>
             <a onclick="changeContent('Formatovani')">Formátování</a>
             <a onclick="changeContent('Formulare')">Formuláře</a>
             <a onclick="changeContent('Platno')">Plátno<a>
             <a onclick="changeContent('Tridy')">Třídy a ID</a>
             <a onclick="changeContent('Responzivnost')">Responzivnost</a>
             <a onclick="changeContent('Media')">Média</a>
        </div>

        <!-- Obsah stránky -->
        <div class="content">
            <!-- Obsah pro stránku s ID 'uvod' -->
            <div  class="active">
                  <!-- Editovatelný nadpis -->
            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;border-radius: 5%" class="editable-title"  id="pageTitle">
                    <h1 style="text-align: center;font-size: 4em">HTML</h1><br>
                  
                    <h2 style="text-align: center;">Vítejte v Kurzu HTML, naučíte se zde základy jazyku HTML.</h2><br>
                    <h2 style="text-align: center;">Na levé straně si vyberte, jakou část HTML se chcete naučit.</h2>
                </div>
                <div style="opacity: 1;text-align:center; display:block;width:120%;height:60%" class="editable-title"  id="pageTitle">
                    <img  src="doctype.png">
                 </div>
            
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Vyberte obsah v bočním panelu.</div>
            </div>

            <!-- Obsah pro stránku s ID 'prvky' -->

            <div id="Uvod">
                <!-- Editovatelný nadpis -->
                <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
                   
                   <h1 style="text-align:center" >Úvod</h1><br>
                   <h3 style="text-align:center">HTML(HyperText Markup Language) je jazyk používaný pro strukturování obsahu na webových stránkách.</h3>
           
              </div>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>


            <div id="Prvky">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Prvky</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Atributy">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Atributy</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="CSS">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">CSS</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Obrazky">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Obrazky</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Tabulky">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Tabulky</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Seznamy">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Seznamy</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Div">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Div</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Formatovani">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Formatovani</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Formulare">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Formulare</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Platno">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Platno</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Tridy">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Tridy a ID</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Responzivnost">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Responzivnost</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Media">
                <!-- Editovatelný nadpis -->
                <p class="editable-title"  id="pageTitle">Media</p>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>
        </div>
    </div>
</header>

<footer>
    <p>&copy; 2023 W3Schools quiz</p>
</footer>

<script>
    // Definice obsahu stránek
    const pages = [
            {id: 'Uvod', title: 'Úvod', content: 'Obsah stránky 1.' },
            {id: 'Prvky', title: 'Prvky', content: 'Obsah stránky 2.' },
            {id: 'Atributy', title: 'Atributy', content: 'Obsah stránky 3.' },
            {id: 'CSS', title: 'CSS a styly', content: 'Obsah stránky 1.' },
            {id: 'Obrazky', title: 'Obrázky', content: 'Obsah stránky 2.' },
            {id: 'Tabulky', title: 'Tabulky', content: 'Obsah stránky 3.' },
            {id: 'Seznamy', title: 'Seznamy', content: 'Obsah stránky 1.' },
            {id: 'Div', title: 'Div', content: 'Obsah stránky 2.' },
            {id: 'Formatovani', title: 'Formátování', content: 'Obsah stránky 3.' },
            {id: 'Formulare', title: 'Formuláře', content: 'Obsah stránky 1.' },
            {id: 'Platno', title: 'Plátno', content: 'Obsah stránky 2.' },
            {id: 'Tridy', title: 'Třídy a ID', content: 'Obsah stránky 3.' },
            {id: 'Responzivnost', title: 'Responzivnost', content: 'Obsah stránky 3.' },
            {id: 'Media', title: 'Média', content: 'Obsah stránky 3.' }
        ];

    // Funkce pro změnu obsahu stránky
    function changeContent(pageId) {
        // Skryj všechny obsahy
        document.querySelectorAll('.content div').forEach(div => div.classList.remove('active'));
        
        // Zobraz vybraný obsah
        document.getElementById(pageId).classList.add('active');
    }
</script>

</body>
</html>