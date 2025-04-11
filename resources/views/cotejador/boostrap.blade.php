<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plantilla con Bootstrap, jQuery y SweetAlert</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- SweetAlert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <style>
    .banner {
      background: url('https://ellendriscoll.net/wp-content/uploads/2014/02/stilllifeweb.jpg') center center no-repeat;
      background-size: cover;
      height: 400px;
    }
  </style>
</head>
<body>

  <div class="container-fluid">
    <!-- Banner responsivo -->
    <div class="row">
      <div class="col-12 banner d-flex align-items-center justify-content-center text-white text-center">
        <h1 class="bg-dark bg-opacity-50 p-3 rounded">Bienvenido a la plantilla</h1>
      </div>
    </div>

    <!-- Input con botón -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-6">
        <div class="input-group">
          <input type="text" class="form-control" id="miInput" placeholder="Escribe algo...">
          <button class="btn btn-primary" id="miBoton">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      $('#miBoton').click(function () {
        const valor = $('#miInput').val();
        if (valor) {
          Swal.fire({
            title: '¡Éxito!',
            text: 'Has escrito: ' + valor,
            icon: 'success'
          });
        } else {
          Swal.fire({
            title: 'Oops...',
            text: 'Por favor escribe algo primero.',
            icon: 'warning'
          });
        }
      });
    });
  </script>

</body>
</html>
