<?php
require_once __DIR__ . '/../db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students - MIT IPT</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 30px; background: #f0f2f5; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { color: #1d4ed8; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
        th { background: #1d4ed8; color: #fff; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #e5e7eb; }
        tr:hover td { background: #f0f7ff; }
        .badge { background: #dbeafe; color: #1d4ed8; padding: 2px 8px; border-radius: 12px; font-size: 0.85em; }
        .info { background: #f0f9ff; border-left: 4px solid #1d4ed8; padding: 12px; margin: 16px 0; border-radius: 0 8px 8px 0; font-size: 0.9em; }
        a { color: #1d4ed8; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Records</h1>
    <div class="info">
        <strong>Database:</strong> mit_ipt | <strong>Table:</strong> students |
        <strong>Total:</strong> <?php echo $conn->query("SELECT COUNT(*) as c FROM students")->fetch_assoc()['c']; ?> records
    </div>
    <table>
        <tr><th>ID</th><th>Name</th><th>Index Number</th><th>Date of Birth</th><th>Contact</th><th>Created</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM students ORDER BY id");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td><strong>{$row['name']}</strong></td>";
            echo "<td><span class='badge'>{$row['index_number']}</span></td>";
            echo "<td>{$row['dob']}</td>";
            echo "<td>{$row['contact']}</td>";
            echo "<td>" . date('Y-m-d', strtotime($row['created_at'])) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p style="margin-top:16px;"><a href="index.html">← Back to Index</a></p>
</div>
</body>
</html>