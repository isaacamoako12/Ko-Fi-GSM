<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'db.php';

$response = array('status' => 'error', 'message' => 'An unknown error occurred.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = $_POST['company'] ?? 'Rocksure International';
    $operator_name = $_POST['operator_name'] ?? '';
    $equipment_type = $_POST['equipment_type'] ?? '';
    $license_classes = $_POST['license_classes'] ?? '';
    $license_permit_issue_date = $_POST['license_permit_issue_date'] ?? '';
    $license_permit_expiry_date = $_POST['license_permit_expiry_date'] ?? '';
    $mincom_certified = isset($_POST['mincom_certified']) ? 1 : 0;
    $mincom_registered = isset($_POST['mincom_registered']) ? 1 : 0;
    $mincom_issue_date = $_POST['mincom_issue_date'] ?? '';

    if (!empty($operator_name) && !empty($equipment_type) && isset($_FILES['operator_picture'])) {
        $target_dir = "uploads/";
        $image_name = basename($_FILES["operator_picture"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["operator_picture"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["operator_picture"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO operators (company, operator_name, operator_picture_path, equipment_type, license_classes, license_permit_issue_date, license_permit_expiry_date, mincom_certified, mincom_registered, mincom_issue_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $company, $operator_name, $target_file, $equipment_type, $license_classes, $license_permit_issue_date, $license_permit_expiry_date, $mincom_certified, $mincom_registered, $mincom_issue_date);

                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'New operator added successfully.';
                } else {
                    $response['message'] = 'Database error: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                $response['message'] = 'Sorry, there was an error uploading your file.';
            }
        } else {
            $response['message'] = 'File is not an image.';
        }
    } else {
        $response['message'] = 'Required fields are missing.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
