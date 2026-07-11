const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const path = require('path');
const fs = require('fs');
const app = express();

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'mit_ipt'
});

connection.connect((err) => {
  if (err) { console.error('Connection error:', err); return; }
  console.log('Connected to mit_ipt - Student Grade Data API');
});

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Serve form
app.get('/', (req, res) => {
  const formPath = path.join(__dirname, 'form.html');
  if (fs.existsSync(formPath)) {
    res.sendFile(formPath);
  } else {
    res.send('<h1>Student Grade Data API</h1><p>form.html not found</p>');
  }
});

// Submit & save to file + database
app.post('/result', (req, res) => {
  const formData = req.body;
  if (!formData || Object.keys(formData).length === 0) {
    return res.status(400).send('No form data received');
  }

  const name = formData.name || 'Unknown';
  const indexNumber = formData.indexNumber || 'N/A';
  const maths = parseFloat(formData.maths) || 0;
  const english = parseFloat(formData.english) || 0;
  const sciences = parseFloat(formData.sciences) || 0;
  const average = ((maths + english + sciences) / 3).toFixed(2);
  let grade;
  if (average >= 80) grade = 'A';
  else if (average >= 70) grade = 'B';
  else if (average >= 60) grade = 'C';
  else if (average >= 50) grade = 'D';
  else if (average >= 40) grade = 'E';
  else grade = 'F';

  // Save to file
  const outPath = path.join(__dirname, 'myfile.txt');
  const timestamp = new Date().toISOString();
  const sep = '\n' + '='.repeat(50) + '\n';
  const output = `[${timestamp}]\r\nname: ${name}\r\nindex: ${indexNumber}\r\nmaths: ${maths}\r\nenglish: ${english}\r\nsciences: ${sciences}\r\naverage: ${average}\r\ngrade: ${grade}${sep}`;

  if (!fs.existsSync(outPath)) fs.writeFileSync(outPath, '', 'utf8');
  fs.appendFileSync(outPath, output, 'utf8');

  // Save to database
  const sql = `INSERT INTO student_grades (name, index_number, maths, english, sciences, average, grade) VALUES (?, ?, ?, ?, ?, ?, ?)`;
  connection.query(sql, [name, indexNumber, maths, english, sciences, average, grade], (err) => {
    if (err) {
      res.send(`<h2>File saved, DB error: ${err.message}</h2><a href="/">Back</a>`);
      return;
    }
    res.send(`
      <h2>Student Data Saved</h2>
      <p><strong>Name:</strong> ${name}</p>
      <p><strong>Average:</strong> ${average} | <strong>Grade:</strong> ${grade}</p>
      <p>✅ Saved to file: myfile.txt</p>
      <p>✅ Saved to database: mit_ipt.student_grades</p>
      <a href="/">← Submit Another</a> | <a href="/view">View All</a>
    `);
  });
});

// View all records from DB
app.get('/view', (req, res) => {
  connection.query('SELECT * FROM student_grades ORDER BY id DESC', (err, results) => {
    if (err) { res.send('Error: ' + err.message); return; }
    let html = '<h2>All Grade Records (Database)</h2>';
    html += '<table border="1" cellpadding="8" style="border-collapse:collapse;">';
    html += '<tr><th>ID</th><th>Name</th><th>Index</th><th>M</th><th>E</th><th>S</th><th>Avg</th><th>Grade</th><th>Date</th></tr>';
    results.forEach(r => {
      html += `<tr><td>${r.id}</td><td>${r.name}</td><td>${r.index_number}</td>`;
      html += `<td>${r.maths}</td><td>${r.english}</td><td>${r.sciences}</td>`;
      html += `<td><strong>${r.average}</strong></td><td><strong>${r.grade}</strong></td>`;
      html += `<td>${r.created_at}</td></tr>`;
    });
    html += '</table><br><a href="/">← Submit New</a>';
    res.send(html);
  });
});

app.listen(3001, () => {
  console.log('Student Grade Data API running on http://localhost:3001');
});
