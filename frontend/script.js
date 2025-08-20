document.addEventListener('DOMContentLoaded', function() {
    const addOperatorForm = document.getElementById('add-operator-form');
    const operatorsList = document.getElementById('operators-list');

    const apiUrl = '../backend';

    // Fetch and display operators
    const fetchOperators = async () => {
        try {
            const response = await fetch(`${apiUrl}/get_operators.php`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const operators = await response.json();
            operatorsList.innerHTML = ''; // Clear existing list
            operators.forEach(operator => {
                const operatorCard = document.createElement('div');
                operatorCard.className = 'operator-card';

                const picturePath = `../backend/${operator.operator_picture_path}`;

                operatorCard.innerHTML = `
                    <img src="${picturePath}" alt="${operator.operator_name}">
                    <h3>${operator.operator_name}</h3>
                    <p><strong>Company:</strong> ${operator.company}</p>
                    <p><strong>Equipment:</strong> ${operator.equipment_type}</p>
                    <p><strong>License Classes:</strong> ${operator.license_classes}</p>
                    <p><strong>License Issue Date:</strong> ${operator.license_permit_issue_date}</p>
                    <p><strong>License Expiry Date:</strong> ${operator.license_permit_expiry_date}</p>
                    <p><strong>Mincom Certified:</strong> ${operator.mincom_certified ? 'Yes' : 'No'}</p>
                    <p><strong>Mincom Registered:</strong> ${operator.mincom_registered ? 'Yes' : 'No'}</p>
                    <p><strong>Mincom Issue Date:</strong> ${operator.mincom_issue_date}</p>
                `;
                operatorsList.appendChild(operatorCard);
            });
        } catch (error) {
            console.error('Error fetching operators:', error);
            operatorsList.innerHTML = '<p>Error loading operators. Please try again later.</p>';
        }
    };

    // Handle form submission
    addOperatorForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(addOperatorForm);

        try {
            const response = await fetch(`${apiUrl}/add_operator.php`, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();

            if (result.status === 'success') {
                addOperatorForm.reset();
                fetchOperators(); // Refresh the list
            } else {
                alert(`Error: ${result.message}`);
            }
        } catch (error) {
            console.error('Error adding operator:', error);
            alert('An error occurred while adding the operator.');
        }
    });

    // Initial fetch of operators
    fetchOperators();
});
