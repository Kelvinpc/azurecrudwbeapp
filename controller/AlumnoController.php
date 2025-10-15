<?php

if (isset($_SERVER['REQUEST_METHOD'])) {

  require_once "../models/Alumno.php";
  $alumno = new Alumno();

  switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
      header("Content-Type: application/json; charset=utf-8");

      if ($_GET["task"] == 'getAll') {
        echo json_encode($alumno->getAll());
      } else if ($_GET["task"] == 'getById') {
        echo json_encode($alumno->getById($_GET['idalumno']));
      }
      break;

    case "POST":
      $input = file_get_contents("php://input");
      $dataJSON = json_decode($input, true);

      $registro = [
        "nombre"      => $dataJSON["nombre"],
        "apellidos"   => $dataJSON["apellidos"],
        "correo"      => $dataJSON["correo"],
        "tipodoc"     => $dataJSON["tipodoc"],
        "numdoc"      => $dataJSON["numdoc"],
      ];
      $filasAfectadas = $alumno->add($registro);

      header("Content-Type: application/json; charset=utf-8");
      echo json_encode(["filas" => $filasAfectadas]);
      break;

    case "PUT":
      $input = file_get_contents("php://input");
      $dataJSON = json_decode($input, true);

      $registro = [
        "idalumno"    => $dataJSON["idalumno"],
        "nombre"      => $dataJSON["nombre"],
        "apellidos"   => $dataJSON["apellidos"],
        "correo"      => $dataJSON["correo"],
        "tipodoc"     => $dataJSON["tipodoc"],
        "numdoc"      => $dataJSON["numdoc"]
      ];

      $filasAfectadas = $alumno->update($registro);
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode(["filas" => $filasAfectadas]);
      break;

    case "DELETE":
      header("Content-Type: application/json; charset=utf-8");

      $url = $_SERVER['REQUEST_URI'];
      $arrayURL = explode('/', $url);
      $idalumno= end($arrayURL);

      $filasafectadas = $alumno->delete(['idalumno' => $idalumno]);
      echo json_encode(['filas' => $filasafectadas]);
      break;

  }

}