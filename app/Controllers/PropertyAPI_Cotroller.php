<?php

namespace App\Controllers;
use App\Models\PropertyModel;
use CodeIgniter\API\ResponseTrait; 



class PropertyAPI_Cotroller extends BaseController
{

    use ResponseTrait; // Use the ResponseTrait

/***************** function to get all property table data API ***************************** */

    public function AllPropertyItems_API()
    {
        $PropertyModel = new PropertyModel();
        $property = $PropertyModel->findAll();
        
        return $this->response->setJSON($property);
    }


    public function get_Title_Image_Property_Api() // Api to get only title and image
    {
        $PropertyModel = new PropertyModel();
        
        $property = $PropertyModel->select('name, property_image')->findAll();
        
        return $this->response->setJSON($property);
    }

/*************** function To get API by price range  **********************/
public function GetPropertiesByPriceRange_API()
    {
        $propertyModel = new PropertyModel();

        $minPrice = 2000;  
        $maxPrice = 9000;  

        $properties = $propertyModel->where('price >=', $minPrice)
                                    ->where('price <=', $maxPrice)
                                    ->findAll();
        
        return $this->response->setJSON($properties);
    }

/*************** function to get property by built year  **********************/

    public function getPropertiesByBuiltYear_API()
    {
        $propertyModel = new PropertyModel();

        $sortOrder = $this->request->getPost('order') ?? 'newest'; // get the input from user newest and oldest

        $orderBy = $sortOrder === 'oldest' ? 'ASC' : 'DESC';

        $properties = $propertyModel->orderBy('built_year', $orderBy)
                                    ->findAll();

        return $this->response->setJSON($properties);
    }


/*************** function to get property by Property Type  **********************/

    public function getPropertiesByPropertyType_API()
    {
        $propertyModel = new PropertyModel();

        $propertyType ='hospitals'; 

        $properties = $propertyModel->where('property_type', $propertyType)
                                    ->findAll();

        return $this->response->setJSON($properties);
    }


/*************** function to get property by Transaction Type  **********************/

    public function getPropertiesByTransactionType_API()
    {
        $propertyModel = new PropertyModel();

        $TransactionType ='Rent'; 

        $properties = $propertyModel->where('transaction_type', $TransactionType)
                                    ->findAll();

        return $this->response->setJSON($properties);
    }

/*************** function to get property by city name or zipcode  **********************/  

public function getPropertiesByCityOrZipcode()
{
    $propertyModel = new PropertyModel();

    // Get the city or zipcode from the request 
    $CityOrZipcode = $this->request->getVar('CityOrZipcode');

    if (empty($CityOrZipcode)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'City or Zipcode is required.'
        ])->setStatusCode(400);
    }

    $builder = $propertyModel->builder();

    if (is_numeric($CityOrZipcode)) {
        $builder->where('zipcode', $CityOrZipcode);
    } else {
        $builder->where('city', $CityOrZipcode);
    }

    $query = $builder->get();
    $properties = $query->getResultArray();

    if (empty($properties)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No properties found for the provided city or zipcode.'
        ])->setStatusCode(404);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $properties
    ]);
}


/*************** function to get property by Amenities  **********************/  

    public function getPropertiesByAmenities()
    {
        $propertyModel = new PropertyModel();

        $amenity = 'parking'; 

        $builder = $propertyModel->builder();

        switch ($amenity) {
            case 'parking':
                $builder->where('parking', 'available');
                break;
            case 'on_site_pharmacy':
                $builder->where('on_site_pharmacy', 'available');
                break;
            case 'laboratory':
                $builder->where('laboratory', 'available');
                break;
            case 'cafeteria':
                $builder->where('cafeteria', 'available');
                break;
            default:
                $builder->where('1=0'); // This will result in an empty set
                break;
        }

        $query = $builder->get();
        $properties = $query->getResultArray();

        return $this->response->setJSON($properties);
    }


    /*************** function to get property by Age of Property  **********************/  

    public function getEquipmentByAgeOfProperty_API()
    {
        $propertyModel = new PropertyModel();
    
        // Static value for testing
        $filter = 'less-than-1-year';
    
        // Get the current year
        $currentYear = date('Y');
    
        switch ($filter) 
        {
            case 'less-than-1-year':
                $year = $currentYear;
                $condition = "built_year = $year";
                break;
            case 'less-than-2-years':
                $year = $currentYear - 1;
                $condition = "built_year >= $year";
                break;
            case 'less-than-5-years':
                $year = $currentYear - 4;
                $condition = "built_year >= $year";
                break;
            case 'more-than-5-years':
                $year = $currentYear - 4;
                $condition = "built_year < $year";
                break;
            default:
                $condition = "1 = 1"; // This will select all records
                break;
        }
    
        $geteyear = $propertyModel->where($condition)->findAll();
    
        return $this->response->setJSON($geteyear);
    }


    /*************** function to get property by Monthly Rent  **********************/  

    public function getEquipmentByMonthlyRent_API()
    {
        $propertyModel = new PropertyModel();

        $startprice = "600";
        $endprice = "4000";

        $getprice = $propertyModel->where("price BETWEEN $startprice AND $endprice AND transaction_type ='rent'")
                                ->findAll();

        return $this->response->setJSON($getprice);
    }

    /*************** function to get property by Monthly Rent  **********************/  

    public function getEquipmentByMonthlyBuy_API()
    {
        $propertyModel = new PropertyModel();

        $startprice = "600";
        $endprice = "4000";

        $getprice = $propertyModel->where("price BETWEEN $startprice AND $endprice AND transaction_type ='buy'")
                                ->findAll();

        return $this->response->setJSON($getprice);
    }

   /*************** function to get property by Possesion **********************/  

    public function getPropertiesByPossesion_API()
    {
        $propertyModel = new PropertyModel();

        $possesion ='Ready to move'; 

        $properties = $propertyModel->where('possession', $possesion)
                                    ->findAll();

        return $this->response->setJSON($properties);
    }

    //**************************code for multiple filter together*********************************

