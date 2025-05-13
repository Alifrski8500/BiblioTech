const express = require('express');
const app = express();
const port = 3000;

app.get('/', (req, res) => {
  res.send('<h1>Hello dari Express!</h1>');
});

app.get('/about', (req, res) => {
  res.send('<h1>Tentang Saya</h1><p>Ini adalah halaman tentang saya.</p>');
});

app.listen(port, () => {
  console.log(`Aplikasi berjalan di http://localhost:${port}`);
});