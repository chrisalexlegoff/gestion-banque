<?php
require_once "../services/dao/UserDao.php";
require_once "../services/dto/User.php";

// echo $_POST["nom"]."<br>";
// echo $_POST["prenom"]."<br>";
// echo $_POST["date_naissance"]."<br>";
// echo $_POST["telephone"]."<br>";
// echo $_POST["email"]."<br>";
// echo $_POST["adresse"]."<br>";

// if (!isset($_GET["id_user"])) {
//    echo "<div> Erreur </div>";
// } else {

   // $iduser = intval($_GET["id_user"]);
   $user = new UserDao();
   $user->save($user);
   $user->getById($iduser);
// }
