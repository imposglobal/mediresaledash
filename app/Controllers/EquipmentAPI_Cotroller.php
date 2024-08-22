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



//**************************code for multiple filter together*********************************


// public function getEquipmentByFiltersHome()
// {
//     $equipmentModel = new EquipmentModel();
//     $equipmentType = 'imaging-equipment'; 
//     $cityOrZipcode = 'Gandhinagar'; 


//     $builder = $equipmentModel->builder();

//     if (!empty($cityOrZipcode)) {
//         if (is_numeric($cityOrZipcode)) {
//             $builder->where('zipcode', $cityOrZipcode);
//         } else {
//             $builder->where('city', $cityOrZipcode);
//         }
//     }

//     if (!empty($equipmentType)) {
//         $builder->where('equipment_type', $equipmentType);
//     }

//     $query = $builder->get();
//     $equipments = $query->getResultArray();

//     if (empty($equipments)) {
//         return $this->response->setJSON([
//             'message' => 'No equipment found for the provided filters.'
//         ])->setStatusCode(404);
//     }

//     return $this->response->setJSON([
//         'status' => 'success',
//         'data' => $equipments
//     ]);
// }


//**************************code for multiple filter in equipment listing page*********************************


// public function getEquipmentsByFilter()
// {
//     $equipmentModel = new EquipmentModel();   
    
//     // Get filter parameters from the request

//     $equipment_type = $this->request->getVar('equipment_type');
//     $transaction_type = $this->request->getVar('transaction_type');
//     $CityOrZipcode = $this->request->getVar('CityOrZipcode');
//     $startprice = $this->request->getVar('start_price');
//     $endprice = $this->request->getVar('end_price');
//     $brand = $this->request->getVar('brand');
//     $condition = $this->request->getVar('condition');
//     $warranty = $this->request->getVar('warranty');
//     $availability = $this->request->getVar('availability');
//     $ageofequipment = $this->request->getVar('ageofequipment');

//     // $transaction_type = "rent";
//     // $startprice  = 400;
//     // $endprice  = 1700;

//      // Get the current year
//      $currentYear = date('Y');

//     // Start building the query
//     $builder = $equipmentModel->builder();

//     if (!empty($equipment_type)) {
//         if (is_array($equipment_type)) {
//             $builder->whereIn('equipment_type', $equipment_type);
//         } else {
//             $builder->where('equipment_type', $equipment_type);
//         }
//     }

//     if (!empty($CityOrZipcode)) {
//         if (is_numeric($CityOrZipcode)) {
//             $builder->where('zipcode', $CityOrZipcode);
//         } else {
//             $builder->where('city', $CityOrZipcode);
//         }
//     }


//     if (!empty($brand)) {
//         if (is_array($brand)) {
//             $builder->whereIn('brand', $brand);
//         } else {
//             $builder->where('brand', $brand);
//         }
//     }

//     if (!empty($condition)) {
//         if (is_array($condition)) {
//             $builder->whereIn('equipment_condition', $condition);
//         } else {
//             $builder->where('equipment_condition', $condition);
//         }
//     }

//     if (!empty($warranty)) {
//         if (is_array($warranty)) {
//             $builder->whereIn('warranty', $warranty);
//         } else {
//             $builder->where('warranty', $warranty);
//         }
//     }


//     if (!empty($availability)) {
//         if (is_array($availability)) {
//             $builder->whereIn('availability', $availability);
//         } else {
//             $builder->where('availability', $availability);
//         }
//     }

//     if (!empty($ageofequipment)) {
//         switch ($ageofequipment) {
//             case 'less-than-1-year':
//                 $year = $currentYear;
//                 $builder->where('manifacture_year', $year);
//                 break;
//             case 'less-than-2-years':
//                 $year = $currentYear - 1;
//                 $builder->where('manifacture_year >=', $year);
//                 break;
//             case 'less-than-5-years':
//                 $year = $currentYear - 4;
//                 $builder->where('manifacture_year >=', $year);
//                 break;
//             case 'more-than-5-years':
//                 $year = $currentYear - 5;
//                 $builder->where('manifacture_year <', $year);
//                 break;
//             default:
//                 break;
//         }
//     }

//     if (!empty($transaction_type)) {
//         if ($transaction_type === 'buy') {

//             if (!empty($startprice) && !empty($endprice)) {      // this will chek the price range filter for 'buy'
//                 $builder->where('transaction_type', 'buy')
//                         ->where('price >=', $startprice)
//                         ->where('price <=', $endprice);
//             }
//         } elseif ($transaction_type === 'rent') {
            
