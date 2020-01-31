var express = require('express');
var app = express();
var morgan = require('morgan');

app.use(express.static('./public'))

app.use(morgan('short'))

// set port
app.listen(3000, function () {
    console.log('Node app is running on port 3000');
});

var profilpegawaiRouter = require('./router/profilpegawai');
var autentikasi = require('./router/autentikasi');

app.use('/profilpegawai', profilpegawaiRouter);
app.use('/aut', autentikasi);

module.exports = app;