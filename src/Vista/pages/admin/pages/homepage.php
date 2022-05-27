<?php
session_start();
include('../../../../Modelo/db.php');
$usuario = $_SESSION['login'];
if (!isset($usuario)) {
    echo $usuario;
    header("location:../../../index.html");
}

?>
<?php
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `order` WHERE id = '$remove_id'");
    header('location:../../admin/pages/homepage.php');
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
    <title>Home Page Admin</title>
    <link rel="stylesheet" href="../styles/normalice.css">
    <link rel="stylesheet" href="../../admin/styles/sylesadd.css">
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">¨
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'> -->
    <script src="../../admin/pages/dataTable.js" type="text/javascript"></script>

</head>

<body>

    <div class="container">
        <nav class="heading__mio">

            <a style="font-size: 2rem;" href="../pages/homepage.php">Inicio</a>
            <a style="font-size: 2rem;" href="../pages/userdata.php">Datos Pendientes</a>
            <a style="font-size: 2rem;" href="../pages/menu.php">Menús</a>

            <a style="font-size: 2rem;" id="lg" href="../../../../Controlador/sesion/Cerrar.php">Cerrar Sesion</a>
            <!--Se va a quedar pendiente  -->

        </nav>

        <section class="shopping-cart">
            <h1 class="heading">Admin Panel<br>De Pedidos</h1>



            <table id="tablax" class="tabla hp">

                <thead>
                    <th>Nombre</th>
                    <th>Metodo Pago</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Comentario</th>
                    <th>Productos</th>
                    <th>Precio Total</th>
                    <!-- <th>Estatus</th> -->


                </thead>

                <tbody>
                    <?php

                    /**
                     * La variable $select_cart seleciona nuestra tabla llamada "Cart" de nuestra base de datos
                     */
                    $select_cart = mysqli_query($conn, "SELECT * FROM `order`");


                    /**
                     * Esta variable es el precio total a pagar por el cliente - se inicia en cero porque no hay nada en el carrito
                     */
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>

                            <tr>
                                <td class="td__admin"><?php echo $fetch_cart['name'] ?></td>
                                <td class="td__admin"><?php echo $fetch_cart['method'] ?></td>
                                <td class="td__admin"><?php echo $fetch_cart['flat'] . "," . $fetch_cart['city'] ?></td>
                                <td class="td__admin"><?php echo $fetch_cart['number'] ?></td>
                                <td class="td__admin"><?php echo $fetch_cart['country'] ?></td>
                                <td class="td__admin"><?php echo $fetch_cart['total_products'] ?></td>

                                <td class="td__admin"><?php echo $fetch_cart['total_price'] ?> Mxn.</td>
                                <td>
                                    <!-- <button id="btn1" class="td_admin delete-btn tbtn">Pendiente</button>
                                <button id="btn2" class="td_admin delete-btn tbtn">Entregado</button> -->
                                    <!-- <button type="submit" id="boton1" class="btn btn-primary toggle">Pendiente</button>
                                    <button type="submit" id="boton2" class="btn btn-primary toggle">Entregado</button> -->
                                </td>
                                <!-- <td class="td__admin"><a href="?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('¿Estas Seguro de eliminar esto del carrito?')" class="delete-btn">  Eliminar</a></td> -->

                            </tr>

                    <?php
                            // $grand_total += $sub_total;
                        };
                    };
                    ?>

                </tbody>
                <td><a href="../../admin/pages/homepage.php?delete_all" onclick="return confirm('¿Estas Seguro que quieres eliminar todos los Pedidos?');" class="delete-btn"> <i class="fas fa-trash"></i> Eliminar Todo </a></td>
                <button style="background-color: white;" id="btnExportar" class="delete-btn "> Exportar a Excel</button>
            </table>






        </section>

    </div>

    <!-- <script src="../../.././pages/admin/pages/tabla.js"></script> -->
    <!-- <script src="../../admin/pages/tabla.js"></script>
    <script src="../../admin/pages/ExportToExcel.js"></script>
    <script src="../../admin/pages/tableexport.min.js"></script>
    <script src="../../admin/pages/xlsx.full.min.js"></script> -->
    <script src="src/jquery.table2excel.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <script>
        $(document).ready(() => {
            $("#btnExportar").click(function() {
                $("#tablax").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile", //do not include extension
                    fileext: ".xls" // file extension
                });
            });
        });

        // const btn1 = document.getElementById("btn1");
        // const btn2 = document.getElementById("btn2");

        // document.getElementById('boton1').addEventListener("click", function() {
        //     if (btn2.classList.contains("active")) {
        //         btn2.classList.remove("active")
        //     }
        //     if (!btn1.classList.contains("active")) {
        //         btn1.classList.toggle("active");

        //     }
        // });

        // document.getElementById('btn2').addEventListener("click", function() {
        //     if (btn1.classList.contains("active")) {
        //         btn1.classList.remove("active");
        //     }

        //     if (!btn2.classList.contains("active")) {
        //         btn2.classList.toggle("active");
        //     }
        // });

        var boton1 = document.getElementById("boton1");
        var boton2 = document.getElementById("boton2");

        document.getElementById('boton1').addEventListener("click", function() {

            if (boton2.classList.contains("active")) {
                boton2.classList.remove("active");
            }

            if (!boton1.classList.contains("active")) {
                boton1.classList.toggle("active");
            }

        });

        document.getElementById('boton2').addEventListener("click", function() {

            if (boton1.classList.contains("active")) {
                boton1.classList.remove("active");
            }

            if (!boton2.classList.contains("active")) {
                boton2.classList.toggle("active");
            }

        });
    </script>

</body>

</html>