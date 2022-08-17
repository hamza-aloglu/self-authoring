const ul = document.getElementById('menu');
if (localStorage.getItem('token') != null) {
    validateJWT().then(function (isValid) {
        console.log(isValid);
        if (isValid === true) {
            ul.innerHTML =
                '<li>' +
                '<form action="/self-authoring/logoutUser" method="post">' +
                '<button type="submit" class="dropdown-item" id="logout_button">logout </button> ' +
                '</form>' +
                '</li>';
        } else {
            ul.innerHTML = '<li> <button class="dropdown-item" id="login_button">login (token expired) </button> </li>';
            const loginButton = document.getElementById('login_button');

            loginButton.addEventListener('click', function () {
                loginContainer.classList.remove('d-none');
                isLoginPageOpen = true;
            });
        }
    });

} else {
    ul.innerHTML = '<li> <button class="dropdown-item" id="login_button">login </button> </li>';

    const loginButton = document.getElementById('login_button');

    loginButton.addEventListener('click', function () {
        loginContainer.classList.remove('d-none');
        isLoginPageOpen = true;
    });
}