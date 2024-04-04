<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Uživatel je přihlášen, můžete zobrazit například jeho jméno
    echo 'Vítejte, ' . $_SESSION['name'] . '!';
    // Zde můžete zobrazit tlačítko pro odhlášení, aby uživatel mohl kliknout a odhlásit se
    echo '<a href="logout.php">Odhlásit se</a>';
} else {
    // Pokud uživatel není přihlášen, můžete zobrazit odkaz na přihlašovací stránku nebo nějaké jiné akce
    echo 'Prosím, přihlaste se <a href="login.php">zde</a>.';
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
function getQuestionsByLevel($conn, $level)
{
    $questions = [];

    // Získání otázek z databáze podle úrovně
    $query = "SELECT * FROM questions WHERE level = $level";
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

// Staticky nastavíme správné odpovědi podle dat z databáze
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

    // Uložení výsledků do databáze
    $userId = ($_SESSION['id']);
    $query = "INSERT INTO test_results (user_id, test_level, total_questions, total_correct, percentage) VALUES ('$userId', '1', '$totalQuestions', '$totalCorrect', '$percentage')";
    mysqli_query($conn, $query);

}

// Získání otázek různých úrovní
$questionsLevel1 = getQuestionsByLevel($conn, 1);
$questionsLevel2 = getQuestionsByLevel($conn, 2);
$questionsLevel3 = getQuestionsByLevel($conn, 3);

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
                <a onclick="changeContent('Testy')" class="active">Testy HTML</a>
                <a onclick="changeContent('1.uroven')">1.Úroveň</a>
                <a onclick="changeContent('2.uroven')">2.Úroveň</a>
                <a onclick="changeContent('3.uroven')">3.Úroveň</a>

            </div>



            <!-- Obsah stránky -->
            <div class="content">

                <!-- Obsah pro stránku s ID 'uvod' -->
                <div class="active" id="Testy">

                    <!-- Editovatelný nadpis -->
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;"
                        class="editable-title" id="pageTitle">



                        <h1 style="text-align: center;font-size: 4em">Testy</h1><br>





                    </div>




                </div>

                <div id="1.uroven">
                    <div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"
                        class="editable-title" id="pageTitle">

                        <h1 style="font-size: 4em">Test úrovně 1</h1><br>

                        <form method="post" id="form_level1" onsubmit="return validateForm()">
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

                        <form method="post">
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

                        <!-- Tlačítko pro stažení výsledků PDF -->
                        <form method="post">
                            <button type="submit" name="download_pdf">Stáhnout výsledky PDF</button>
                        </form>

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

                        <form method="post">
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