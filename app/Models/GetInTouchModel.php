<?php
namespace App\Models;  
use CodeIgniter\Model;

class GetInTouchModel extends Model
{
    protected $table = 'get_in_touch';
    protected $primaryKey = 'gid';
    protected $allowedFields = [
        'full_name', 
        'email',    
        'phone',      
        'message',
        'created_at'
        
    ];

   
}
?>