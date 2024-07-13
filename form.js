document.getElementById('requestForm').addEventListener('submit', function(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Perform your custom validation here
    if (validateForm()) {
        // If validation passes, show the success message
        alert('Form submitted!');
        // Optionally, you can submit the form programmatically if needed
        // document.getElementById('requestForm').submit();
    } else {
        // If validation fails, you can show an error message or handle it as needed
        alert('Please fill out all fields correctly before submitting.');
    }
});

function validateForm() {
    // Check if any of the required fields are empty
    let usn1 = document.getElementById('usn1').value.trim();
    let name1 = document.getElementById('name1').value.trim();
    let email1 = document.getElementById('email1').value.trim();
    let contact1 = document.getElementById('contact1').value.trim();
    let section1 = document.getElementById('section1').value.trim();

    if (usn1 === '' || name1 === '' || email1 === '' || contact1 === '' || section1 === '') {
        return false;
    }

    let usn2 = document.getElementById('usn2').value.trim();
    let name2 = document.getElementById('name2').value.trim();
    let email2 = document.getElementById('email2').value.trim();
    let contact2 = document.getElementById('contact2').value.trim();
    let section2 = document.getElementById('section2').value.trim();

    if (usn2 === '' || name2 === '' || email2 === '' || contact2 === '' || section2 === '') {
        return false;
    }

    let usn3 = document.getElementById('usn3').value.trim();
    let name3 = document.getElementById('name3').value.trim();
    let email3 = document.getElementById('email3').value.trim();
    let contact3 = document.getElementById('contact3').value.trim();
    let section3 = document.getElementById('section3').value.trim();

    if (usn3 === '' || name3 === '' || email3 === '' || contact3 === '' || section3 === '') {
        return false;
    }

    let usn4 = document.getElementById('usn4').value.trim();
    let name4 = document.getElementById('name4').value.trim();
    let email4 = document.getElementById('email4').value.trim();
    let contact4 = document.getElementById('contact4').value.trim();
    let section4 = document.getElementById('section4').value.trim();

    if (usn4 === '' || name4 === '' || email4 === '' || contact4 === '' || section4 === '') {
        return false;
    }

    // Check if domain and project title are filled out
    let domain = document.getElementById('domain').value.trim();
    let projectTitle = document.getElementById('projectTitle').value.trim();

    if (domain === '' || projectTitle === '') {
        return false;
    }

    // Check if consent letter is uploaded (optional, if required)
    // let consentLetter = document.getElementById('consentLetter').value.trim();
    // if (consentLetter === '') {
    //     return false;
    // }

    // If all checks pass, return true
    return true;
}
