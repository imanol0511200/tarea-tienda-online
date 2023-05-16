<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action='procedimientos/iniciosesion.php' method="post">
    <img width="80" height="80" src="https://img.icons8.com/fluency/48/online-shop.png" alt="online-shop"/>
        <h1 class="h1 mb-3 fw-normal">ElecStore</h1>

        <div class="form-floating">
      <input type="email"name="correo" class="form-control" placeholder="name@example.com">
      <label  >Correo</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="paas"id="floatingPassword" placeholder="Password">
      <label for="floatingPassword" >Contraseña</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar sesion</button>
    <a href='registrousuaiors.php'>Registrate</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>
