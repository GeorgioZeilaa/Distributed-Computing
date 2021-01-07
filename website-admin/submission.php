<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //The API url in this case the container name
    $url = "http://product-api-service-admin";

    // collect value of input field
    $data = array(
      'Pname' => $_POST['Pname'],
      'Quantity' => $_POST['Quantity'],
      'Price' => $_POST['Price']);
      $payload = json_encode(array("user" => $data));

      $ch = curl_init($url);
      //Attach encoded JSON string to the POST fields
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
      
      //Set the content type to application/json
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      
      //Return response instead of outputting
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      //Execute the POST request
      $result = curl_exec($ch);
      
      //Close cURL resource
      curl_close($ch);

      //Redirect back to the main page
      header('Location: index.php');
      exit;
  }
?>