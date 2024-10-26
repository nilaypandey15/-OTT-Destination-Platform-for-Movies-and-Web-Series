// Function to simulate user authentication
function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // In a real application, you would validate the credentials and authenticate the user with a backend server.
    // For this example, let's use hardcoded credentials for demonstration purposes.
    const hardcodedEmail = "user@example.com";
    const hardcodedPassword = "password";

    if (email === hardcodedEmail && password === hardcodedPassword) {
        // Authentication successful
        localStorage.setItem("loggedIn", "true");
        localStorage.setItem("username", email.split("@")[0]); // Just for demonstration, using the part before @ in email as username
        showLoggedInArea();
    } else {
        alert("Invalid email or password. Please try again.");
    }
}

// Function to log out the user
function logout() {
    localStorage.removeItem("loggedIn");
    localStorage.removeItem("username");
    showLoginForm();
}

// Function to display the logged in area
function showLoggedInArea() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("loggedInArea").style.display = "block";
    document.getElementById("username").textContent = localStorage.getItem("username");
}

// Function to display the login form
function showLoginForm() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("loggedInArea").style.display = "none";
}

// Check if the user is already logged in
if (localStorage.getItem("loggedIn") === "true") {
    showLoggedInArea();
} else {
    showLoginForm();
}
