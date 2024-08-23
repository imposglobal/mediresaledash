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
   
}


?>