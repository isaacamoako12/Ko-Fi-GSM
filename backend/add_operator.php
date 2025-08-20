<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

$name = $_POST['name'];
$shift = $_POST['shift'];
$equipment_type = $_POST['equipment_type'];
$license_class = $_POST['license_class'];
$license_permit_issue_date = $_POST['license_permit_issue_date'];
$license_permit_expiry_date = $_POST['license_permit_expiry_date'];
$mincom_certified = isset($_POST['mincom_certified']) ? 1 : 0;
$mincom_registered = isset($_POST['mincom_registered']) ? 1 : 0;
$mincom_issue_date = $_POST['mincom_issue_date'];
$picture_path = '';

if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $target_dir = "uploads/";
    $picture_path = time() . '_' . basename($_FILES["picture"]["name"]);
    $target_file = $target_dir . $picture_path;

    if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $response['message'] = 'Error uploading file.';
        echo json_encode($response);
        exit;
    }
}

$sql = "INSERT INTO operators (name, shift, equipment_type, license_class, license_permit_issue_date, license_permit_expiry_date, mincom_certified, mincom_registered, mincom_issue_date, picture_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssiiss", $name, $shift, $equipment_type, $license_class, $license_permit_issue_date, $license_permit_expiry_date, $mincom_certified, $mincom_registered, $mincom_issue_date, $picture_path);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
