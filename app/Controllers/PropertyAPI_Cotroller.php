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
    $price = $this->request->getVar('price'); 

    // Pagination parameters
    $page = (int)($this->request->getVar('page') ?? 1);
    $perPage = (int)($this->request->getVar('per_page') ?? 10);
    $offset = ($page - 1) * $perPage;

    // Get the current year
    $currentYear = date('Y');

    // Build the query for filtering
    $builder = $propertyModel->builder();

    // Location
    if (!empty($CityOrZipcode)) {
        if (is_numeric($CityOrZipcode)) {
            $builder->where('zipcode', $CityOrZipcode);
        } else {
            $builder->where('city', $CityOrZipcode);
        }
    }

    // Property type
    if (!empty($property_types)) {
        if (is_array($property_types)) {
            $builder->whereIn('property_type', $property_types);
        } else {
            $builder->where('property_type', $property_types);
        }
    }

    // Possession
    if (!empty($possession)) {
        $builder->where('possession', $possession);
    }

    // Amenities
    if (!empty($amenities)) {
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
            $builder->where('1=0'); // No records will be matched
        }
    }

    // Age of property
    if (!empty($ageofproperty) && is_array($ageofproperty)) {
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

    // Transaction type filtering
    if (!empty($transaction_types)) {
        $builder->groupStart(); // Start a group for OR conditions

        if (in_array('Buy', $transaction_types)) {
            if (!empty($startprice) && !empty($endprice)) {
                $builder->orGroupStart()
                        ->where('transaction_type', 'Buy')
                        ->where('price >=', $startprice)
                        ->where('price <=', $endprice)
                        ->groupEnd();
            } else {
                $builder->orWhere('transaction_type', 'Buy');
            }
        }

        if (in_array('Rent', $transaction_types)) {
            if (!empty($start_rent_price) && !empty($end_rent_price)) {
                $builder->orGroupStart()
                        ->where('transaction_type', 'Rent')
                        ->where('price >=', $start_rent_price)
                        ->where('price <=', $end_rent_price)
                        ->groupEnd();
            } else {
                $builder->orWhere('transaction_type', 'Rent');
            }
        }

        $builder->groupEnd(); // End the group for OR conditions
    }

    // Low to high & High to Low Price
    if (!empty($price) && $price !== 'All') {
        $sortOrder = ($price === 'low') ? 'ASC' : 'DESC';
        $builder->orderBy('price', $sortOrder);
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
        'total_items' => $totalItems,
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


//*************************Home Page API Hero Section Form API*********************************
public function getPropertyByFiltersHome()
{
    $propertyModel = new PropertyModel();

    // Get filter parameters from the request
    $propertyType = $this->request->getVar('property_type');
    $cityOrZipcode = $this->request->getVar('cityZipcode');
    $transactionType = $this->request->getVar('transaction_type');



    // Initialize query builder
    $builder = $propertyModel->builder();

    // Apply city or zipcode filter
    if (!empty($cityOrZipcode)) {
        if (is_numeric($cityOrZipcode)) {
            $builder->where('zipcode', $cityOrZipcode);
        } else {
            $builder->like('city', $cityOrZipcode, 'both'); // Use 'like' for partial matches
        }
    }

    // Apply property type filter
    if (!empty($propertyType)) {
        $builder->where('property_type', $propertyType);
    }

    // Apply transaction type filter
    if (!empty($transactionType)) {
        $builder->where('transaction_type', $transactionType);
    }

    // Execute the query
    $properties = $builder->get()->getResultArray();

    // Return response
    if (empty($properties)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No properties found for the provided filters.'
        ])->setStatusCode(404);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $properties
    ]);
}

//*************************Slider Home Page API***************************

public function getProperty_types_name_and_Adress_API()
{
    $PropertyModel = new PropertyModel();
    
    $properties = $PropertyModel->select('pid,property_image, property_type, address, price,name')
                                ->orderBy('pid', 'DESC')
                                ->findAll();

    foreach ($properties as &$property) {
        $images = explode(',', $property['property_image']);
        $property['property_image'] = $images[0] ?? ''; // Fetch the first image or set it to an empty string if not found
    }

    return $this->response->setJSON($properties);
}




}



