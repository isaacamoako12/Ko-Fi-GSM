document.addEventListener('DOMContentLoaded', () => {
    const operatorForm = document.getElementById('operator-form');
    const operatorTable = document.getElementById('operator-table').getElementsByTagName('tbody')[0];
    const operatorIdField = document.getElementById('operator-id');

    const fetchOperators = async () => {
        const response = await fetch('backend/get_operators.php');
        const operators = await response.json();
        operatorTable.innerHTML = '';
        operators.forEach(operator => {
            const row = operatorTable.insertRow();
            row.innerHTML = `
                <td><img src="backend/uploads/${operator.picture_path}" alt="${operator.name}" width="50"></td>
                <td>${operator.name}</td>
                <td>${operator.shift}</td>
                <td>${operator.equipment_type}</td>
                <td>${operator.license_class}</td>
                <td>${operator.license_permit_issue_date}</td>
                <td>${operator.license_permit_expiry_date}</td>
                <td>${operator.mincom_certified ? 'Yes' : 'No'}</td>
                <td>${operator.mincom_registered ? 'Yes' : 'No'}</td>
                <td>${operator.mincom_issue_date}</td>
                <td class="actions">
                    <button onclick="editOperator(${operator.id})">Edit</button>
                    <button onclick="deleteOperator(${operator.id})">Delete</button>
                </td>
            `;
        });
    };

    operatorForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(operatorForm);
        const url = operatorIdField.value ? 'backend/update_operator.php' : 'backend/add_operator.php';

        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.success) {
            operatorForm.reset();
            operatorIdField.value = '';
            fetchOperators();
        } else {
            alert('Error: ' + result.message);
        }
    });

    window.editOperator = async (id) => {
        const response = await fetch(`backend/get_operator.php?id=${id}`);
        const operator = await response.json();

        document.getElementById('operator-id').value = operator.id;
        document.getElementById('name').value = operator.name;
        document.getElementById('shift').value = operator.shift;
        document.getElementById('equipment-type').value = operator.equipment_type;
        document.getElementById('license-class').value = operator.license_class;
        document.getElementById('license-permit-issue-date').value = operator.license_permit_issue_date;
        document.getElementById('license-permit-expiry-date').value = operator.license_permit_expiry_date;
        document.getElementById('mincom-certified').checked = operator.mincom_certified;
        document.getElementById('mincom-registered').checked = operator.mincom_registered;
        document.getElementById('mincom-issue-date').value = operator.mincom_issue_date;
    };

    window.deleteOperator = async (id) => {
        if (confirm('Are you sure you want to delete this operator?')) {
            const response = await fetch('backend/delete_operator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            });

            const result = await response.json();
            if (result.success) {
                fetchOperators();
            } else {
                alert('Error: ' + result.message);
            }
        }
    };

    fetchOperators();
});
