<?php
namespace App\Models;  
use CodeIgniter\Model;


class LoginModel extends Model{
    protected $table = 'user';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'name',
        'lname',       
        'email', 
        'password',
        'created_at'

    ];

}  
?>