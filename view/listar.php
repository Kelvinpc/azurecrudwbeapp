<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lista de Alumnos</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body { background-color: #f8f9fa; }
    .btn { transition: all 0.3s ease; }
    .btn:hover { transform: scale(1.05); }
    th, td { vertical-align: middle; }
    .card-header { background-color: #fdb10dff; color: white; font-weight: bold; }
  </style>
</head>
<body>

<div class="container my-5">
  <h2 class="text-center text-primary mb-4">Alumnos</h2>
  
  <div class="text-end mb-3">
    <button class="btn btn-success" onclick="location.href='./crear.php'">
      <i class="fa-solid fa-plus me-1"></i> Nuevo alumno
    </button>
  </div>

  <div class="card shadow">
    <div class="card-header">Lista de alumnos</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover align-middle" id="tabla-alumnos">
        <thead class="table-light">
          <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Tipo de doc</th>
            <th>Número de doc</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<script>
const tabla = document.querySelector("#tabla-alumnos tbody");

function obtenerDatos() {
  fetch(`../controller/AlumnoController.php?task=getAll`)
    .then(res => res.json())
    .then(data => {
      tabla.innerHTML = '';
      data.forEach(element => {
        tabla.innerHTML += `
          <tr>
            <td>${element.nombre}</td>
            <td>${element.apellidos}</td>
            <td>${element.correo}</td>
            <td>${element.tipodoc}</td>
            <td>${element.numdoc}</td>
            <td class="text-center">
              <a href="editar.php?idalumno=${element.idalumno}" class="btn btn-outline-info btn-sm me-1" title="Editar">
                <i class="fa-solid fa-pencil"></i>
              </a>
              <a href="#" class="btn btn-outline-danger btn-sm delete" data-idalumno="${element.idalumno}" title="Eliminar">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>
        `;
      });
    })
    .catch(error => console.error(error));
}

document.addEventListener("DOMContentLoaded", () => {
  obtenerDatos();

  tabla.addEventListener("click", (event) => {
    const enlace = event.target.closest("a");
    if (enlace && enlace.classList.contains("delete")) {
      event.preventDefault();
      const idalumno = enlace.getAttribute("data-idalumno");

      Swal.fire({
        title: "¿Está seguro?",
        text: "¡Esta acción no se puede revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`../controller/AlumnoController.php/${idalumno}`, { method: 'DELETE' })
            .then(res => res.json())
            .then(datos => {
              if (datos.filas > 0) {
                enlace.closest('tr').remove();
                Swal.fire("¡Eliminado!", "El alumno ha sido eliminado correctamente.", "success");
              } else {
                Swal.fire("Error", "No se pudo eliminar el alumno.", "error");
              }
            })
            .catch(err => {
              console.error(err);
              Swal.fire("Error", "Ocurrió un problema al eliminar el alumno.", "error");
            });
        }
      });
    }
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
