<?php
namespace App\Models;  
use CodeIgniter\Model;

class GetInTouchModel extends Model
{
    protected $table = 'get_in_touch';
    protected $primaryKey = 'gid';
    protected $allowedFields = [
        'full_name',     
        'phone', 
        'subject',     
        'message',
        'created_at'
        
    ];

   



}
?>