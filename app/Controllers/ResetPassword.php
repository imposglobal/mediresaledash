<?php

namespace App\Controllers;
use App\Models\LoginModel;


class ResetPassword extends BaseController
{

        public function reset_password($id)
    {
        $data['id'] = $id;
        //echo $data['id'];
        return view("forgot_password/reset_password",$data);
    }

    /******************************** update password********************************* */

    public function update_password()
{
        $session = session();
        $LoginModel = new LoginModel();

        $new_password = $this->request->getVar('new_password');
        $confirm_password = $this->request->getVar('confirm_password');
        $id = $this->request->getVar('id'); // Get the user ID from the hidden input

        // Initialize response array from ajax in reset_password view file
        $response = [
            'status' => 'error',
            'message' => ''
        ];

        if ($new_password !== $confirm_password) {
            $response['message'] = 'Passwords do not match.';
            return $this->response->setJSON($response);
        }

        $updateData = [
            'password' => $new_password, // Store plain text password
        ];

        $LoginModel->where('id', $id)->set($updateData)->update();

        if ($LoginModel->affectedRows() > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Password updated successfully.';
        } else {
            $response['message'] = 'Failed to update password.';
        }

        return $this->response->setJSON($response);
    }

}