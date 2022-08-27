<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
<div class="form-floating h-100" id="container">

    <!-- TEXT AREA -->
    <form action="/self-authoring/createText" method="post" id="create_text" style="all: unset">
        <textarea class="form-control bg-light h-100" id="text" name="writing"></textarea>
        <input type="number" value="" hidden name="uid" id="uid">
    </form>

    <!-- 3 DOTS DROPDOWN -->
    <div class="dropdown bg-light" id="dropdown">
        <button class="btn btn-secondary bg-light text-dark" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>

        <ul class="dropdown-menu" id="menu">
            <!--
              Eğer user loginlenmişse bu buton gözükecek,
              bu butona tıklanınca writing view gözükecek,
              writing viewin içinde user textleri olacak
                    -> user loginlendiği zaman butonun visible olması.
                    -> butona clicklenince writing view gözükmesi
                    -> butona clicklenince serverdan response döndürmesi
                    -> bu serverdan responseun userın textleri olması
                    -> bu textleri düzgün bir biçimde gösterme
                        => texte tıklanınca contentin sayfamda gözükmesi.
            -->
        </ul>
    </div>

    <!-- LOGIN PAGE -->
    <div class="container centered-axis-xy p-3 d-none" id="login_view">
        <form action="/self-authoring/loginUser" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="name" name="user-email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="user-password">
                <div class="form-text">
                    <div id="register_button">register?</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- REGISTER PAGE -->
    <div class="container centered-axis-xy p-3 d-none" id="register_view">
        <form action="/self-authoring/registerUser" method="post">

            <?php if (isset($isEmailValid)):
                if (!$isEmailValid):
                    ?>

                    <div class="alert alert-danger" role="alert">
                        <?php if (isset($emailValidationMessage)):
                            echo $emailValidationMessage;
                        endif;
                        ?>
                    </div>

                <?php endif; endif; ?>

            <div class="mb-3">
                <label for="reg-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="reg-name" name="user-name">
            </div>
            <div class="mb-3">
                <label for="reg-email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="reg-email" name="user-email">
            </div>
            <div class="mb-3">
                <label for="reg-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="reg-password" name="user-password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- WRITINGS PAGE -->
    <div class="container centered-axis-xy p-3 d-none" id="writing_view">
        <h3>Hello World.</h3>
    </div>

</div>

<?php require 'services/tokenAdjustment.php' ?>
<script>

    <?php require 'services/fetchWritingsOfUser.js' ?>

    <?php require 'services/validateJWT.js'?>


</script>

<?php require 'services/dynamicMenuContent.php' ?>

<script>
    <?php require 'services/setUidValue.js' ?>

</script>
<?php require 'services/dynamicRegister-Login.php' ?>

<script>
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>
</html>