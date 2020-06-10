import sys
import random
import numpy as np
from numpy import dot
from numpy.linalg import norm
import pymysql
def distance(userl,frndl) :
    user = np.array(userl)
    frnd = np.array(frndl)
    return  dot(user, frnd)/(norm(user)*norm(frnd))

d= {'reading' : 0,'cooking' : 1,'dancing' : 2,'singing' : 3,'painting' : 4,'sports' : 5,'collecting' : 6,'fashion' : 7,'social service' : 8,'travelling' : 9}
conn = pymysql.connect(host="localhost",user="root",passwd="",db="user hobby")
mycursor = conn.cursor()
userid = int(sys.argv[1])
sqlu = "SELECT * FROM user_hobby WHERE user =" + str(userid) + ";"
mycursor.execute(sqlu)
u = mycursor.fetchone()
user = [0,0,0,0,0,0,0,0,0,0]
hobu = u[1].split(",")
for i in hobu:
    try:
        user[d[i]] = 1
    except:
        break


sql = "SELECT * FROM user_hobby;"
mycursor.execute(sql)
result = mycursor.fetchall()
l = []
if(user == [0,0,0,0,0,0,0,0,0,0]):
    rand = random.sample(result,6)
    for i in rand:
        if(i[0] != userid):
            print(i[0])


else:
    for row in result:
        a = [0,0,0,0,0,0,0,0,0,0]
        hob = row[1].split(",")
        for i in hob:
            try:
                a[d[i]] = 1
            except:
                break
        if(a == [0,0,0,0,0,0,0,0,0,0]):
            continue
        dist = distance(user,a)


        l.append([dist,row[0]])
    l = sorted(l,reverse=True)
    i = 0
    j = 0
    while(i < 5):
        if(l[j][1] != userid):
            print(l[j][1])
            i = i + 1
        j = j + 1



conn.close()
