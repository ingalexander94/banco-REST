<?php 
namespace App\Models;

use CodeIgniter\Model;

class User extends Model{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType    = 'array'; 
    protected $allowedFields = ['username','password', 'role_id', 'created_at'];
    protected $useTimestamps = FALSE;
    protected $createdField  = 'created_at';
    protected $validationRules  = [
        'username' => 'required|is_unique[users.username]|min_length[2]|max_length[100]',
        'password' => 'required|min_length[6]|max_length[255]',
        'role_id' => 'required|Integer',
    ];
    protected $skipValidation = FALSE;  
}