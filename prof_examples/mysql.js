const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'mit_ipt'
});

connection.connect((err) => {
  if (err) {
    console.error('Connection error:', err);
    return;
  }
  console.log('Connected to mit_ipt database!');

  // List all tables
  connection.query('SHOW TABLES', (err, results) => {
    if (err) { console.error(err); return; }
    console.log('\nTables in mit_ipt:');
    results.forEach(row => console.log(' - ' + Object.values(row)[0]));
  });

  // Query students
  connection.query('SELECT * FROM students', (err, results) => {
    if (err) { console.error(err); return; }
    console.log('\nStudents:');
    results.forEach(r => console.log(`  ${r.id}. ${r.name} (${r.index_number})`));
  });

  // Query student grades
  connection.query('SELECT name, average, grade FROM student_grades ORDER BY average DESC', (err, results) => {
    if (err) { console.error(err); return; }
    console.log('\nGrade Report:');
    results.forEach(r => console.log(`  ${r.name}: ${r.average} (${r.grade})`));
  });

  // Query courses
  connection.query('SELECT course_code, course_name, credits FROM courses', (err, results) => {
    if (err) { console.error(err); return; }
    console.log('\nCourses:');
    results.forEach(r => console.log(`  ${r.course_code}: ${r.course_name} (${r.credits} credits)`));

    // Close after all queries
    connection.end(() => console.log('\nConnection closed.'));
  });
});
