<?php

namespace App\Controllers;
use App\Models\EquipmentModel;



class EquipmentAPI_Cotroller extends BaseController
{


    /************************************** GET API function ***************************** */

    public function equipment_api()
    {
        $equipmentModel = new EquipmentModel();
        $equipments = $equipmentModel->findAll();
        
        return $this->response->setJSON($equipments);
    }


    public function get_Title_Image_Equipment_Api() // Api to get only title and image
{
    $equipmentModel = new EquipmentModel();
    
    $equipments = $equipmentModel->select('title, equipment_image')->findAll();
    
    return $this->response->setJSON($equipments);
}




    /*************** function to get equipment by equipment Type  **********************/

    public function getEquipmentByEquipmentType_API()
    {
        $equipmentModel = new EquipmentModel();

        $equipmentType = 'imaging-equipment'; 

        $equipment =  $equipmentModel->where('equipment_type', $equipmentType)
                                    ->findAll();

        return $this->response->setJSON($equipment);
    }

    /*************** function to get equipment by Brand  **********************/

    public function getEquipmentByBrand_API()
    {
        $equipmentModel = new EquipmentModel();

        $brand = 'Olympus'; 

        $getbrand = $equipmentModel->where('brand', $brand)
                                    ->findAll();

        return $this->response->setJSON($getbrand);
    }


     /*************** function to get equipment by Condition  **********************/

     public function getEquipmentByCondition_API()
     {
         $equipmentModel = new EquipmentModel();
 
         $condition = 'new'; 
 
         $getcondition = $equipmentModel->where('equipment_condition', $condition)
                                     ->findAll();
 
         return $this->response->setJSON($getcondition);
     }

      /*************** function to get equipment by warranty  **********************/

      public function getEquipmentByWarranty_API()
      {
          $equipmentModel = new EquipmentModel();
  
          $warranty = 'under-warranty'; 
  
          $getwarranty = $equipmentModel->where('warranty', $warranty)
                                      ->findAll();
  
          return $this->response->setJSON($getwarranty);
      }

       /*************** function to get equipment by Availability  **********************/

       public function getEquipmentByAvailability_API()
       {
           $equipmentModel = new EquipmentModel();
   
           $availability = 'out-of-stock'; 
   
           $getavailability = $equipmentModel->where('availability', $availability)
                                       ->findAll();
   
           return $this->response->setJSON($getavailability);
       }


/*************** function to get Age Of Equipmnet  **********************/

public function getEquipmentByAge_API()
{
    $equipmentModel = new EquipmentModel();

    // Static value for testing
    $filter = 'less-than-1-year';

    // Get the current year
    $currentYear = date('Y');

    switch ($filter) 
    {
        case 'less-than-1-year':
            $year = $currentYear;
            $condition = "manifacture_year = $year";
            break;
        case 'less-than-2-years':
            $year = $currentYear - 1;
            $condition = "manifacture_year >= $year";
            break;
        case 'less-than-5-years':
            $year = $currentYear - 4;
            $condition = "manifacture_year >= $year";
            break;
        case 'more-than-5-years':
            $year = $currentYear - 4;
            $condition = "manifacture_year < $year";
            break;
        default:
            $condition = "1 = 1"; // This will select all records
            break;
    }

    // Apply the condition to the query
    $geteyear = $equipmentModel->where($condition)->findAll();

    return $this->response->setJSON($geteyear);
}


/*************** function to get price  **********************/

public function getEquipmentByPrice_API()
{
    $equipmentModel = new EquipmentModel();

    $startprice = "600";
    $endprice = "3000";

    // Apply the condition to the query
    $getprice = $equipmentModel->where("price BETWEEN $startprice AND $endprice")
                               ->findAll();

    return $this->response->setJSON($getprice);
}


/************** function to get property by city name or zipcode  *********************/  

public function getEquipmentByCityOrZipcode()
    {
        $equipmentModel = new EquipmentModel();

        $CityOrZipcode = 'Amrawati';

        $builder = $equipmentModel->builder();

        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }

