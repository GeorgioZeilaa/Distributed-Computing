from flask import Flask, request, redirect
from flask_restful import Resource, Api
import mysql.connector

app = Flask(__name__)
api = Api(app)

@app.route('/set', methods=['POST'])
def set(self):
    config = {
        'user':'root','password':'root',
        'host': 'db-mysql','port':'3306',
        'database':'products'
    }

    pname = request.form['Pname']
    qty = request.form['Quantity']
    price = request.form['Price']

    connection = mysql.connector.connect(**config)
    cursor = connection.cursor()
    sql = "INSERT INTO items_on_sale (name, qty, price) VALUES (%s, %s, %s)"
    val = (pname, qty, price)
    cursor.execute(sql,val)
    return redirect('/')

if __name__=='__main__':
    app.run(port=80,debug=True)