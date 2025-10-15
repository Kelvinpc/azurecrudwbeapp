<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actualizar alumno</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
      transition: all 0.3s ease-in-out;
    }

    .btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>

<body>

  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-primary">Actualizar alumno</h2>
      <button onclick="window.location.href='./listar.php'" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Volver
      </button>
    </div>

    <form id="formulario-actualizar" autocomplete="off">
      <div class="card">
        <div class="card-header bg-info text-white">
          <strong>Formulario de Actualización</strong>
        </div>
        <div class="card-body">

          <div class="row mb-3">
            <div class="col-md-6 form-floating">
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required maxlength="20" />
              <label for="nombre">Nombre</label>
            </div>
            <div class="col-md-6 form-floating">
              <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellidos" required maxlength="40" />
              <label for="apellidos">Apellidos</label>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 form-floating">
              <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo" required maxlength="60" />
              <label for="correo">Correo electrónico</label>
            </div>
            <div class="col-md-3 form-floating">
              <select id="tipodoc" name="tipodoc" class="form-select" required>
                <option value="" disabled selected>Seleccione</option>
                <option value="DNI">DNI</option>
                <option value="DEX">DEX</option>
                <option value="PASS">PASS</option>
              </select>
              <label for="tipodoc">Tipo de documento</label>
            </div>
            <div class="col-md-3 form-floating">
              <input type="text" id="numdoc" name="numdoc" class="form-control" placeholder="Número de documento" required maxlength="12" />
              <label for="numdoc">Número de documento</label>
            </div>
          </div>
        </div>

        <div class="card-footer text-end">
          <button class="btn btn-primary" type="submit">
            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Cambios
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const urlParams = new URLSearchParams(window.location.search);
      const idalumno = urlParams.get("idalumno");

      // Cargar datos actuales del alumno
      fetch(`/controller/AlumnoController.php?task=getById&id=${idalumno}`)
        .then(res => res.json())
        .then(data => {
          if (data.length > 0) {
            const alumno = data[0];
            document.getElementById("nombre").value = alumno.nombre;
            document.getElementById("apellidos").value = alumno.apellidos;
            document.getElementById("correo").value = alumno.correo;
            document.getElementById("tipodoc").value = alumno.tipodoc;
            document.getElementById("numdoc").value = alumno.numdoc;
          }
        })
        .catch(err => {
          console.error("Error al obtener datos del alumno:", err);
          Swal.fire("Error", "No se pudo cargar la información del alumno.", "error");
        });

      // Evento para actualizar el alumno
      document.getElementById("formulario-actualizar").addEventListener("submit", function (e) {
        e.preventDefault();

        const nombre = document.getElementById("nombre").value.trim();
        const apellidos = document.getElementById("apellidos").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const tipodoc = document.getElementById("tipodoc").value;
        const numdoc = document.getElementById("numdoc").value.trim();

        if (!nombre || !apellidos || !correo || !tipodoc || !numdoc) {
          Swal.fire("Campos vacíos", "Por favor complete todos los campos.", "warning");
          return;
        }

        Swal.fire({
          title: '¿Actualizar datos del alumno?',
          text: "Esta acción modificará la información del registro.",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#fdb10dff',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Sí, actualizar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch('/controller/AlumnoController.php', {
              method: 'PUT',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                id: idalumno,
                nombre,
                apellidos,
                correo,
                tipodoc,
                numdoc
              })
            })
              .then(res => res.json())
              .then(data => {
                if (data.filas > 0) {
                  Swal.fire({
                    title: 'Actualizado',
                    text: 'Alumno actualizado correctamente.',
                    icon: 'success',
                    confirmButtonColor: '#198754'
                  }).then(() => {
                    window.location.href = "./listar.php";
                  });
                } else {
                  Swal.fire("Sin cambios", "No se actualizó el registro.", "info");
                }
              })
              .catch(err => {
                console.error("Error al actualizar:", err);
                Swal.fire("Error", "No se pudo actualizar el alumno.", "error");
              });
          }
        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
