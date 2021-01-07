from flask import Flask, request
from flask_restful import Resource, Api
import mysql.connector, json

app = Flask(__name__)
api = Api(app)

class Product(Resource):
    #config for login credentials
    config = {
            'user':'root','password':'root',
            'host': 'db-mysql','port':'3306',
            'database':'products'
        }
    def get(self):
        #accessing the config and connecting to the mysql database
        connection = mysql.connector.connect(**self.config)
        cursor = connection.cursor()

        #to retrieve data from mysql table
        cursor.execute("SELECT * FROM items_on_sale")
        #making a json format of the data
        results = [{"item":name, 'qty':qty,'price':price} for (name,qty,price) in cursor]

        return {'products':results}
    
    def post(self):
        #to receive the form data from the php admin page
        data = request.get_json()
        
        #accessing the config and connecting to the mysql database
        connection = mysql.connector.connect(**self.config)
        cursor = connection.cursor()
        cursor = connection.cursor(buffered=True)

        #checking if there is already an existing product name by checking the row number it returns
        sql = "SELECT COUNT(*) FROM items_on_sale WHERE name = %s "
        val = (str(data['user']['Pname']),)
        cursor.execute(sql,val)
        result=cursor.fetchone()

        #if there are none existing name that was entered then add a new record
        if(result[0] == 0):
            sql = "insert into items_on_sale (name,qty,price) values (%s,%s,%s) "
            val = (str(data['user']['Pname']),str(data['user']['Quantity']),str(data['user']['Price']))
            cursor.execute(sql,val)
            connection.commit()
        #if there is an existing record then just update quantity
        else:
            sql = "UPDATE items_on_sale SET qty = %s, price= %s WHERE name = %s"
            val = (str(data['user']['Quantity']),str(data['user']['Price']),str(data['user']['Pname']))
            cursor.execute(sql,val)
            connection.commit()

api.add_resource(Product, '/')

if __name__=='__main__':
    app.run(host='0.0.0.0',port=80,debug=True)