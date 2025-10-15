<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Alumnos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }
    .card {
      border: none;
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .card-header {
      background: linear-gradient(135deg, #fdb10dff, #da9502ff);
      color: white;
    }
    .btn-custom {
      background: linear-gradient(135deg, #fdb10dff, #da9502ff);
      border: none;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background: linear-gradient(135deg, #fdb10dff, #da9502ff);
      transform: translateY(-2px);
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card text-center">
          <div class="card-header py-4">
            <h2 class="fw-bold mb-0">Sistema de Alumnos</h2>
          </div>
          <div class="card-body p-5">
            <p class="lead mb-4">Gestiona tus registros de forma rápida y eficiente.</p>
            <a href="view/listar.php" class="btn btn-custom btn-lg px-5">
              <i class="bi bi-list-ul me-2"></i> Ver lista de alumnos
            </a>
          </div>
          <div class="card-footer bg-light py-3">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
