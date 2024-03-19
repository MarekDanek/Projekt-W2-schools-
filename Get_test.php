<?php
// Připojení k databázi
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'w2_schools';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    echo "Nepodařilo se připojit k MySQL: " . mysqli_connect_error();
    exit();
}

// Funkce pro získání náhodných otázek a odpovědí z databáze podle úrovně
function getRandomQuestionsByLevel($conn, $numQuestions, $level)
{
    $questions = [];

    // Získání náhodných otázek podle úrovně
    $query = "SELECT * FROM Questions WHERE level = $level ORDER BY RAND() LIMIT $numQuestions";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $question = [
            'id' => $row['id'],
            'question' => $row['question'],
            'answers' => []
        ];

        // Získání odpovědí k dané otázce
        $answersQuery = "SELECT * FROM Answers WHERE question_id = " . $row['id'];
        $answersResult = mysqli_query($conn, $answersQuery);

        while ($answerRow = mysqli_fetch_assoc($answersResult)) {
            $question['answers'][] = $answerRow['answer'];
        }

        // Přidání otázky do pole otázek
        $questions[] = $question;
    }

    return $questions;
}

// Počet otázek pro test
$numQuestions = 5;

// Úroveň testu (1, 2 nebo 3)
$testLevel = 1; // Můžete změnit úroveň podle potřeby

// Získání náhodných otázek podle úrovně
$randomQuestions = getRandomQuestionsByLevel($conn, $numQuestions, $testLevel);

// Výstup ve formátu JSON
header('Content-Type: application/json');
echo json_encode($randomQuestions);
?>