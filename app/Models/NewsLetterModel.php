<?php
namespace App\Models;  
use CodeIgniter\Model;

class NewsLetterModel extends Model
{
    protected $table = 'newsletter';
    protected $primaryKey = 'news_id';
    protected $allowedFields = [
        'email',    
        'created_at'
        
    ];

   
}
?>