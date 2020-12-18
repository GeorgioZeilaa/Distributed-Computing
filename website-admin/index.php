<!DOCTYPE html>
<html>
    <body>
        <h1>Admin:</h1>
            <?php
                $json = file_get_contents('http://product-api-service');
                $temp = json_decode($json, true);
                echo "Item Name". "Quantity". "Price";
                foreach($temp["products"] as $product)
                {
                    echo "<p>";
                    echo $product["item"] . " " . $product["qty"] . "  " . $product["price"];
                    echo "</p>";
                }
            ?>
            <h2>Add Form</h2>
            <form action="submission.php" method="post">
            <input type="submit">
            </form>
    </body>
</html>