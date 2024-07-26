<?php

namespace App\Controllers;
use App\Models\EquipmentModel;



class Equipment extends BaseController
{

    protected $equipmentModel;

    public function __construct()
    {
        $this->equipmentModel = new EquipmentModel();
    }


   

    public function equipments()
    {

        
        //  // //when unkonmwn user try to access any url path, then it should redirect to login page i.e without login no one can access any page directly
          if(!session()->get('isLoggedIn'))
            return redirect()->to('/');

        return view('equipments/add_equipments');
    }


    

    public function add_equipments()
    {
        $EquipmentModel = new EquipmentModel();
        
        // Handle multiple file uploads
        $images = $this->request->getFiles();
        $validImages = [];
        $imageNames = [];
    
        foreach ($images['equipment_image'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . '../assets/uploads/equipments/', $newName);
                $imageNames[] = $newName; // Store the new name of the file
            }
        }
    
        if (!empty($imageNames)) {
            $imageNamesString = implode(',', $imageNames); // Convert array of image names to a comma-separated string
        } else {
            $imageNamesString = null; // No valid images uploaded, set to null
        }
    
        // Get data from the form and map it to the database fields
        $data = [
            'title' => $this->request->getPost('title'),
            'serial_number' => $this->request->getPost('serial_number'),
            'price' => $this->request->getPost('price'),
            'manifacture_year' => $this->request->getPost('manifacture_year'),
            'description' => $this->request->getPost('description'),
            'equipment_image' => $imageNamesString
        ];
    
        // Save data to the database
        $EquipmentModel->save($data);
    
        // Redirect with a success message
       // Return JSON response
    return $this->response->setJSON(['status' => 'success', 'message' => 'Equipment added successfully']);
    }
    

    // public function view_all_equipments()
    // {
        
    //      // //when unkonmwn user try to access any url path, then it should redirect to login page i.e without login no one can access any page directly
    //      if(!session()->get('isLoggedIn'))
    //         return redirect()->to('/');
    //     $EquipmentModel = new EquipmentModel();
    //     $data['equipment'] =  $EquipmentModel->findAll();
    //     return view('equipments/view_all_equipments', $data);
    // }


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

    $data = [
        'equipment' => $EquipmentModel->paginate(3),
        'pager' => $EquipmentModel->pager,
        'search' => $search
    ];
        
       return view('equipments/view_all_equipments', $data);

    }


    public function view_equipments($id)
    {
        $EquipmentModel = new EquipmentModel();
        $data['viewequipment'] = $EquipmentModel->view_equipment_by_id($id);
    
        // Debug statement
        error_log(print_r($data['viewequipment'], true));
    
        return view('equipments/view_equipments', $data);
    }


   


    public function delete_equipments($id) {
        $result = $this->equipmentModel->equipment_delete($id);
        if ($result) {
            echo json_encode(["status" => "success", "message" => "Equipment deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete equipment record."]);
        }
    }
    

    public function update_equipments($id) {
        $data['editequipments'] = $this->equipmentModel->get_equipment_by_id($id);
        
        return view('equipments/update_equipments', $data);
    }



    public function edit_equipments($id) {
        $data = [
            'title' => $this->request->getPost('title'),
            'serial_number' => $this->request->getPost('serial_number'),
            'price' => $this->request->getPost('price'),
            'manifacture_year' => $this->request->getPost('manifacture_year'),
            'description' => $this->request->getPost('description')
        ];
    
        // Handle file upload
        $files = $this->request->getFiles();
        if (isset($files['equipment_image'])) {
            $uploadedImages = [];
            foreach ($files['equipment_image'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . '../assets/uploads/equipments/', $newName);
                    $uploadedImages[] = $newName;
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
            $filePath = FCPATH . 'assets/uploads/equipments/' . $imageName;
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
