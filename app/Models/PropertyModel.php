<?php
namespace App\Models;  
use CodeIgniter\Model;


class PropertyModel extends Model{
    protected $table = 'property';
    protected $primaryKey = 'pid';
    protected $allowedFields = [
        'name',       
        'description',
        'property_type',
        'transaction_type', 
        'state',
        'city',
        'zipcode',
        'address',
        'built_year',
        'possession',
        'total_area',
        'price',
        'parking',
        'pharmacy',
        'laboratory',
        'cafeteria',
        'property_image',
        'created_at'

    ];

    public function view_property_by_id($id) 
{
    return $this->db
                    ->table('property')
                    ->where(["pid" => $id])
                    ->get()
                    ->getResultArray(); // Get an array of results
}


    public function property_delete($id) 
    {
        return $this->db->table($this->table)->where('pid', $id)->delete();
    }

    public function get_property_by_id($id) 
    {
        return $this->db
                        ->table('property')
                        ->where(["pid" => $id])
                        ->get()
                        ->getRow();
                        
                        
    }

    public function update_property_by_id($id, $data)
     {
        return $this->db
                    ->table('property')
                    ->where(["pid" => $id])
                    ->set($data)
                    ->update();
    }

}  
?>