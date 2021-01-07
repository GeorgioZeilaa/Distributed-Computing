<!DOCTYPE html>
<html>
<body>
    <div class="main">
        <!--Adding style sheet to this webpage -->
        <head> <link rel="stylesheet" href="styles.css"> </head>
        <div class="designheader">
            <div class="topleft">
                <!--To show the unique ID hostname of the container -->
                <?php echo "Host Address: ", gethostname(); ?>
            </div>
            <div class="title">
                <h1>Currently on sale:</h1>
            </div>
        </div>
        <br>
        <div class="table">
            <?php
                //to get the json data to view them
                $json = file_get_contents('http://product-api-service');
                $temp = json_decode($json, true);

                //creating a table for items to be placed in
                echo "<table border='1'>
                <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                </tr>";
                
                //loop through the json to put them in the table
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
    </div>
</body>
</html>