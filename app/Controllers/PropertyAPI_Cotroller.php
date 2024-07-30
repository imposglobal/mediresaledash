<?php

namespace App\Controllers;
use App\Models\PropertyModel;



class PropertyAPI_Cotroller extends BaseController
{

/***************** function to get all property table data API ***************************** */

    public function AllPropertyItems_API()
    {
        $PropertyModel = new PropertyModel();
        $property = $PropertyModel->findAll();
        
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

        $CityOrZipcode = 'pune';

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

   /*************** function to get property by Possesion **********************/  

    public function getPropertiesByPossesion_API()
    {
        $propertyModel = new PropertyModel();

        $possesion ='Ready to move'; 

        $properties = $propertyModel->where('possession', $possesion)
                                    ->findAll();

        return $this->response->setJSON($properties);
    }
 

}



