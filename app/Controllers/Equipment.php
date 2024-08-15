<?php

namespace App\Controllers;
use App\Models\EquipmentModel;
use App\Models\CommonModel;
use App\Models\StateModel;
use App\Models\CityModel;



class Equipment extends BaseController
{

    protected $equipmentModel;
    protected $cityModel;
    protected $stateModel;

    public function __construct() {
        $this->equipmentModel = new EquipmentModel();
        $this->cityModel = new CityModel();
        $this->stateModel = new StateModel();
    }


    public function equipments()
    { 
         //when unkonmwn user try to access any url path, then it should redirect to login page i.e without login no one can access any page directly
          if(!session()->get('isLoggedIn'))
            return redirect()->to('/');

            $CommonModel = new CommonModel();
            $states = $CommonModel->selectData("states");
            $data['states'] = $states;

        return view('equipments/add_equipments' , $data);
    }

    public function cities()
    {
       $stateId= $this->request->getPost("statesId");
       
       $CommonModel = new CommonModel();
       $citydata = $CommonModel->selectData("cities", array("state_id" => $stateId));
       
       $output =  "";
       foreach ($citydata as $city) {

             $output .= "<option value='$city->id'>$city->city</option>";
       }
       echo json_encode($output);
    }

/************************************* original code by shraddha ************************************* */
    // public function add_equipments()
    // {
    //     $EquipmentModel = new EquipmentModel();
        
    //     // Handle multiple file uploads
    //     $images = $this->request->getFiles();
    //     $validImages = [];
    //     $imageNames = [];
    
    //     foreach ($images['equipment_image'] as $file) {
    //         if ($file->isValid() && !$file->hasMoved()) {
    //             $newName = $file->getRandomName();
    //             $file->move(WRITEPATH . '../assets/uploads/equipments/', $newName);
    //             $imageNames[] = $newName; // Store the new name of the file
    //         }
    //     }
    
    //     if (!empty($imageNames)) {
    //         $imageNamesString = implode(',', $imageNames); // Convert array of image names to a comma-separated string
    //     } else {
    //         $imageNamesString = null; // No valid images uploaded, set to null
    //     }

    // $StateModel = new StateModel();
    // $CityModel = new CityModel();

    // $stateId = $this->request->getPost('state');
    // $cityId = $this->request->getPost('city');

    // // Fetch state name
    // $state = $StateModel->where('id', $stateId)->first();
    // $stateName = $state['name'] ?? 'state not found.';

    // // Fetch city name
    // $city = $CityModel->select('cities.city as city_name')
    //                   ->join('states', 'cities.state_id = states.id')
    //                   ->where('cities.id', $cityId)
    //                   ->first();
    // $cityName = $city['city_name'] ?? 'City not found.';
    
    //     // Get data from the form and map it to the database fields
    //     $data = [
    //         'title' => $this->request->getPost('title'),
    //         'equipment_type' => $this->request->getPost('equipment_type'),
    //         'brand' => $this->request->getPost('brand'),
    //         'equipment_condition' => $this->request->getPost('equipment_condition'),
    //         'warranty' => $this->request->getPost('warranty'),
    //         'availability' => $this->request->getPost('availability'),
    //         'serial_number' => $this->request->getPost('serial_number'),
    //         'price' => $this->request->getPost('price'),
    //         'manifacture_year' => $this->request->getPost('manifacture_year'),
    //         'state' => $stateName,
    //         'city' => $cityName,
    //         'zipcode' => $this->request->getPost('zipcode'),
    //         'description' => $this->request->getPost('description'),
    //         'equipment_image' => $imageNamesString
    //     ];
    
    //     // Save data to the database
    //     $EquipmentModel->save($data);
    
