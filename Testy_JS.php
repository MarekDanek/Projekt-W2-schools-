<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    // echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    // echo '<a href="logout.php">Odhlásit se</a>';
} else {
    // Pokud uživatel není přihlášen, přesměrujte ho na přihlašovací stránku
    header("Location: login.php");
    exit();
}

// Připojení k databázi
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    echo "Nepodařilo se připojit k MySQL: " . mysqli_connect_errno();
    exit();
}

// Funkce pro získání otázek podle úrovně
function getQuestionsByLevel($conn, $level, $category)
{
    $questions = [];

    // Získání otázek z databáze podle úrovně
    $query = "SELECT * FROM questions WHERE level = $level AND category = '$category'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $questionText = $row['question_text'];
        $questionId = $row['question_id'];

        // Získání odpovědí na danou otázku
        $answersQuery = "SELECT * FROM answers WHERE question_id = $questionId";
        $answersResult = mysqli_query($conn, $answersQuery);

        // Pole pro uchování odpovědí
        $answers = [];

        while ($answerRow = mysqli_fetch_assoc($answersResult)) {
            // Uložení odpovědi do pole
            $answers[] = array(
                'answer_id' => $answerRow['answer_id'],
                'answer_text' => $answerRow['answer_text'],
                'is_correct' => $answerRow['is_correct']
            );
        }

        // Přidání otázky s odpověďmi do seznamu otázek
        $questions[] = array(
            'question_id' => $questionId,
            'question' => $questionText,
            'answers' => $answers
        );
    }

    return $questions;
}

// Statický nastavení správné odpovědi podle dat z databáze
$correctAnswers = [];
$query = "SELECT question_id, answer_id FROM answers WHERE is_correct = 1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $correctAnswers[$row['question_id']] = $row['answer_id'];
}

// Zpracování odeslaného formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $totalQuestions = 0;
    $totalCorrect = 0;

    foreach ($_POST as $key => $value) {
        // Kontrola, zda je klíč odpovědí
        if (strpos($key, 'answer_') === 0) {
            $questionId = substr($key, strlen('answer_'));
            $selectedAnswerId = $value;

            // Zkontrolujeme, zda je zvolená odpověď správná
            if (isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] == $selectedAnswerId) {
                $totalCorrect++;
            }

            $totalQuestions++;
        }
    }

    // Výpočet procentuálního výsledku
    $percentage = ($totalCorrect / $totalQuestions) * 100;


    // Zpracování odeslaného formuláře
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

        // Zkontrolujte, zda jsou potřebné indexy v poli $_POST přítomny
        $level1 = isset($_POST['level1']) ? $_POST['level1'] : null;
        $level2 = isset($_POST['level2']) ? $_POST['level2'] : null;
        $level3 = isset($_POST['level3']) ? $_POST['level3'] : null;


        if (isset($_POST['level1'])) {
            $level = $_POST['level1'];
        } elseif (isset($_POST['level2'])) {
            $level = $_POST['level2'];
        } elseif (isset($_POST['level3'])) {
            $level = $_POST['level3'];
        } else {
            $level = null;
        }

        if ($level !== null) {
            // Kontrola, zda je uživatel přihlášen
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
                // Uložení výsledků do databáze
                $query = "INSERT INTO test_results (user_id, test_level, total_questions, total_correct, percentage, test_type) VALUES (?, ?, ?, ?, ?, 'JS')";
                $statement = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($statement, "iiiii", $userId, $level, $totalQuestions, $totalCorrect, $percentage);
                mysqli_stmt_execute($statement);
                mysqli_stmt_close($statement);
            } else {
                // Uživatel není přihlášen
                echo "Uživatel není přihlášen.";
            }
        } else {
            // Úroveň testu není platná
            echo "Neplatná úroveň testu.";
        }
        $message = "Test byl úspěšně odeslán, stáhněte si certifikát a zjistěte výsledky v profilu";
        // Vložení kódu JavaScriptu do PHP
        echo '<script>alert("' . $message . '");</script>';
    }






    // // Uložení výsledků do databáze
    // $userId = ($_SESSION['id']);
    // $query = "INSERT INTO test_results (user_id, test_level, total_questions, total_correct, percentage) VALUES ('$userId', '$level', '$totalQuestions', '$totalCorrect', '$percentage')";
    // mysqli_query($conn, $query);

}

// Zde zkontrolujeme, zda uživatel již splnil nějaký test
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $query = "SELECT * FROM test_results WHERE user_id = $userId AND test_type = 'JS'";
    $result = mysqli_query($conn, $query);
    $completedTests = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $completedTests[$row['test_level']] = true;

    }
}

// Získání otázek různých úrovní
$questionsLevel1 = getQuestionsByLevel($conn, 1, "JS");
$questionsLevel2 = getQuestionsByLevel($conn, 2, "JS");
$questionsLevel3 = getQuestionsByLevel($conn, 3, "JS");

