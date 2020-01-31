var express = require('express');
var router = express.Router();
var jwt = require('jsonwebtoken');

router.get('/', function (req, res) {
    res.json({
        message: 'Welcome'
    });
});

router.post('/post', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            res.json({
                message: 'Post Created',
                authData
            });
        }
    });
});

router.post('/login', function (req, res) {
    // Mock User
    var user = {
        id: 1,
        username: 'test',
        email: '....'
    }

    jwt.sign({user: user}, 'secretkey', function (error, token) {
        res.json({
            token
        });
    });
});

/** verifyToken method - this method verifies token */
function verifyToken(req, res, next){
    
    //Request header with authorization key
    const bearerHeader = req.headers['authorization'];
    
    //Check if there is  a header
    if(typeof bearerHeader !== 'undefined'){
        const bearer = bearerHeader.split(' ');
        
        //Get Token arrray by spliting
        const bearerToken = bearer[1];
        //set the token
        req.token = bearerToken;
        //call next middleware
        next();
    }else{
        res.sendStatus(403);
    }
}

module.exports = router;