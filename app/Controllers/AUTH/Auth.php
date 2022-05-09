<?php 
namespace App\Controllers\AUTH;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\User; 
class Auth extends BaseController {

    use ResponseTrait;

    public function __construct() {
        $this->model = new User();
    }

    public function register() {
        try {
            $user = $this->request->getJSON();
            $exist = $this->model->where('username', $user->username)->first();
            if($exist) return $this->failResourceExists('Ya existe el usuario.');
            $user->password = hassPassword($user->password);
            if($this->model->insert($user)):
                return $this->respondCreated('Usuario creado.');
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador.'. $error);
        }
    }

    public function login() {
        try {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $user = $this->model->where('username', $username)->first();
            if(!$user) return $this->failNotFound('El usuario no existe.');
            if(verifyPassword($password, $user["password"])):
                return $this->respond(['token' => generateToken($username)]);
            else:
                return $this->failUnauthorized('Los datos ingresados no son correctos.');
            endif;
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador.'. $error);
        }
    }

}