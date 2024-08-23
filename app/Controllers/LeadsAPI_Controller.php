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
        $id = $this->request->getGet('id'); // Retrieve the 'id' from the query parameter

        if (!$id) {
            return $this->fail('No property ID provided.', 400); // Return an error if ID is missing
        }

        $PropertyModel = new PropertyModel();

        // Fetch the property by ID
        $property = $PropertyModel->find($id);

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
        $id = $this->request->getGet('id'); // Retrieve the 'id' from the query parameter

        if (!$id) {
            return $this->fail('No property ID provided.', 400); // Return an error if ID is missing
        }

        $EquipmentModel = new EquipmentModel();

        // Fetch the property by ID
        $equipment = $EquipmentModel->find($id);

        if ($equipment) {
            return $this->respond([
                'status' => 'success',
                'data' => $equipment
            ]);
        } else {
            return $this->failNotFound('Property not found.');
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


}
 ?>