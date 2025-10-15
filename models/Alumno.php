<?php
require_once "../config/Database.php";
class Alumno{
  private $conexion;
  public function __construct() {
    $this->conexion = Database::getConexion();
  }
  /**
   * Devuelve un conjunto de alumnos contenidos en un arreglo
   * @return array
   */
  public function getAll(): array{
    $sql="SELECT * FROM alumnos";
    $stmt = $this->conexion->prepare($sql); 
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }

  /**
   * Registra un alumno en la base de datos
   * @param mixed $params
   * @return int
   */
  public function add($params = []): int{
   $sql="INSERT INTO alumnos (nombre, apellidos, correo, tipodoc, numdoc) VALUES(?,?,?,?,?)";
   $stmt = $this->conexion->prepare($sql);
   $stmt->execute(
    array(
      $params["nombre"],
      $params["apellidos"],
      $params["correo"],
      $params["tipodoc"],
      $params["numdoc"]
    )
    );
    return $stmt->rowCount();
  }
  public function update($params = []): int{
    $sql = "UPDATE alumnos SET nombre = ?,apellidos = ?,correo = ?,tipodoc = ?,numdoc = ? WHERE idalumno = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([
        $params["nombre"],
        $params["apellidos"],
        $params["correo"],
        $params["tipodoc"],
        $params["numdoc"],
        $params["idalumno"]
    ]);
    return $stmt->rowCount();  
  }
  public function delete($params = []): int{
    $sql= "DELETE FROM alumnos WHERE idalumno=? ";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["idalumno"]
      )

      );
    return $stmt->rowCount();
  }
  public function getById ($idalumno): array{
    $sql= "SELECT * FROM alumnos WHERE idalumno=?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($idalumno)
      );  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
}