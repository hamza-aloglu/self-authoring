<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body style="">

<div class="form-floating h-100" id="container">
    <textarea class="form-control bg-light h-100" id="text"></textarea>

    <!-- 3 DOTS DROPDOWN -->
    <div class="dropdown bg-light" id="dropdown">
        <button class="btn btn-secondary bg-light text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" id="login_button">login</button></li>
        </ul>
    </div>

    <!-- LOGIN PAGE -->
    <div class="container centered-axis-xy p-3 d-none" id="login_view">
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="name" name="user-email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="user-password">
                <div class="form-text"><div id="register_button">register</div></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- REGISTER PAGE -->
    <div class="container centered-axis-xy p-3 d-none" id="register_view">
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="user-name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="user-email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="user-password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</div>


<script>
    const loginButton = document.getElementById('login_button');
    const loginContainer = document.getElementById('login_view');
    const textArea = document.getElementById('text');
    const registerButton = document.getElementById('register_button');
    const registerContainer = document.getElementById('register_view');

    let isLoginPageOpen = false;
    let isRegisterPageOpen = false;
    loginButton.addEventListener('click', function () {
        loginContainer.classList.remove('d-none');
        isLoginPageOpen = true;
    });

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>
</html>