const http = require('http');

const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/html');
  res.end('<h1>Hello dari server Node.js!</h1>');
});

server.listen(3000, 'localhost', () => {
  console.log('Server berjalan di http://localhost:3000/');
});