        $query = $builder->get();
        $equipments = $query->getResultArray();

        if (empty($equipments)) {
            return $this->response->setJSON([
                
                'message' => 'No properties found for the provided city or zipcode.'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' =>  $equipments
        ]);
    }

// Working API

//**************************code for multiple filter in Home Page*********************************

public function getEquipmentByFiltersHome()
{
    $equipmentModel = new EquipmentModel();

    // $equipmentType = $this->request->getVar('Diagnostic Equipment');
    // $cityOrZipcode = $this->request->getVar('Adilabad');
    // $transactionType = $this->request->getVar('buy');

    $equipmentType = 'Diagnostic Equipment'; 
    $cityOrZipcode = 'Adilabad'; 
    $transactionType = 'buy'; // or 'rent'

    $builder = $equipmentModel->builder();

    if (!empty($cityOrZipcode)) {
        if (is_numeric($cityOrZipcode)) {
            $builder->where('zipcode', $cityOrZipcode);
        } else {
            $builder->where('city', $cityOrZipcode);
        }
    }

    if (!empty($equipmentType)) {
        $builder->where('equipment_type', $equipmentType);
    }

    if (!empty($transactionType)) {
        $builder->where('transaction_type', $transactionType);
    }

    $query = $builder->get();
    $equipments = $query->getResultArray();

    if (empty($equipments))
    {
        return $this->response->setJSON([
            'message' => 'No equipment found for the provided filters.'
        ])->setStatusCode(404);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $equipments
    ]);
}



//**************************code for multiple filter in equipment listing page*********************************

