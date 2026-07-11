<?php
require_once __DIR__ . '/../db_config.php';

// GET form handling
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"])) {
    $action = sanitize($conn, $_GET["action"]);

    if ($action == "list") {
        $result = $conn->query("SELECT * FROM courses ORDER BY id");
        echo "<!DOCTYPE html><html><head><title>Courses</title>";
        echo "<style>body{font-family:sans-serif;margin:30px;background:#f0f2f5}table{width:100%;border-collapse:collapse;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);border-radius:8px;overflow:hidden}th{background:#ea580c;color:#fff;padding:12px;text-align:left}td{padding:10px 12px;border-bottom:1px solid #e5e7eb}.info{background:#fff7ed;border-left:4px solid #ea580c;padding:12px;margin:16px 0;border-radius:0 8px 8px 0}a{color:#ea580c;text-decoration:none}</style>";
        echo "</head><body>";
        echo "<h1>Course List (GET)</h1>";
        echo "<div class='info'><strong>Action:</strong> $action | <strong>Records:</strong> " . $result->num_rows . "</div>";
        echo "<table><tr><th>ID</th><th>Code</th><th>Name</th><th>Semester</th><th>Credits</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td><strong>{$row['course_code']}</strong></td><td>{$row['course_name']}</td><td>{$row['semester']}</td><td>{$row['credits']}</td></tr>";
        }
        echo "</table>";
        echo "<p><a href='08_forms_get.php'>← Back</a></p></body></html>";
        exit;
    }

    if ($action == "search") {
        $keyword = isset($_GET["q"]) ? sanitize($conn, $_GET["q"]) : "";
        $stmt = $conn->prepare("SELECT * FROM courses WHERE course_name LIKE ? OR course_code LIKE ?");
        $like = "%$keyword%";
        $stmt->bind_param("ss", $like, $like);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<!DOCTYPE html><html><head><title>Search Results</title>";
        echo "<style>body{font-family:sans-serif;margin:30px;background:#f0f2f5}table{width:100%;border-collapse:collapse;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);border-radius:8px;overflow:hidden}th{background:#ea580c;color:#fff;padding:12px;text-align:left}td{padding:10px 12px;border-bottom:1px solid #e5e7eb}a{color:#ea580c;text-decoration:none}</style>";
        echo "</head><body>";
        echo "<h1>Search: '$keyword'</h1>";
        echo "<table><tr><th>ID</th><th>Code</th><th>Name</th><th>Semester</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['course_code']}</td><td>{$row['course_name']}</td><td>{$row['semester']}</td></tr>";
        }
        echo "</table>";
        echo "<p><a href='08_forms_get.php'>← Back</a></p></body></html>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GET Form - Courses</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 30px; background: #f0f2f5; }
        .form-container { background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 450px; margin-bottom: 20px; }
        h1 { color: #ea580c; }
        label { display: block; font-weight: 600; margin-bottom: 4px; margin-top: 12px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; }
        button { margin-top: 16px; padding: 10px 20px; background: #ea580c; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
        button:hover { background: #c2410c; }
        .info { background: #fff7ed; border-left: 4px solid #ea580c; padding: 12px; margin: 16px 0; border-radius: 0 8px 8px 0; font-size: 0.9em; }
        a { color: #ea580c; }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Course Search (GET)</h1>
    <div class="info">
        <strong>Database:</strong> mit_ipt | <strong>Table:</strong> courses<br>
        GET sends data via URL. Use for non-sensitive data only.
    </div>

    <form action="08_forms_get.php" method="GET">
        <input type="hidden" name="action" value="list">
        <button type="submit">📋 View All Courses</button>
    </form>

    <hr style="margin: 20px 0; border: none; border-top: 1px solid #e5e7eb;">

    <form action="08_forms_get.php" method="GET">
        <input type="hidden" name="action" value="search">
        <label>Search Course:</label>
        <input type="text" name="q" placeholder="Enter course name or code...">
        <button type="submit">🔍 Search</button>
    </form>
    <p style="margin-top:16px;"><a href="index.html">← Back to Index</a></p>
</div>
</body>
</html>