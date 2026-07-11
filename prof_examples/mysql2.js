var mysql = require('mysql2');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected to MySQL!");

  // Create database
  var sql = "CREATE DATABASE IF NOT EXISTS mit_ipt";
  con.query(sql, function(err, result) {
    if (err) throw err;
    console.log("Database created: " + result);

    // Switch to mit_ipt
    con.changeUser({ database: 'mit_ipt' }, function(err) {
      if (err) throw err;
      console.log("Switched to mit_ipt database");

      // Create example table
      var createTable = `CREATE TABLE IF NOT EXISTS employees (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        department VARCHAR(50),
        salary DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )`;
      con.query(createTable, function(err, result) {
        if (err) throw err;
        console.log("Table created: " + result.message);

        // Insert employee
        var insert = "INSERT INTO employees (name, department, salary) VALUES (?, ?, ?)";
        con.query(insert, ['John Smith', 'IT', 75000], function(err, result) {
          if (err) throw err;
          console.log("Inserted ID: " + result.insertId);

          // Select all
          con.query("SELECT * FROM employees", function(err, results) {
            if (err) throw err;
            console.log("\nEmployees:");
            results.forEach(r => console.log(`  ${r.id}. ${r.name} - ${r.department} - $${r.salary}`));
            con.end();
          });
        });
      });
    });
  });
});
