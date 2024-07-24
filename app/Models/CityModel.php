<?php
namespace App\Models;  
use CodeIgniter\Model;


class CityModel extends Model{
    protected $table = 'cities';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'city',       
        'state_id'
    ];

}  
?>