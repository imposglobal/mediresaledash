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
   
    


}
