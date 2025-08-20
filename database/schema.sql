CREATE TABLE operators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company VARCHAR(255) NOT NULL,
    operator_name VARCHAR(255) NOT NULL,
    operator_picture_path VARCHAR(255) NOT NULL,
    equipment_type ENUM('excavator', 'loader', 'water bowser', 'dump truck', 'grader', 'loader') NOT NULL,
    license_classes VARCHAR(255) NOT NULL,
    license_permit_issue_date DATE NOT NULL,
    license_permit_expiry_date DATE NOT NULL,
    mincom_certified BOOLEAN NOT NULL,
    mincom_registered BOOLEAN NOT NULL,
    mincom_issue_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
