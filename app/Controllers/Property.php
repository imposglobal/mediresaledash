<?php

namespace App\Controllers;
use App\Models\PropertyModel;
use App\Models\CommonModel;
use App\Models\StateModel;
use App\Models\CityModel;

class Property extends BaseController
{
    
    protected $propertyModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
    }


    public function property()
    {
         //  // //when unkonmwn user try to access any url path, then it should redirect to login page i.e without login no one can access any page directly
         if(!session()->get('isLoggedIn'))
            return redirect()->to('/');

        $CommonModel = new CommonModel();
        $states = $CommonModel->selectData("states");
        // echo '<pre>';
        // print_r($states);
        // die();
        $data['states'] = $states;
        
        return view('property/add_property', $data);
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


    public function add_property()
    {
        $PropertyModel = new PropertyModel();
        
         // Handle multiple file uploads
         $images = $this->request->getFiles();
         $validImages = [];
         $imageNames = [];
     
         foreach ($images['property_image'] as $file) {
             if ($file->isValid() && !$file->hasMoved()) {
                 $newName = $file->getRandomName();
                 $file->move(WRITEPATH . '../assets/uploads/property', $newName);
                 $imageNames[] = $newName; // Store the new name of the file
             }
         }
     
         if (!empty($imageNames)) {
             $imageNamesString = implode(',', $imageNames); // Convert array of image names to a comma-separated string
         } else {
             $imageNamesString = null; // No valid images uploaded, set to null
         }


    $StateModel = new StateModel();
    $CityModel = new CityModel();

    $stateId = $this->request->getPost('state');
    $cityId = $this->request->getPost('city');

    // Fetch state name
    $state = $StateModel->where('id', $stateId)->first();
    $stateName = $state['name'] ?? 'state not found.';

    // Fetch city name
    $city = $CityModel->select('cities.city as city_name')
                      ->join('states', 'cities.state_id = states.id')
                      ->where('cities.id', $cityId)
                      ->first();
    $cityName = $city['city_name'] ?? 'City not found.';
         

        // Get data from the form and map it to the database fields
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'property_type' => $this->request->getPost('property_type'),
            'transaction_type' => $this->request->getPost('transaction_type'),
            'state' => $stateName,
            'city' => $cityName,
            'zipcode' => $this->request->getPost('zipcode'),
            'address' => $this->request->getPost('address'),
            'built_year' => $this->request->getPost('built_year'),
            'possession' => $this->request->getPost('possession'),
            'total_area' => $this->request->getPost('total_area'),
            'price' => $this->request->getPost('price'),
            'parking' => $this->request->getPost('parking'),
            'pharmacy' => $this->request->getPost('pharmacy'),
            'laboratory' => $this->request->getPost('parking'),
            'cafeteria' => $this->request->getPost('cafeteria'),
            'property_image' => $imageNamesString
            
        ];
    
        // Save data to the database
        $PropertyModel->save($data);
    
        // Redirect with a success message
       // Return JSON response
    return $this->response->setJSON(['status' => 'success', 'message' => 'Property added successfully']);
    }


// public function view_all_property(): string
// {
//      if(!session()->get('isLoggedIn'))
//          return redirect()->to('/');

         
//     $PropertyModel = new PropertyModel();
//     $data['properties'] =  $PropertyModel->findAll();
//     return view('property/view_all_property', $data);
// }

//*******************view all property*********************************

public function view_all_property()
{
    if(!session()->get('isLoggedIn'))
    return redirect()->to('/');
    $PropertyModel = new PropertyModel();
    
     // Get the search parameter
     $search = $this->request->getVar('search');

     // Apply filters if search parameter is present
     if ($search) {
         $PropertyModel->like('id', $search)
                        ->orLike('name', $search)
                        ->orLike('state', $search)
                        ->orLike('city', $search)
                        ->orLike('zipcode', $search)
                        ->orLike('address', $search)
                        ->orLike('built_year', $search)
                        ->orLike('total_area', $search)
                        ->orLike('price', $search)
                        ->orLike('parking', $search);
     }
 
     $data = [
        'properties' => $PropertyModel->paginate(3),
        'pager' => $PropertyModel->pager,
         'search' => $search
     ];
    
    return view('property/view_all_property', $data);
}

