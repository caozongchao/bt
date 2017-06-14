var path = require('path')
var fs = require('fs')
var sd = require('silly-datetime')
var parseTorrentFile = require('parse-torrent-file')
var newdir = sd.format(new Date(), 'YYYYMMDD')

var pa = fs.readdirSync('temp/'+newdir)

var mysql = require("mysql");
var pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'p2p',
    charset: 'utf8',
});

pa.forEach(function(item){
    if (item != '.gitkeep') {
        var torrent = fs.readFileSync(path.join(__dirname, 'temp/'+newdir+'/'+item))
        var parsed
        try {
            parsed = parseTorrentFile(torrent)
        } catch (e) {
            console.error(e)
        }
        name = parsed.name
        hash = item.substr(0,40)
        stat = fs.statSync(path.join(__dirname, 'temp/'+newdir+'/'+item));
        time = sd.format(stat.ctime, 'YYYY-MM-DD HH:mm:ss')
        num = parsed.files.length
        size = parsed.length
        var infoAddSql = 'INSERT INTO info(name,hash,time,num,size) VALUES (?,?,?,?,?)'
        var value =[name,hash,time,num,size]
        pool.getConnection(function(err,conn){
            if(err){
                console.log(err)
            }else{
                conn.query(infoAddSql,value,function(err1,results){
                    conn.release();
                    if(err1){
                        // throw err1
                        console.log(value.hash)
                        fs.writeFile("error.txt", value.hash, function(err) {
                            if(err) {
                                console.log(err);
                            }
                        });
                    }
                });
            }
        });
        fs.unlink(path.join(__dirname, 'temp/'+newdir+'/'+item))
    }
})

