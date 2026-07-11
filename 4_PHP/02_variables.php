<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Variables</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #e67e22; border-bottom: 2px solid #e67e22; padding-bottom: 10px; }
        h2 { color: #d35400; margin-top: 25px; }
        .output { background: #f0f0f0; border-left: 4px solid #e67e22; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>02 - PHP Variables</h1>
    <p>PHP variables start with <code>$</code>. No type declaration is needed.</p>

    <?php
    // Variable declarations - no type needed
    $name = "Alice";          // String
    $age = 25;                // Integer
    $price = 19.99;           // Float
    $isStudent = true;        // Boolean

    echo "<h2>Basic Variables</h2>";
    echo "<div class='output'>";
    echo "\$name = \"$name\"<br>";
    echo "\$age = $age<br>";
    echo "\$price = $price<br>";
    echo "\$isStudent = " . ($isStudent ? "true" : "false") . "<br>";
    echo "</div>";

    // Naming rules
    echo "<h2>Naming Rules</h2>";
    echo "<div class='output'>";
    echo "<ul>";
    echo "<li>Must start with <code>\$</code></li>";
    echo "<li>Can contain letters, numbers, and underscores</li>";
    echo "<li>Cannot start with a number</li>";
    echo "<li>Case-sensitive: <code>\$name</code> &ne; <code>\$Name</code></li>";
    echo "</ul>";
    echo "</div>";

    // Variable scope
    $globalVar = "I am global";

    // PHP type juggling example
    echo "<h2>Type Juggling</h2>";
    echo "<div class='output'>";
    $x = "10";    // String
    $y = 5;       // Integer
    $result = $x + $y;  // PHP auto-converts string to int
    echo "\"10\" (string) + 5 (integer) = $result (integer)<br>";
    echo "gettype of \$result: " . gettype($result) . "<br>";
    echo "</div>";

    // Concatenation operator (.)
    echo "<h2>Concatenation Operator (.)</h2>";
    echo "<div class='output'>";
    $firstName = "John";
    $lastName = "Doe";
    $fullName = $firstName . " " . $lastName;
    echo "\$fullName = \$firstName . \" \" . \$lastName<br>";
    echo "Result: $fullName<br><br>";

    // Chaining concatenation
    $greeting = "Hello, " . $fullName . "! Welcome to PHP.";
    echo "Chained: $greeting<br><br>";

    // Concatenation assignment (.=)
    $message = "PHP";
    $message .= " is";
    $message .= " powerful!";
    echo "Using .= operator: $message";
    echo "</div>";

    // Useful variable functions
    echo "<h2>Variable Functions</h2>";
    echo "<div class='output'>";
    echo "isset(\$name): " . (isset($name) ? "true" : "false") . "<br>";
    echo "empty(\$age): " . (empty($age) ? "true" : "false") . "<br>";
    echo "unset example: after unset, \$name is " . (isset($name) ? "set" : "unset") . "<br>";
    echo "strlen(\$fullName): " . strlen($fullName) . "<br>";
    echo "strtoupper(\$fullName): " . strtoupper($fullName) . "<br>";
    echo "</div>";
    ?>

</div>
</body>
</html>
