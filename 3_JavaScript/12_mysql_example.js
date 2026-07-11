// =============================================
// 12 - MySQL Database Operations
// =============================================

// Install: npm install mysql2
const mysql = require("mysql2");

// --- Create connection ---
var connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "password"
});

// --- Connect to MySQL server ---
connection.connect((err) => {
    if (err) {
        console.log("Connection error:", err.message);
        return;
    }
    console.log("Connected to MySQL server.");

    // --- Create database ---
    connection.query("CREATE DATABASE IF NOT EXISTS mydb", (err) => {
        if (err) {
            console.log("Error creating database:", err.message);
            return;
        }
        console.log("Database 'mydb' created or already exists.");

        // Use the database
        connection.query("USE mydb", (err) => {
            if (err) {
                console.log("Error using database:", err.message);
                return;
            }

            // --- Create table ---
            var createTable = `
                CREATE TABLE IF NOT EXISTS students (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100),
                    age INT
                )
            `;

            connection.query(createTable, (err) => {
                if (err) {
                    console.log("Error creating table:", err.message);
                    return;
                }
                console.log("Table 'students' created or already exists.");

                // --- Insert values ---
                var insertQuery = "INSERT INTO students (name, email, age) VALUES ?";
                var values = [
                    ["Alice", "alice@email.com", 22],
                    ["Bob", "bob@email.com", 24],
                    ["Charlie", "charlie@email.com", 21]
                ];

                connection.query(insertQuery, [values], (err, result) => {
                    if (err) {
                        console.log("Error inserting values:", err.message);
                        return;
                    }
                    console.log("Inserted " + result.affectedRows + " rows.");

                    // --- Read values ---
                    connection.query("SELECT * FROM students", (err, rows) => {
                        if (err) {
                            console.log("Error reading data:", err.message);
                            return;
                        }
                        console.log("\nStudents table:");
                        console.table(rows);

                        connection.end();
                        console.log("\nConnection closed.");
                    });
                });
            });
        });
    });
});
