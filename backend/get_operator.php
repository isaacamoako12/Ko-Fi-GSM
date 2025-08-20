<?php
include 'db_connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM operators WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$operator = $result->fetch_assoc();

$operator['mincom_certified'] = (bool)$operator['mincom_certified'];
$operator['mincom_registered'] = (bool)$operator['mincom_registered'];

$stmt->close();
$conn->close();

echo json_encode($operator);
?>
