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

    //**************************code for multiple filter in Property listing page*********************************


// code with pagination

public function getpropertybyFilter()
{
    $propertyModel = new PropertyModel();


     // Get filter parameters from the request

     $CityOrZipcode = $this->request->getVar('CityOrZipcode');
     $property_types = $this->request->getVar('property_type');
     $transaction_types = $this->request->getVar('transaction_type');
     $startprice = $this->request->getVar('start_price');
     $endprice = $this->request->getVar('end_price');
     $start_rent_price = $this->request->getVar('start_rent_price');
     $end_rent_price = $this->request->getVar('end_rent_price');
     $ageofproperty = $this->request->getVar('ageofproperty');
     $amenities = $this->request->getVar('amenities');
     $possession = $this->request->getVar('possession'); 

    // Pagination parameters
    $page = (int)($this->request->getVar('page') ?? 1);
    $perPage = (int)($this->request->getVar('per_page') ?? 20);
    $offset = ($page - 1) * $perPage;

    // Get the current year
    $currentYear = date('Y');

    // Build the query for filtering
    $builder = $propertyModel->builder();

    // location
    if (!empty($CityOrZipcode)) {
        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }
    }

    // property type
    if (!empty($property_types)) {
        if (is_array($property_types)) {
            $builder->whereIn('property_type', $property_types);
        } else {
            $builder->where('property_type', $property_types);
        }
    }

    // possesion
    if (!empty($possession)) {
        $builder->where('possession', $possession);
    }

    // amenities
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



    // Handling age of equipment filtering
    if (!empty($ageofproperty) && is_array($ageofproperty)) 
    {
        $builder->groupStart(); // Start a group for OR conditions

        foreach ($ageofproperty as $age) {
            switch ($age) {
                case 'less than 1 year':
                    $year = $currentYear;
                    $builder->orGroupStart()
                            ->where('built_year', $year)
                            ->groupEnd();
                    break;
                case 'less than 2 year':
                    $year = $currentYear - 1;
                    $builder->orGroupStart()
                            ->where('built_year >=', $year)
                            ->groupEnd();
                    break;
                case 'less than 5 year':
                    $year = $currentYear - 4;
                    $builder->orGroupStart()
                            ->where('built_year >=', $year)
                            ->groupEnd();
                    break;
                case 'more than 5 years':
                    $year = $currentYear - 5;
                    $builder->orGroupStart()
                            ->where('built_year <', $year)
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
    $filteredproperty = $builder->get()->getResultArray();

    // Calculate total pages
    $totalPages = ceil($totalItems / $perPage);

    // Prepare the response with pagination metadata
    $response = [
        'status' => 'success',
        'data' => $filteredproperty,
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



//**************************code for multiple filter in Home Page*********************************

public function getPropertyByFiltersHome()
{
    $propertyModel = new PropertyModel();

    // $propertyType = $this->request->getVar('hospitals');
    // $cityOrZipcode = $this->request->getVar('Bilaspur');
    // $transactionType = $this->request->getVar('rent');

    $propertyType = 'hospitals'; 
    $cityOrZipcode = 'Bilaspur'; 
    $transactionType = 'rent'; // or 'rent'

    $builder = $propertyModel->builder();

    if (!empty($cityOrZipcode)) {
        if (is_numeric($cityOrZipcode)) {
            $builder->where('zipcode', $cityOrZipcode);
        } else {
            $builder->where('city', $cityOrZipcode);
        }
    }

    if (!empty($propertyType)) {
        $builder->where('property_type', $propertyType);
    }

    if (!empty($transactionType)) {
        $builder->where('transaction_type', $transactionType);
    }

    $query = $builder->get();
    $properties = $query->getResultArray();

    if (empty($properties))
    {
        return $this->response->setJSON([
            'message' => 'No properties found for the provided filters.'
        ])->setStatusCode(404);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $properties
    ]);
}

//Api function to get property_type and adress only
public function getProperty_types_and_Adress_API()
{
    $PropertyModel = new PropertyModel();
    $property = $PropertyModel->select('property_image,property_type, address,price,')
                              ->orderBy('pid', 'DESC')
                              ->findAll();
    
    return $this->response->setJSON($property);
}




}



