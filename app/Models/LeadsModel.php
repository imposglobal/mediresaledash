<?php
namespace App\Models;  
use CodeIgniter\Model;

class LeadsModel extends Model
{
    protected $table = 'leads';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pid', 
        'eid',    
        'first_name',      
        'last_name',
        'email',
        'phone_number',
        'created_at'
        
    ];


    
public function leads_delete($id) 
{
 return $this->db->table($this->table)->where('id', $id)->delete();
}



    public function view_leads_by_id($id) 
    {
        $result = $this->db
                       ->table('leads')
                       ->where(["id" => $id])
                       ->get()
                       ->getResultArray();
    
        // Debug statement
        error_log(print_r($result, true));
    
        return $result;
    }
   
}





?>