//     public function getpropertybyFilter()
//    {
//     $propertyModel = new PropertyModel();

//     // Get filter parameters from the request
//     $property_type = $this->request->getVar('property_type');
//     $transaction_type = $this->request->getVar('transaction_type');
//     $possession = $this->request->getVar('possession');

  
//     // Start building the query
//     $query = $propertyModel;

//     // Apply filters dynamically
//     if (!empty($property_type)) {
//         $query = $query->where('property_type', $property_type);
//     }

//     if (!empty($transaction_type)) {
//         $query = $query->where('transaction_type', $transaction_type);
//     }

//     if (!empty($possession)) {
//         $query = $query->where('possession', $possession);
//     }
    
//     // Get the results
//     $filteredProperty = $query->findAll();

//     // Prepare the response
//     if (!empty($filteredProperty)) {
//         $response = [
//             'status' => 'success',
//             'data' => $filteredProperty
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


// public function getpropertybyFilter()
// {
//     $propertyModel = new PropertyModel();

//     // Get filter parameters from the request
//     $property_type = $this->request->getVar('property_type');
//     $transaction_type = $this->request->getVar('transaction_type');
//     $possession = $this->request->getVar('possession');
//     $CityOrZipcode = $this->request->getVar('CityOrZipcode');

//     // Start building the query
//     $builder = $propertyModel->builder();

//     // Apply filters dynamically
//     if (!empty($property_type)) {
//         $builder->where('property_type', $property_type);
//     }

//     if (!empty($transaction_type)) {
//         $builder->where('transaction_type', $transaction_type);
//     }

//     if (!empty($possession)) {
//         $builder->where('possession', $possession);
//     }

//     // Apply city or zipcode filter if provided
//     if (!empty($CityOrZipcode)) {
//         if (is_numeric($CityOrZipcode)) {
//             $builder->where('zipcode', $CityOrZipcode);
//         } else {
//             $builder->where('city', $CityOrZipcode);
//         }
//     }
    
//     // Get the results
//     $filteredProperty = $builder->get()->getResultArray();

//     // Prepare the response
//     if (!empty($filteredProperty)) {
//         $response = [
//             'status' => 'success',
//             'data' => $filteredProperty
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


<<<<<<< HEAD


// multiple filter API
=======
// public function getpropertybyFilter()
// {
//     $propertyModel = new PropertyModel();

//     // Get filter parameters from the request
//     // $property_types = $this->request->getVar('property_type');
//     // $transaction_type = $this->request->getVar('transaction_type');
//     // $possession = $this->request->getVar('possession');
//     // $CityOrZipcode = $this->request->getVar('CityOrZipcode');
//     // $ageofproperty = $this->request->getVar('ageofproperty');
//     // $startprice = $this->request->getVar('start_price');
//     // $endprice = $this->request->getVar('end_price');
//     // $amenities = $this->request->getVar('amenities'); // Changed to allow multiple amenities
//     $transaction_type = "rent";

//     // Get the current year
//     $currentYear = date('Y');

//     // Start building the query
//     $builder = $propertyModel->builder();

//     if (!empty($property_types)) {
//         if (is_array($property_types)) {
//             $builder->whereIn('property_type', $property_types);
//         } else {
//             $builder->where('property_type', $property_types);
//         }
//     }

//     if (!empty($transaction_type)) {
//         if (is_array($transaction_type)) {
//             $builder->whereIn('transaction_type', $transaction_type);
//         } else {
//             $builder->where('transaction_type', $transaction_type);
//         }
//     }

//     if (!empty($possession)) {
//         $builder->where('possession', $possession);
//     }

//     if (!empty($CityOrZipcode)) {
//         if (is_numeric($CityOrZipcode)) {
//             $builder->where('zipcode', $CityOrZipcode);
//         } else {
//             $builder->where('city', $CityOrZipcode);
//         }
//     }

