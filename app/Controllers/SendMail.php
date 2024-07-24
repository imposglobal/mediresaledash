<?php

namespace App\Controllers;
use App\Models\EquipmentModel;
use App\Models\LoginModel;


class SendMail extends BaseController
{

        public function forgot_password()
    {
        return view("forgot_password/forgot_password");
    }

    /************************* Email send  ******************************/

    public function send_email_link()
    {
        $email = \Config\Services::email();
        $session = session();
        $LoginModel = new LoginModel();
        $to = $this->request->getPost('email');
        // echo $email;
        $data = $LoginModel->where('email', $to)->first();  
        //print_r($data);
    
        if ($data) {
            $dbemail = $data['email'];  // get email from database using $data variable which stores all data
            $name= $data['name'];
            $id=$data['id'];
            
            if ($to == $dbemail) { // compare email enter by user i.e $to and from database i.e $dbemail
                        
                $email->setTo($to);
                $email->setFrom('support@eco4.doodlo.in');
                $email->setSubject('Reset password');

               
                $link = base_url('/reset_password') . '/' . $id;

                $message = '<div style="width: 600px; margin: 0 auto; background: #f5f5f5; padding: 20px; font-family: Arial, sans-serif;">';
                $message .= '<p style="color: #333;">Dear ' . $name . '</p>';
                $message .= '<p style="color: #333;">We have sent you this email in response to your request to reset your password on Mediresale.</p>';
                $message .= '<p style="color: #333;">To reset your password, please click the Reset Password button below::</p>';
                $message .= '<div style="text-align: center; margin-top: 20px; margin-bottom: 20px;  margin-left: -30px !important;">';
                $message .= '<a href=" ' . $link . '" style="background-color: #007bff ; margin-left: -430px !important; color: #fff; text-decoration: none; padding: 10px 40px; border-radius: 5px; display: inline-block;">Reset Password</a>';
                $message .= '</div>';
                $message .= '<p style="color: #333;"></p>';
                $message .= '<p style="color: #333;">Please ignore this email if you did not request a password change.</p>';
                $message .= '<p style="color: #333;">Feel free to reach out to us at mediressaletest@gmil.com</p>';
                $message .= '<p style="color: #333;"></p>';
                $message .= '<p style="color: #333;">Mediresale Team</p>';
                $message .= '</div>';

                $email->setMessage($message );  
                
                if ($email->send()) {
                    $session->setFlashdata('msg', 'Email sent successfully. Please click the link in email to reset the password');
                    $session->set('id', $id);
                } else {
                    $session->setFlashdata('msg', 'Failed to send email, please try again.');
                }
                return redirect()->back();
                
            } else {
                $session->setFlashdata('msg', 'Email does not exist, please enter a valid email Id.');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist, please enter a valid email Id.');
            return redirect()->back();
        }   
    }
    



}