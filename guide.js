function acceptRequest(btn) {
    var requestDiv = btn.parentElement;
    requestDiv.style.backgroundColor = "#d4edda";
    requestDiv.innerHTML += "<p>Status: Accepted</p>";
    disableButtons(requestDiv);
}

function rejectRequest(btn) {
    var requestDiv = btn.parentElement;
    requestDiv.style.backgroundColor = "#f8d7da";
    requestDiv.innerHTML += "<p>Status: Rejected</p>";
    disableButtons(requestDiv);
}

function disableButtons(requestDiv) {
    var buttons = requestDiv.querySelectorAll("button");
    buttons.forEach(button => {
        button.disabled = true;
    });
}
