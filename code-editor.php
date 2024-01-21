<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HTML editor</title>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      display: flex;
      height: 100vh;
      overflow: hidden;
      background-color: #f0f0f0;
    }

    #editor-container,
    #output-container {
      flex: 1;
      height: 100%;
      box-sizing: border-box;
    }

    #editor-container {
      padding: 20px;
      background-color: #2d2d2d;
      color: #ffffff;
    }

    #code-editor {
      width: 100%;
      height: 100%;
      border: none;
      background-color: #1e1e1e;
      color: #ffffff;
      font-family: 'Courier New', Courier, monospace;
      font-size: 20px;
    }

    #output-container {
      padding: 20px;
      overflow-y: auto;
      background-color: #ffffff;
      color: #333333;
    }

    #output-container pre {
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
  <div id="editor-container">
    <!-- HTML Editor -->
    <textarea id="code-editor">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stránka</title>
</head>
<body>

 <!-- Zde napište kód -->

</body>
</html>
    </textarea>
  </div>

  <div id="output-container"></div>

  <script>
    // Funkce pro aktualizaci výstupu při změně kódu
    function updateOutput() {
      const codeEditor = document.getElementById('code-editor');
      const outputContainer = document.getElementById('output-container');
      const code = codeEditor.value;

      try {
        // Vytvoření HTML stránky a vložení na stránku
        outputContainer.innerHTML = code;
      } catch (error) {
        // Errory
        outputContainer.innerHTML = `<strong>Chyba:</strong> ${error.message}`;
      }
    }

    // Přidání posluchače události pro aktualizaci výstupu při změně kódu
    const codeEditor = document.getElementById('code-editor');
    codeEditor.addEventListener('input', updateOutput);

    // Spouští aktualizaci výstupu při načtení stránky
    updateOutput();
  </script>
</body>
</html> 