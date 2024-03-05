<?php
session_start();

// Zkontrolujte, zda je uživatel přihlášen
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    echo '<a href="logout.php">Odhlásit se</a>';
} else {
    // Pokud uživatel není přihlášen, můžete zobrazit odkaz na přihlašovací stránku nebo nějaké jiné akce
    echo 'Prosím, přihlaste se <a href="login.php">zde</a>.';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/ff64eh8dhqc8jrxg2u6y012u6f30leosxjppmc0zxq5jpbvi/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Kurz HTML</title>
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

        .editable-title {}

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

        .comment {
            background-color: black;
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
            color: black;

        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-size: 1, 5em;
        }

        form input,
        form textarea {
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
                        <a onclick="changeContent('Tabulky')">Tabulky</a>
                        <a onclick="changeContent('Seznamy')">Seznamy</a>
                        <a onclick="changeContent('Formulare')">Formuláře</a>
                        <a onclick="changeContent('Responzivnost')">Responzivnost</a>
            </div>



            <!-- Obsah stránky -->
            <div class="content">

                <!-- HTML -->

                <!-- Obsah pro stránku s ID 'uvod' -->
                <div class="active" id="HTML">

                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;"
                        class="editable-title" id="pageTitle">



                        <div style="display:block" class="search-container">
                            <input type="text" id="searchInput" placeholder="Hledat...">
                            <button onclick="searchPage()">Hledat</button>
                        </div>




                        <h1 style="text-align: center;font-size: 4em">HTML</h1><br>

                        <h2 style="text-align: center;">Vítejte v Kurzu HTML, naučíte se zde základ jazyku HTML.</h2>
                        <br>
                        <h2 style="text-align: center;">Na levé straně si vyberte, jakou část HTML se chcete naučit,
                            nebo vyhledejte podle klíčového slova.</h2><br>
                        <h2 style="text-align: center;">Můžete si zde vytvořit svůj vlastní obsah, jestli vám něco zde
                            chybí. Jen klikněte na tlačítko "Vytvořit vlastní obsah"</h2><br>

                        <div style="display:block;text-align:center;">
                            <button onclick="goToEditor()" class="button-link">Vytvořit vlastní obsah</button>
                        </div>

                        <div style="display:block">
                            <h1>Váš obsah</h1>
                            <div style="display:block;font-size:2em;" id="my-div"></div>
                            <button class="button-link" onclick="deleteAllContent()">Smazat vše</button>

                        </div>

                    </div>



                </div>

                <!-- UVOD -->

                <div id="Uvod">
                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Úvod</h1><br>
                        <h3 style="text-align:center">HTML(HyperText Markup Language) je jazyk používaný pro
                            strukturování obsahu na webových stránkách.</h3><br>

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
                        <h3 style="text-align:center">Obsah stránky se značkuje pomocí různých HTML elementů. Například
                            <code>&lt;h1&gt; až &lt;h6&gt; se používají pro nadpisy,</code><code>&lt;p&gt; pro odstavce, a mnoho dalších elementů pro různé účely.</code>
                        </h3><br>

                        <h2 style="text-align:center">Atributy</h2>
                        <h3 style="text-align:center">Elementy mohou mít také atributy, které poskytují další informace
                            o elementu. Atributy jsou vždy uvedeny v začátkovém tagu. Například
                            <code>&lt;img src="obrazek.jpg" alt="Popisek obrázku"&gt;.</code>
                        </h3><br>

                        <h3 style="text-align:center">HTML je základním nástrojem pro vytváření stránek na internetu. S
                            jeho pomocí můžete strukturovat obsah, přidávat obrázky, odkazy, formuláře a mnoho dalšího.
                            Nyní můžete začít s tvorbou vlastních webových stránek.</h3><br>



                    </div>


                </div>


                <!-- Prvky -->



                <div id="Prvky">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Základní HTML Prvky</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;h1&gt; až &lt;h6&gt; - Nadpisy</h2>
                        <h3 style="text-align:center">Nadpisy se používají k označení různých úrovní nadpisů na stránce.
                            <code>&lt;h1&gt; je nejvyšší úrovně, zatímco &lt;h6&gt; je nejnižší.</code>
                        </h3><br>

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
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;p&gt; - Odstavec</h2>
                        <h3 style="text-align:center">
                            <code>Element &lt;p&gt; slouží k vytváření odstavců textu na stránce. Každý odstavec je oddělen prázdným prostorem od ostatních.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad odstavců</p>

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
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;a&gt; - Odkaz</h2>
                        <h3 style="text-align:center">
                            <code>Element &lt;a&gt; slouží k vytváření odkazů na jiné stránky, soubory nebo místa na stejné stránce. Atribut href určuje cílovou adresu.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad odkazů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                       
                &lt;a href="https://www.ben.com"&gt;Odkaz na příklad&lt;/a&gt;<br>

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <h2 style="text-align:center;background-color:#191616;">&lt;img&gt; - Obrázek</h2>
                        <h3 style="text-align:center">
                            <code>Element &lt;img&gt; se používá k vkládání obrázků na stránku. Atribut src specifikuje zdrojový soubor obrázku.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad obrázku</p>

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
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;ul&gt;, &lt;ol&gt; a &lt;li&gt; -
                            Seznamy</h2>
                        <h3><code>Pro vytváření nečíslovaných seznamů použijte &lt;ul&gt; a &lt;li&gt;. Pro číslované seznamy použijte &lt;ol&gt;.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady seznamu</p>

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
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;div&gt; - Blokový Kontejner</h2>
                        <h3 style="text-align:center">
                            <code>Element &lt;div&gt; slouží k vytváření blokových kontejnerů pro skupiny elementů. Používá se pro organizaci a formátování obsahu.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady Blokovýho kontejneru</p>

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
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;span&gt; - Řádkový Kontejner</h2>
                        <h3 style="text-align:center">
                            <code>Element &lt;span&gt; slouží k vytváření řádkových kontejnerů pro skupiny textových prvků. Používá se pro aplikaci stylů nebo skrytí části textu.</code>
                        </h3><br>


                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady řádksovýho kontejneru</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br><br>


                        <h3 style="text-align:center">Toto jsou jen základní HTML prvky. Existuje mnoho dalších prvků,
                            které můžete používat k vytváření struktury a obsahu webových stránek.</h3>


                    </div>



                </div>



                <!-- ATRIBUTY -->

                <div id="Atributy">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">
                        <!-- Editovatelný nadpis -->

                        <h1>HTML Atributy</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;class&gt; - Třída</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute class se používá k přiřazení jednoho nebo více CSS tříd prvkům pro stylování.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady třídy</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &lt;style&gt;<br>
                .muj-span{<br>
                    
                }<br>
                &lt;/style&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span class="muj-span"&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;id&gt; - Identifikátor</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute id slouží k nastavení unikátního identifikátoru pro prvek.</code>
                        </h3><br>


                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady ID</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &lt;style&gt;<br>
                #muj-span{<br>
                    
                }<br>
                &lt;/style&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span id="muj-span"&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;style&gt; - Inline styly</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute style umožňuje nastavit inline CSS styly přímo uvnitř elementu.</code>
                        </h3>
                        <br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad inline stylů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span style=""&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;src&gt; - Zdroj</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute src se často používá pro specifikaci zdrojového souboru, například v elementu &lt;img&gt;.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady zdrojů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                //obrázek<br>            
                &lt;img src="nazev.png" alt="popisek"&gt;<br> 
                //audio<br>            
                &lt;audio src="nazev.ogg" controls&gt;<br> 
                &lt;/audio&gt;<br> 
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <h2 style="text-align:center;background-color:#191616;">&lt;href&gt; - Hypertext Reference</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute href se často používá pro odkazování na jiné stránky, soubory nebo místa na stejné stránce, například v elementu &lt;a&gt;.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady odkazů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>     

                &lt;a href="https://www.ben.com">Ben stránka&lt;/a&gt;
            
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;alt&gt; - popisek</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute alt se používá pro poskytnutí textu pro obrázky v elementu &lt;img&gt;.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady Popisků</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
         
                &lt;img src="nazev.png" alt="popisek"&gt;<br> 
              
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">&lt;width&gt; a &lt;height&gt; - Šířka a
                            Výška</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute width a height určují šířku a výšku elementu, například v elementu &lt;img&gt;.</code>
                        </h3><br><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklady výšky a šířky</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &lt;style&gt;<br>
                .muj-div{<br>
                    width : 100px;<br>
                    height : 100px;<br>
                }<br>
                &lt;/style&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;div class="muj-div"&gt;<br> 
                   Text v divu<br> 
                &lt;/div&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h3 style="text-align:center;">Tyto jsou jen některé z atributů, které můžete použít v HTML pro
                            ovlivnění chování a vzhledu prvků.</h3>


                    </div>



                </div>

                <!-- CSS -->

                <div id="CSS">
                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">


                        <h1>CSS a Styly</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">CSS - Kaskádové styly</h2>
                        <h3 style="text-align:center;">
                            <code>Styly v CSS definují vzhled a formátování webových stránek, dají se psát takhle do souboru HTML, nebo do externího souboru např. "styly.css"</code>
                        </h3><br><br>


                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad CSS</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &lt;style&gt;<br>
                .muj-div{<br>
                    width : 100px;<br>
                    height : 100px;<br>
                }<br>
                &lt;/style&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;div class="muj-div"&gt;<br> 
                   Text v divu<br> 
                &lt;/div&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                        <h2 style="text-align:center;background-color:#191616;">&lt;style&gt; - Inline styly</h2>
                        <h3 style="text-align:center;">
                            <code>Attribute style umožňuje nastavit inline CSS styly přímo uvnitř elementu</code>
                        </h3>
                        <br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad inline stylů</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                
                &lt;span style=""&gt;<br> 
                   Text v spanu<br> 
                &lt;/span&gt;<br> 

                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                    </div>


                </div>


                <div id="Tabulky">
                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">


                        <h1>Tabulky</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Tabulky</h2>
                        <h3 style="text-align:center;"><code>Elementy &lt;table&gt;, &lt;tr&gt; a &lt;td&gt; slouží k vytváření tabulek na webových stránkách. &lt;table&gt slouží k
                    vytvoření tabulky, &lt;tr&gt; k vytvoření řádku, &lt;td&gt obsahuje data.
                    
            </code></h3><br><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad Tabulky</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                 &lt;style&gt;<br>
                table, th, td {<br>
                    border:1px solid black;<br>
                }<br>
                &lt;/style&gt;<br>

                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                                
             &lt;table&gt;<br>  
                &lt;tr&gt;<br>  
                   
                    &lt;th&gt;Kontakt&lt;/th&gt;<br>  
                    &lt;th&gt;Stát&lt;/th&gt;<br>  
                &lt;/tr&gt;<br><br>  
                &lt;tr&gt;<br>  
                
                    &lt;td&gt;Karel&lt;/td&gt;<br>  
                    &lt;td&gt;Polsko&lt;/td&gt;<br>  
                &lt;/tr&gt;<br><br>    
                &lt;tr&gt;<br>  
         
                    &lt;td&gt;Nguen&lt;/td&gt;<br>  
                    &lt;td&gt;Česko&lt;/td&gt;<br>  
                &lt;/tr&gt;<br>  
                &lt;/table&gt;<br><br>    


                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>


                </div>

                <div id="Seznamy">
                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Seznamy</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Seznamy</h2>
                        <h3 style="text-align:center;">
                            <code>Elementy &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt; slouží k vytváření různých typů seznamů na webových stránkách. 
              &lt;ul&gt; slouží k vytváření nečíslovaného seznamu, &lt;ol&gt; slouží k vytváření číslovaného seznamu, &lt;li&gt; slouží k definování jednotlivých položek v seznamu. </code>
                        </h3><br><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad Tabulky</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br>      
                                                
                &lt;ol&gt;<br> 
                 &lt;li&gt;Coffee&lt;/li&gt;<br> 
                 &lt;li&gt;Tea&lt;/li&gt;<br> 
                 &lt;li&gt;Milk&lt;/li&gt;<br> 
                &lt;/ol&gt;<br><br>

                &lt;ul&gt;<br> 
                 &lt;li&gt;Coffee&lt;/li&gt;<br> 
                 &lt;li&gt;Tea&lt;/li&gt;<br> 
                 &lt;li&gt;Milk&lt;/li&gt;<br> 
                &lt;/ul&gt;<br> 


                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                    </div>

                </div>


                <div id="Formulare">
                    <!-- Editovatelný nadpis -->

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Formuláře</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Formuláře</h2>
                        <h3 style="text-align:center;">
                            <code>Elementy &lt;form&gt;, &lt;input&gt;, &lt;label&gt; a další slouží k vytváření formulářů na webových stránkách.
                &lt;form&gt; definuje začátek formuláře, &lt;input&gt; slouží k vytváření různých vstupních polí, &lt;label&gt; popisuje vstupní pole nebo tlačítko.
                Další prvky jako &lt;select&gt;, &lt;textarea&gt; a &lt;button&gt; jsou také běžně používány v rámci formulářů.</code>
                        </h3>
                        <br><br>


                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Příklad Tabulky</p>

                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br>          
                                                
            &lt;form&gt;<br>  
                &lt;label for="fname"&gt;Jméno:&lt;/label&gt;&lt;br&gt;<br>  
                &lt;input type="text" id="fname" name="fname" value="Marek"&gt;&lt;br&gt;<br>  
                &lt;label for="lname"&gt;Příjmení:&lt;/label&gt;&lt;br&gt;<br>  
                &lt;input type="text" id="lname" name="lname" value="Daněk"&gt;<br>  
             &lt;/form&gt;<br><br>      



                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
  
           
            </code>
                        </div><br>


                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>





                    </div>
                </div>
                <!-- Responzivnost -->

                <div id="Responzivnost">
                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Responzivnost</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Responzivní obsah</h2>
                        <h3 style="text-align:center;"><code>Responzivnost ve webech znamená přispůsobení obsahu na velikost obrazovky nebo zařízení, na kterém jsou zobrazovány.<br>
Můžeme použít <b>&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;</b> na přizpůsobení velikosti.<br>
Když dáte obrázku atribut <b>&lt;width : 100%&gt;</b> tak obrázek se zvětšuje a zmenšuje podle velikosti stránky.<br>
Když dáte obrázku atribut <b>&lt;max-width : 100%&gt;</b> tak se obrázek může zmenšit a přizpůsobit se stránce, ale nezvětší se než 100%.
</code></h3><br><br>





                    </div>


                </div>

            </div>
        </div>



    </header>

    <script>
        // Definice obsahu stránek
        const pages = [
            { id: 'HTML', title: 'HTML' },
            { id: 'Uvod', title: 'Úvod' },
            { id: 'Prvky', title: 'Prvky' },
            { id: 'Atributy', title: 'Atributy' },
            { id: 'CSS', title: 'CSS a styly' },
            { id: 'Tabulky', title: 'Tabulky' },
            { id: 'Seznamy', title: 'Seznamy' },
            { id: 'Formulare', title: 'Formuláře' },
            { id: 'Responzivnost', title: 'Responzivnost' }
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



        //TINYMCE

        var savedContent = localStorage.getItem('editorContent');
        if (savedContent) {
            document.getElementById('my-div').innerHTML = savedContent;
        }

        function deleteAllContent() {
            // Smazání všeho obsahu v divu
            document.getElementById('my-div').innerHTML = '';

            // Smazání obsahu v localStorage
            localStorage.removeItem('editorContent');
        }

        function goToEditor() {
            // Přesměrování zpět na editor
            window.location.href = 'tinymc-editor.php';
        }
    </script>

</body>

</html>