// Uzavření spojení s databází
mysqli_close($conn);
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
            height: 100%;

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



        .comment {
            background-color: black;
            color: white;
        }

        /* Styly pro tlačítko */
        #submit-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        #submit-btn:hover {
            background-color: darkgray;
            color: black;
        }

        .results {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-top: 20px;
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
                <a onclick="changeContent('Testy')" class="active">Testy JS</a>
                <a onclick="changeContent('1.uroven'); setTestLevel1(1)">1.Úroveň</a>
                <a onclick="changeContent('2.uroven'); setTestLevel2(2)">2.Úroveň</a>
                <a onclick="changeContent('3.uroven'); setTestLevel3(3)">3.Úroveň</a>

            </div>



            <!-- Obsah stránky -->
            <div class="content">

                <!-- Obsah pro stránku s ID 'uvod' -->
                <div class="active" id="Testy">

                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;"
                        class="editable-title" id="pageTitle">



                        <h1 style="text-align: center;font-size: 4em">Test JS</h1><br>

                        <h3 style="text-align: center;">Tento test nebudete mít šanci dělat podruhé!<br>
                            Za splnění více jak 80% otázek vám bude přidělen certifikát Javascript<br>
                            Na test máte neomezeně času.

                        </h3>



                    </div>




                </div>

                <div id="1.uroven">
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="font-size: 4em">Test úrovně 1</h1><br>

                        <?php if (isset($completedTests[1])): ?>
                            <p style="font-size: 1.5em;">Tento test je splněn.</p>
                        <?php else: ?>

                            <form style="font-size: 1.2em;" method="post">
                                <input type="hidden" name="level1" id="level1" value="1">
                                <ul>
                                    <?php foreach ($questionsLevel1 as $question): ?>
                                        <li>
                                            <p>
                                                <?php echo $question['question']; ?>
                                            </p>
                                            <?php foreach ($question['answers'] as $answer): ?>
                                                <label>
                                                    <input type="radio" name="answer_<?php echo $question['question_id']; ?>"
                                                        value="<?php echo $answer['answer_id']; ?>">
                                                    <?php echo $answer['answer_text']; ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- Jeden společný button pro odeslání odpovědí všech otázek -->
                                <button type="submit" name="submit" id="submit_level1">Odeslat odpovědi</button>
                            </form>
                        <?php endif; ?>


                        <?php if (isset($percentage)): ?>
                            <div class="results">
                                <p>Počet správných odpovědí:
                                    <?php echo $totalCorrect; ?>
                                </p>,
                                <p>Počet chybných odpovědí:
                                    <?php echo $totalQuestions - $totalCorrect; ?>
                                </p>,
                                <p>Procentuální úspěšnost:
                                    <?php echo round($percentage, 2); ?>%
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <div id="2.uroven">

                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="font-size: 4em">Test úrovně 2</h1><br>

                        <?php if (isset($completedTests[2])): ?>
                            <p style="font-size: 1.5em;">Tento test je splněn.</p>
                        <?php else: ?>

                            <form style="font-size: 1.2em;" method="post">
                                <input type="hidden" name="level2" id="level2" value="2">
                                <ul>
                                    <?php foreach ($questionsLevel2 as $question): ?>
                                        <li>
                                            <p>
                                                <?php echo $question['question']; ?>
                                            </p>
                                            <?php foreach ($question['answers'] as $answer): ?>
                                                <label>
                                                    <input type="radio" name="answer_<?php echo $question['question_id']; ?>"
                                                        value="<?php echo $answer['answer_id']; ?>">
                                                    <?php echo $answer['answer_text']; ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- Jeden společný button pro odeslání odpovědí všech otázek -->
                                <button type="submit" name="submit" id="submit_level2">Odeslat odpovědi</button>
                            </form>
                        <?php endif; ?>


                        <?php if (isset($percentage)): ?>
                            <div class="results">
                                <p>Počet správných odpovědí:
                                    <?php echo $totalCorrect; ?>
                                </p>,
                                <p>Počet chybných odpovědí:
                                    <?php echo $totalQuestions - $totalCorrect; ?>
                                </p>,
                                <p>Procentuální úspěšnost:
                                    <?php echo round($percentage, 2); ?>%
                                </p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div id="3.uroven">


                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">


                        <h1 style="font-size: 4em">Test úrovně 3</h1><br>

                        <?php if (isset($completedTests[3])): ?>
                            <p style="font-size: 1.5em;">Tento test je splněn.</p>
                        <?php else: ?>

                            <form style="font-size: 1.2em;" method="post">
                                <input type="hidden" name="level3" id="level3" value="3">
                                <ul>
                                    <?php foreach ($questionsLevel3 as $question): ?>
                                        <li>
                                            <p>
                                                <?php echo $question['question']; ?>
                                            </p>
                                            <?php foreach ($question['answers'] as $answer): ?>
                                                <label>
                                                    <input type="radio" name="answer_<?php echo $question['question_id']; ?>"
                                                        value="<?php echo $answer['answer_id']; ?>">
                                                    <?php echo $answer['answer_text']; ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- Jeden společný button pro odeslání odpovědí všech otázek -->
                                <button type="submit" name="submit" id="submit_level3">Odeslat odpovědi</button>
                            </form>
                        <?php endif; ?>


                        <?php if (isset($percentage)): ?>
                            <div class="results">
                                <p>Počet správných odpovědí:
                                    <?php echo $totalCorrect; ?>
                                </p>,
                                <p>Počet chybných odpovědí:
                                    <?php echo $totalQuestions - $totalCorrect; ?>
                                </p>,
                                <p>Procentuální úspěšnost:
                                    <?php echo round($percentage, 2); ?>%
                                </p>
                            </div>
                        <?php endif; ?>

                    </div>

    </header>

    <script>
        // Definice obsahu stránek
        const pages = [
            { id: 'Testy', title: 'Testy' },
            { id: '1.uroven', title: '1.uroven' },
            { id: '2.uroven', title: '2.uroven' },
            { id: '3.uroven', title: '3.uroven' }
        ];

        function setTestLevel1(level) {
            document.getElementById('level1').value = level; // Nastavení úrovně 1 testu


        }
        function setTestLevel2(level) {

            document.getElementById('level2').value = level; // Nastavení úrovně 2 testu


        }
        function setTestLevel3(level) {

            document.getElementById('level3').value = level; // Nastavení úrovně 3 testu

        }

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





    </script>

</body>

</html>