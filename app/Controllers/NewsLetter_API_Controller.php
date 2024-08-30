<?php
namespace App\Controllers;
use App\Models\NewsLetterModel;
use CodeIgniter\API\ResponseTrait; 

class NewsLetter_API_Controller extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait

    public function NewsLetterAPI()
    {
        $newsLetterModel = new NewsLetterModel();
    
        $data = [
            'email' => $this->request->getVar('email')
        ];

       
        if ($newsLetterModel->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Email recieved successfully']);
        } else {
            return $this->failServerError('Failed to create lead');
        }
    }

    
}
 ?>