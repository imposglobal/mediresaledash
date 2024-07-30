<?php

namespace App\Controllers;
use App\Models\PropertyModel;



class PropertyAPI_Cotroller extends BaseController
{


    /************************************** GET API function ***************************** */

    public function AllPropertyItems_API()
    {
        $PropertyModel = new PropertyModel();
        $property = $PropertyModel->findAll();
        
        return $this->response->setJSON($property);
    }

// function To get API by price range
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

    
   
}