//*******************view property by id*********************************

    public function view_property($id): string
    {
        $PropertyModel = new PropertyModel();
        $data['viewproperty'] = $PropertyModel->view_property_by_id($id);
        return view('property/view_property', $data);
    }

//**********************delete property***********************************

    public function delete_property($id) 
    {
        $PropertyModel = new PropertyModel();
        $result = $PropertyModel->property_delete($id);
        if ($result) 
        {
            echo json_encode(["status" => "success", "message" => "Property deleted successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete property record."]);
        }
    }

    //*******************delete image in update property form**********************

    public function delete_property_image()
   {
    $imageName = $this->request->getPost('image_name');

    $propertyModel = new PropertyModel();
    $property = $propertyModel->where('property_image LIKE', "%$imageName%")->first();

    if ($property) {
        $images = explode(',', $property['property_image']);
        $updatedImages = array_diff($images, [$imageName]);
        $newImageString = implode(',', $updatedImages);

        $propertyModel->update($property['id'], ['property_image' => $newImageString]);

        // Correct the path to the image file
        $filePath = FCPATH . 'assets/uploads/property/' . $imageName;
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




//****************************update propert****************************

public function update_property($id) 
{
    $propertyModel = new PropertyModel();
    $commonModel = new CommonModel();
    
    // Fetch states data
    $states = $commonModel->selectData("states");
    
    // Fetch property data by ID
    $editProperty = $propertyModel->get_property_by_id($id);
    
    // Prepare data array
    $data = [
        'states' => $states,
        'editproperty' => $editProperty
    ];
    
    // Return the view with data
    return view('property/update_property', $data);
}

public function edit_property($id)
    {

        $StateModel = new StateModel();
        $CityModel = new CityModel();
    
        $stateId = $this->request->getPost('state');
        $cityId = $this->request->getPost('city');
    
        // Fetch state name
        $state = $StateModel->where('id', $stateId)->first();
        $stateName = $state['name'] ?? 'state not found.';
    
        // Fetch city name
        $city = $CityModel->select('cities.city as city_name')
                          ->join('states', 'cities.state_id = states.id')
                          ->where('cities.id', $cityId)
                          ->first();
        $cityName = $city['city_name'] ?? 'City not found.';


        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'address' => $this->request->getPost('address'),
            'state' => $stateName,
            'city' => $cityName,
            'address' => $this->request->getPost('address'),
            'built_year' => $this->request->getPost('built_year'),
            'total_area' => $this->request->getPost('total_area'),
            'zipcode' => $this->request->getPost('zipcode'),
            'price' => $this->request->getPost('price'),
            'property_type' => $this->request->getPost('property_type'),
            'transaction_type' => $this->request->getPost('transaction_type'),
            'possession' => $this->request->getPost('possession'),
            'parking' => $this->request->getPost('parking'),
            'pharmacy' => $this->request->getPost('pharmacy'),
            'laboratory' => $this->request->getPost('laboratory'),
            'cafeteria' => $this->request->getPost('cafeteria'),
            'parking' => $this->request->getPost('parking')
        ];
    
        // Handle file upload
        $files = $this->request->getFiles();
        if (isset($files['property_image'])) {
            $uploadedImages = [];
            foreach ($files['property_image'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . '../assets/uploads/property', $newName);
                    $uploadedImages[] = $newName;
                }
            }
    
            if (!empty($uploadedImages)) {
                // Fetch existing images from the database
                $existingImages = $this->propertyModel->get_property_by_id($id);
                $existingImagesArray = !empty($existingImages->property_image) ? explode(',', $existingImages->property_image) : [];
                
                // Merge existing and new images
                $allImages = array_merge($existingImagesArray, $uploadedImages);
                $data['property_image'] = implode(',', $allImages);
            }
        } else {
            // If no new images, keep existing ones
            $existingImages = $this->propertyModel->get_property_by_id($id);
            $data['property_image'] = $existingImages ? $existingImages->property_image : '';
        }
    
        $result = $this->propertyModel->update_property_by_id($id, $data);
        if ($result) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Property updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error updating property']);
        }
    }
    
}
