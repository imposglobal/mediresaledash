<?php

namespace App\Controllers;
use App\Models\EquipmentModel;
use App\Models\PropertyModel;

class DashBoard extends BaseController
{
    /****************************************** Dashboard Function ************************************************/
    public function dashboard()
    {
        $EquipmentModel = new EquipmentModel();
        $PropertyModel = new PropertyModel();

        // Query for equipment count
        $query1 = $EquipmentModel->db->query('SELECT COUNT(*) AS total_count FROM equipments');
        $result1 = $query1->getRow();
        $total_equipments_Count = $result1->total_count;

        // Query for property count
        $query2 = $PropertyModel->db->query('SELECT COUNT(*) AS total_count FROM property');
        $result2 = $query2->getRow();
        $total_property_Count = $result2->total_count;

        // Pass both counts to the view
        return view('dashboard', [
            'total_equipments_Count' => $total_equipments_Count,
            'total_property_Count' => $total_property_Count
        ]);
    }
}
