var mysql = require('mysql');

//connection configurations
var dbConn = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'rest'
    //database: 'restaccess'
});

// connect to database
dbConn.connect(function(error){
    if (error) throw error;
    console.log('connected');
}); 

module.exports = dbConn;