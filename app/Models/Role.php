<?php 
namespace App\Models;

use CodeIgniter\Model;

class Role extends Model{
    protected $table      = 'roles';
    protected $primaryKey = 'id';
    protected $returnType    = 'array'; 
    protected $allowedFields = ['name', 'created_at'];
    protected $useTimestamps = FALSE;
    protected $createdField  = 'created_at';
    protected $validationRules  = [
        'name' => 'required|alpha_space|min_length[2]|max_length[100]',
    ];
    protected $skipValidation = FALSE;  
}