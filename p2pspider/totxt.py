import libtorrent
import MySQLdb
import os
import time
import pickle

import sys
default_encoding = 'utf-8'
if sys.getdefaultencoding() != default_encoding:
    reload(sys)
    sys.setdefaultencoding(default_encoding)

f = file("info.txt","a+")

for root, dirs, files in os.walk('torrents'):
    for file in files:
        info = libtorrent.torrent_info(os.path.join(root,file))
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
        value = [name,infoHash,fileTime,numFiles,totalSize,fileInfo]
        f.writelines(str(name)+"\n")
        f.writelines(str(infoHash)+"\n")
        f.writelines(str(fileTime)+"\n")
        f.writelines(str(numFiles)+"\n")
        f.writelines(str(totalSize)+"\n")
        f.writelines(str(fileInfo)+"\n")
        f.writelines("========\n")

