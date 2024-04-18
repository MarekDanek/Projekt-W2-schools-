<?php
session_start();

// Zkontrolujte, zda je uživatel přihlášen
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    // echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    // echo '<a href="Hlavni_stranka.php">Odhlásit se</a>';
} else {
    // Pokud uživatel není přihlášen, můžete zobrazit odkaz na přihlašovací stránku nebo nějaké jiné akce
    // echo 'Prosím, přihlaste se <a href="login.php">zde</a>.';
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
    <title>Kurz JS</title>
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
                <a onclick="changeContent('JavaScript')" class="active">Javascript</a>
                <a onclick="changeContent('Uvod')">Úvod</a>
                <a onclick="changeContent('Syntaxe')">Syntaxe</a>
                <a onclick="changeContent('Operace')">Operace</a>
                <a onclick="changeContent('Funkce')">Funkce<a>
                        <a onclick="changeContent('Objekty')">Objekty</a>
                        <a onclick="changeContent('Udalosti')">Udalosti</a>
                        <a onclick="changeContent('Pole')">Pole</a>
                        <a onclick="changeContent('matematicke_funkce')">Matematické funkce</a>
                        <a onclick="changeContent('IF')">IF</a>
                        <a onclick="changeContent('JSON')">JSON</a>
            </div>



            <div class="content">

                <!-- Obsah pro stránku s ID 'uvod' -->
                <div class="active" id="JavaScript">

                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;"
                        class="editable-title" id="pageTitle">

                        <div style="display:block" class="search-container">
                            <input type="text" id="searchInput" placeholder="Hledat...">
                            <button onclick="searchPage()">Hledat</button>
                        </div>

                        <h1 style="text-align: center;font-size: 4em">JavaScript</h1><br>

                        <h2 style="text-align: center;">Vítejte v Kurzu JavaScript, naučíte se zde základy jazyku
                            JavaScript</h2><br>
                        <h2 style="text-align: center;">Na levé straně si vyberte, jakou část JS se chcete naučit, nebo
                            vyhledejte podle klíčového slova.</h2><br>

                        <h2 style="text-align: center;"> <a target="_blank"
                                href="https://www.youtube.com/watch?v=FqqhAWJgN0E&list=PLQ8x_VWW6AktVAKDISvXrcsh6kp7Jt_SM">Klikněte
                                zde pro JS video tutoriál na youtubu od Davida Šetka.</a></h2>
                        <br>


                    </div>




                </div>


                <div id="Uvod">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Úvod</h1><br>

                        <h3 style="text-align:center">JS (JavaScript) je jazyk používaný pro tvorbu interaktivních
                            webových stránek na klientovi.</h3><br>
                        <h3 style="text-align:center">
                            <code>JS můžete psát přímo v souboru html -> &lt;script&gt;&lt;/script&gt; nebo si vytvořit soubor.js a do něj psát samostatný js kód.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Základní kostra JS</p>
  
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                
                &lt;script&gt;<br> <br> 
                 //zde se píše js kód<br><br> 
                &lt;/script&gt;<br>  
                       
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <h3 style="text-align:center">JS umožňuje měnit obsah v HTML s pomocí ->
                            document.getElementById("demo").innerHTML = "Hello JavaScript";.</h3><br>


                    </div>
                </div>


                <div id="Syntaxe">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Syntaxe</h1><br>

                        <h3 style="text-align:center">
                            <code>JS můžete psát přímo v souboru html -> &lt;script&gt;&lt;/script&gt; nebo si vytvořit soubor.js a do něj psát samostatný js kód.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Základní syntaxe JS</p>
  
                                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Deklarace proměnných<br>
                &nbsp;&nbsp;let x = 5; // Deklarace proměnné x s hodnotou 5<br>
                &nbsp;&nbsp;const PI = 3.14; // Deklarace konstanty PI s hodnotou 3.14<br>
                &nbsp;&nbsp;var message = 'Hello World'; // Deklarace proměnné message s hodnotou 'Hello World'<br>
                <br>
                &nbsp;&nbsp;//zde se píše JavaScriptový kód<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>




                    </div>
                </div>



                <div id="Operace">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Operace</h1><br>

                        <h3 style="text-align:center">JS nabízí širokou škálu operací, které umožňují
                            manipulaci s daty a interakci s uživatelem na webových stránkách.</h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Základní operace JS</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Deklarace proměnných<br>
                &nbsp;&nbsp;let x = 5; // Deklarace proměnné x s hodnotou 5<br>
                &nbsp;&nbsp;const PI = 3.14; // Deklarace konstanty PI s hodnotou 3.14<br>
                &nbsp;&nbsp;var message = 'Hello World'; // Deklarace proměnné message s hodnotou 'Hello World'<br>
                <br>
                &nbsp;&nbsp;// Operace s proměnnými<br>
                &nbsp;&nbsp;let y = x + 3; // Přiřazení součtu hodnot proměnných x a 3 do proměnné y<br>
                &nbsp;&nbsp;let z = x * y; // Přiřazení součinu hodnot proměnných x a y do proměnné z<br>
                <br>
                &nbsp;&nbsp;console.log(y); // Vypsání hodnoty proměnné y do konzole<br>
                &nbsp;&nbsp;alert(z); // Zobrazení hodnoty proměnné z v alert okně<br>
                <br>
                &nbsp;&nbsp;//zde se píše JavaScriptový kód<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>



                </div>

                <div id="Funkce">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Funkce</h1><br>

                        <h3 style="text-align:center">JS je bohatý na funkce, které umožňují strukturovat
                            kód, opakovatelně vykonávat úkoly a usnadňují správu komplexních aplikací na webových
                            stránkách.</h3><br>
                        <h3 style="text-align:center">
                            <code>V JavaScriptu můžete definovat vlastní funkce pomocí klíčového slova <code>function</code>
                            a poté je volat v rámci kódu. Funkce mohou být deklarovány přímo v HTML souborech nebo v
                            samostatných souborech s příponou .js, které se následně importují do HTML.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Funkce</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Definice funkce<br>
                &nbsp;&nbsp;function greet() {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;return "Hello World!";<br>
                &nbsp;&nbsp;}<br>
                <br>
                &nbsp;&nbsp;// Volání funkce<br>
                &nbsp;&nbsp;let message = greet();<br>
                <br>
                &nbsp;&nbsp;console.log(message); // Vypsání výsledku volání funkce do konzole<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                    </div>



                </div>


                <div id="Objekty">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Objekty</h1><br>
                        <h3 style="text-align:center">JS poskytuje koncept objektů, které umožňují
                            organizovat data a funkcionalitu do jednotlivých entit. Objekty jsou základními stavebními
                            bloky v JavaScriptu a umožňují vytvářet složité datové struktury a interakce.</h3><br>
                        <h3 style="text-align:center">
                            <code>V JavaScriptu můžete definovat objekty pomocí složených závorek <code>{}</code> a
                            přistupovat k jejich vlastnostem a metodám pomocí tečkové notace nebo závorkové notace.
                            Objekty mohou obsahovat různé typy dat, včetně čísel, řetězců, funkcí a dokonce i jiných
                            objektů.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Objekty</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Definice objektu<br>
                &nbsp;&nbsp;let person = {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;firstName: 'John',<br>
                &nbsp;&nbsp;&nbsp;&nbsp;lastName: 'Doe',<br>
                &nbsp;&nbsp;&nbsp;&nbsp;age: 30,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;fullName: function() {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return this.firstName + ' ' + this.lastName;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;}<br>
                <br>
                &nbsp;&nbsp;// Přístup k vlastnostem objektu<br>
                &nbsp;&nbsp;console.log(person.firstName); // Vypíše 'John'<br>
                &nbsp;&nbsp;console.log(person.age); // Vypíše 30<br>
                <br>
                &nbsp;&nbsp;// Volání metody objektu<br>
                &nbsp;&nbsp;console.log(person.fullName()); // Vypíše 'John Doe'<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                    </div>



                </div>

                <div id="Udalosti">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Údálosti</h1><br>
                        <h3 style="text-align:center">JS umožňuje manipulovat s interakcí uživatele na
                            webových stránkách pomocí událostí. Události jsou akce, které se odehrávají na stránce, jako
                            například kliknutí myší, stisknutí klávesy nebo načtení stránky, a JavaScript umožňuje
                            reagovat na tyto události a provádět odpovídající akce.</h3><br>
                        <h3 style="text-align:center">
                            <code>V JavaScriptu můžete zachytávat události pomocí přidání posluchačů událostí k elementům HTML, které vyvolávají dané události. Posluchači událostí jsou funkce, které jsou vyvolány, když se daná událost odehrává, a umožňují provádět různé akce v reakci na události.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Údálosti</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;button id="myButton"&gt;Click me&lt;/button&gt;<br><br>
                
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Zachytávání události kliknutí na tlačítko<br>
                &nbsp;&nbsp;document.getElementById('myButton').addEventListener('click', function() {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;alert('Button clicked!');<br>
                &nbsp;&nbsp;});<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                    </div>



                </div>

                <div id="Pole">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Pole</h1><br>

                        <h3 style="text-align:center">V JS je pole (array) datová struktura, která umožňuje
                            ukládat a organizovat více hodnot do jedné proměnné. Pole v JavaScriptu může obsahovat prvky
                            různých datových typů, včetně čísel, řetězců, objektů nebo dokonce jiných polí.</h3><br>
                        <h3 style="text-align:center">
                            <code>Pole v JavaScriptu se deklarují pomocí hranatých závorek <code>[]</code> a mohou být
                            inicializovány s konkrétními hodnotami nebo mohou být prázdná a naplněna později. Prvky v
                            poli jsou indexovány od nuly, což znamená, že první prvek má index 0, druhý prvek má index 1
                            a tak dále.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Základní kostra JS</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Deklarace a inicializace pole<br>
                &nbsp;&nbsp;let fruits = ['Apple', 'Banana', 'Orange'];<br>
                <br>
                &nbsp;&nbsp;// Přístup k prvkům pole pomocí indexu<br>
                &nbsp;&nbsp;console.log(fruits[0]); // Vypíše 'Apple'<br>
                &nbsp;&nbsp;console.log(fruits[1]); // Vypíše 'Banana'<br>
                <br>
                &nbsp;&nbsp;// Změna hodnoty prvku v poli<br>
                &nbsp;&nbsp;fruits[2] = 'Pear';<br>
                &nbsp;&nbsp;console.log(fruits); // Vypíše ['Apple', 'Banana', 'Pear']<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>



                </div>

                <div id="matematicke_funkce">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Matematické funkce</h1><br>
                        <h3 style="text-align:center">V JavaScriptu jsou k dispozici různé matematické funkce pro
                            provádění operací s čísly. Tyto funkce umožňují provádět základní matematické operace, jako
                            jsou sčítání, odčítání, násobení, dělení, umocňování a další.</h3><br>
                        <h3 style="text-align:center">
                            <code>Matematické funkce v JavaScriptu jsou součástí vnitřního objektu <code>Math</code>,
                            který obsahuje mnoho užitečných metod pro práci s čísly. Tyto metody zahrnují například
                            <code>Math.abs()</code> pro absolutní hodnotu, <code>Math.round()</code> pro zaokrouhlení na
                            nejbližší celé číslo a <code>Math.sqrt()</code> pro odmocninu.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Základní kostra JS</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Použití matematických funkcí<br>
                &nbsp;&nbsp;let number = -5.678;<br>
                &nbsp;&nbsp;let absoluteValue = Math.abs(number); // Výpočet absolutní hodnoty<br>
                &nbsp;&nbsp;let roundedValue = Math.round(number); // Zaokrouhlení na nejbližší celé číslo<br>
                &nbsp;&nbsp;let squareRoot = Math.sqrt(25); // Výpočet odmocniny<br>
                <br>
                &nbsp;&nbsp;console.log(absoluteValue); // Vypíše 5.678<br>
                &nbsp;&nbsp;console.log(roundedValue); // Vypíše -6 (zaokrouhlení dolů)<br>
                &nbsp;&nbsp;console.log(squareRoot); // Vypíše 5 (odmocnina z 25)<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>



                </div>

                <div id="IF">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">IF</h1><br>
                        <h3 style="text-align:center">V JavaScriptu se používá podmíněné vykonávání kódu pomocí
                            konstrukce `if`. Tato konstrukce
                            umožňuje provádět určité kroky pouze tehdy, když je splněna určitá podmínka.</h3><br>
                        <h3 style="text-align:center">
                            <code>Výraz uvnitř `if` je vyhodnocen jako pravdivý nebo nepravdivý (boolean). Pokud je výraz pravdivý (true),
                       kód uvnitř bloku `if` je vykonán. V opačném případě je tento kód přeskočen.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Základní kostra JS</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Podmíněné vykonávání kódu pomocí if<br>
                &nbsp;&nbsp;let number = 10;<br>
                &nbsp;&nbsp;if (number > 0) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;console.log("Číslo je kladné.");<br>
                &nbsp;&nbsp;} else if (number === 0) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;console.log("Číslo je nula.");<br>
                &nbsp;&nbsp;} else {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;console.log("Číslo je záporné.");<br>
                &nbsp;&nbsp;}<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>



                </div>

                <div id="JSON">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">JSON</h1><br>
                        <h3 style="text-align:center">JSON (JavaScript Object Notation) je lehký datový formát používaný
                            pro výměnu dat mezi serverem a prohlížečem. V JavaScriptu se často používá k uložení a
                            přenosu dat.</h3><br>
                        <h3 style="text-align:center">
                            <code>JSON je textový formát, který je snadno čitelný pro lidi i stroje. Skládá se ze sady párových klíč-hodnota, které jsou uzavřeny v závorkách `{}`.</code>
                        </h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comment">Základní kostra JS</p>
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                &lt;script&gt;<br>
                &nbsp;&nbsp;// Použití formátu JSON<br>
                &nbsp;&nbsp;let jsonData = '{"name": "John", "age": 30, "city": "New York"}';<br>
                &nbsp;&nbsp;let jsonObj = JSON.parse(jsonData);<br>
                &nbsp;&nbsp;console.log(jsonObj.name); // Vypíše "John"<br>
                &nbsp;&nbsp;console.log(jsonObj.age); // Vypíše 30<br>
                &nbsp;&nbsp;console.log(jsonObj.city); // Vypíše "New York"<br>
                &lt;/script&gt;<br>
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-js.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                    </div>



                </div>

            </div>



    </header>

    <script>
        // Definice obsahu stránek
        const pages = [
            { id: 'JavaScript', title: 'JavaScript' },
            { id: 'Uvod', title: 'Uvod' },
            { id: 'Syntaxe', title: 'Syntaxe' },
            { id: 'Operace', title: 'Operace' },
            { id: 'Funkce', title: 'Funkce' },
            { id: 'Objekty', title: 'Objekty' },
            { id: 'Udalosti', title: 'Udalosti' },
            { id: 'Pole', title: 'Pole' },
            { id: 'matematicke_funkce', title: 'Matematickee funkce' },
            { id: 'IF', title: 'IF' },
            { id: 'JSON', title: 'JSON' }
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