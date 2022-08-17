<script>
const loginContainer = document.getElementById('login_view');
const textArea = document.getElementById('text');
const registerButton = document.getElementById('register_button');

const registerContainer = document.getElementById('register_view');
let isLoginPageOpen = false;

<?php if (isset($isEmailValid)):
    if (!$isEmailValid):
        ?>
        registerContainer.classList.remove('d-none');
    <?php
    else: ?>
        isLoginPageOpen = true;
        loginContainer.classList.remove('d-none');

    <?php endif; endif; ?>

let isRegisterPageOpen = false;


textArea.addEventListener('click', function () {
if (isLoginPageOpen || isRegisterPageOpen) {
loginContainer.classList.add('d-none');
registerContainer.classList.add('d-none');
isLoginPageOpen = false;
isRegisterPageOpen = false;
}
});

registerButton.addEventListener('click', function () {
registerContainer.classList.remove('d-none');
isRegisterPageOpen = true;
});
</script>