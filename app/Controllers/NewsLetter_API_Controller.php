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

    public function view_all_newsletter_leads()
    {

        // echo 'testing';
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
    
        $newsLetterModel = new NewsLetterModel();
    
        
        $data = [
            'leads' => $newsLetterModel->paginate(10),  // pagination
            'pager' => $newsLetterModel->pager,
        ];
    
        return view('leads/newsletter_leads', $data);
    }

    /************  Function to delete email data from newsletter  table  ***************/

    public function delete_newsletter_lead($news_id) {
        $newsLetterModel = new NewsLetterModel();
    
        $builder = $newsLetterModel->table('newsletter'); 
        $builder->where('news_id', $news_id); 
        $result = $builder->delete();
    
        if ($result) {
            echo json_encode(["status" => "success", "message" => "Lead deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete Lead record."]);
        }
    }
    
}
 ?>