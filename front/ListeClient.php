<html>

<head>
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/2.2.1/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/2.2.1/mdb.min.js"></script>
</head>

<body>

    <div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#">Brand</a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <!-- Navbar dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <!-- Left links -->

                    <!-- Search form -->
                    <form class="d-flex input-group w-auto">
                        <input type="search" class="form-control" placeholder="Type query" aria-label="Search" />
                        <button class="btn btn-outline-primary" type="button" data-mdb-ripple-color="dark">
                            Search
                        </button>
                    </form>
                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </div>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/services/dao/UserDao.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/GestionBanque/services/dto/User.php";

    $userDao = new UserDao();
    $users = $userDao->getAll();
    ?>
    <div>
        <h2>Liste utilisateurs : </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Date de Naissance</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client) { ?>
                    <tr>
                        <th scope="row"><a href="../../AfficherUser.php?id_client=<?php echo  $client->getId(); ?>"><?php echo  $client->getId(); ?></a></th>
                        <td><?php echo $client->getNom(); ?></td>
                        <td><?php echo $client->getPrenom(); ?></td>
                        <td><?php echo $client->getDateNaissance()->format("d-m-Y"); ?></td>
                        <td><?php echo $client->getTelephone(); ?></td>
                        <td><?php echo $client->getEmail(); ?></td>
                        <td><?php echo $client->getAdresse(); ?></td>
                        <td><?php echo $client->getType(); ?></td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>

</body>

</html>