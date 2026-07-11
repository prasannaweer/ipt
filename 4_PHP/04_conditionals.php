<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Conditionals</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #2980b9; border-bottom: 2px solid #2980b9; padding-bottom: 10px; }
        h2 { color: #1a5276; }
        .output { background: #f0f0f0; border-left: 4px solid #2980b9; padding: 15px; margin: 15px 0; }
        code { background: #e8e8e8; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
<div class="container">
    <h1>04 - PHP Conditionals</h1>

    <?php
    // if statement
    echo "<h2>if Statement</h2>";
    echo "<div class='output'>";
    $temperature = 32;
    echo "Temperature: {$temperature}&deg;C<br>";
    if ($temperature > 30) {
        echo "It's hot outside!<br>";
    }
    echo "</div>";

    // if...else
    echo "<h2>if...else Statement</h2>";
    echo "<div class='output'>";
    $hour = date('H');
    echo "Current hour (24h): $hour<br>";
    if ($hour < 12) {
        echo "Good morning!<br>";
    } else {
        echo "Good afternoon/evening!<br>";
    }
    echo "</div>";

    // if...elseif...else
    echo "<h2>if...elseif...else Statement</h2>";
    echo "<div class='output'>";
    $score = 82;
    echo "Score: $score<br>";
    if ($score >= 90) {
        $grade = "A";
    } elseif ($score >= 80) {
        $grade = "B";
    } elseif ($score >= 70) {
        $grade = "C";
    } elseif ($score >= 60) {
        $grade = "D";
    } else {
        $grade = "F";
    }
    echo "Grade: <strong>$grade</strong><br>";
    echo "</div>";

    // Day-of-week switch example
    echo "<h2>Switch Statement (Day of Week)</h2>";
    echo "<div class='output'>";
    $dayNumber = date('w');  // 0 = Sunday, 6 = Saturday
    $dayName = date('l');    // Full day name

    echo "Today is <strong>$dayName</strong> (day number: $dayNumber)<br><br>";

    switch ($dayNumber) {
        case 0:
            echo "It's Sunday &mdash; Day of rest!<br>";
            break;
        case 1:
            echo "It's Monday &mdash; Start of the work week!<br>";
            break;
        case 2:
            echo "It's Tuesday &mdash; Keep going!<br>";
            break;
        case 3:
            echo "It's Wednesday &mdash; Hump day!<br>";
            break;
        case 4:
            echo "It's Thursday &mdash; Almost there!<br>";
            break;
        case 5:
            echo "It's Friday &mdash; TGIF!<br>";
            break;
        case 6:
            echo "It's Saturday &mdash; Weekend fun!<br>";
            break;
        default:
            echo "Unknown day<br>";
            break;
    }
    echo "</div>";

    // Switch with fall-through
    echo "<h2>Switch with Fall-Through (Weekday vs Weekend)</h2>";
    echo "<div class='output'>";
    switch ($dayNumber) {
        case 0:
        case 6:
            echo "It's the weekend!<br>";
            break;
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            echo "It's a weekday.<br>";
            break;
    }
    echo "</div>";

    // match expression (PHP 8+)
    echo "<h2>match Expression (PHP 8+)</h2>";
    echo "<div class='output'>";
    $color = "blue";
    $meaning = match($color) {
        "red" => "Danger / Stop",
        "green" => "Go / Safe",
        "blue" => "Calm / Information",
        default => "Unknown",
    };
    echo "\$color = \"$color\" &rarr; $meaning<br>";
    echo "</div>";
    ?>

</div>
</body>
</html>
