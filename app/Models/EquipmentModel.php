<?php
namespace App\Models;  
use CodeIgniter\Model;


class EquipmentModel extends Model{

 
    protected $table = 'equipments';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'title',
        'equipment_type',      
        'brand',
        'equipment_condition',
        'warranty',
        'availability',
        'serial_number', 
        'price',
        'manifacture_year',
        'state',
        'city',
        'zipcode',
        'description',
        'equipment_image',
        'created_at'

    ];


  
    
    public function equipment_delete($id) 
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }


    // public function equipment_delete($id) 
    // {
    //     // Retrieve the image name from the database
    //     $image = $this->db->table($this->table)->select('equipment_image')->where('id', $id)->get()->getRow();
        
    //     if ($image) {
    //         // Delete the record from the database
    //         $this->db->table($this->table)->where('id', $id)->delete();
    
    //         // Remove the image file from the uploads folder
    //         $filePath = FCPATH . 'assets/uploads/equipments/' . $image->equipment_image;
    //         if (file_exists($filePath)) {
    //             if (unlink($filePath)) {
    //                 return $this->response->setJSON(['status' => 'success', 'message' => 'Record and image deleted successfully.']);
    //             } else {
    //                 return $this->response->setJSON(['status' => 'error', 'message' => 'Record deleted but failed to delete the image.']);
    //             }
    //         } else {
    //             return $this->response->setJSON(['status' => 'error', 'message' => 'Record deleted but image file not found.']);
    //         }
    //     } else {
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'Record not found.']);
    //     }
    // }
    

   
    
    public function view_equipment_by_id($id) 
    {
        $result = $this->db
                       ->table('equipments')
                       ->where(["id" => $id])
                       ->get()
                       ->getResultArray();
    
        // Debug statement
        error_log(print_r($result, true));
    
        return $result;
    }
    



    public function get_equipment_by_id($id) {
        return $this->db
                        ->table('equipments')
                        ->where(["id" => $id])
                        ->get()
                        ->getRow();
                        
                        
    }


    public function update_equipment_by_id($id, $data) {
        return $this->db
                    ->table('equipments')
                    ->where(["id" => $id])
                    ->set($data)
                    ->update();
    }
}  
?>