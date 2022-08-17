<script>
    const loginContainer = document.getElementById('login_view');
    const textArea = document.getElementById('text');
    const registerButton = document.getElementById('register_button');

    const registerContainer = document.getElementById('register_view');
    let isLoginPageOpen = false;
    let isRegisterPageOpen = false;

    <?php if (isset($isEmailValid)):
    if (!$isEmailValid):
    ?>
    isRegisterPageOpen = true;
    registerContainer.classList.remove('d-none');
    <?php
    else: ?>
    isLoginPageOpen = true;
    loginContainer.classList.remove('d-none');

    <?php endif; endif; ?>



    registerButton.addEventListener('click', function () {
        registerContainer.classList.remove('d-none');
        isRegisterPageOpen = true;
    });

    textArea.addEventListener('click', function () {
        if (isLoginPageOpen || isRegisterPageOpen) {
            loginContainer.classList.add('d-none');
            registerContainer.classList.add('d-none');
            isLoginPageOpen = false;
            isRegisterPageOpen = false;
        }
    });
</script>