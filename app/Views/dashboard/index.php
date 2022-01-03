<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .button {
    background:#1877f2;
    border:1px solid #1877f2;
    color:#fff;
    font-size:1.25rem;
    padding:0.5rem;
    margin:0.5rem 0;
    border-radius:8px;
    outline: none;
    cursor: pointer;
}
</style>
    <title>Hi <?= $userInfo['u_name']; ?></title>
</head>
<body>

<form method="post" action="<?= base_url('auth/logout'); ?>">
    <button type="submit" class="button">Logout</button>
</form>

</body>
</html>