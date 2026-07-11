const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.urlencoded({ extended: true }));

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/form.html');
});

app.post('/example', (req, res) => {
  let fname = req.body.fname;
  let lname = req.body.lname;

  res.send(`Full name is: ${fname} ${lname}`);
});
app.post('/example1', (req, res) => {
  let fname = req.body.fname;
  let lname = req.body.lname;

  res.send(`Last name and First name: ${lname} ${fname}`);
});
app.post('/example2', (req, res) => {
  let x = parseInt(req.body.fname);
  let y = parseInt(req.body.lname);
  let sum = x + y;

  res.send(`Sum is: ${sum}`);
});
const port = 8080;
app.listen(port, () => {
  console.log('Server running on port ' + port);
});


