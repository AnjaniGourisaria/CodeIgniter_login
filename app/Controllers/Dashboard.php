<?php 
namespace App\Controllers;
class Dashboard extends BaseController{
    public function index(){
        $usersModels = new \App\Models\UsersModel();
        $loggedUsersID = session()->get('loggedUser');
        $userInfo = $usersModels->find($loggedUsersID);
        $data = [
            'title'=>'Dashboard',
            'userInfo'=>$userInfo
        ];
        return view('dashboard/index',$data);
    }
}