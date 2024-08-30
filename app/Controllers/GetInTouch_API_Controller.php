<?php
namespace App\Controllers;
use App\Models\GetInTouchModel;
use CodeIgniter\API\ResponseTrait; 

class GetInTouch_API_Controller extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait

    public function GetInTouchFormAPI()
    {
        $getInTouchModel = new GetInTouchModel();
    
        $data = [
            'full_name' => $this->request->getVar('full_name'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'message' => $this->request->getVar('message')
        ];

       
        if ($getInTouchModel->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Thank you for contacting us']);
        } else {
            return $this->failServerError('Failed to create lead');
        }
    }

}
 ?>