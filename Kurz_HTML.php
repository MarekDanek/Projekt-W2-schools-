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
             <a onclick="changeContent('HTML')" class="active">HTML</a>
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
            <div  class="active"  id="HTML">
                
                  <!-- Editovatelný nadpis -->
            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;" class="editable-title"  id="pageTitle">

            <div style="display:block" class="search-container">
                    <input type="text" id="searchInput" placeholder="Hledat...">
                    <button onclick="searchPage()">Hledat</button>
                          </div>
                

                    <h1 style="text-align: center;font-size: 4em">HTML</h1><br>
                  
                    <h2 style="text-align: center;">Vítejte v Kurzu HTML, naučíte se zde základy, jazyku HTML.</h2><br>
                    <h2 style="text-align: center;">Na levé straně si vyberte, jakou část HTML se chcete naučit, nebo vyhledejte podle klíčového slova.</h2><br>

                           

                </div>
   
               
            
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Vyberte obsah v bočním panelu.</div>
            </div>

            <!-- Obsah pro stránku s ID 'prvky' -->

            <div id="Uvod">
                <!-- Editovatelný nadpis -->
                <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
                   
                   <h1>Úvod</h1><br>
                   <h3 style="text-align:center">HTML(HyperText Markup Language) je  jazyk používaný pro strukturování obsahu na webových stránkách.</h3><br>
                  
                   <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Základní kostra HTML</p>
  
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>              
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Váš HTML a CSS kód zde<br>         
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
        </div>
        <br>

        <h2 style="text-align:center">Značkování obsahu</h2>
    <h3 style="text-align:center">Obsah stránky se značkuje pomocí různých HTML elementů. Například <code>&lt;h1&gt; až &lt;h6&gt; se používají pro nadpisy,</code><code>&lt;p&gt; pro odstavce, a mnoho dalších elementů pro různé účely.</code></h3><br>
    
    <h2 style="text-align:center">Atributy</h2>
    <h3 style="text-align:center">Elementy mohou mít také atributy, které poskytují další informace o elementu. Atributy jsou vždy uvedeny v začátkovém tagu. Například <code>&lt;img src="obrazek.jpg" alt="Popisek obrázku"&gt;.</code></h3><br>

    <h3 style="text-align:center">HTML je základním nástrojem pro vytváření stránek na internetu. S jeho pomocí můžete strukturovat obsah, přidávat obrázky, odkazy, formuláře a mnoho dalšího. Nyní můžete začít s tvorbou vlastních webových stránek.</h3><br>
        
                 <form method="post" id="Form">
                    <label for="Title">Title:</label>
                    <input type="text" id="Title" name="Title" required>
                    <label for="Obsah">Obsah:</label>
                    <input type="text" id="Obsah" name="Obsah" required>


                    <button type="submit">Send Message</button>
                </form>
           
              </div>
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>


            <div id="Prvky">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
                     
            <h1>Základní HTML Prvky</h1>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;h1&gt; až &lt;h6&gt; - Nadpisy</h2>
    <h3 style="text-align:center">Nadpisy se používají k označení různých úrovní nadpisů na stránce. <code>&lt;h1&gt; je nejvyšší úrovně, zatímco &lt;h6&gt; je nejnižší.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                       
                &lt;h1&gt;Vítejte na webu!&lt;/h1&gt;<br>
       &lt;h2&gt;Podnadpis&lt;/h2&gt;<br>
       &lt;h3&gt;Podnadpis druhé úrovně&lt;/h3&gt;<br>
       &lt;h4&gt;Podnadpis třetí úrovně&lt;/h4&gt;<br>
       &lt;h5&gt;Podnadpis čtvrté úrovně&lt;/h5&gt;<br>
       &lt;h6&gt;Podnadpis páté úrovně&lt;/h6&gt;<br>   

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;p&gt; - Odstavec</h2>
    <h3 style="text-align:center"><code>Element &lt;p&gt; slouží k vytváření odstavců textu na stránce. Každý odstavec je oddělen prázdným prostorem od ostatních.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                       
                &nbsp;&lt;p&gt;&lt;Toto je váš text v odstavci.&lt;/p&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;a&gt; - Odkaz</h2>
    <h3 style="text-align:center"><code>Element &lt;a&gt; slouží k vytváření odkazů na jiné stránky, soubory nebo místa na stejné stránce. Atribut href určuje cílovou adresu.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                       
                &lt;a href="https://www.example.com"&gt;Odkaz na příklad&lt;/a&gt;<br>

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>
    
    
    <h2 style="text-align:center;background-color:#191616;">&lt;img&gt; - Obrázek</h2>
    <h3 style="text-align:center"><code>Element &lt;img&gt; se používá k vkládání obrázků na stránku. Atribut src specifikuje zdrojový soubor obrázku.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                       
                &lt;img src="obrazek.jpg" alt="Popisek obrázku"&gt;<br>

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;ul&gt;, &lt;ol&gt; a &lt;li&gt; - Seznamy</h2>
    <h3><code>Pro vytváření nečíslovaných seznamů použijte &lt;ul&gt; a &lt;li&gt;. Pro číslované seznamy použijte &lt;ol&gt;.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                            &lt;ul&gt;<br>
                &lt;li&gt;Položka 1&lt;/li&gt;<br>
                &lt;li&gt;Položka 2&lt;/li&gt;<br>
                &lt;li&gt;Položka 3&lt;/li&gt;<br>
            &lt;/ul&gt;<br>

            &lt;ol&gt;<br>
                &lt;li&gt;První položka&lt;/li&gt;<br>
                &lt;li&gt;Druhá položka&lt;/li&gt;<br>
                &lt;li&gt;Třetí položka&lt;/li&gt;<br>
            &lt;/ol&gt;<br>

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;div&gt; - Blokový Kontejner</h2>
    <h3 style="text-align:center"><code>Element &lt;div&gt; slouží k vytváření blokových kontejnerů pro skupiny elementů. Používá se pro organizaci a formátování obsahu.</code></h3><br>

    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;div&gt;<br>   
                    Obsah divu zde<br>   
                &lt;/div&gt;<br>   

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;span&gt; - Řádkový Kontejner</h2>
    <h3 style="text-align:center"><code>Element &lt;span&gt; slouží k vytváření řádkových kontejnerů pro skupiny textových prvků. Používá se pro aplikaci stylů nebo skrytí části textu.</code></h3><br>

    
    <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady nadpisů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span class="moje-span"&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
        </div><br>

        <div style="text-align:center;display:block;">
    <a class="button-link" href="code-editor.php" target="_blank"><button class="button-link">Vyzkoušej</button></a>
    </div><br><br>


    <h3 style="text-align:center">Toto jsou jen základní HTML prvky. Existuje mnoho dalších prvků, které můžete používat k vytváření struktury a obsahu webových stránek.</h3>

    <form id="contentForm">
    <label for="pageTitle">Title:</label>
    <input type="text" id="pageTitle" name="pageTitle" required>
    
    <label for="pageContent">Content:</label>
    <textarea id="pageContent" name="pageContent" required></textarea>
    
    <button type="button" onclick="saveContent()">Save Content</button>