    //     // Redirect with a success message
    //    // Return JSON response
    // return $this->response->setJSON(['status' => 'success', 'message' => 'Equipment added successfully']);
    // }

/***************************************  additional code by krushna to save iamge with its path in db *****************************/
    
    
public function add_equipments()
{
    $EquipmentModel = new EquipmentModel();
    
    // Handle multiple file uploads
    $images = $this->request->getFiles();
    $validImages = [];
    $imageNames = [];
    
    if (isset($images['equipment_image'])) {
        foreach ($images['equipment_image'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $yearMonthFolder = date('Y') . '/' . date('m');
                // $uploadPath = WRITEPATH . '../assets/uploads/equipments/' . $yearMonthFolder . '/';
                $uploadPath = WRITEPATH . '../assets/uploads/equipments/';


                // Ensure the directory exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $imagePaths[] = 'http://localhost/mediresaledash/assets/uploads/equipments/' . $newName; // image will be saved with this path in db
                
            }
        }
    }

    // Convert array of image paths to a comma-separated string
    $imageNamesString = !empty($imagePaths) ? implode(',', $imagePaths) : null;

    $StateModel = new StateModel();
    $CityModel = new CityModel();

    $stateId = $this->request->getPost('state');
    $cityId = $this->request->getPost('city');

    // Fetch state name
    $state = $StateModel->where('id', $stateId)->first();
    $stateName = $state['name'] ?? 'State not found.';

    // Fetch city name
    $city = $CityModel->select('cities.city as city_name')
                      ->join('states', 'cities.state_id = states.id')
                      ->where('cities.id', $cityId)
                      ->first();
    $cityName = $city['city_name'] ?? 'City not found.';

    // Get data from the form and map it to the database fields
    $data = [
        'title' => $this->request->getPost('title'),
        'equipment_type' => $this->request->getPost('equipment_type'),
        'transaction_type' => $this->request->getPost('transaction_type'),
        'brand' => $this->request->getPost('brand'),
        'equipment_condition' => $this->request->getPost('equipment_condition'),
        'warranty' => $this->request->getPost('warranty'),
        'availability' => $this->request->getPost('availability'),
        'serial_number' => $this->request->getPost('serial_number'),
        'price' => $this->request->getPost('price'),
        'manifacture_year' => $this->request->getPost('manifacture_year'),
        'state' => $stateName,
        'city' => $cityName,
        'zipcode' => $this->request->getPost('zipcode'),
        'description' => $this->request->getPost('description'),
        'equipment_image' => $imageNamesString
    ];

    // Save data to the database
    if ($EquipmentModel->save($data)) {
        // Return JSON response on success
        return $this->response->setJSON(['status' => 'success', 'message' => 'Equipment added successfully']);
    } else {
        // Handle database save error
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to add equipment']);
    }
}
    



//***********************view equipment code***********************************

     public function view_all_equipments()
    {
        if(!session()->get('isLoggedIn'))
        return redirect()->to('/');
        $EquipmentModel = new EquipmentModel();

          // Get the search parameter
    $search = $this->request->getVar('search');

    // Apply filters if search parameter is present
    if ($search) {
        $EquipmentModel->like('id', $search)
                       ->orLike('title', $search)
                       ->orLike('serial_number', $search)
                       ->orLike('price', $search)
                       ->orLike('description', $search);
    }
//  pagination
    $data = [
        'equipment' => $EquipmentModel->paginate(3),
        'pager' => $EquipmentModel->pager,
        'search' => $search
    ];
        
       return view('equipments/view_all_equipments', $data);

    }


    //************************view equipment by id*************************************8

    public function view_equipments($id)
    {
        $EquipmentModel = new EquipmentModel();
        $data['viewequipment'] = $EquipmentModel->view_equipment_by_id($id);
    
        // Debug statement
        error_log(print_r($data['viewequipment'], true));
    
        return view('equipments/view_equipments', $data);
    }


   
//*****************************delete equipment*******************************

    public function delete_equipments($id) {
        $result = $this->equipmentModel->equipment_delete($id);
        if ($result) {
            echo json_encode(["status" => "success", "message" => "Equipment deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete equipment record."]);
        }
    }
    
//*****************************update equipment*******************************


