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
    <title>Kurz PHP</title>
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
                <a onclick="changeContent('PHP')" class="active">PHP</a>
                <a onclick="changeContent('Uvod')">Úvod</a>
                <a onclick="changeContent('Syntaxe')">Syntaxe</a>
                <a onclick="changeContent('Promenne')">Proměnné</a>
                <a onclick="changeContent('Formulare')">Formuláře</a>
                <a onclick="changeContent('Relace')">Relace</a>
                <a onclick="changeContent('JSON')">JSON</a>
                <a onclick="changeContent('OOP')">OOP</a>
                <a onclick="changeContent('Databaze')">Databáze</a>
            </div>



            <div class="content">

                <!-- Obsah pro stránku s ID 'uvod' -->
                <div class="active" id="PHP">

                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;"
                        class="editable-title" id="pageTitle">

                        <div style="display:block" class="search-container">
                            <input type="text" id="searchInput" placeholder="Hledat...">
                            <button onclick="searchPage()">Hledat</button>
                        </div>

                        <h1 style="text-align: center;font-size: 4em">PHP</h1><br>

                        <h2 style="text-align: center;">Vítejte v Kurzu PHP(Hypertext Preprocessor, původně Personal
                            Home Page), naučíte se zde základy jazyku PHP</h2><br>
                        <h2 style="text-align: center;">Na levé straně si vyberte, jakou část PHP se chcete naučit, nebo
                            vyhledejte podle klíčového slova.</h2><br>


                    </div>




                </div>


                <div id="Uvod">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="text-align: center;font-size: 4em">Úvod</h1><br>

                        <h3 style="text-align:center">PHP je skriptovací programovací jazyk, který se používá na
                            backend.</h3><br>
                        <h3 style="text-align:center">
                            <code>PHP můžete psát přímo v souboru html -> &lt;?php;?&gt; nebo si vytvořit soubor.php a do něj psát samostatný php kód.</code>
                        </h3><br>
                        <h3 style="text-align:center">Je důležitý kontrolovat velikost písmen u psaní kódu, např.
                            echo,ECHO, ecHo je stejný zápis, ale $color a $Color už ne.</h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Základní kostra PHP</p>


                 &lt;?php<br>    
                 //Zde se píše PHP kód<br>  
                 ?&gt;<br>          
              
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                
                 
                       
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>

                        <h3 style="text-align:center">PHP umožňuje práci s daty a databázemi.</h3><br>


                    </div>
                </div>


                <div id="Syntaxe">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Syntaxe</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Kostra</h2>

                        <div style="display:block;" id="code-container">
                            <code>
                                <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Základní kostra PHP</p>


                 &lt;?php<br>    
                 //Zde se píše PHP kód<br>  
                 ?&gt;<br>          
              
                &lt;!DOCTYPE html&gt;<br>
                &lt;html lang="en"&gt;<br>
                &lt;head&gt;<br>
                &nbsp;&nbsp;&lt;meta charset="UTF-8"&gt;<br>
                &nbsp;&nbsp;&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;<br>
                &nbsp;&nbsp;&lt;title&gt;W2Schools Quiz&lt;/title&gt;<br>
                &lt;/head&gt;<br>
                &lt;body&gt;<br><br><br>
                
                 
                       
                &lt;/body&gt;<br>
                &lt;/html&gt;<br>
            </code>
                        </div>
                        <br>


                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <h2 style="text-align:center;background-color:#191616;">Echo - Vypisování</h2>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Echo PHP</p>


                    &lt;!DOCTYPE html&gt;<br>
                    &lt;html&gt;<br>
                    &lt;body&gt;<br><br>

                    &lt;h1&gt;W2Schools Quiz&lt;/h1&gt;<br><br>

                    &lt;?php<br>
                    echo "Hello World!";<br>
                    ?&gt;<br><br>

                    &lt;/body&gt;<br>
                    &lt;/html&gt;<br>

                    </code>
                        </div>
                        <br>


                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>




                    </div>
                </div>



                <div id="Promenne">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Proměnné</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Vytváření proměnných</h2>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">vytváření proměnných</p>


                    $x = 10;<br>
                    $y = "Jakub";


                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <h2 style="text-align:center;background-color:#191616;">Výstup</h2>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">výstup proměnných</p>


                    $txt = "W2schools Quiz";<br>
                    echo "My favorite web is $txt!";<br><br>

                    //nebo<br><br>

                    $x = 5;<br>
                    $y = 4;<br>
                    echo $x + $y;<br>

                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>

                        <h2 style="text-align:center;background-color:#191616;">Datové typy</h2>

                        <h3 style="text-align:center">V PHP se neurčuje datový typ, určí ho hodnota.</h3><br>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">datové typy</p>


                $x = 510;      // $x je int(číslo)<br>
                $y = "Jakub"; // $y je string(text)<br>
                echo $x;<br>
                echo $y;<br>

                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>




                    </div>



                </div>


                <div id="Formulare">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Formuláře</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Formuláře</h2>

                        <h3 style="text-align:center">Formůláře slouží k uložení dat od uživatele a následně uložení do
                            databáze.<code>&lt;form&gt; vytváří strukturu formu, &lt;input&gt; je místo na napsaní textu(jméno nebo heslo).</code>
                        </h3><br>
                        <h3>HTML formulář přenáší data pomocí metody HTTP POST, když je v atributu formuláře uvedena
                            hodnota "POST".</h3>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Formulář</p>
                    

                    Welcome &lt;?php echo $_POST["name"]; ?&gt;&lt;br&gt;<br>
                   Your email address is: &lt;?php echo $_POST["email"]; ?&gt;<br><br><br>
                     

                    &lt;html&gt;<br>
                 &lt;body&gt;<br><br>

              &lt;form action="welcome.php" method="post"&gt;<br>
              Name: &lt;input type="text" name="name"&gt;&lt;br&gt;<br>
               E-mail: &lt;input type="text" name="email"&gt;&lt;br&gt;<br>
            &lt;input type="submit"&gt;<br>
             &lt;/form&gt;<br><br>

              &lt;/body&gt;<br>
            &lt;/html&gt;<br>


                    </code>
                        </div>
                        <br>


                    </div>



                </div>

                <div id="Relace">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">
                        <h1>Relace</h1><br>

                        <h2 style="text-align:center;background-color:#191616;">Relace(Session)</h2>


                        <h3 style="text-align:center">Relace v PHP je mechanismus, který umožňuje uchovávat a spravovat
                            data mezi jednotlivými stránkami v rámci jedné relace uživatele.
                            Tento mechanismus je klíčový pro udržování stavu a interakce s uživatelem během jeho
                            návštěvy webové stránky.</h3>


                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Session</p>
                   

                    &lt;?php<br>
                    // Spustit relaci<br>
                    session_start();<br>
                    ?&gt;<br>
                    &lt;!DOCTYPE html&gt;<br>
                    &lt;html&gt;<br>
                    &lt;body&gt;<br><br>
                    &lt;?php<br>
                    // Set session variables<br>
                    $_SESSION["favcolor"] = "green";<br>
                    $_SESSION["favanimal"] = "cat";<br>
                    echo "Session variables are set.";<br>
                    ?&gt;<br><br>
                    &lt;/body&gt;<br>
                    &lt;/html&gt;<br>


             


                    </code>
                        </div>
                        <br>




                    </div>



                </div>

                <div id="JSON">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>JSON PHP</h1><br>
                        <h2 style="text-align:center;background-color:#191616;">JSON</h2>
                        <h3 style="text-align:center">JSON (JavaScript Object Notation) je formát dat, který je snadno
                            čitelný a zapisovatelný jak pro lidi, tak pro počítače.
                            V PHP se funkce json_encode() používá kódování dat z PHP pole do formátu JSON a funkce
                            json_decode() se používá ke dekódování dat JSON do PHP pole. </h3>
                        <br>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">JSON</p>
                  

                    // Kódování PHP pole do JSON<br>
                    $data = array("name" => "John", "age" => 30, "city" => "New York");<br>
                    $json_encoded = json_encode($data);<br><br>

                    // Dekódování dat JSON do PHP pole<br>
                    $json_data = '{"name":"John","age":30,"city":"New York"}';<br>
                    $decoded_data = json_decode($json_data, true);<br>

             


                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">JSON ECHO</p>
                    <br><br>

                    $json_data = '{"name":"John","age":30,"city":"New York"}';<br>
                    $decoded_data = json_decode($json_data, true);<br><br>

                    print_r($decoded_data);<br>
                    /* Vypíše:<br>
                    Array<br>
                    (<br>
                        [name] => John<br>
                        [age] => 30<br>
                        [city] => New York<br>
                    )<br>
                    */<br>

             


                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>



                    </div>



                </div>

                <div id="OOP">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>OOP</h1><br>

                        <h3 style="text-align:center">Objektově orientované programování (OOP) v PHP umožňuje
                            organizovat kód do objektů, které kombinují data a funkce.
                            Objekt je instance třídy, která obsahuje vlastnosti a metody. Třída je šablona pro vytváření
                            objektů.</h3>


                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Třída</p>
                

                    class Car {<br>
                    // Kód zde.<br>
                    }<br>

             


                    </code>
                        </div>
                        <br>

                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>


                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Třída</p>
                  

                    class Fruit {<br><br>
                    
                    public $name;<br>
                    public $color;<br><br>

                    // Metody<br>
                    function set_name($name) {<br>
                        $this->name = $name;<br>
                    }<br>
                    function get_name() {<br>
                        return $this->name;<br>
                    }<br>
                    }<br><br>

                    $skoda = new Car();<br>
                    $BMW = new Car();<br>
                    $skoda->set_name('Škoda');<br>
                    $BMW->set_name('BMW');<br><br>

                    echo $skoda->get_name();<br>
                    echo "<br>";<br>
                    echo $BMW->get_name();<br>

             


                    </code>
                        </div>
                        <br>


                        <div style="text-align:center;display:block;">
                            <a class="button-link" href="code-editor-php.php" target="_blank"><button
                                    class="button-link">Vyzkoušej</button></a>
                        </div><br>




                    </div>



                </div>

                <div id="Databaze">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1>Databáze</h1><br>

                        <h3 style="text-align:center">Databáze a PHP jsou spolu úzce spjaty, neboť PHP je jedním z
                            nejpopulárnějších programovacích jazyků používaných pro interakci s databázemi na webových
                            stránkách, ikdyž je zastaralý.</h3><br>

                        <h2 style="text-align:center;background-color:#191616;">Připojení k databázi</h2>

                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Připojení k databázi</p>


                        $DATABASE_HOST = 'localhost';<br>
                        $DATABASE_USER = 'root';<br>
                        $DATABASE_PASS = '';<br>
                        $DATABASE_NAME = 'w2_schools';<br><br>

                        $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);<br><br>

                        if (mysqli_connect_errno()) {<br>
                        echo "Nepodařilo se připojit k MySql: " . mysqli_connect_errno();<br>
                        exit();<br><br>

                        } else {<br>
                        // echo "je pripojeno";<br>
                        }<br>

   
                    </code>
                        </div>
                        <br>

                        <h2 style="text-align:center;background-color:#191616;">Práce s daty</h2>

                        <h3 style="text-align:center">Tento příkaz vypíše všechny uživatele, který se jmenují Marek.
                        </h3>
                        <br>


                        <div style="display:block;" id="code-container">
                            <code>
                    <p style="background-color:black;color: white;text-align:center;border-radius:5%;" class="comnment">Práce s daty</p>

                    $sql = "SELECT * FROM users WHERE username='Marek'";<br>
                    $result = mysqli_query($conn, $sql);

   
                    </code>
                        </div>
                        <br>


                    </div>



                </div>

            </div>



    </header>

    <script>
        // Definice obsahu stránek
        const pages = [
            { id: 'PHP', title: 'PHP' },
            { id: 'Uvod', title: 'Uvod' },
            { id: 'Syntaxe', title: 'Syntaxe' },
            { id: 'Promenne', title: 'Promenne' },
            { id: 'Formulare', title: 'Formulare' },
            { id: 'Relace', title: 'Relace' },
            { id: 'JSON', title: 'JSON' },
            { id: 'OOP', title: 'OOP' },
            { id: 'Databaze', title: 'Databaze' },
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