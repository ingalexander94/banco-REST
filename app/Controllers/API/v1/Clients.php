<?php 
namespace App\Controllers\API\v1;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Client;
class Clients extends ResourceController {
    
    public function __construct() {
        $this->model=$this->setModel(new Client());
    }

    public function index() {
       try {
            $clients = $this->model->findAll();
            return $this->respond($clients);
       } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador. '.$error);
       }
    }

    public function create() {
        try {
            $client = $this->request->getJSON();
            if($this->model->insert($client)):
                $client->id = $this->model->insertID();
                return $this->respondCreated($client);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador.'. $error);
        }
    }

    public function show($id=NULL) {
        try {
            if(!$id) return $this->failValidationError('Necesita un id valido.');
            $client = $this->model->find($id);
            return !$client ? $this->failNotFound('No se ha encontrado un cliente con el id '.$id) : $this->respond($client);
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador. '.$error);
        }
    }

    public function update($id=NULL) {
        try {
            if(!$id) return $this->failValidationError('Necesita un id valido.');
            $client = $this->model->find($id);
            if(!$client) return $this->failNotFound('No se ha encontrado un cliente con el id '.$id);
            $newClient = $this->request->getJSON();
            if($this->model->update($id, $client)):
                $newClient->id = $id;
                return $this->respondUpdated($newClient);
            else:
                return $this->failValidationError($this->model->validation->listErrors());
            endif;
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador. '.$error);
        }
    }

    public function delete($id=NULL) {
        try {
            if(!$id) return $this->failValidationError('Necesita un id valido.');
            $client = $this->model->find($id);
            if(!$client) return $this->failNotFound('No se ha encontrado un cliente con el id '.$id);
            if($this->model->delete($id)):
                return $this->respondDeleted('Se ha eliminado el usuario con el id '.$id);
            endif;
        } catch (\Exception $error) {
            return $this->failServerError('Ocurrio un error en el servidor, hable con el administrador. '.$error);
        }
    }

}