const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'mit_ipt'
});

connection.connect((err) => {
  if (err) {
    console.error('MySQL connection error:', err);
    return;
  }
  console.log('Connected to mit_ipt database');

  const createTable = `CREATE TABLE IF NOT EXISTS student_grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    index_number VARCHAR(50) NOT NULL,
    maths DECIMAL(5,2) NOT NULL,
    english DECIMAL(5,2) NOT NULL,
    sciences DECIMAL(5,2) NOT NULL,
    average DECIMAL(5,2) NOT NULL,
    grade CHAR(2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )`;
  connection.query(createTable, (err) => {
    if (err) console.error('Table creation error:', err);
    else console.log('Table ready');
  });
});

app.use(bodyParser.urlencoded({ extended: true }));

// Serve form
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/form.html');
});

// View all grades
app.get('/grades', (req, res) => {
  connection.query('SELECT * FROM student_grades ORDER BY average DESC', (err, results) => {
    if (err) { res.send('Error: ' + err.message); return; }
    let html = '<h2>Student Grade Report</h2>';
    html += '<table border="1" cellpadding="8" style="border-collapse:collapse;">';
    html += '<tr><th>ID</th><th>Name</th><th>Index</th><th>Maths</th><th>English</th><th>Sciences</th><th>Average</th><th>Grade</th></tr>';
    results.forEach(r => {
      html += `<tr><td>${r.id}</td><td>${r.name}</td><td>${r.index_number}</td>`;
      html += `<td>${r.maths}</td><td>${r.english}</td><td>${r.sciences}</td>`;
      html += `<td><strong>${r.average}</strong></td><td><strong>${r.grade}</strong></td></tr>`;
    });
    html += '</table><br><a href="/">← Submit New</a>';
    res.send(html);
  });
});

// Submit grade
app.post('/result', (req, res) => {
  let name = req.body.name;
  let indexNumber = req.body.indexNumber;
  let maths = parseFloat(req.body.maths);
  let english = parseFloat(req.body.english);
  let sciences = parseFloat(req.body.sciences);

  let average = (maths + english + sciences) / 3;
  let grade;
  if (average >= 80) grade = 'A';
  else if (average >= 70) grade = 'B';
  else if (average >= 60) grade = 'C';
  else if (average >= 50) grade = 'D';
  else if (average >= 40) grade = 'E';
  else grade = 'F';

  const sql = `INSERT INTO student_grades (name, index_number, maths, english, sciences, average, grade)
               VALUES (?, ?, ?, ?, ?, ?, ?)`;
  connection.query(sql, [name, indexNumber, maths, english, sciences, average.toFixed(2), grade], (err) => {
    if (err) {
      res.send(`<h2>Error saving data</h2><p>${err.message}</p><a href="/">Go Back</a>`);
      return;
    }
    res.send(`
      <h2>Student Result</h2>
      <p><strong>Name:</strong> ${name}</p>
      <p><strong>Index Number:</strong> ${indexNumber}</p>
      <p><strong>Marks:</strong> Maths: ${maths}, English: ${english}, Sciences: ${sciences}</p>
      <p><strong>Average:</strong> ${average.toFixed(2)}</p>
      <p><strong>Grade:</strong> ${grade}</p>
      <p><em>Record saved to mit_ipt.student_grades</em></p>
      <a href="/">Go Back</a> | <a href="/grades">View All Grades</a>
    `);
  });
});

const port = 8080;
app.listen(port, () => {
  console.log(`Student grading app running on http://localhost:${port}`);
});
