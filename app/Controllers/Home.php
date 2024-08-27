<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Models\CommonModel;



class Home extends BaseController
{

    public $session;
    public function __construct() {
        helper('form','array');
        $this->session = session();
        
    }
   
  /************************************** Login Page view ********************************** */
  public function index(): string
  {
      return view('login/login');
  }

  /********************************* Login functionality************************************************ */
public function loginAuth()
{
    $session = session();
    $LoginModel = new LoginModel();
    $email = $this->request->getVar('email');   // get email from user login form
    $password = $this->request->getVar('password'); // get password from user login form
    // echo $email;
    // echo $password;

    $data = $LoginModel->where('email', $email)->first();  // get email data form database 
    // print_r($data);
    if($data){
        $pass = $data['password'];  // get password from database using $data variable which stores all data
        
        if($password == $pass){ // compare password enter by user i.e $password and from database i.e $pass
            $ses_data = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'isLoggedIn' => TRUE
            ];
            $session->set($ses_data);

            return redirect()->to('/dashboard');

        }else{
            $session->setFlashdata('msg', 'Email or Password is incorrect.');
            return redirect()->to('/');
        }
    }
    else{
        $session->setFlashdata('msg', 'Email or password incorrect.');
        return redirect()->to('/');
    }
}


/******************************************* Log Out *********************************************************/

public function logout(){

    // Cache-Control Headers
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.

    $session=session();
    $LoginModel = new LoginModel();

    $session->destroy(); 
    return redirect()->to('/'); 

    
}


   




    


   
    


}
