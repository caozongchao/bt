import libtorrent
import MySQLdb
import os
import time

import sys
default_encoding = 'utf-8'
if sys.getdefaultencoding() != default_encoding:
    reload(sys)
    sys.setdefaultencoding(default_encoding)

conn = MySQLdb.connect(host = 'localhost',user = '******',passwd = '******',port = 3306)
cur = conn.cursor()
conn.select_db('******')

f = file("error.txt","a+")

for root, dirs, files in os.walk('torrents'):
    for file in files:
        try:
            info = libtorrent.torrent_info(os.path.join(root,file))
        except Exception as e:
            f.writelines(value[1]+"\n")
            continue
        name = info.name().encode('utf8')
        infoHash = file[0:40]
        fileTime = time.strftime("%Y-%m-%d %H:%M:%S",time.localtime(os.stat(os.path.join(root,file)).st_ctime))
        numFiles = info.num_files()
        totalSize = info.total_size()
        files = info.files()
        items = dict([(file.size,file.path) for file in files]).items()
        items.sort(reverse = True)
        fileInfo = os.path.split(items[0][1])[-1]+"$||$"+str(items[0][0])
        for i in items[1:10]:
            fileInfo = fileInfo+"@||@"+os.path.split(i[1])[-1]+"$||$"+str(i[0])
            fileInfo = fileInfo.encode('utf8')
        value = [str(name),infoHash,fileTime,numFiles,totalSize,str(fileInfo)]
        try:
            cur.execute('insert into info(name,hash,time,num,size,files) values(%s,%s,%s,%s,%s,%s)',value)
            conn.commit()
        except Exception as e:
            f.writelines(value[1]+"\n")
cur.close()
conn.close()
f.close()