//             if (!empty($startprice) && !empty($endprice)) { // this will chek the price range filter for 'buy'
//                 $builder->where('transaction_type', 'rent')
//                         ->where('price >=', $startprice)
//                         ->where('price <=', $endprice);
//             }
//         }
//     }
    
    

//     // Get the results
//     $filteredEquipments = $builder->get()->getResultArray();


//      // Prepare the response
//      if (!empty($filteredEquipments)) {
//         $response = [
//             'status' => 'success',
//             'data' => $filteredEquipments
//         ];
//     } else {
//         $response = [
//             'status' => 'error',
//             'message' => 'No properties found.'
//         ];
//     }

//     // Return the results as JSON
//     return $this->response->setJSON($response);
// }



/********************************test api ****************************/
public function getEquipmentsByFilter()
{
    $equipmentModel = new EquipmentModel();   

    // Get filter parameters from the request
     $equipment_type = $this->request->getVar('equipment_type');
    //$equipment_type = 'Diagnostic Equipment';

    $transaction_type = $this->request->getVar('transaction_type');
    $CityOrZipcode = $this->request->getVar('CityOrZipcode');
    $startprice = $this->request->getVar('start_price');
    $endprice = $this->request->getVar('end_price');
    $brand = $this->request->getVar('brand');
    $condition = $this->request->getVar('condition');
    $warranty = $this->request->getVar('warranty');
    $availability = $this->request->getVar('availability');
    $ageofequipment = $this->request->getVar('ageofequipment');
    //$ageofequipment = 'less-than-1-year';

    
    $page = $this->request->getVar('page') ?? 1; // Default to page 1 if not provided
    $perPage = $this->request->getVar('per_page') ?? 20; // Default to 5 items per page if not provided

    // Validate pagination parameters
    $page = (int)$page > 0 ? (int)$page : 1;
    $perPage = (int)$perPage > 0 ? (int)$perPage : 20;

    // Calculate offset
    $offset = ($page - 1) * $perPage;

    // Get the current year
    $currentYear = date('Y');

    // Start building the query
    $builder = $equipmentModel->builder();

    // Apply filters 
    if (!empty($equipment_type)) {
        $builder->whereIn('equipment_type', is_array($equipment_type) ? $equipment_type : [$equipment_type]);
    }

    if (!empty($CityOrZipcode)) {
        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }
    }

    if (!empty($brand)) {
        $builder->whereIn('brand', is_array($brand) ? $brand : [$brand]);
    }

    if (!empty($condition)) {
        $builder->whereIn('equipment_condition', is_array($condition) ? $condition : [$condition]);
    }

    if (!empty($warranty)) {
        $builder->whereIn('warranty', is_array($warranty) ? $warranty : [$warranty]);
    }

    if (!empty($availability)) {
        $builder->whereIn('availability', is_array($availability) ? $availability : [$availability]);
    }

    if (!empty($ageofequipment)) {
        switch ($ageofequipment) {
            case 'less than 1 year':
                $builder->where('manifacture_year', $currentYear);
                break;
            case 'less than 2 years':
                $builder->where('manifacture_year >=', $currentYear - 1);
                break;
            case 'less than 5 years':
                $builder->where('manifacture_year >=', $currentYear - 4);
                break;
            case 'more than 5 years':
                $builder->where('manifacture_year <', $currentYear - 5);
                break;
        }
    }

    if (!empty($transaction_type) && in_array($transaction_type, ['buy', 'rent'])) {
        $builder->where('transaction_type', $transaction_type);
        if (!empty($startprice) && !empty($endprice)) {
            $builder->where('price >=', $startprice)
                    ->where('price <=', $endprice);
        }
    }

    // Apply pagination
    $builder->limit($perPage, $offset);

    // Get the results
    try {
        $filteredEquipments = $builder->get()->getResultArray();
        
        // Get total count of items matching the filters
        $totalItems = $builder->countAllResults(false); // Pass false to avoid applying the limit to the count query
    } catch (\Exception $e) {
        // Log the error and return a server error response
        log_message('error', 'Error fetching equipment: ' . $e->getMessage());
        return $this->response->setStatusCode(500)->setJSON([
            'status' => 'error',
            'message' => 'Internal server error.'
        ]);
    }

    // Prepare the response with pagination metadata
    $totalPages = ceil($totalItems / $perPage);

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
    
    return $this->response->setStatusCode(200)->setJSON($response);
}


}
