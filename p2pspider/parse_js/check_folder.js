var fs = require('fs')
var sd = require('silly-datetime')
var newdir = sd.format(new Date(), 'YYYYMMDD')
fs.exists('temp/'+newdir,function(exists){
    if(!exists){
        fs.mkdir('temp/'+newdir, 0777, function(err){
            if(err){
                console.log(err);
            }
        })
    }
});