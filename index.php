<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">

    <script src="https://kit.fontawesome.com/d248edc114.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="/assets/script.js"></script>
    <title>Bienvenido | Control Inventario</title>

</head>
<body>
    <div class="jumbotron center">
    <h1 class="display-4"> Administracion de Productos</h1>
    
    <p class="lead">Bienvenido al control de inventario, aca podrás modificar y agregar productos, agregar o quitar categorias, etc</p>
    <hr class="my-4">    
    <!-- <a class="btn btn-success btn-lg" href="login.php">Iniciar Sesion</a> -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">
  Iniciar Sesion
</button>
    </div>




<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Iniciar Sesion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="validar.php" method="post">
            <label for="email">Correo o Usuario:</label>
            <input type="text" name="email" placeholder="Ingresar usuario">
            <label for="password">Contraseña:</label>
            <input type="password" name="clave" placeholder="Ingresa tu contraseña">
            <input type="submit" value="Ingresar">
        </form>
      </div>

    </div>
  </div>
</div>

</body>
</html>