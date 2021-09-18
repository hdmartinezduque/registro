<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">  
    <title>Crear usuario </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
  
      
      <!-- Custom styles for this template -->
      <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">

    <form action="process/insert_usuario.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Solicitud Nuevo Usuario</h1>
       

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name = "email" placeholder="name@example.com" required>
            <label for="floatingInput">Email</label>
          </div>

          <div class="form-floating">
            <input type="text" class="form-control" id = "nombre" name = "nombre" placeholder="Nombre" required>
            <label for="floatingInput">Nombre</label>
          </div>            

          <div class="form-floating">
            <input type="text" class="form-control" id="apellido" name = "apellido" placeholder="Apellido" required>
            <label for="floatingInput">Apellido</label>
          </div>      
          
          <div class="form-floating">
            <input type="password" class="form-control" id="password" name = "password" placeholder="password" required>
            <label for="floatingInput">Contrase&ntilde;a</label>
          </div>  
          <button class="w-100 btn btn-lg btn-primary" type="submit">Enviar</button>    
    </form>
    </main>
  </body>
</html>