</form>

    


            </div>
                <!-- Editovatelný nadpis -->
                
                <!-- Editovatelný obsah -->
                <div class="editable-content"  id="pageContent">Obsah stránky 2.</div>
            </div>

            <div id="Atributy">

            <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
                <!-- Editovatelný nadpis -->

                <h1>HTML Atributy</h1><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;class&gt; - Třída</h2>
    <h3 style="text-align:center;"><code>Attribute class se používá k přiřazení jednoho nebo více CSS tříd prvkům pro stylování.</code></h3><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;id&gt; - Identifikátor</h2>
    <h3 style="text-align:center;"><code>Attribute id slouží k nastavení unikátního identifikátoru pro prvek.</code></h3><br>
    
    <h2 style="text-align:center;background-color:#191616;">&lt;style&gt; - Inline styly</h2>
    <h3 style="text-align:center;"><code>Attribute style umožňuje nastavit inline CSS styly přímo uvnitř elementu.</code></h3><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;src&gt; - Zdroj</h2>
    <h3 style="text-align:center;"><code>Attribute src se často používá pro specifikaci zdrojového souboru, například v elementu &lt;img&gt;.</code></h3><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;href&gt; - Hypertext Reference</h2>
    <h3 style="text-align:center;"><code>Attribute href se často používá pro odkazování na jiné stránky, soubory nebo místa na stejné stránce, například v elementu &lt;a&gt;.</code>/h3><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;alt&gt; - Alternativní Text</h2>
    <h3 style="text-align:center;"><code>Attribute alt se používá pro poskytnutí alternativního textu pro obrázky v elementu &lt;img&gt;.</code></h3><br>

    <h2 style="text-align:center;background-color:#191616;">&lt;width&gt; a &lt;height&gt; - Šířka a Výška</h2>
    <h3 style="text-align:center;"><code>Attribute width a height určují šířku a výšku elementu, například v elementu &lt;img&gt;.</code></h3><br><br>

    <h3 style="text-align:center;">Tyto jsou jen některé z atributů, které můžete použít v HTML pro ovlivnění chování a vzhledu prvků.</h3>


    </div>
               
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

<script>
    // Definice obsahu stránek
    const pages = [
            {id: 'HTML', title: 'HTML', content: 'Obsah stránky 1.' },
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