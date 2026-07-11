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

const port = 8080;
app.listen(port, () => {
  console.log('Server running on port ' + port);
});