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


public function getEquipmentByFilters()
{
    $equipmentModel = new EquipmentModel();
    $equipmentType = 'imaging-equipment'; 
    $cityOrZipcode = 'Gandhinagar'; 


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

    $query = $builder->get();
    $equipments = $query->getResultArray();

    if (empty($equipments)) {
        return $this->response->setJSON([
            'message' => 'No equipment found for the provided filters.'
        ])->setStatusCode(404);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $equipments
    ]);
}

}
