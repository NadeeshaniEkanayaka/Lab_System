document.getElementById("loginForm").addEventListener("submit", function(event) {
    var emailInput = document.getElementById("emailInput").value;
    var passwordInput = document.getElementById("passwordInput").value;

    if (emailInput.trim() === "") {
        alert("Please enter your email.");
        event.preventDefault();
    } else if (passwordInput.trim() === "") {
        alert("Please enter your password.");
        event.preventDefault();
    }
});
