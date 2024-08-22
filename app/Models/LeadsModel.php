<?php
namespace App\Models;  
use CodeIgniter\Model;

class LeadsModel extends Model
{
    protected $table = 'leads';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pid',    
        'first_name',      
        'last_name',
        'email',
        'phone_number'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}


?>