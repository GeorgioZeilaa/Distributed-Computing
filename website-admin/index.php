<html>
<body>
<!--linking a styles sheet to get some design into the page-->
<head> <link rel="stylesheet" href="styles.css"> </head>
    <div class="main">
        <div class="mainheader">
            <div id="textbox">
                <span style="float: left;">
                    <!--Uses the gethostname to retrieve the unique host ID of the container and text is placed on the left side -->
                    <?php echo "Host Address: ", gethostname(); ?>
                </span>
                <span style="float: right;">
                    <!--Top right side with specific colour text -->
                    <h style="color: #FF0000;">Admin Page</h>
                </span>
            </div>
            <div class="title">
                <h1>Currently on sale:</h1>
            </div>
        </div>
        <div class="centerall">
            <?php
                //to get the json data from the api
                $json = file_get_contents('http://product-api-service');
                $temp = json_decode($json, true);
                
                //to create a table
                echo "<table border='1'>
                <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                </tr>";

                //printing the data by looping through the list in json
                foreach($temp["products"] as $product)
                {
                    echo "<tr>";
                    echo "<td>" . $product["item"] . "</td>";
                    echo "<td>" . $product["qty"]. "</td>";
                    echo "<td>" . $product["price"]. "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>
        <!-- To send data as POST method -->
        <form method="POST" action="submission.php">
            <h2>Add/Update Item: </h2>
            <div>
                <!--All the form data which defines that they are required to be filled, datatype defined and minimum values defined-->
                <label>Product Name:</label> <input type = "text" name= "Pname" required/> <br>
                <label>Quantity:</label> <input type = "number" min="1" name = "Quantity" required/> <br>
                <label>Price:</label> <input type = "number" step="0.01" min="0" name ="Price" required/> <br>
                <div class="button">
                    <input type = "submit">
                </div>
            </div>
        </form>
    </div>
</body>
</html>