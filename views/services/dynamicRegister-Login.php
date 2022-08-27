<script>
    const loginContainer = document.getElementById('login_view');
    const registerContainer = document.getElementById('register_view');

    const textArea = document.getElementById('text');
    const registerButton = document.getElementById('register_button');

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
        console.log('in register button click')
        registerContainer.classList.remove('d-none');
        isRegisterPageOpen = true;
    });

    textArea.addEventListener('click', function () {
        if (isLoginPageOpen || isRegisterPageOpen || isWritingsPageOpen) {
            loginContainer.classList.add('d-none');
            registerContainer.classList.add('d-none');
            writingsContainer.classList.add('d-none');
            isLoginPageOpen = false;
            isRegisterPageOpen = false;
        }
    });
</script>