<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>js editor</title>
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
      overflow: auto;
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
    <!-- JavaScript editor -->
    <textarea id="code-editor">
      // JS Editor
console.log("Hello, world!");</textarea>
  </div>

  <div id="output-container"></div>

  <script>
    // Funkce pro aktualizaci výstupu při změně kódu
    function updateOutput() {
      const codeEditor = document.getElementById('code-editor');
      const outputContainer = document.getElementById('output-container');
      const code = codeEditor.value;

      try {
        // Spuštění JavaScript kódu a vložení výsledku do výstupního kontejneru
        const result = eval(code);
        outputContainer.innerHTML = `<pre>${result}</pre>`;
      } catch (error) {
        // Chyby jsou zobrazeny výstupním kontejnerem
        outputContainer.innerHTML = `<strong>Chyba:</strong> ${error.message}`;
      }
    }

    // Přidání posluchače události pro aktualizaci výstupu při změně kódu
    const codeEditor = document.getElementById('code-editor');
    codeEditor.addEventListener('input', updateOutput);

    // Spuštění aktualizace výstupu při načtení stránky
    updateOutput();
  </script>
</body>
</html>
