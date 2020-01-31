var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');
var dbConn = require('../db');
var jwt = require('jsonwebtoken');

router.use(bodyParser.json());
router.use(bodyParser.urlencoded({
    extended: true
}));

router.get('/', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            dbConn.query('SELECT * FROM profilpegawai', function (error, results, fields) {
    
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json(results);
            // if (error) throw error;
            //    return res.status(200).send({ error: false, data: results, message: 'list pegawai' });
            });
            authData
        }
    });  
});

router.get('/dosen', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            dbConn.query('SELECT * FROM profilpegawai WHERE posisi=1', function (error, results, fields) {
    
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json(results);
                
            //if (error) throw error;
            //   return res.status(200).send({ error: false, data: results, message: 'list pegawai posisi dosen' });
            });
            authData
        }
    });
});

router.get('/kependidikan', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            dbConn.query('SELECT * FROM profilpegawai WHERE posisi=0', function (error, results, fields) {
    
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json(results);
            //if (error) throw error;
            //    return res.status(200).send({ error: false, data: results, message: 'list pegawai posisi kependidikan' });
            });
            authData
        }
    });
});

router.get('/:nip', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            var nip = req.params.nip;
    
            if (!nip) {
                return res.status(400).send({ error: true, message: 'masukkan nip' });
            }
            
            dbConn.query('SELECT * FROM profilpegawai where nip=?', nip, function (error, result, fields) {
            
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json(result[0])
            //if (error) throw error;
            //    return res.status(200).send({ error: false, data: results[0], message: 'pegawai berdasarkan nip' });
            });
            authData
        }
    });
});

router.post('/create', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            var nama = req.body.nama;
            var nip = req.body.nip;
            var gender = req.body.gender;
            var unitkerja = req.body.unitkerja;
            var posisi = req.body.posisi;

            var sql = `INSERT INTO profilpegawai (nama, nip, gender, unitkerja, posisi) VALUES ("${nama}", "${nip}", "${gender}", "${unitkerja}", "${posisi}")`;

            if (!nama,!nip,!gender,!unitkerja,!posisi) {
                return res.status(400).send({ error:true, message: 'lengkapi data' });
            }
            
            dbConn.query(sql, function (error, results, fields) {
            
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json({status: 'success', nip: results.insertnip});
            //if (error) throw error;
            //    return res.status(200).send({ error: false, message: 'data berhasil ditambah' });
            });
            authData
        }
    });
});

router.put('/update', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            var nama = req.body.nama;
            var nip = req.body.nip;
            var gender = req.body.gender;
            var unitkerja = req.body.unitkerja;
            var posisi = req.body.posisi;

            var sql = `UPDATE profilpegawai SET nama="${nama}", gender="${gender}", unitkerja="${unitkerja}", posisi="${posisi}" WHERE nip="${nip}"`;

            if (!nip) {
                return res.status(400).send({ error:true, message: 'isi nip' });
            }
            
            dbConn.query(sql, function (error, results, fields) {
            
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json({status: 'success'});
            //if (error) throw error;
            //    return res.status(200).send({ error: false, message: 'data berhasil diedit' });
            });
            authData
        }
    });
});

router.delete('/:nip', verifyToken, function (req, res) {
    jwt.verify(req.token, 'secretkey', function (error, authData) {
        if(error) {
            res.sendStatus(403);
        } else {
            var nip = req.params.nip;

            var sql = `DELETE FROM profilpegawai WHERE nip=${nip}`

            if (!nip) {
                return res.status(400).send({ error: true, message: 'isi nip' });
            }
            
            dbConn.query(sql, function (error, results) {
            
                if (error) {
                    res.status(500).send({error: "Something Failed"})
                }
                res.json({status: 'success'});  
            //if (error) throw error;
            //    return res.status(200).send({ error: false, data: results[0], message: 'data dihapus' });
            });
            authData
        }
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