<?php
namespace App\Models;  
use CodeIgniter\Model;


class LoginModel extends Model{
    protected $table = 'registration';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'name',       
        'email', 
        'password',
        'created_at'

    ];

}  
?>