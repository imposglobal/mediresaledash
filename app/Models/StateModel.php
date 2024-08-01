<?php
namespace App\Models;  
use CodeIgniter\Model;


class StateModel extends Model{
    protected $table = 'states';
    protected $primarykey = 'id';
    protected $allowedFields = [

        'name'
    
    ];

    public function getStates() {
        return $this->db->table($this->table)->get()->getResultArray();
    }

}  
?>