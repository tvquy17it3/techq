// const { Socket } = require('dgram');
const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);



const io = require('socket.io')(server,{
    cors:{origin:'*'}
});

// app.get('/', (req, res) => {
//   res.send('<h1>Hello world</h1>');
// });
var clients = 0;
io.on('connection',(socket)=>{
    // console.log('Connection');
    clients++;
    io.emit("live-user", { msg: `Hiện tại có ${clients} đang kết nối !!` });
    socket.broadcast.emit("noti", { msg: `Một người vừa mới tham gia !!` });

    socket.on('sendChatToServer', (msg)=>{
        socket.broadcast.emit('sendChatToClient',msg);
    });

    socket.on('disconnect',(socket)=>{
        clients--;
        console.log('Disconnnect!'+clients);
        io.emit("noti", { msg: `Một người vừa rời đi !!` });
        io.emit("live-user", { msg: `Hiện tại có ${clients} đang kết nối !!` });
    });
})

var chat = io.of('/t');
chat.on('connection',(socket)=>{
    socket.on('user_name', (msg)=>{
        socket.broadcast.emit("noti", msg);
    });

    socket.on('sendChatToServer', (msg)=>{
        socket.broadcast.emit('sendChatToClient',msg);
    });

    socket.on('disconnect',()=>{
        socket.broadcast.emit("noti", 'Đã rời đi!!');
        console.log('Disconnnect!');
    });
})



server.listen(3000, () => {
  console.log('listening on *:3000');
});

// https://freetuts.net/namespaces-trong-socketio-2327.html