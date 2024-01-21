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
    <script src="https://cdn.tiny.cloud/1/ff64eh8dhqc8jrxg2u6y012u6f30leosxjppmc0zxq5jpbvi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <style>
 body {
    background-image: url("background-modified.png");
    height: 100vh;
    background-size: cover;
    background-position: center;
           
            margin: 0;
           
        }

        #editor-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: auto;
        }

        textarea {
            width: 100%;
            height: 500px; 
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }


   

        button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }


        </style>
        <title >tinymce</title>
</head>
<body>
    <header>

<div style="display:block;background-color:black;opacity: 0.7;color:white;padding:5%;">
<h1>Vytvoř kontent</h1>
</div>
<div style="display:block;">
    
        <textarea name="textarea" id="default"  ></textarea>
        <div style="text-align:center;">
        <button style=" display: inline-block; padding: 15px 40px; background-color: white; color: black; border: none;border-radius: 5px; font-size: 20px;cursor: pointer;" onclick="insertContent()">Vložit obsah na stránku</button>
       </div>
</div>         



</header>
<!-- <script src="tinymce\tinymce.min.js"></script>
<script src="TINYMC-script.js"></script> -->


<script>
      tinymce.init({
            selector: '#default',
            // Další konfigurace TinyMCE
        });

        function insertContent() {
            var editorContent = tinymce.get('default').getContent().trim();

            // Kontrola na prázdný obsah
            if (editorContent === '') {
                alert('Napište prosím nějaký obsah.');
                return;
            }

            // Získání existujícího obsahu z localStorage
            var existingContent = localStorage.getItem('editorContent') || '';

            // Vytvoření nového divu s novým obsahem
            var newDiv = '<div style="display:block;text-align: center;">' + editorContent;

            // Přidání nového divu nad existující obsah
            var newContent = newDiv + existingContent;

            // Uložení celého obsahu do localStorage
            localStorage.setItem('editorContent', newContent);

            window.location.href = 'Kurz_HTML.php';
        }
    </script>




</body>
</html>
