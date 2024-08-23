<?php
namespace App\Controllers;
use App\Models\LeadsModel;
use App\Models\PropertyModel;
use App\Models\EquipmentModel;
use CodeIgniter\API\ResponseTrait; 
class LeadsAPI_Controller extends BaseController
{
    use ResponseTrait; // Use the ResponseTrait



    public function getDetails()
    {
        $pid = $this->request->getGet('pid'); // Retrieve the 'pid' from the query parameter
    
        if (!$pid) {
            return $this->fail('No property ID provided.', 400); // Return an error if pid is missing
        }
    
        $PropertyModel = new PropertyModel();
    
        // Fetch the property by pid
        $property = $PropertyModel->where('pid', $pid)->first();
    
        if ($property) {
            return $this->respond([
                'status' => 'success',
                'data' => $property
            ]);
        } else {
            return $this->failNotFound('Property not found.');
        }
    }
    



    public function addLead()
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



    public function getEquipmentDetails()
    {
        $eid = $this->request->getGet('eid'); // Retrieve the 'eid' from the query parameter
    
        if (!$eid) {
            return $this->fail('No Equipment ID provided.', 400); // Return an error if eid is missing
        }
    
        $EquipmentModel = new EquipmentModel();
    
        // Fetch the equipment by eid
        $equipment = $EquipmentModel->where('eid', $eid)->first();
    
        if ($equipment) {
            return $this->respond([
                'status' => 'success',
                'data' => $equipment // Corrected to use the fetched equipment data
            ]);
        } else {
            return $this->failNotFound('Equipment not found.');
        }
    }
    
    
  
    

    public function addEquipmentLead()
    {
        $leadsModel = new LeadsModel();
    
        $data = [
            'eid'           => $this->request->getVar('equipment_id'),
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



    // get all leads  -  equipment lead and property lead

     

    public function view_all_leads()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
    
        $leadsModel = new LeadsModel();
    
        // pagination
        $data = [
            'leads' => $leadsModel->paginate(3),
            'pager' => $leadsModel->pager,
        ];
    
        return view('leads/leads', $data);
    }

    //   delete lead

    public function delete_leads($id) {
        $leadsModel = new LeadsModel(); // Instantiate the LeadsModel
    
        $result = $leadsModel->leads_delete($id); // Use the instantiated model
        if ($result) {
            echo json_encode(["status" => "success", "message" => "Lead deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete Lead record."]);
        }
    }


  




    
    


}
 ?>