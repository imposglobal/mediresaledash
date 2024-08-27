<?php
namespace App\Controllers;
use App\Models\GetInTouchModel;
use CodeIgniter\API\ResponseTrait; 
class GetInTouch_API extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait


    public function GetInTouch()
    {
        $leadsModel = new LeadsModel();
    
        $data = [
            'pid'           => $this->request->getVar('property_id'),
            'first_name'    => $this->request->getVar('first_name'),
            'last_name'     => $this->request->getVar('last_name'),
            'email'         => $this->request->getVar('email'),
            'phone_number'  => $this->request->getVar('phone_number')
        ];

       
        if ($leadsModel->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Lead created successfully']);
        } else {
            return $this->failServerError('Failed to create lead');
        }
    }



}
 ?>