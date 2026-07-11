<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Loops</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #e74c3c; border-bottom: 2px solid #e74c3c; padding-bottom: 10px; }
        h2 { color: #c0392b; }
        .output { background: #f0f0f0; border-left: 4px solid #e74c3c; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>06 - PHP Loops</h1>

    <?php
    // while loop
    echo "<h2>while Loop</h2>";
    echo "<div class='output'>";
    echo "Counting 1 to 5:<br>";
    $i = 1;
    while ($i <= 5) {
        echo "Number: $i<br>";
        $i++;
    }
    echo "</div>";

    // do...while loop
    echo "<h2>do...while Loop</h2>";
    echo "<div class='output'>";
    echo "Executes at least once even if condition is false:<br>";
    $j = 10;
    do {
        echo "Value: $j<br>";
        $j++;
    } while ($j < 10);
    // Note: $j starts at 10, condition is false, but body still runs once
    echo "(Started at 10, condition \$j < 10 was false, but body ran once)<br>";
    echo "</div>";

    // for loop
    echo "<h2>for Loop</h2>";
    echo "<div class='output'>";
    echo "Multiplication table for 7:<br>";
    for ($k = 1; $k <= 10; $k++) {
        echo "7 &times; $k = " . (7 * $k) . "<br>";
    }
    echo "</div>";

    // Nested for loop
    echo "<h2>Nested for Loop &mdash; Number Grid</h2>";
    echo "<div class='output'>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>&times;</th>";
    for ($col = 1; $col <= 5; $col++) {
        echo "<th>$col</th>";
    }
    echo "</tr>";
    for ($row = 1; $row <= 5; $row++) {
        echo "<tr><th>$row</th>";
        for ($col = 1; $col <= 5; $col++) {
            echo "<td>" . ($row * $col) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    // foreach with indexed array
    echo "<h2>foreach Loop &mdash; Indexed Array</h2>";
    echo "<div class='output'>";
    $languages = array("PHP", "Python", "Java", "C#", "JavaScript");
    foreach ($languages as $index => $lang) {
        echo ($index + 1) . ". $lang<br>";
    }
    echo "</div>";

    // foreach with associative array
    echo "<h2>foreach Loop &mdash; Associative Array</h2>";
    echo "<div class='output'>";
    $capitals = array(
        "USA" => "Washington D.C.",
        "Japan" => "Tokyo",
        "France" => "Paris",
        "Brazil" => "Brasilia"
    );
    foreach ($capitals as $country => $capital) {
        echo "<strong>$country</strong> &rarr; $capital<br>";
    }
    echo "</div>";

    // break and continue
    echo "<h2>break &amp; continue</h2>";
    echo "<div class='output'>";
    echo "<strong>break</strong> &mdash; Stop at first multiple of 7:<br>";
    for ($n = 1; $n <= 50; $n++) {
        if ($n % 7 == 0) {
            echo "Found: $n (stopped)<br>";
            break;
        }
    }

    echo "<br><strong>continue</strong> &mdash; Skip odd numbers:<br>";
    for ($n = 1; $n <= 10; $n++) {
        if ($n % 2 != 0) {
            continue;
        }
        echo "$n ";
    }
    echo "<br>";
    echo "</div>";
    ?>

</div>
</body>
</html>
