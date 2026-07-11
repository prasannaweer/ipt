<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Operators</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #27ae60; border-bottom: 2px solid #27ae60; padding-bottom: 10px; }
        h2 { color: #1e8449; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #27ae60; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .output { background: #f0f0f0; border-left: 4px solid #27ae60; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>03 - PHP Operators</h1>

    <?php
    $a = 15;
    $b = 4;

    // Arithmetic Operators
    echo "<h2>Arithmetic Operators</h2>";
    echo "<table>";
    echo "<tr><th>Operator</th><th>Description</th><th>Example</th><th>Result</th></tr>";
    echo "<tr><td>+</td><td>Addition</td><td>\$a + \$b</td><td>" . ($a + $b) . "</td></tr>";
    echo "<tr><td>-</td><td>Subtraction</td><td>\$a - \$b</td><td>" . ($a - $b) . "</td></tr>";
    echo "<tr><td>*</td><td>Multiplication</td><td>\$a * \$b</td><td>" . ($a * $b) . "</td></tr>";
    echo "<tr><td>/</td><td>Division</td><td>\$a / \$b</td><td>" . ($a / $b) . "</td></tr>";
    echo "<tr><td>%</td><td>Modulus</td><td>\$a % \$b</td><td>" . ($a % $b) . "</td></tr>";
    echo "<tr><td>**</td><td>Exponentiation</td><td>\$a ** \$b</td><td>" . ($a ** $b) . "</td></tr>";
    echo "</table>";

    // Assignment Operators
    echo "<h2>Assignment Operators</h2>";
    echo "<div class='output'>";
    $x = 10;
    echo "\$x = 10<br>";
    $x += 5;  echo "\$x += 5  &rarr; \$x = $x<br>";
    $x -= 3;  echo "\$x -= 3  &rarr; \$x = $x<br>";
    $x *= 2;  echo "\$x *= 2  &rarr; \$x = $x<br>";
    $x /= 4;  echo "\$x /= 4  &rarr; \$x = $x<br>";
    $x %= 3;  echo "\$x %= 3  &rarr; \$x = $x<br>";
    $x = 10;
    $x &= 6;  echo "\$x = 10; \$x &= 6  &rarr; \$x = $x (bitwise AND)";
    echo "</div>";

    // Comparison Operators
    echo "<h2>Comparison Operators</h2>";
    echo "<table>";
    echo "<tr><th>Operator</th><th>Description</th><th>Example</th><th>Result</th></tr>";
    echo "<tr><td>==</td><td>Equal</td><td>\$a == \$b</td><td>" . var_export($a == $b, true) . "</td></tr>";
    echo "<tr><td>===</td><td>Identical</td><td>\$a === \$b</td><td>" . var_export($a === $b, true) . "</td></tr>";
    echo "<tr><td>!=</td><td>Not equal</td><td>\$a != \$b</td><td>" . var_export($a != $b, true) . "</td></tr>";
    echo "<tr><td>!==</td><td>Not identical</td><td>\$a !== \$b</td><td>" . var_export($a !== $b, true) . "</td></tr>";
    echo "<tr><td>&lt;</td><td>Less than</td><td>\$a &lt; \$b</td><td>" . var_export($a < $b, true) . "</td></tr>";
    echo "<tr><td>&gt;</td><td>Greater than</td><td>\$a &gt; \$b</td><td>" . var_export($a > $b, true) . "</td></tr>";
    echo "<tr><td>&lt;=</td><td>Less than or equal</td><td>\$a &lt;= \$b</td><td>" . var_export($a <= $b, true) . "</td></tr>";
    echo "<tr><td>&gt;=</td><td>Greater than or equal</td><td>\$a &gt;= \$b</td><td>" . var_export($a >= $b, true) . "</td></tr>";
    echo "<tr><td>&lt;=&gt;</td><td>Spaceship</td><td>\$a &lt;=&gt; \$b</td><td>" . ($a <=> $b) . "</td></tr>";
    echo "</table>";

    // Type comparison note
    echo "<div class='output'>";
    echo "<strong>Note:</strong> <code>\"5\" == 5</code> is <code>true</code> (loose comparison)<br>";
    echo "But <code>\"5\" === 5</code> is <code>false</code> (strict comparison - different types)";
    echo "</div>";

    // Logical Operators
    echo "<h2>Logical Operators</h2>";
    echo "<table>";
    echo "<tr><th>Operator</th><th>Description</th><th>Example</th><th>Result</th></tr>";
    $p = true; $q = false;
    echo "<tr><td>&&</td><td>And</td><td>\$p && \$q</td><td>" . var_export($p && $q, true) . "</td></tr>";
    echo "<tr><td>||</td><td>Or</td><td>\$p || \$q</td><td>" . var_export($p || $q, true) . "</td></tr>";
    echo "<tr><td>!</td><td>Not</td><td>!\$p</td><td>" . var_export(!$p, true) . "</td></tr>";
    echo "<tr><td>and</td><td>And (lower)</td><td>\$p and \$q</td><td>" . var_export($p and $q, true) . "</td></tr>";
    echo "<tr><td>or</td><td>Or (lower)</td><td>\$p or \$q</td><td>" . var_export($p or $q, true) . "</td></tr>";
    echo "<tr><td>xor</td><td>Exclusive Or</td><td>\$p xor \$q</td><td>" . var_export($p xor $q, true) . "</td></tr>";
    echo "</table>";

    // Ternary Operator
    echo "<h2>Ternary Operator</h2>";
    echo "<div class='output'>";
    $score = 85;
    $grade = ($score >= 90) ? "A" : (($score >= 80) ? "B" : (($score >= 70) ? "C" : "F"));
    echo "Score: $score &rarr; Grade: <strong>$grade</strong><br>";
    echo "<br>Null coalescing: \$undefinedVar ?? 'default value' = " . ($undefinedVar ?? 'default value');
    echo "</div>";
    ?>

</div>
</body>
</html>
