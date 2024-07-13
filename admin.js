// Function to send data to the server
function sendData(action, id , guideName, slots) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'admin.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            // Optionally, you can refresh the table data here
        }
    };
    const data = `action=${action}&id=${id}&guide_name=${guideName}&slots=${slots}`;
    xhr.send(data);
}

// Function to add a guide
function addGuide() {
    const guideNameInput = document.getElementById('guideNameInput').value;
    const slotsInput = document.getElementById('slotsInput').value;

    if (guideNameInput && slotsInput) {
        const table = document.getElementById('guideTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        const nameCell = newRow.insertCell(0);
        nameCell.innerHTML = guideNameInput;

        const slotsCell = newRow.insertCell(1);
        slotsCell.innerHTML = slotsInput;

        const actionCell = newRow.insertCell(2);
        actionCell.innerHTML = `
            <button onclick="editGuide(this)">Edit</button>
            <button onclick="deleteGuide(this)">Delete</button>
        `;

        // Send data to the server
        sendData('add', null, guideNameInput, slotsInput);

        // Clear the input fields
        document.getElementById('guideNameInput').value = '';
        document.getElementById('slotsInput').value = '';
    } else {
        alert('Please enter both guide name and slots.');
    }
}

// Function to delete a guide
function deleteGuide(button) {
    const row = button.parentNode.parentNode;
    const id = row.getAttribute('data-id');
    row.parentNode.removeChild(row);

    // Send data to the server
    sendData('delete', id);
}

// Function to edit a guide
function editGuide(button) {
    const row = button.parentNode.parentNode;
    const id = row.getAttribute('data-id');
    const nameCell = row.cells[0];
    const slotsCell = row.cells[1];
    const actionCell = row.cells[2];

    const guideName = nameCell.innerHTML;
    const slots = slotsCell.innerHTML;

    nameCell.innerHTML = `<input type="text" value="${guideName}" id="editGuideName">`;
    slotsCell.innerHTML = `<input type="number" value="${slots}" id="editSlots">`;
    actionCell.innerHTML = `
        <button onclick="saveGuide(this, ${id})">Save</button>
        <button onclick="cancelEdit(this)">Cancel</button>
    `;
}

// Function to save the edited guide
function saveGuide(button, id) {
    const row = button.parentNode.parentNode;
    const nameCell = row.cells[0];
    const slotsCell = row.cells[1];
    const actionCell = row.cells[2];

    const editedGuideName = document.getElementById('editGuideName').value;
    const editedSlots = document.getElementById('editSlots').value;

    nameCell.innerHTML = editedGuideName;
    slotsCell.innerHTML = editedSlots;
    actionCell.innerHTML = `
        <button onclick="editGuide(this)">Edit</button>
        <button onclick="deleteGuide(this)">Delete</button>
    `;

    // Send data to the server
    sendData('edit', id, editedGuideName, editedSlots);
}

// Function to cancel editing
function cancelEdit(button) {
    const row = button.parentNode.parentNode;
    const nameCell = row.cells[0];
    const slotsCell = row.cells[1];
    const actionCell = row.cells[2];

    const guideName = document.getElementById('editGuideName').value;
    const slots = document.getElementById('editSlots').value;

    nameCell.innerHTML = guideName;
    slotsCell.innerHTML = slots;
    actionCell.innerHTML = `
        <button onclick="editGuide(this)">Edit</button>
        <button onclick="deleteGuide(this)">Delete</button>
    `;
}
