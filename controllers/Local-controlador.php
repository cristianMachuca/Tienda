<?php
include_once('./controllers/BaseController.php');
include_once('./models/local.php');

class LocalController extends BaseController {

  public function __construct($method, $param = null) {
    parent::__construct(
      method: $method,
      param: $param,
      requiereParam: ['PUT', 'DELETE']
    );
  }

  public function init() {
    switch ($this->method) {
      case 'POST':
        $this->createLocal();
        break;
      case 'GET':
        $this->getAllLocal();
        break;
      case 'PUT':
        $this->updateLocal();
        break;
      case 'DELETE':
        $this->deleteLocal();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  private function createLocal() {
    [
      'IdTienda' => $IdTienda,
      'NombreTienda' => $NombreTienda,
      'NombreAcesor' => $NombreAcesor,
    ] = request();

    $local = new Local(
      idTienda: $IdTienda,
      nomTienda: $NombreTienda,
      nomAcesor: $NombreAcesor
    );
    $res = $local->createLocal();
    if($res == 1) {
      response([
        'status' => 'Se ha creado correctamente la tienda',
        'error' => False
      ], 201);
      exit();
    }
    response([
      'status' => 'No se ha podido crear correctamente la tienda', 
      'error' => True
    ], 400);
  }

  private function updateLocal() {
    [
      'IdTienda' => $IdTienda,
      'NombreTienda' => $NombreTienda,
      'NombreAcesor' => $NombreAcesor,
    ] = request();
    $local = new Local(
      idTienda: $IdTienda,
      nomTienda: $NombreTienda,
      nomAcesor: $NombreAcesor,
    );
    $res = $local->updateLocal();
    if($res == 1) {
      response([
        'status' => 'Se ha actualizado correctamente la tienda',
        'error' => False], 200
      );
      exit();
    }
    response([
      'status' => 'No se ha podido actualizar correctamente la tienda', 
      'error' => True
    ], 400);
  }

  private function getAllLocal() {
    $local = new Local();
    $res = $local->readAllLocal();
    if(gettype($res) == 'string') {
      response([
        'status' => 'No se ha registrado ningúna Tienda',
        'error' => True
      ], 202);
      exit();
    }

    response([
      'data' => mapped($res),
      'status' => 'Ok',
      'error' => False
    ],200);
  }

  private function deleteLocal() {
    $local = new Local(idTienda: $this->param);
    $exist = $local->selectOne();
    if(!isset($exist)) {
      response([
        "error" => True,
        "status" => "No se ha encontrado ningún registro con el id: ".$this->param
      ], 202);
      exit();
    }
    $res = $local->deleteLocal();
    echo $res;
    response(["error" => False, "status" => "Se ha eliminado correctamente el Tienda"], 200);
  }

}
?>