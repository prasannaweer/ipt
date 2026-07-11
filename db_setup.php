<?php
require_once 'db_config.php';

$message = "";

// Auto-setup: if tables don't exist, create and seed them (for Railway/cloud deploy)
$tablesCheck = $conn->query("SHOW TABLES LIKE 'students'");
if ($tablesCheck->num_rows == 0) {
    // Auto-create tables
    $sqls = [
        "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            index_number VARCHAR(50) NOT NULL UNIQUE,
            dob DATE,
            contact VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS student_grades (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT,
            name VARCHAR(100) NOT NULL,
            index_number VARCHAR(50) NOT NULL,
            maths DECIMAL(5,2) NOT NULL,
            english DECIMAL(5,2) NOT NULL,
            sciences DECIMAL(5,2) NOT NULL,
            average DECIMAL(5,2) NOT NULL,
            grade CHAR(2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            course_code VARCHAR(20) NOT NULL,
            course_name VARCHAR(100) NOT NULL,
            semester VARCHAR(50),
            credits INT DEFAULT 3,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS employees (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            department VARCHAR(50),
            basic_salary DECIMAL(10,2),
            allowance DECIMAL(10,2) DEFAULT 0,
            deduction DECIMAL(10,2) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            category VARCHAR(50),
            price DECIMAL(10,2),
            stock INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100),
            password_hash VARCHAR(255),
            role ENUM('admin','editor','viewer') DEFAULT 'viewer',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
    ];
    foreach ($sqls as $sql) { $conn->query($sql); }

    // Auto-seed
    $seeds = [
        "INSERT IGNORE INTO students (name, index_number, dob, contact) VALUES
            ('John Doe', 'REG001', '2003-01-15', '123-456-7890'),
            ('Jane Smith', 'REG002', '2004-02-20', '987-654-3210'),
            ('Alice Johnson', 'REG003', '2005-03-10', '555-123-4567'),
            ('Bob Wilson', 'REG004', '2002-11-05', '444-987-6543'),
            ('Sara Lee', 'REG005', '2003-07-22', '333-222-1111')",
        "INSERT IGNORE INTO student_grades (student_id, name, index_number, maths, english, sciences, average, grade) VALUES
            (1, 'John Doe', 'REG001', 85.50, 78.00, 90.00, 84.50, 'A'),
            (2, 'Jane Smith', 'REG002', 72.00, 80.50, 68.00, 73.50, 'B'),
            (3, 'Alice Johnson', 'REG003', 65.00, 70.00, 75.00, 70.00, 'B'),
            (4, 'Bob Wilson', 'REG004', 55.00, 60.00, 50.00, 55.00, 'D'),
            (5, 'Sara Lee', 'REG005', 92.00, 88.00, 95.00, 91.67, 'A')",
        "INSERT IGNORE INTO courses (course_code, course_name, semester, credits) VALUES
            ('CS101', 'Introduction to Computer Science', 'Fall 2024', 3),
            ('CS102', 'Data Structures', 'Spring 2024', 4),
            ('CS103', 'Algorithms', 'Fall 2024', 3),
            ('IT201', 'Web Development', 'Spring 2024', 3),
            ('IT202', 'Database Systems', 'Fall 2024', 4)",
        "INSERT IGNORE INTO employees (name, department, basic_salary, allowance, deduction) VALUES
            ('Alice Brown', 'HR', 50000, 10000, 3000),
            ('Bob Davis', 'IT', 65000, 13000, 5000),
            ('Charlie Evans', 'Finance', 45000, 6750, 2000),
            ('Diana Foster', 'IT', 72000, 14400, 6000),
            ('Edward Green', 'HR', 38000, 3800, 1500)",
        "INSERT IGNORE INTO products (name, category, price, stock) VALUES
            ('Laptop', 'Electronics', 999.99, 50),
            ('Keyboard', 'Electronics', 49.99, 200),
            ('Desk Chair', 'Furniture', 199.99, 30),
            ('Monitor 27in', 'Electronics', 349.99, 75),
            ('Notebook', 'Stationery', 2.99, 500)",
        "INSERT IGNORE INTO users (username, email, password_hash, role) VALUES
            ('admin', 'admin@mit.edu', SHA2('admin123', 256), 'admin'),
            ('lecturer', 'lecturer@mit.edu', SHA2('lect123', 256), 'editor'),
            ('student1', 'student1@mit.edu', SHA2('stud123', 256), 'viewer')",
    ];
    foreach ($seeds as $sql) { $conn->query($sql); }
    $message = "<div style='color:#16a34a;background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;'>✅ Auto-setup complete! Database tables created and seeded.</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ?? "";

    if ($action == "reset") {
        // Drop and recreate all tables
        $sqls = [
            "DROP TABLE IF EXISTS student_grades",
            "DROP TABLE IF EXISTS students",
            "DROP TABLE IF EXISTS courses",
            "DROP TABLE IF EXISTS employees",
            "DROP TABLE IF EXISTS products",
            "DROP TABLE IF EXISTS users",

            "CREATE TABLE students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                index_number VARCHAR(50) NOT NULL UNIQUE,
                dob DATE,
                contact VARCHAR(50),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE student_grades (
                id INT AUTO_INCREMENT PRIMARY KEY,
                student_id INT,
                name VARCHAR(100) NOT NULL,
                index_number VARCHAR(50) NOT NULL,
                maths DECIMAL(5,2) NOT NULL,
                english DECIMAL(5,2) NOT NULL,
                sciences DECIMAL(5,2) NOT NULL,
                average DECIMAL(5,2) NOT NULL,
                grade CHAR(2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE courses (
                id INT AUTO_INCREMENT PRIMARY KEY,
                course_code VARCHAR(20) NOT NULL,
                course_name VARCHAR(100) NOT NULL,
                semester VARCHAR(50),
                credits INT DEFAULT 3,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE employees (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                department VARCHAR(50),
                basic_salary DECIMAL(10,2),
                allowance DECIMAL(10,2) DEFAULT 0,
                deduction DECIMAL(10,2) DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                category VARCHAR(50),
                price DECIMAL(10,2),
                stock INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(100),
                password_hash VARCHAR(255),
                role ENUM('admin','editor','viewer') DEFAULT 'viewer',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
        ];

        $ok = true;
        foreach ($sqls as $sql) {
            if (!$conn->query($sql)) {
                $ok = false;
                $message .= "<p style='color:red;'>Error: " . htmlspecialchars($conn->error) . "</p>";
            }
        }

        if ($ok) {
            $message = "<div style='color:#16a34a;background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;'>✅ All tables recreated successfully!</div>";
        }
    }

    if ($action == "seed") {
        $seeds = [
            "INSERT INTO students (name, index_number, dob, contact) VALUES
                ('John Doe', 'REG001', '2003-01-15', '123-456-7890'),
                ('Jane Smith', 'REG002', '2004-02-20', '987-654-3210'),
                ('Alice Johnson', 'REG003', '2005-03-10', '555-123-4567'),
                ('Bob Wilson', 'REG004', '2002-11-05', '444-987-6543'),
                ('Sara Lee', 'REG005', '2003-07-22', '333-222-1111')",

            "INSERT INTO student_grades (student_id, name, index_number, maths, english, sciences, average, grade) VALUES
                (1, 'John Doe', 'REG001', 85.50, 78.00, 90.00, 84.50, 'A'),
                (2, 'Jane Smith', 'REG002', 72.00, 80.50, 68.00, 73.50, 'B'),
                (3, 'Alice Johnson', 'REG003', 65.00, 70.00, 75.00, 70.00, 'B'),
                (4, 'Bob Wilson', 'REG004', 55.00, 60.00, 50.00, 55.00, 'D'),
                (5, 'Sara Lee', 'REG005', 92.00, 88.00, 95.00, 91.67, 'A')",

            "INSERT INTO courses (course_code, course_name, semester, credits) VALUES
                ('CS101', 'Introduction to Computer Science', 'Fall 2024', 3),
                ('CS102', 'Data Structures', 'Spring 2024', 4),
                ('CS103', 'Algorithms', 'Fall 2024', 3),
                ('IT201', 'Web Development', 'Spring 2024', 3),
                ('IT202', 'Database Systems', 'Fall 2024', 4)",

            "INSERT INTO employees (name, department, basic_salary, allowance, deduction) VALUES
                ('Alice Brown', 'HR', 50000, 10000, 3000),
                ('Bob Davis', 'IT', 65000, 13000, 5000),
                ('Charlie Evans', 'Finance', 45000, 6750, 2000),
                ('Diana Foster', 'IT', 72000, 14400, 6000),
                ('Edward Green', 'HR', 38000, 3800, 1500)",

            "INSERT INTO products (name, category, price, stock) VALUES
                ('Laptop', 'Electronics', 999.99, 50),
                ('Keyboard', 'Electronics', 49.99, 200),
                ('Desk Chair', 'Furniture', 199.99, 30),
                ('Monitor 27in', 'Electronics', 349.99, 75),
                ('Notebook', 'Stationery', 2.99, 500)",

            "INSERT INTO users (username, email, password_hash, role) VALUES
                ('admin', 'admin@mit.edu', SHA2('admin123', 256), 'admin'),
                ('lecturer', 'lecturer@mit.edu', SHA2('lect123', 256), 'editor'),
                ('student1', 'student1@mit.edu', SHA2('stud123', 256), 'viewer')",
        ];

        $count = 0;
        foreach ($seeds as $sql) {
            if ($conn->query($sql)) $count++;
            else $message .= "<p style='color:orange;'>Seed warning: " . htmlspecialchars($conn->error) . "</p>";
        }
        $message = "<div style='color:#16a34a;background:#f0fdf4;padding:12px;border-radius:8px;border:1px solid #bbf7d0;'>✅ Seeded $count tables with sample data!</div>";
    }
}

// Get table info
$tables = $conn->query("SHOW TABLES FROM mit_ipt");
$tableList = [];
while ($row = $tables->fetch_assoc()) {
    $tableList[] = reset($row);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Setup - MIT IPT</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 30px; background: #f0f2f5; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { color: #7c3aed; }
        .card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #7c3aed; color: #fff; padding: 10px; text-align: left; }
        td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; margin: 4px; color: #fff; }
        .btn-reset { background: #dc2626; }
        .btn-seed { background: #16a34a; }
        .btn:hover { filter: brightness(1.1); }
        a { color: #7c3aed; }
    </style>
</head>
<body>
<div class="container">
    <h1>Database Setup - mit_ipt</h1>
    <?php echo $message; ?>

    <div class="card">
        <h2>Actions</h2>
        <form method="POST" style="display:inline;" onsubmit="return confirm('Reset will DROP all tables. Continue?');">
            <input type="hidden" name="action" value="reset">
            <button type="submit" class="btn btn-reset">🔄 Reset Database (Drop & Create Tables)</button>
        </form>
        <form method="POST" style="display:inline;">
            <input type="hidden" name="action" value="seed">
            <button type="submit" class="btn btn-seed">🌱 Seed Sample Data</button>
        </form>
    </div>

    <div class="card">
        <h2>Tables (<?php echo count($tableList); ?>)</h2>
        <table>
            <tr><th>Table</th><th>Columns</th><th>Rows</th></tr>
            <?php
            foreach ($tableList as $t) {
                $cols = $conn->query("SHOW COLUMNS FROM $t");
                $colCount = $cols->num_rows;
                $rows = $conn->query("SELECT COUNT(*) as c FROM $t")->fetch_assoc()['c'];
                $colNames = [];
                $cols->data_seek(0);
                while ($c = $cols->fetch_assoc()) $colNames[] = $c['Field'];
                echo "<tr>";
                echo "<td><strong>$t</strong></td>";
                echo "<td style='font-size:0.85em;'>" . implode(', ', $colNames) . "</td>";
                echo "<td>$rows</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <p><a href="index.html">← Back to Index</a></p>
</div>
</body>
</html>