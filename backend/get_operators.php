<?php
include 'db_connection.php';

$sql = "SELECT * FROM operators";
$result = $conn->query($sql);

$operators = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['mincom_certified'] = (bool)$row['mincom_certified'];
        $row['mincom_registered'] = (bool)$row['mincom_registered'];
        $operators[] = $row;
    }
}

$conn->close();

echo json_encode($operators);
?>