//     if (!empty($ageofproperty)) {
//         switch ($ageofproperty) {
//             case 'less-than-1-year':
//                 $year = $currentYear;
//                 $builder->where('built_year', $year);
//                 break;
//             case 'less-than-2-years':
//                 $year = $currentYear - 1;
//                 $builder->where('built_year >=', $year);
//                 break;
//             case 'less-than-5-years':
//                 $year = $currentYear - 4;
//                 $builder->where('built_year >=', $year);
//                 break;
//             case 'more-than-5-years':
//                 $year = $currentYear - 5;
//                 $builder->where('built_year <', $year);
//                 break;
//             default:
//                 break;
//         }
//     }

//     if (!empty($startprice) && !empty($endprice)) {
//         $builder->where('price >=', $startprice);
//         $builder->where('price <=', $endprice);
//     }

//     if (!empty($amenities)) {
//         // Ensure $amenities is an array
//         if (is_array($amenities)) {
//             foreach ($amenities as $amenity) {
//                 switch ($amenity) {
//                     case 'parking':
//                         $builder->where('parking', 'available');
//                         break;
//                     case 'on_site_pharmacy':
//                         $builder->where('on_site_pharmacy', 'available');
//                         break;
//                     case 'laboratory':
//                         $builder->where('laboratory', 'available');
//                         break;
//                     case 'cafeteria':
//                         $builder->where('cafeteria', 'available');
//                         break;
//                     default:
//                         // Ignore unknown amenities
//                         break;
//                 }
//             }
//         } else {
//             // If $amenities is not an array, handle it (e.g., error or default behavior)
//             $builder->where('1=0'); // This will result in an empty set
//         }
//     }

//     // Get the results
//     $filteredProperty = $builder->get()->getResultArray();

//     // Prepare the response
//     if (!empty($filteredProperty)) {
//         $response = [
//             'status' => 'success',
//             'data' => $filteredProperty
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


/********************** testt **********************/
>>>>>>> origin/krushna


public function getpropertybyFilter()
{
    $propertyModel = new PropertyModel();

    //Get filter parameters from the request
    // $property_types = $this->request->getVar('property_type');
    // $transaction_type = $this->request->getVar('transaction_type');
    // $possession = $this->request->getVar('possession');
    // $CityOrZipcode = $this->request->getVar('CityOrZipcode');
    // $ageofproperty = $this->request->getVar('ageofproperty');
    // $startprice = $this->request->getVar('start_price');
    // $endprice = $this->request->getVar('end_price');
    // $amenities = $this->request->getVar('amenities'); // Changed to allow multiple amenities

    $transaction_type = "rent";
    $startprice  = 400;
    $endprice  = 1700;

    // Get the current year
    $currentYear = date('Y');

    // Start building the query
    $builder = $propertyModel->builder();

    if (!empty($property_types)) {
        if (is_array($property_types)) {
            $builder->whereIn('property_type', $property_types);
        } else {
            $builder->where('property_type', $property_types);
        }
    }


    if (!empty($possession)) {
        $builder->where('possession', $possession);
    }

    if (!empty($CityOrZipcode)) {
        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }
    }

    if (!empty($ageofproperty)) {
        switch ($ageofproperty) {
            case 'less-than-1-year':
                $year = $currentYear;
                $builder->where('built_year', $year);
                break;
            case 'less-than-2-years':
                $year = $currentYear - 1;
                $builder->where('built_year >=', $year);
                break;
            case 'less-than-5-years':
                $year = $currentYear - 4;
                $builder->where('built_year >=', $year);
                break;
            case 'more-than-5-years':
                $year = $currentYear - 5;
                $builder->where('built_year <', $year);
                break;
            default:
                break;
        }
    }

       if (!empty($transaction_type)) {
        if ($transaction_type === 'buy') {

            if (!empty($startprice) && !empty($endprice)) {      // this will chek the price range filter for 'buy'
                $builder->where('transaction_type', 'buy')
                        ->where('price >=', $startprice)
                        ->where('price <=', $endprice);
            }
        } elseif ($transaction_type === 'rent') {
            
            if (!empty($startprice) && !empty($endprice)) { // this will chek the price range filter for 'buy'
                $builder->where('transaction_type', 'rent')
                        ->where('price >=', $startprice)
                        ->where('price <=', $endprice);
            }
        }
    }
    
    

    if (!empty($amenities)) {
        // Ensure $amenities is an array
        if (is_array($amenities)) {
            foreach ($amenities as $amenity) {
                switch ($amenity) {
                    case 'parking':
                        $builder->where('parking', 'available');
                        break;
                    case 'on_site_pharmacy':
                        $builder->where('on_site_pharmacy', 'available');
                        break;
                    case 'laboratory':
                        $builder->where('laboratory', 'available');
                        break;
                    case 'cafeteria':
                        $builder->where('cafeteria', 'available');
                        break;
                    default:
                        // Ignore unknown amenities
                        break;
                }
            }
        } else {
            // If $amenities is not an array, handle it (e.g., error or default behavior)
            $builder->where('1=0'); // This will result in an empty set
        }
    }

    // Get the results
    $filteredProperty = $builder->get()->getResultArray();

    // Prepare the response
    if (!empty($filteredProperty)) {
        $response = [
            'status' => 'success',
            'data' => $filteredProperty
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No properties found.'
        ];
    }

    // Return the results as JSON
    return $this->response->setJSON($response);
}


 

}



