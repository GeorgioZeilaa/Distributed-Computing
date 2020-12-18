from flask import Flask
from flask_restful import Resource, Api
import mysql.connector

app = Flask(__name__)
api = Api(app)

class Product(Resource):
    def get(self):
        config = {
            'user':'root','password':'root',
            'host': 'db-mysql','port':'3306',
            'database':'products'
        }
        
        connection = mysql.connector.connect(**config)
        cursor = connection.cursor()
        cursor.execute("SELECT * FROM items_on_sale")
        results = [{"item":name, 'qty':qty,'price':price} for (name,qty,price) in cursor]
        return {'products':results}
        
    def set(self):
api.add_resource(Product, '/')

if __name__=='__main__':
    app.run(host='0.0.0.0',port=80,debug=True)