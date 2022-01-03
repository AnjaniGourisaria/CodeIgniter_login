<?php 
namespace App\Libraries;

class Hash{
    public function make($password){
        return password_hash($password,PASSWORD_BCRYPT);
    }
    public function check($enterd_password,$db_password){
        if(password_verify($enterd_password,$db_password)){
            return true;
        }else{
            return false;
        }
    }
}
