var http = require('http');
var dt = require('./mymodule');
function myFunction(req, res) {
  res.writeHead(200, {'Content-Type': 'text/plain'});
  res.write('Hi there' + dt.getDate());
  res.write('Calculation result: ' + dt.calculation());
  res.end();
}
http.createServer(myFunction).listen(8080);
console.log('Server running at http://localhost:8080/');