public function getEquipmentsByFilter()
{
    $equipmentModel = new EquipmentModel();   
    
    // Get filter parameters from the request
    $equipment_type = $this->request->getVar('equipment_type');
    $transaction_types = $this->request->getVar('transaction_type');
    $CityOrZipcode = $this->request->getVar('CityOrZipcode');
    $startprice = $this->request->getVar('start_price');
    $endprice = $this->request->getVar('end_price');
    $start_rent_price = $this->request->getVar('start_rent_price');
    $end_rent_price = $this->request->getVar('end_rent_price');
    $brand = $this->request->getVar('brand');
    $condition = $this->request->getVar('condition');
    $warranty = $this->request->getVar('warranty');
    $availability = $this->request->getVar('availability');
    $ageofequipment = $this->request->getVar('ageofequipment');

    // Pagination parameters
    $page = (int)($this->request->getVar('page') ?? 1);
    $perPage = (int)($this->request->getVar('per_page') ?? 20);
    $offset = ($page - 1) * $perPage;

    // Get the current year
    $currentYear = date('Y');

    // Build the query for filtering
    $builder = $equipmentModel->builder();

    if (!empty($equipment_type)) {
        if (is_array($equipment_type)) {
            $builder->whereIn('equipment_type', $equipment_type);
        } else {
            $builder->where('equipment_type', $equipment_type);
        }
    }

    if (!empty($CityOrZipcode)) {
        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }
    }

    if (!empty($brand)) {
        if (is_array($brand)) {
            $builder->whereIn('brand', $brand);
        } else {
            $builder->where('brand', $brand);
        }
    }

    if (!empty($condition)) {
        if (is_array($condition)) {
            $builder->whereIn('equipment_condition', $condition);
        } else {
            $builder->where('equipment_condition', $condition);
        }
    }

    if (!empty($warranty)) {
        if (is_array($warranty)) {
            $builder->whereIn('warranty', $warranty);
        } else {
            $builder->where('warranty', $warranty);
        }
    }

    if (!empty($availability)) {
        if (is_array($availability)) {
            $builder->whereIn('availability', $availability);
        } else {
            $builder->where('availability', $availability);
        }
    }

    // Handling age of equipment filtering
    if (!empty($ageofequipment) && is_array($ageofequipment)) {
        $builder->groupStart(); // Start a group for OR conditions

        foreach ($ageofequipment as $age) {
            switch ($age) {
                case 'less than 1 year':
                    $year = $currentYear;
                    $builder->orGroupStart()
                            ->where('manifacture_year', $year)
                            ->groupEnd();
                    break;
                case 'less than 2 year':
                    $year = $currentYear - 1;
                    $builder->orGroupStart()
                            ->where('manifacture_year >=', $year)
                            ->groupEnd();
                    break;
                case 'less than 5 year':
                    $year = $currentYear - 4;
                    $builder->orGroupStart()
                            ->where('manifacture_year >=', $year)
                            ->groupEnd();
                    break;
                case 'more than 5 years':
                    $year = $currentYear - 5;
                    $builder->orGroupStart()
                            ->where('manifacture_year <', $year)
                            ->groupEnd();
                    break;
                default:
                    break;
            }
        }

        $builder->groupEnd(); // End the group for OR conditions
    }

    // Handling transaction type filtering
    if (!empty($transaction_types)) {
        $builder->groupStart(); // Start a group for OR conditions

        if (in_array('Buy', $transaction_types)) {
            if (!empty($startprice) && !empty($endprice)) {
                // Filter by price if both start and end prices are provided
                $builder->orGroupStart()
                        ->where('transaction_type', 'Buy')
                        ->where('price >=', $startprice)
                        ->where('price <=', $endprice)
                        ->groupEnd();
            } else {
                // Filter by transaction type only if price fields are not provided
                $builder->orWhere('transaction_type', 'Buy');
            }
        }

        if (in_array('Rent', $transaction_types)) {
            if (!empty($start_rent_price) && !empty($end_rent_price)) {
                // Filter by rent price if both start and end rent prices are provided
                $builder->orGroupStart()
                        ->where('transaction_type', 'Rent')
                        ->where('price >=', $start_rent_price)
                        ->where('price <=', $end_rent_price)
                        ->groupEnd();
            } else {
                // Filter by transaction type only if price fields are not provided
                $builder->orWhere('transaction_type', 'Rent');
            }
        }

        $builder->groupEnd(); // End the group for OR conditions
    }

    // Clone the builder to get the total count of filtered items
    $countBuilder = clone $builder;
    $totalItems = $countBuilder->countAllResults(false);

    // Apply pagination
    $builder->limit($perPage, $offset);

    // Get the filtered results
    $filteredEquipments = $builder->get()->getResultArray();

    // Calculate total pages
    $totalPages = ceil($totalItems / $perPage);

    // Prepare the response with pagination metadata
    $response = [
        'status' => 'success',
        'data' => $filteredEquipments,
        'pagination' => [
            'total_items' => $totalItems,
            'total_pages' => $totalPages,
            'current_page' => $page,
            'per_page' => $perPage
        ]
    ];

    // Return the results as JSON
    return $this->response->setJSON($response);
}



/***************Api function to get property_type and address only **********/

// public function getEquipment_types_and_Condition_Price_API()
// {
//     $equipmentModel = new EquipmentModel();
//     $equipment = $equipmentModel->select('equipment_type, equipment_condition,price,equipment_image,')
//                               ->orderBy('eid', 'DESC')
//                               ->findAll();
    
//     return $this->response->setJSON($equipment);
// }
 
public function getEquipment_types_and_Condition_Price_API()
{
    $equipmentModel = new EquipmentModel();
    $equipments = $equipmentModel->select('eid,equipment_type, equipment_condition, price, equipment_image')
                                 ->orderBy('eid', 'DESC')
                                 ->findAll();
    
    
    foreach ($equipments as &$equipment) {
        if (!empty($equipment['equipment_image'])) {
            $images = explode(',', $equipment['equipment_image']);
            $equipment['equipment_image'] = $images[0]; // Get the first image
        } else {
            $equipment['equipment_image'] = null; // Handle the case where there are no images
        }
    }

    return $this->response->setJSON($equipments);
}


}
