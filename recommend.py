import pymysql as mdb
import math
import sys
from decimal import Decimal

conn=mdb.connect('localhost','testuser','test123','testdb')
c=conn.cursor()

user_id=str(sys.argv[1])
lati=str(sys.argv[2])
longi=str(sys.argv[3])
radius=int(str(sys.argv[4]))

#user_id=1
#lati='28.635308'
#longi='77.224960'
#radius=1.5

c.execute("Select user_id from users")
userids=c.fetchall()

c.execute("Select lati, longi from userloc")
locations=c.fetchall()

c.execute("Select i1,i2,i3,i4,i5 from userint")
interests=c.fetchall()

c.execute("Select organization,job_profile from userprof")
profiles=c.fetchall()

c.execute("Select i1,i2,i3,i4,i5 from userint where user_id=%s"%user_id)
recc_user_int=c.fetchall()

c.execute("Select organization,job_profile from userprof where user_id=%s"%user_id)
recc_user_prof=c.fetchall()

temp=""

affinity_score=0.0
alpha=0.0
beta=0.0
gamma=0.0

size=len(locations)

outp=""

j=0
while j<size:
    userb=int(userids[j][0])
    if(user_id != userb):
        #print(j)
        lat1=float(locations[j][0])
        long1=float(locations[j][1])
        if(float(lati)>lat1):
            dlat = float(float(lati) - lat1)
        else:
            dlat = float(lat1 - float(lati))
        if(float(longi)>long1):
            dlon = float(float(longi) - long1)
        else:
            dlon = float(long1 - float(longi))

        a = math.pow(float((math.sin(dlat/2))),2) + float(math.cos(float(lati)) * math.cos(lat1) * (math.pow((math.sin(dlon/2)),2)) )
        c = 2 * float( math.atan2( math.sqrt(a), math.sqrt(1-a) ) )
        d = float(63.74 * c)
        d=float(d * 1.1)
        
        if(d<=radius):
            #Distance --> Alpha
            alpha=float( 50 * float(1-float(d/radius)) )
            
            #Interests --> Beta
            beta=0.0
            k=0
            while k<5:
                l=0
                while l<5:
                    if(recc_user_int[0][k]==interests[j][l]):
                        beta=float(  beta + float(   (11-2*k)*float(   1-float(abs(k-l)/5)  )   )  )
                    l=l+1
                k=k+1
                
            #Profile --> Gamma
            gamma=0.0
            k=0
            while k<2:
                l=0
                while l<2:
                    if(recc_user_prof[0][k]==profiles[j][l]):
                        gamma=float(gamma + float( 10-5*l ))
                    l=l+1
                k=k+1

            #Affinity Score
            affinity_score=float(alpha+beta+gamma)
            temp+=str(affinity_score)             
            #print(affinity_score)

            outp+=str(userids[j][0])+','+str(locations[j][0])+','+str(locations[j][1])+','+str(d)+','+str(affinity_score)+'~'
    j=j+1
#While ends here
#print Decimal('1.248765385376538583753')+Decimal('2.387638768583658653765')
print outp