   public function update_equipments($id) {
    $editequipments = $this->equipmentModel->get_equipment_by_id($id);
    $city  =  $this->cityModel->getCities();
    $state  =  $this->stateModel->getStates();

    // Prepare data array
    $data = [
        'editequipments' => $editequipments,
        'cities' => $city,
        'states' => $state
    ];

    return view('equipments/update_equipments', $data);
    }




    public function edit_equipments($id) {

        // $StateModel = new StateModel();
        // $CityModel = new CityModel();
    
        // $stateId = $this->request->getPost('state');
        // $cityId = $this->request->getPost('city');
    
        // // Fetch state name
        // $state = $StateModel->where('id', $stateId)->first();
        // $stateName = $state['name'] ?? 'state not found.';
    
        // // Fetch city name
        // $city = $CityModel->select('cities.city as city_name')
        //                   ->join('states', 'cities.state_id = states.id')
        //                   ->where('cities.id', $cityId)
        //                   ->first();
        // $cityName = $city['city_name'] ?? 'City not found.';

        $data = [
            'title' => $this->request->getPost('title'),
            'equipment_type' => $this->request->getPost('equipment_type'),
            'transaction_type' => $this->request->getPost('transaction_type'),
            'brand' => $this->request->getPost('brand'),
            'equipment_condition' => $this->request->getPost('equipment_condition'),
            'warranty' => $this->request->getPost('warranty'),
            'availability' => $this->request->getPost('availability'),
            'serial_number' => $this->request->getPost('serial_number'),
            'price' => $this->request->getPost('price'),
            'manifacture_year' => $this->request->getPost('manifacture_year'),
             'state' => $this->request->getPost('state'),
            'city' => $this->request->getPost('city'),
            'zipcode' => $this->request->getPost('zipcode'),
            'description' => $this->request->getPost('description'),
        ];
    
        // Handle file upload
        $files = $this->request->getFiles();
        if (isset($files['equipment_image'])) {
            $uploadedImages = [];
            foreach ($files['equipment_image'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . '../assets/uploads/equipments/', $newName);
                    // $uploadedImages[] = $newName;
                    $uploadedImages[] = 'http://localhost/mediresaledash/assets/uploads/equipments/' . $newName;
                }
            }
    
            if (!empty($uploadedImages)) {
                // Fetch existing images from the database
                $existingImages = $this->equipmentModel->get_equipment_by_id($id);
                $existingImagesArray = !empty($existingImages->equipment_image) ? explode(',', $existingImages->equipment_image) : [];
                
                // Merge existing and new images
                $allImages = array_merge($existingImagesArray, $uploadedImages);
                $data['equipment_image'] = implode(',', $allImages);
            }
        } else {
            // If no new images, keep existing ones
            $existingImages = $this->equipmentModel->get_equipment_by_id($id);
            $data['equipment_image'] = $existingImages ? $existingImages->equipment_image : '';
        }
    
        $result = $this->equipmentModel->update_equipment_by_id($id, $data);
        if ($result) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Equipment updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error']);
        }
    }
    

//*************delete equipment image in update_equipment form**************************


    public function delete_equipment_image()
    {
        $imageName = $this->request->getPost('image_name');
    
        $equipmentModel = new EquipmentModel();
        $equipment = $equipmentModel->where('equipment_image LIKE', "%$imageName%")->first();
    
        if ($equipment) {
            $images = explode(',', $equipment['equipment_image']);
            $updatedImages = array_diff($images, [$imageName]);
            $newImageString = implode(',', $updatedImages);
    
            $equipmentModel->update($equipment['id'], ['equipment_image' => $newImageString]);
    
            // Correct the path to the image file
            $filePath = FCPATH.'assets/uploads/equipments/' . $imageName;
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    return $this->response->setStatusCode(200)->setBody('success');
                } else {
                    return $this->response->setStatusCode(500)->setBody('file_delete_failed');
                }
            } else {
                return $this->response->setStatusCode(404)->setBody('file_not_found');
            }
        } else {
            return $this->response->setStatusCode(404)->setBody('not_found');
        }
    }

}
