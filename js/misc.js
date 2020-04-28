const PASSWORDREGEX = /^[A-Za-z]\w{7,14}$/;

function validateField(fieldText, fieldalert, pattern) {
    if(fieldText.match(pattern)) {
        fieldalert.style.display = "none";
        return true;
    }
    else
        fieldalert.style.display = "block";

    return false;
}

window.onload = function() {
    document.getElementById("password").oninput = function() {
        validateField(document.getElementById("password").value,
            document.getElementById("password-alert"), PASSWORDREGEX);
    };
};
