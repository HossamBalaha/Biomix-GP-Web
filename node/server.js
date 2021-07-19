const tf = require('@tensorflow/tfjs');

const PORT = 8001;

const http = require('http');
const socketio = require('socket.io');
var express = require('express');
var open = require('open');
const fs = require('fs');
let jsonData = require('.\\tfjsv3\\model.json');

// var app = express();
//
// app.listen(PORT);
// console.log('Your node server start....');

// exports = module.exports = app;
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function run() {
    const port = PORT;
    const server = http.createServer(function (req, res) {
        let data = jsonData;
        res.writeHead(200, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(data));
    });

    const io = socketio(server);

    server.listen(port, '127.0.0.1', () => {
        console.log(`  > Running socket on port: ${port}`);
        //open('http://127.0.0.1:' + port);
    });

    io.on('connection', (socket) => {

    });
}

run();

// module.exports = {
//     port: PORT,
//     files: ['./**/*.{html,htm,css,js}'],
//     open: true
// };
