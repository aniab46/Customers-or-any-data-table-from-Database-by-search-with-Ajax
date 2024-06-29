<?php

// Create connection
$conn = new mysqli("localhost", "root", "", "customer_data");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT name, address, city, postal, country FROM customerdata WHERE 
    name LIKE '%$search%' OR 
    address LIKE '%$search%' OR 
    city LIKE '%$search%' OR 
    postal LIKE '%$search%' OR 
    country LIKE '%$search%'";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
