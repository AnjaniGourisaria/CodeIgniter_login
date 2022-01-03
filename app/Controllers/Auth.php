<?php 
namespace App\Controllers;
// use App\Libraries\Hash;
// use CodeIgniter\Controller;
class Auth extends BaseController {
    private function hash_password($password){
        return password_hash($password, PASSWORD_BCRYPT);
     }
     public function checking($enterd_password,$db_password){
        if(password_verify($enterd_password,$db_password)){
            return true;
        }else{
            return false;
        }
    }
    
    public function __construct() {
        helper(['url','form']);
    }
    public function login() {
        return view('auth/login');
    }
    public function register() {
        return view('auth/register');
    }
    public function save() {
        // $validation = $this->validate([
        //     'name' => 'required|min_length[4]|max_length[10]',
        //     'email' => 'required|valid_email|is_unique[register.email]',
        //     'password' => 'required|min_length[8]|max_length[18]',
        //     'reEnterPassword' => 'required|min_length[8]|max_length[18]|matches[password]',
        // ]);
        $validation = $this->validate([
            'name' =>[
                'rules'=>'required|min_length[4]|max_length[20]|is_unique[register.u_name]',
                'errors'=>[
                    'required'=> "UserName is Compulsory/must be",
                    'min_length' => 'Must be between 4 and 20 characters',
                    'max_length' => 'Must be between 4 and 20 characters',
                    'is_unique' => 'Username Taken'
                ]
                ],
            'email' =>[
                    'rules'=> 'required|valid_email|is_unique[register.email]',
                    'errors'=>[
                        'required'=> "Email is Compulsory/must be",
                        'valid_email' => 'Please enter a valid email',
                        'is_unique' => 'Email Taken'
                    ]
                    ],
            'password' =>[
                    'rules'=> 'required|min_length[8]|max_length[18]',
                    'errors'=>[
                        'required'=> "Password is Compulsory/must be",
                        'min_length' => 'Must be between 8 and 20 characters',
                        'max_length' => 'Must be between 8 and 20 characters'
                     ]
                     ],
            'reEnterPassword' =>[
                    'rules'=> 'required|min_length[8]|max_length[18]|matches[password]',
                    'errors'=>[
                        'required'=> "Password is Compulsory/must be",
                        'min_length' => 'Must be between 8 and 20 characters',
                        'max_length' => 'Must be between 8 and 20 characters',
                        'matches' => 'Must Matches the both passowrd and Confirm password'
                    ]
                    ],
        ]);


        if(!$validation){
            return view('auth/register',['validation'=>$this->validator]);
        }else{
            //Registration Process Using Models Bases
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $values = [
                'u_name'=>$name,
                'email'=>$email,
                'password'=>$this->hash_password($password),

            ];
            $usersModel = new \App\Models\UsersModel();
            $quary = $usersModel->insert($values);
            if(!$quary){
                return redirect()->back()->with('fail','Something Went Wrong');
            }else{
                // return redirect()->to('auth/register')->with('success','You Are Registered Successfully');
                $last_id = $usersModel->insertID();
                session()->set('loggedUser',$last_id);
                return redirect()->to('/dashboard');
            }

        }
        
    }
    public function auth(){
        $validation = $this->validate([
        'name' =>[
            'rules'=>'required|min_length[4]|max_length[20]|is_not_unique[register.u_name]',
            'errors'=>[
                'required'=> "UserName is Compulsory/must be",
                'min_length' => 'Must be between 4 and 20 characters',
                'max_length' => 'Must be between 4 and 20 characters',
                'is_not_unique'=> 'User Is Not Taken'
            ]
            ],
            'password' =>[
                'rules'=> 'required|min_length[8]|max_length[18]',
                'errors'=>[
                    'required'=> "Password is Compulsory/must be",
                    'min_length' => 'Must be between 8 and 20 characters',
                    'max_length' => 'Must be between 8 and 20 characters'
                 ]
                 ],
                ]);
        if(!$validation){
            return view('auth/login',['validation'=>$this->validator]);
        }else{
                $session = session();
                $model = new \App\Models\UsersModel();
                $name = $this->request->getVar('name');
                $password = $this->request->getVar('password');
                $data = $model->where('u_name', $name)->first();
                if($data){
                    $pass = $data['password'];
                    $verify_pass = $this->checking($password, $pass);
                    if($verify_pass){
                        // $ses_data = [
                        //     'id'       => $data['id'],
                        //     'u_name'     => $data['u_name'],
                        //     'email'    => $data['email'],
                        //     'login_in'     => TRUE
                        // ];
                        $user_id = $data['id'];
                        $session->set('loggedUser',$user_id);
                        // updated code
                        $model->query("UPDATE `register` SET `login_in` = '1' WHERE `register`.`id` = $user_id ");
                        // echo 'order has successfully been updated';
                        return redirect()->to('/dashboard');
                    }else{
                        // $session->setFlashdata('fail', 'Wrong Password');
                        $session->setFlashdata('fail', 'Invalid Creditials');
                        return redirect()->to('auth/login')->withInput();
                    }
                }else{
                    // $session->setFlashdata('fail', 'Email not Found');
                    $session->setFlashdata('fail', 'Invalid Creditials');
                    return redirect()->to('auth/login')->withInput();
                }
            }
        }
        public function logout(){
            if(session()->has('loggedUser')){
                $usersModels = new \App\Models\UsersModel();
                // $usersModels = new \App\Models\UsersModel();
                $loggedUsersID = session()->get('loggedUser');
                $userInfo = $usersModels->find($loggedUsersID);
                $id_u= $userInfo['id'];
                $usersModels->query("UPDATE `register` SET `login_in` = '0' WHERE `register`.`id` =  $id_u ");
                session()->remove('loggedUser');
                $u_name= $userInfo['u_name'];
                return redirect()->to('auth/login')->with('fail',"You $u_name Logout");
            }
        }
        }
  
?>