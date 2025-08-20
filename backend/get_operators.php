<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include 'db.php';

$sql = "SELECT id, company, operator_name, operator_picture_path, equipment_type, license_classes, license_permit_issue_date, license_permit_expiry_date, mincom_certified, mincom_registered, mincom_issue_date, created_at FROM operators ORDER BY created_at DESC";
$result = $conn->query($sql);

$operators = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $operators[] = $row;
    }
}

$conn->close();
echo json_encode($operators);
?>
