<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'register';
    protected $primaryKey = 'id';
    protected $allowedFields = ['u_name','email','password','login_in'];
   
}
?>