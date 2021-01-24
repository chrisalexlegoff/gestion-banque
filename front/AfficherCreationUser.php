<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Signin Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/register.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" method="POST" action="faireCreationUser.php">
    <img class="mb-4" src="../img/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Enregistrement</h1>
    <label for="inputName" class="sr-only">Nom</label>
    <input type="name" id="inputName" class="form-control" placeholder="Nom" name="nom" required autofocus>
    <label for="LastName" class="sr-only">Prenom</label>
    <input type="LastName" id="LastName" class="form-control" placeholder="Prenom" name="prenom" required autofocus>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="DateDeNaissance" id="inputDateDeNaissance" class="form-control" placeholder="DateDeNaissance" name="dateDeNaissance" required autofocus>
    <label for="inputDateDeNaissance" class="sr-only">Date de naissance</label>
    <input type="Telephone" id="inputTelephone" class="form-control" placeholder="Telephone" name="telephone" required autofocus>
    <label for="inputTelephone" class="sr-only">telephone</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
    <input type="Adresse" id="inputAdresse" class="form-control" placeholder="Adresse" name="adresse" required autofocus>
    <label for="inputAdresse" class="sr-only">Adresse</label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
  </form>
</body>

</html>