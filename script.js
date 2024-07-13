function notifyGuide(button) {
    let row = button.closest('tr');
    let remainingCell = row.cells[4];
    let remaining = parseInt(remainingCell.textContent);

    if (remaining > 0) {
        remainingCell.textContent = remaining - 1;
        alert('The request  has been sent!');
    } else {
        alert('No remaining slots available for this guide.');
    }
}

function redirectToForm(guideName) {
    window.location.href = `form.html?guideName=${encodeURIComponent(guideName)}`;
}
