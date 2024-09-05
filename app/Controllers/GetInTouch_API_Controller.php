<?php
namespace App\Controllers;
use App\Models\GetInTouchModel;
use CodeIgniter\API\ResponseTrait; 

class GetInTouch_API_Controller extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait


/************** API Function to subimt Get In Touch form from wordpress website ***************/
   
    public function GetInTouchFormAPI()
    {
        $getInTouchModel = new GetInTouchModel();
    
        $data = [
            'full_name' => $this->request->getVar('full_name'),
            'phone' => $this->request->getVar('phone'),
            'subject' => $this->request->getVar('subject'),
            'message' => $this->request->getVar('message')
        ];

       
        if ($getInTouchModel->insert($data)) {
            return $this->respondCreated(['status' => 'success', 'message' => 'Thank you for contacting us']);
        } else {
            return $this->failServerError('Failed to create lead');
        }
    }

/**************  Function to show data from database to dashboards website leads table ***************/

    public function view_all_website_leads()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
    
        $getInTouchModel = new GetInTouchModel();
    
        
        $data = [
            'leads' => $getInTouchModel->paginate(10),  // pagination
            'pager' => $getInTouchModel->pager,
        ];
    
        return view('leads/wesite_leads', $data);
    }


/**************  Function to delete data from website leads table dashboard ***************/

    public function delete_website_leads($gid) {
        $getInTouchModel = new GetInTouchModel();
    
        $builder = $getInTouchModel->table('get_in_touch'); 
        $builder->where('gid', $gid); 
        $result = $builder->delete();
    
        
        if ($getInTouchModel->affectedRows() > 0) {
            echo json_encode(["status" => "success", "message" => "Lead deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete Lead record."]);
        }
    }


}
 ?>