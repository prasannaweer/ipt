const express = require('express');
const path = require('path');

const app = express();
const port = 3000;

// parse application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true }));
// parse application/json
app.use(express.json());

// serve example.html from the same folder
app.get('/example.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'example.html'));
});

// handle form submission or JSON body data
app.post('/process', (req, res) => {
  const data = req.body;
  res.json({
    message: 'Data received',
    received: data,
  });
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
