const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.urlencoded({ extended: true }));

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/form.html');
});

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

  res.send(`
    <h2>Student Result</h2>
    <p><strong>Name:</strong> ${name}</p>
    <p><strong>Index Number:</strong> ${indexNumber}</p>
    <p><strong>Marks:</strong> Maths: ${maths}, English: ${english}, Sciences: ${sciences}</p>
    <p><strong>Average:</strong> ${average.toFixed(2)}</p>
    <p><strong>Grade:</strong> ${grade}</p>
    <a href="/">Go Back</a>
  `);
});

const port = 8080;
app.listen(port, () => {
  console.log('Student grading app running on port ' + port);
});
