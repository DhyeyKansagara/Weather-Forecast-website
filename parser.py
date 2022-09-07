import sys
import xml.dom.minidom
import mysql.connector

sql= "DELETE from weather WHERE cityName = %s"
    
document = xml.dom.minidom.parse(sys.argv[1])
divisions = document.getElementsByTagName('div')
finalList = []
for div in divisions:
    data = []
    if(div.hasAttribute('class') and div.getAttribute('class') == 'tombstone-container'):
        for p in div.getElementsByTagName('p'):
            temp = ""
            for node in p.childNodes:
                if(node.nodeType == node.TEXT_NODE):
                    temp = temp+" "+node.nodeValue
            if (temp != ""):
                data.append(temp.strip())

        for img in div.getElementsByTagName('img'):
            if(img.hasAttribute('alt')):
                data.append(img.getAttribute('alt').strip())

        finalList.append(data)


def insert(cursor, weatherRow):
    query = 'INSERT INTO weather(cityName,day,description,temp,lDescription) VALUES (%s,%s,%s,%s,%s)'
    cursor.execute(query, (sys.argv[1].strip(".xhtml"), weatherRow[0], weatherRow[1], weatherRow[2], weatherRow[3]))         

try:
    cnx = mysql.connector.connect(host='localhost', user='root', password='vwxyz', database='weather')
    cursor = cnx.cursor()
    a = ('dhyey')
    cursor.execute(sql,(sys.argv[1].strip(".xhtml"),))
    for item in finalList:
        insert(cursor,item)
        

    cnx.commit()
     
    cursor.close()


except mysql.connector.Error as err:
    
    print(err)
finally:
    try:
        cnx
    except NameError:
        pass
    else:
        cnx.close()
            