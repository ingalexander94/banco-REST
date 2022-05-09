<?php 
namespace App\Models;

use CodeIgniter\Model;

class Client extends Model{
    protected $table         = 'clients';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array'; 
    protected $allowedFields = ['name','surname','phone', 'email', 'created_at'];
    protected $useTimestamps = FALSE;
    protected $createdField  = 'created_at';
    protected $validationRules  = [
        'name' => 'required|alpha_space|min_length[3]|max_length[75]',
        'surname' => 'required|min_length[3]|max_length[75]',
        'phone' => 'permit_empty|alpha_numeric|min_length[7]|max_length[10]',
        'email' => 'required|valid_email|max_length[85]',
    ];
    protected $skipValidation = FALSE;  
}           