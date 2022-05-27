<!-- Conectar Esta Pagina que es el login del admin -->
<?php
// include('../../../../Modelo/db.php');
session_start();

include('../../../../Modelo/db.php');
$usuario = $_SESSION['login'];

if (!isset($usuario)) {
    echo $usuario;
    header("location:../../../index.html");
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `info` WHERE id = '$remove_id'");
    header('location:../../admin/pages/userdata.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `order`");
    header('location:../../admin/pages/homepage.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Pendientes</title>
    <!-- <link rel="stylesheet" href="../styles/normalice.css">
    <link rel="stylesheet" href="../styles/stylesadmin.css">
    <link rel="stylesheet" href="../styles/sylesadd.css"> -->
    <link rel="stylesheet" href="../styles/normalice.css">
    <!-- <link rel="stylesheet" href="../styles/stylesadmin.css"> -->

    <!-- <link rel="stylesheet" href="../styles/sylesadd.css"> -->
    <link rel="stylesheet" href="../../admin/styles/sylesadd.css">
</head>

<body>

    <div class="nav-bg">
        <nav class="heading__mio">
            <a style="font-size: 2rem;" href="../pages/homepage.php">Inicio</a>
            <a style="font-size: 2rem;" href="../pages/userdata.php">Datos Pendientes</a>
            <a style="font-size: 2rem;" href="../pages/menu.php">Menús</a>

            <a style="font-size: 2rem;" id="lg" href="../../login.html">Cerrar Sesion</a>
            <!--Se va a quedar pendiente  -->
            <!--Se va a quedar pendiente  -->


        </nav>
    </div>

    <header style="background: none;" class="heading">
        <!-- <h1>Bienvenido de Nuevo Admin</h1> -->
        <!-- <h2>Datos de clientes</h2> -->
    </header>


    <h2 style="color: red;">Testing</h2>

    <section class="shopping-cart">
        <h1 class="heading">Admin Panel<br>De Datos Pendientes</h1>



        <table id="tablax" class="tabla hp info">

            <thead>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Mensaje</th>
                <th>Accion</th>

            </thead>

            <tbody>
                <?php

                /**
                 * La variable $select_cart seleciona nuestra tabla llamada "Cart" de nuestra base de datos
                 */
                $select_info = mysqli_query($conn, "SELECT * FROM `info`");


                /**
                 * Esta variable es el precio total a pagar por el cliente - se inicia en cero porque no hay nada en el carrito
                 */
                $grand_total = 0;
                if (mysqli_num_rows($select_info) > 0) {
                    while ($fetch_info = mysqli_fetch_assoc($select_info)) {
                ?>

                        <tr>
                            <td class="td__admin"><?php echo $fetch_info['name'] ?></td>
                            <td class="td__admin"><?php echo $fetch_info['email'] ?></td>
                            <td class="td__admin"><?php echo $fetch_info['telefono'] ?></td>
                            <td class="td__admin"><?php echo $fetch_info['texto'] ?></td>
                            <td class="td__admin"><a href="../../admin/pages/userdata.php?remove=<?php echo $fetch_info['id']; ?>" onclick="return confirm('¿Estas Seguro de eliminar esto del carrito?')" class="delete-btn"> Eliminar</a></td>

                        </tr>

                <?php
                        // $grand_total += $sub_total;
                    };
                };
                ?>

            </tbody>
            <td><a href="../../admin/pages/userdata.php?delete_all" onclick="return confirm('¿Estas Seguro que quieres eliminar todos los Pedidos?');" class="delete-btn"> <i class="fas fa-trash"></i> Eliminar Todo </a></td>
            <!-- <button style="background-color: yellow;" id="btnExportar" class="delete-btn "> Exportar a Excel</button> -->
        </table>






    </section>





</body>

</html>