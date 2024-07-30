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



}
