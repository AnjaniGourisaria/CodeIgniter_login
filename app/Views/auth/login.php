<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<style type="text/css">
    .login {
    width:400px;
    background:#fff;
    border:1px solid #dddfe2;
    /* box-shadow: 0 2px 4px rgba(0 0 0 / 10%), 0 8px 16px rgba(0 0 0 / 10%); */
    box-shadow:0 4px 45px rgb(1 12 2 / 650%), 0 6px 56px rgb(1 24 5 / 50%);

    border-radius:8px;
    padding:2rem;
    align-items:center;
    text-align:center;
    border-top-width: 0px;
    margin-top: 146px;
    margin-right: 45px;
    margin-left: 729px;
}
.login > input {
    border-radius: 8px;
    border:2px solid #dddfe2;
    outline:none;
    color:#1d2129;
    margin:0.5rem 0;
    padding:0.5rem 0.75rem;
    width:80%;
    font-size:1rem;
}
.login > .button {
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
span {
    align-items: center;
    appearance: auto;
}
#regi_form_btn {
    display: flow-root;
}
.text-danger {
     color: red;
     font-size: x-large;
     }
.text-success {
     color: green;
     font-size: x-large;
     }
</style>
</style>
<title>Login  User</title>

</head>
<body>
    
</body>
</html>
<div >
<form  class="login" action="<?= base_url('auth/auth'); ?>"  method="POST">
            <?= csrf_field(); ?>        
            <?= csrf_field(); ?>  
     <?php if(!empty(session()->getFlashdata('fail'))) : ?>
       <span class="text-danger"><?= session()->getflashdata('fail'); ?> </span>
        <?php endif ?>
     
        <h1>Login</h1>
            <input type="name" name="name"  placeholder="Enter Your Username" required value="<?= set_value('name'); ?>">         </input>
       <span class="text-danger"><?= isset($validation) ? display_error($validation,'name') : '' ?> </span>

            <input type="password" name="password" placeholder="Enter Your Password" required value="<?= set_value('password'); ?>">  </input>
       <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : '' ?> </span>
            
            <button type="submit" class="button">Login</button>
            <input type="hidden" name="login_in" placeholder="Enter Your Password" required value="True">  </input>
            <div>OR</div>
            <div class="button" ><a href="<?= site_url('auth/register'); ?>">Register</a></div>
        </div>
        </form>