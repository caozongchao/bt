import MySQLdb
import os

#fileNum = os.popen('ls -l torrents|wc -l').readlines()[0]
#print fileNum

conn = MySQLdb.connect(host = 'localhost',user = '******',passwd = '******',port = 3306)
cur = conn.cursor()
conn.select_db('******')

n = cur.execute('select count(*) from info')
for row in cur.fetchall():
    for r in row:
        databaseNum = r
        print databaseNum

#print int(fileNum) - int(databaseNum) - 2
