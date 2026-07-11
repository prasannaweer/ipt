var fs = require('fs');

fs.appendFile('myfile.txt', 'Hello content! \n hi there \n',    
  function(err) { if (err)
    throw err; console.log('Saved!');
  });
