const PASSWORDREGEX = /^[A-Za-z]\w{7,14}$/;

function validateField(fieldText, fieldalert, pattern) {
    if(fieldText.match(pattern)) {
        fieldalert.style.display = "none";
        return true;
    }
    fieldalert.style.display = "block";
}

document.getElementById("password").addEventListener("keypress", ev => {
    validateField(document.getElementById("password").value,
        document.getElementById("password-alert"), PASSWORDREGEX);
});
