<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Functions</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #f39c12; border-bottom: 2px solid #f39c12; padding-bottom: 10px; }
        h2 { color: #d68910; }
        .output { background: #f0f0f0; border-left: 4px solid #f39c12; padding: 15px; margin: 15px 0; }
        pre { background: #2c3e50; color: #ecf0f1; padding: 15px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
<div class="container">
    <h1>07 - PHP Functions</h1>

    <?php
    // ===== Function Definition & Calling =====
    echo "<h2>Basic Function</h2>";
    echo "<div class='output'>";

    function sayHello() {
        return "Hello from PHP!";
    }

    echo sayHello() . "<br>";
    echo "</div>";

    // ===== Parameters =====
    echo "<h2>Function with Parameters</h2>";
    echo "<div class='output'>";

    function greet($name, $timeOfDay = "morning") {
        // $timeOfDay has a default value
        return "Good $timeOfDay, $name!";
    }

    echo greet("Alice") . "<br>";
    echo greet("Bob", "afternoon") . "<br>";
    echo "</div>";

    // ===== Return Values =====
    echo "<h2>Return Values</h2>";
    echo "<div class='output'>";

    function add($a, $b) {
        return $a + $b;
    }

    function divide($a, $b) {
        if ($b == 0) {
            return "Error: Division by zero";
        }
        return $a / $b;
    }

    echo "add(10, 5) = " . add(10, 5) . "<br>";
    echo "divide(20, 4) = " . divide(20, 4) . "<br>";
    echo "divide(10, 0) = " . divide(10, 0) . "<br>";
    echo "</div>";

    // ===== Type Hinting =====
    echo "<h2>Type Hints (PHP 7+)</h2>";
    echo "<div class='output'>";

    function multiply(int $a, int $b): int {
        return $a * $b;
    }

    function formatCurrency(float $amount, string $symbol = "$"): string {
        return $symbol . number_format($amount, 2);
    }

    echo "multiply(6, 7) = " . multiply(6, 7) . "<br>";
    echo "formatCurrency(1234.5) = " . formatCurrency(1234.5) . "<br>";
    echo "formatCurrency(99.9, &euro; ) = " . formatCurrency(99.99, "&euro;") . "<br>";
    echo "</div>";

    // ===== Array Return =====
    echo "<h2>Returning Arrays</h2>";
    echo "<div class='output'>";

    function getMinMax(array $numbers): array {
        return [
            "min" => min($numbers),
            "max" => max($numbers),
            "avg" => array_sum($numbers) / count($numbers)
        ];
    }

    $data = [15, 3, 42, 8, 27, 1];
    $stats = getMinMax($data);

    echo "Data: " . implode(", ", $data) . "<br>";
    echo "Min: {$stats['min']}<br>";
    echo "Max: {$stats['max']}<br>";
    echo "Avg: " . round($stats['avg'], 2) . "<br>";
    echo "</div>";

    // ===== Anonymous Functions / Closures =====
    echo "<h2>Anonymous Functions (Closures)</h2>";
    echo "<div class='output'>";

    $square = function($x) {
        return $x * $x;
    };

    echo "square(9) = " . $square(9) . "<br>";

    // Passing closure to function
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8];
    $evens = array_filter($numbers, function($n) {
        return $n % 2 == 0;
    });
    echo "Even numbers from [1-8]: " . implode(", ", $evens) . "<br>";
    echo "</div>";

    // ===== Built-in Function Examples =====
    echo "<h2>Built-in Function Examples</h2>";
    echo "<div class='output'>";
    echo "strlen(\"Hello World\") = " . strlen("Hello World") . "<br>";
    echo "strtoupper(\"hello\") = " . strtoupper("hello") . "<br>";
    echo "str_replace(\"world\", \"PHP\", \"Hello world!\") = " . str_replace("world", "PHP", "Hello world!") . "<br>";
    echo "date(\"Y-m-d H:i:s\") = " . date("Y-m-d H:i:s") . "<br>";
    echo "rand(1, 100) = " . rand(1, 100) . "<br>";
    echo "</div>";
    ?>

</div>
</body>
</html>
