<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Models\CommonModel;



class Profile extends BaseController
{

   

    /*****************************  ******************************/
  public function profile_show()
  {
    

    $session = session();
    $LoginModel = new LoginModel();

    $user_id = $session->get('id'); 
    if (!$user_id) {
        return redirect()->to('/');
    }
    
    $user = $LoginModel->find($user_id);

    if (!$user) {
        // Handle the case when the user ID is not found in the database
        return redirect()->to('/');
    }
    
    $data['user'] = $user;
    
      return view('profile/profile', $data);
  }


public function update_profile()
{
    $LoginModel = new LoginModel();
    $session = session();
    $user_id = $session->get('id');

    if (!$user_id) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'User not logged in.',
        ]);
    }

    // Check if the user ID exists in the database
    $user = $LoginModel->find($user_id);
    if (!$user) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'User not found.',
        ]);
    }

    $data = [
        'id' => $user_id,
        'name' => $this->request->getPost('name'),
        'lname' => $this->request->getPost('lname'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password')
    ];

    if ($LoginModel->save($data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update profile.',
        ]);
    }
}

  

}
