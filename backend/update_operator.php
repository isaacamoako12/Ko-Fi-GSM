<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

$id = $_POST['id'];
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

// Check if a new picture is uploaded
if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    // First, delete the old picture if it exists
    $sql_select = "SELECT picture_path FROM operators WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $old_picture_path = 'uploads/' . $row['picture_path'];
        if (file_exists($old_picture_path) && !empty($row['picture_path'])) {
            unlink($old_picture_path);
        }
    }
    $stmt_select->close();

    // Upload the new picture
    $target_dir = "uploads/";
    $picture_path = time() . '_' . basename($_FILES["picture"]["name"]);
    $target_file = $target_dir . $picture_path;

    if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $response['message'] = 'Error uploading file.';
        echo json_encode($response);
        exit;
    }

    $sql = "UPDATE operators SET name=?, shift=?, equipment_type=?, license_class=?, license_permit_issue_date=?, license_permit_expiry_date=?, mincom_certified=?, mincom_registered=?, mincom_issue_date=?, picture_path=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssiissi", $name, $shift, $equipment_type, $license_class, $license_permit_issue_date, $license_permit_expiry_date, $mincom_certified, $mincom_registered, $mincom_issue_date, $picture_path, $id);
} else {
    // Update without changing the picture
    $sql = "UPDATE operators SET name=?, shift=?, equipment_type=?, license_class=?, license_permit_issue_date=?, license_permit_expiry_date=?, mincom_certified=?, mincom_registered=?, mincom_issue_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssiisi", $name, $shift, $equipment_type, $license_class, $license_permit_issue_date, $license_permit_expiry_date, $mincom_certified, $mincom_registered, $mincom_issue_date, $id);
}

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
