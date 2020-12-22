from flask import Flask, render_template, request
import mysql.connector
app = Flask(__name__)


config = {
            'user':'root','password':'root',
            'host': 'db-mysql','port':'3306',
            'database':'products'
        }

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == "POST":
        details = request.form
        Pname = details['Pname']
        Quantity = details['Quantity']
        Price = details['Price']

        connection = mysql.connector.connect(**config)
        cursor = connection.cursor()
        cursor.execute("INSERT INTO items_on_sale(name, QTY, Price) VALUES (%s, %s, %s)", (Pname, Quantity, Price))
        mysql.connection.commit()
        cursor.close()
        return 'success'
    return render_template('http://website-admin')

if __name__ == '__main__':
    app.run(host='0.0.0.0',port=80,debug=True)