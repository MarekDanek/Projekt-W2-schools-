<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hádej kód</title>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }
  #code {
    font-family: monospace;
    font-size: 18px;
    margin-bottom: 20px;
  }
  input {
    padding: 10px;
    font-size: 16px;
    margin-right: 10px;
  }
  button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
</style>
</head>
<body>

<div style="display:block;background-color:black;opacity: 0.7;color:white;padding: 5%;"  class="editable-title"  id="pageTitle">
<h1>Hádej kód</h1>
<div id="code">
  <p>// JavaScript kód:</p>
  <pre><code>function add(a, b) {
  return a + b;
}

const result = add(2, 3);
console.log(result);</code></pre>
</div>
<p>Hádejte, co vypíše tento kód:</p>
<input type="text" id="guess" placeholder="Výstup kódu">
<button id="check">Zkontrolovat</button>
<div id="result"></div>
</div>
<script>
  const codeExamples = [
    { code: 'function multiply(a, b) {\n  return a * b;\n}\n\nconst result = multiply(4, 5);\nconsole.log(result);', output: '20' },
    { code: 'const array = [1, 2, 3, 4, 5];\nconst sum = array.reduce((acc, cur) => acc + cur, 0);\nconsole.log(sum);', output: '15' }
  ];

  let currentExampleIndex = 0;

  const checkButton = document.getElementById('check');
  const guessInput = document.getElementById('guess');
  const resultDisplay = document.getElementById('result');

  function setupCurrentExample() {
    const currentExample = codeExamples[currentExampleIndex];
    document.getElementById('code').innerHTML = `<p>// JavaScript kód:</p><pre><code>${currentExample.code}</code></pre>`;
    return currentExample.output;
  }

  function checkGuess() {
    const guess = guessInput.value.trim();
    const correctOutput = setupCurrentExample();

    if (guess === correctOutput) {
      resultDisplay.textContent = 'Správně! Další úroveň.';
      resultDisplay.style.color = 'green';
      currentExampleIndex++;
    } else {
      resultDisplay.textContent = 'Špatně! Zkus to znovu.';
      resultDisplay.style.color = 'red';
    }
  }

  checkButton.addEventListener('click', checkGuess);


</script>
</body>
</html>
