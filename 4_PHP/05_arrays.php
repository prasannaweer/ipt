<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Arrays</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 700px; }
        h1 { color: #8e44ad; border-bottom: 2px solid #8e44ad; padding-bottom: 10px; }
        h2 { color: #6c3483; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #8e44ad; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .output { background: #f0f0f0; border-left: 4px solid #8e44ad; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>05 - PHP Arrays</h1>

    <?php
    // ========== NUMERIC ARRAYS ==========

    // Auto-indexed (zero-based)
    echo "<h2>Numeric Arrays &mdash; Auto Index</h2>";
    echo "<div class='output'>";
    $colors = array("Red", "Green", "Blue");
    // Short syntax: $colors = ["Red", "Green", "Blue"];

    echo "Using print_r:<br><pre>" . print_r($colors, true) . "</pre>";
    echo "Count: " . count($colors) . "<br>";
    echo "</div>";

    // Manually indexed
    echo "<h2>Numeric Arrays &mdash; Manual Index</h2>";
    echo "<div class='output'>";
    $days = array(
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday"
    );
    echo "Using print_r:<br><pre>" . print_r($days, true) . "</pre>";
    echo "</div>";

    // Accessing numeric arrays
    echo "<h2>Accessing Numeric Arrays</h2>";
    echo "<div class='output'>";
    echo "\$colors[0] = $colors[0]<br>";
    echo "\$colors[2] = $colors[2]<br>";
    echo "Last element: \$colors[" . (count($colors) - 1) . "] = " . $colors[count($colors) - 1] . "<br>";
    echo "</div>";

    // ========== ASSOCIATIVE ARRAYS ==========
    echo "<h2>Associative Arrays</h2>";
    echo "<div class='output'>";
    $student = array(
        "name" => "Alice Johnson",
        "age" => 21,
        "major" => "Computer Science",
        "gpa" => 3.85
    );
    echo "<pre>" . print_r($student, true) . "</pre>";
    echo "</div>";

    echo "<div class='output'>";
    echo "\$student[\"name\"] = " . $student["name"] . "<br>";
    echo "\$student[\"major\"] = " . $student["major"] . "<br>";
    echo "</div>";

    // ========== MULTIDIMENSIONAL ARRAYS ==========
    echo "<h2>Multidimensional Arrays</h2>";
    echo "<div class='output'>";
    $courses = array(
        array("CS101", "Intro to CS", 3),
        array("CS201", "Data Structures", 4),
        array("MATH101", "Calculus I", 4)
    );

    echo "<strong>Numeric multidimensional array:</strong><br>";
    echo "<table>";
    echo "<tr><th>Code</th><th>Name</th><th>Credits</th></tr>";
    foreach ($courses as $course) {
        echo "<tr>";
        echo "<td>" . $course[0] . "</td>";
        echo "<td>" . $course[1] . "</td>";
        echo "<td>" . $course[2] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    echo "<div class='output'>";
    $employees = array(
        "emp001" => array("name" => "Bob", "dept" => "Sales", "salary" => 55000),
        "emp002" => array("name" => "Carol", "dept" => "IT", "salary" => 72000),
        "emp003" => array("name" => "Dave", "dept" => "HR", "salary" => 48000)
    );

    echo "<strong>Associative multidimensional array:</strong><br>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Department</th><th>Salary</th></tr>";
    foreach ($employees as $id => $emp) {
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>" . $emp["name"] . "</td>";
        echo "<td>" . $emp["dept"] . "</td>";
        echo "<td>$" . number_format($emp["salary"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

    // Useful array functions
    echo "<h2>Useful Array Functions</h2>";
    echo "<div class='output'>";
    $fruits = array("Apple", "Banana", "Cherry", "Date");
    echo "Array: " . implode(", ", $fruits) . "<br>";

    $fruits[] = "Elderberry";  // Append
    echo "After append: " . implode(", ", $fruits) . "<br>";

    sort($fruits);
    echo "After sort: " . implode(", ", $fruits) . "<br>";

    echo "in_array(\"Cherry\"): " . (in_array("Cherry", $fruits) ? "true" : "false") . "<br>";

    $keys = array_keys(array("a" => 1, "b" => 2, "c" => 3));
    echo "array_keys: " . implode(", ", $keys) . "<br>";
    echo "</div>";
    ?>

</div>
</body>
</html>
