import mysql.connector
import os
import json
mydb = mysql.connector.connect(
      host="localhost",
      user="controlservice",
      password="RqKF2OR2iHpdgQRB",
      database="controlcenter"
    )
mycursor = mydb.cursor()
sql = "select distinct(appname) from apprunlog"
mycursor.execute(sql)
data = mycursor.fetchall()
for app in data:
    sql = "update apprunreport set success = (select count(*) from apprunlog where appname = %s and Exitstatus = '0'),fails = (select count(*) from apprunlog where appname = %s and Exitstatus = '1') where appname = %s"
    val = (app[0],app[0],app[0])
    mycursor.execute(sql,val)
mydb.commit()
sql = "select * from apprunreport"
mycursor.execute(sql)
data = mycursor.fetchall()
label = '"label":['
success = '"success":['
failure = '"failure":['
for app in data:
    label = label +'"'+app[0] + '",'
    success = success + str(app[1]) +','
    failure = failure + str(app[2]) +','
label = label.rstrip(",")+"],"
success = success.rstrip(",")+"],"
failure = failure.rstrip(",")+"]"
jsondata = "{"+label+success+failure+"}"
file = "runreport.json"
f = open(file, "w")
f.write(jsondata)
f.close()
mycursor.close()
mydb.close()
