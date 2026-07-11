<?php
require_once __DIR__ . '/../db_config.php';

$message = "";
$students = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "";

    // Add new student
    if ($action == "add") {
        $name = sanitize($conn, $_POST["name"]);
        $index = sanitize($conn, $_POST["index_number"]);
        $dob = sanitize($conn, $_POST["dob"]);
        $contact = sanitize($conn, $_POST["contact"]);

        $stmt = $conn->prepare("INSERT INTO students (name, index_number, dob, contact) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $index, $dob, $contact);

        if ($stmt->execute()) {
            $message = "<div style='color:#16a34a;background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;'>✅ Student '$name' added successfully! (ID: {$conn->insert_id})</div>";
        } else {
            $message = "<div style='color:#dc2626;background:#fef2f2;padding:12px;border-radius:8px;border:1px solid #fecaca;'>❌ Error: " . htmlspecialchars($conn->error) . "</div>";
        }
        $stmt->close();
    }

    // Search students
    if ($action == "search") {
        $keyword = sanitize($conn, $_POST["keyword"]);
        $stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ? OR index_number LIKE ? OR contact LIKE ?");
        $like = "%$keyword%";
        $stmt->bind_param("sss", $like, $like, $like);
        $stmt->execute();
        $students = $stmt->get_result();
        $stmt->close();
    }

    // Delete student
    if ($action == "delete") {
        $id = (int)$_POST["id"];
        $conn->query("DELETE FROM students WHERE id = $id");
        $message = "<div style='color:#16a34a;background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;'>✅ Student deleted!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students CRUD (POST)</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 30px; background: #f0f2f5; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { color: #1d4ed8; }
        .card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        label { display: block; font-weight: 600; margin: 8px 0 4px; }
        input { width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; margin: 4px; }
        .btn-primary { background: #1d4ed8; color: #fff; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-success { background: #16a34a; color: #fff; }
        .btn:hover { filter: brightness(1.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1d4ed8; color: #fff; padding: 10px; text-align: left; }
        td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; }
        tr:hover td { background: #f0f7ff; }
        .info { background: #eff6ff; border-left: 4px solid #1d4ed8; padding: 12px; margin: 16px 0; border-radius: 0 8px 8px 0; font-size: 0.9em; }
        a { color: #1d4ed8; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Management (POST)</h1>
    <div class="info">
        <strong>Database:</strong> mit_ipt | <strong>Table:</strong> students<br>
        POST sends data in request body. Use for sensitive/large data.
    </div>

    <?php echo $message; ?>

    <div class="card">
        <h2 style="margin-top:0;">➕ Add New Student</h2>
        <form method="POST" action="09_forms_post.php">
            <input type="hidden" name="action" value="add">
            <label>Name:</label>
            <input type="text" name="name" required placeholder="Enter full name">
            <label>Index Number:</label>
            <input type="text" name="index_number" required placeholder="e.g., REG006">
            <label>Date of Birth:</label>
            <input type="date" name="dob">
            <label>Contact:</label>
            <input type="text" name="contact" placeholder="Phone number">
            <button type="submit" class="btn btn-primary" style="margin-top:12px;">💾 Save Student</button>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-top:0;">🔍 Search Students</h2>
        <form method="POST" action="09_forms_post.php">
            <input type="hidden" name="action" value="search">
            <div style="display:flex;gap:8px;">
                <input type="text" name="keyword" required placeholder="Search by name, index, or contact..." style="flex:1;">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
    </div>

    <?php if ($students): ?>
    <div class="card">
        <h2 style="margin-top:0;">📋 Search Results</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Index</th><th>DOB</th><th>Contact</th><th>Action</th></tr>
            <?php while ($row = $students->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                <td><?php echo $row['index_number']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this student?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger" style="padding:4px 10px;font-size:0.85em;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php endif; ?>

    <div class="card">
        <h2 style="margin-top:0;">📖 All Students</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Index</th><th>DOB</th><th>Contact</th></tr>
            <?php
            $all = $conn->query("SELECT * FROM students ORDER BY id");
            while ($row = $all->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td><strong>" . htmlspecialchars($row['name']) . "</strong></td><td>{$row['index_number']}</td><td>{$row['dob']}</td><td>{$row['contact']}</td></tr>";
            }
            ?>
        </table>
    </div>

    <p style="margin-top:16px;"><a href="index.html">← Back to Index</a></p>
</div>
</body>
</html>