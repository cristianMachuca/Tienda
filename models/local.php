<?php
include_once("./models/generic-model.php");

class local extends GenericModel
{
  public function __construct(
    ?int $idTienda = null,
    ?string $nomTienda = null,
    ?string $nomAcesor = null,
  ) {
    parent::__construct("local");
    $this->idTienda = $idTienda;
    $this->nomTienda = $nomTienda;
    $this->nomAcesor = $nomAcesor;
  }

  function createLocal()
  {
    $query = "INSERT INTO $this->table_name(IdTienda, NombreTienda, NombreAcesor)
      VALUES ('$this->idTienda', '$this->nomTienda', '$this->nomAcesor')";
    $res = $this->exec($query);
    return $res;
  }

  function updateLocal()
  {
    $query = "UPDATE `$this->table_name`
      SET `NombreTienda` = '$this->nomTienda    ',
          `NombreAcesor` = '$this->nomAcesor',
      WHERE IdTienda=$this->idTienda";
    $res = $this->exec($query);
    return $res;
  }

  function deleteLocal()
  {
    $query = "DELETE FROM $this->table_name WHERE IdTienda=$this->idTienda";
    $res = $this->exec($query);
    return $res;
  }

  function readAllLocal()
  {
    $query = "SELECT IdTienda,NombreTienda, NombreAcesor FROM $this->table_name";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      while ($row = $res->fetch_array()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return "No se encontro ningún regitro";
  }

  function selectOne()
  {
    $query = "SELECT * FROM $this->table_name WHERE IdTienda=$this->idTienda";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}