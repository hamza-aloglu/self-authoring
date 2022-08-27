<script>
    const ul = document.getElementById('menu');

    const writingsContainer = document.getElementById('writing_view');
    let isWritingsPageOpen = false;

    if (localStorage.getItem('token') != null) {
        validateJWT().then(function (isValid) {
            if (isValid === true) {
                ul.innerHTML =
                    '<li>' +
                    '<form action="/self-authoring/logoutUser" method="post">' +
                    '<button type="submit" class="dropdown-item" id="logout_button">logout </button> ' +
                    '</form>' +
                    '<button type="submit" form="create_text" class="dropdown-item" id="logout_button">save text </button> ' +
                    '<button class="dropdown-item" id="writings_button">see texts </button> ' +
                    '</li>';

                const writingsButton = document.getElementById('writings_button');
                writingsButton.addEventListener('click', function () {
                    fetchWritingsOfUser().then(function (texts) {
                        const idOfTexts = [];
                        for (const textId in texts) {
                            idOfTexts.push(textId)
                        }

                        idOfTexts.forEach(function (element, index) {

                            let lengthOfText = texts[element].length
                            let datePartStartingIndex = lengthOfText - 10;

                            let textPart = texts[element].slice(0, datePartStartingIndex);
                            let datePart = texts[element].slice(datePartStartingIndex, lengthOfText);


                            writingsContainer.innerHTML += '<div class="card shadow my-1">' +
                                '<div class="row container my-2"> ' +
                                '<div class="col-12">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title"></h5>' +
                                '<p class="card-text">' + '<button id="saved_text_button' + element + '">' + textPart + '</button>' + '</p>' +
                                '<p class="card-text">' + '<small class="text-muted">' + datePart + '</small></p>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            
                        });
                    });

                    writingsContainer.classList.remove('d-none');
                    isWritingsPageOpen = true;
                });
            } else {
                ul.innerHTML += '<li> <button class="dropdown-item" id="login_button">login (token expired) </button> </li>';
                const loginButton = document.getElementById('login_button');

                loginButton.addEventListener('click', function () {
                    loginContainer.classList.remove('d-none');
                    isLoginPageOpen = true;
                });
            }
        });

    } else {
        ul.innerHTML += '<li> <button class="dropdown-item" id="login_button">login </button> </li>';

        const loginButton = document.getElementById('login_button');

        loginButton.addEventListener('click', function () {
            loginContainer.classList.remove('d-none');
            isLoginPageOpen = true;
        });
    }

</script>
