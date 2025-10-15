<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Alumno</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
      transition: all 0.3s ease;
    }

    .btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>

<body>


  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-primary">Registrar Nuevo Alumno</h2>
      <button type="button" onclick="window.location.href='./listar.php'" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Volver
      </button>
    </div>

<form autocomplete="off" id="formulario-alumno">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <strong>Formulario de Registro</strong>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Nombre -->
        <div class="col-md-6 mb-3">
          <div class="form-floating">
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required maxlength="20">
            <label for="nombre">Nombre</label>
          </div>
        </div>

        <!-- Apellidos -->
        <div class="col-md-6 mb-3">
          <div class="form-floating">
            <input type="text" id="apellidos" name="apellidos" class="form-control" plgitaceholder="Apellidos" required maxlength="40">
            <label for="apellidos">Apellidos</label>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Correo -->
        <div class="col-md-6 mb-3">
          <div class="form-floating">
            <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo" required maxlength="60">
            <label for="correo">Correo electrónico</label>
          </div>
        </div>

        <!-- Tipo de documento -->
        <div class="col-md-3 mb-3">
          <div class="form-floating">
            <select id="tipodoc" name="tipodoc" class="form-select" required>
              <option value="" disabled selected>Seleccione</option>
              <option value="DNI">DNI</option>
              <option value="DEX">DEX</option>
              <option value="PASS">PASS</option>
            </select>
            <label for="tipodoc">Tipo de documento</label>
          </div>
        </div>

        <!-- Número de documento -->
        <div class="col-md-3 mb-3">
          <div class="form-floating">
            <input type="text" id="numdoc" name="numdoc" class="form-control" placeholder="Número de documento" required maxlength="12">
            <label for="numdoc">Número de documento</label>
          </div>
        </div>
      </div>
    </div>

    <div class="card-footer text-end">
      <button type="submit" class="btn btn-primary" id="btnGuardar">
        <i class="fa-solid fa-check me-1"></i> Guardar datos del alumno
      </button>
    </div>
  </div>
</form>

  </div>

  <script>
    const formulario = document.querySelector("#formulario-alumno");

    function registrarAlumno() {
      const data = {
        nombre: document.querySelector("#nombre").value,
        apellidos: document.querySelector("#apellidos").value,
        correo: document.querySelector("#correo").value,
        tipodoc: document.querySelector("#tipodoc").value,
        numdoc: document.querySelector("#numdoc").value
      };

      fetch("/controller/AlumnoController.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      })
        .then(response => response.json())
        .then(result => {
          if (result.filas > 0) {
            formulario.reset();
            Swal.fire({
              icon: "success",
              title: "Alumno registrado",
              text: "El nuevo alumno se registró correctamente.",
              footer: "Alumnos - SENATI",
              confirmButtonColor: "#198754"
            }).then(() => {
              window.location.href = "./listar.php";
            });
          } else {
            Swal.fire({
              icon: "warning",
              title: "Sin cambios",
              text: "No se pudo registrar.",
              confirmButtonColor: "#ffc107"
            });
          }
        })
        .catch(error => {
          console.error(error);
          Swal.fire({
            icon: "error",
            title: "Error del servidor",
            text: "No se pudo registrar.",
            confirmButtonColor: "#dc3545"
          });
        });
    }

    formulario.addEventListener("submit", function (event) {
      event.preventDefault();

      Swal.fire({
        title: "¿Registrar alumno?",
        text: "Confirma si deseas registrar.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#fdb10dff",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Registrar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          registrarAlumno();
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"crossorigin="anonymous"></script>
</body>

</html>
