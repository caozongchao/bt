import libtorrent
import MySQLdb
import os
import time

import sys
default_encoding = 'utf-8'
if sys.getdefaultencoding() != default_encoding:
    reload(sys)
    sys.setdefaultencoding(default_encoding)

# newdir = time.strftime('%Y%m%d',time.localtime(time.time()))

# if os.path.exists(os.path.join('temp',newdir)):
#     pass
# else:
#     os.makedirs(os.path.join('temp',newdir))

conn = MySQLdb.connect(host = 'localhost',user = 'root',passwd = 'root',port = 3306)
cur = conn.cursor()
conn.select_db('p2p')

f = file("error.txt","a+")

# for root, dirs, files in os.walk(os.path.join('temp',newdir)):
for root, dirs, files in os.walk('temp'):
    for file in files:
        currentFile = os.path.join(root,file)
        try:
            info = libtorrent.torrent_info(currentFile)
        except Exception as e:
            f.writelines(value[1]+"\n")
            continue
        name = info.name().encode('utf8')
        infoHash = file[0:40]
        fileTime = time.strftime("%Y-%m-%d %H:%M:%S",time.localtime(os.stat(currentFile).st_ctime))
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
        os.remove(currentFile)
cur.close()
conn.close()
f.close()

