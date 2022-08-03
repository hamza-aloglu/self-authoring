<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h4>
    <?php
    if (isset($users)) {
        foreach ($users as $user)
        {
            echo "<pre>";
            var_dump($user);
            echo "</pre>";
            echo "<br>";
        }
    }
    ?>
</h4>

<form action="/self-authoring/store" method="post">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="submit">
</form>
</body>
</html>