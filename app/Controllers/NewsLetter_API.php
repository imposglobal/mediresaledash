<?php
namespace App\Controllers;
use App\Models\NewsLetterModel;
use CodeIgniter\API\ResponseTrait; 
class NewsLetter_API extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait

    public function NewsLetter()
    {
        $leadsModel = new LeadsModel();
    
        $data = [
            'pid'           => $this->request->getVar('property_id'),
            'email'         => $this->request->getVar('email')
        ];

       
        if ($leadsModel->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Lead created successfully']);
        } else {
            return $this->failServerError('Failed to create lead');
        }
    }

}
 ?>