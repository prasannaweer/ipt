<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Hello World</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #7b4bb6; border-bottom: 2px solid #7b4bb6; padding-bottom: 10px; }
        .output { background: #f0f0f0; border-left: 4px solid #7b4bb6; padding: 15px; margin: 15px 0; }
        code { background: #e8e8e8; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
<div class="container">
    <h1>01 - PHP Hello World</h1>
    <p>This page demonstrates basic PHP echo statements and comments.</p>

    <?php
    // This is a single-line comment

    /*
       This is a
       multi-line comment
    */

    echo "<h2>Hello, World!</h2>";
    echo "<p>Welcome to PHP programming.</p>";

    // Printing different data types
    echo "<div class='output'>";
    echo "<strong>String:</strong> " . "PHP is fun!" . "<br>";
    echo "<strong>Integer:</strong> " . 42 . "<br>";
    echo "<strong>Float:</strong> " . 3.14 . "<br>";
    echo "<strong>Boolean:</strong> " . (true ? "true" : "false") . "<br>";
    echo "</div>";

    // Using heredoc syntax
    echo "<div class='output'>";
    echo "<strong>Heredoc syntax output:</strong><br>";
    echo <<<EOT
    <em>This text is output using heredoc syntax.</em><br>
    It allows multi-line strings with variable interpolation.
    EOT;
    echo "</div>";

    // Using nowdoc syntax (no variable parsing)
    echo "<div class='output'>";
    echo "<strong>Nowdoc syntax output:</strong><br>";
    echo <<<'EOT'
    <em>This text is output using nowdoc syntax.</em><br>
    Variables are NOT parsed inside nowdoc strings.
    EOT;
    echo "</div>";
    ?>

</div>
</body>
</html>
