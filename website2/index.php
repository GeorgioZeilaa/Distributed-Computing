<!DOCTYPE html>
<html>
<body>
<h1>Currently on sale2:</h1>
<?php
    $json = file_get_contents('http://product-api-service');
    $temp = json_decode($json, true);

    foreach($temp["products"] as $product)
    {
        echo "<p>";
        echo $product["item"] . ":" . $product["qty"]. ":" . $product["price"];
        echo "</p>";
    }
?>
</body>
</html>