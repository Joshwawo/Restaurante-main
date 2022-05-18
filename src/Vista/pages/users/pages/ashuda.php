<!-- Conectar Esta Pagina que es el login del admin -->
<?php

include('../../../../Modelo/db.php');
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
    /**
     * Esta condicional if, hace referencia a que ya se a seleccionado el producto y nos mostrara un mensa "Producto ya agregado al carrito", no nos dejara agarrarlo otra vez, y la condicional else hace refencia a que si no esta en el carrito nos dejara agregarlo al carrrito de compras y nos aparecera el mensaje "Producto Agregado Correctamente"
     */
    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Producto ya fue agregado al carrito';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'Producto agregado correctamente!';
    }
}

?>

<!DOCTYPE html>
<html class="ashuda" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home User</title>
    <!-- <link rel="stylesheet" href="/Restaurante/src/Vista/pages/users/styles/normalice.css">
    <link rel="stylesheet" href="/Restaurante/src/Vista/pages/users/styles/stylescliente.css"> -->
    <link rel="stylesheet" href="../styles/normalice.css">
    <!-- <link rel="stylesheet" href="../styles/stylescliente.css"> -->
    <!-- <link rel="stylesheet" href="../styles/stails.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../admin/styles/sylesadd.css">



</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };

    ?>
    <main>

        <div class="container">
            <nav class="heading__mio">
                <a class="heading__mio" href="../pages/homeuser.php">Inicio</a>
                <a class="heading__mio" href="../pages/ashuda.php">Ayuda</a>
                <?php
                /**
                 *La variable $select_rows seleciona nuestra tabla llamada "Cart" de nuestra base de datos y si no encuentra la tabla nos mandara un error de fallo de consulta
                 */
                $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
                /**
                 * Esta variable es el contador de los productos que se han agregado al carrito
                 */
                $row_count = mysqli_num_rows($select_rows);
                ?>
                <a href="cart.php" class="cart headermio_mio--2">carrito <span>(🛒<?php echo $row_count; ?>)</span> </a>
                <a class="heading__mio" id="lg" href="../../login.html">Cerrar Sesion</a>
            </nav>
            <header class="headermio">
                <h1 class="headermio--h1">¿Necesitas Ayuda?</h1>
                <p class="headermio--p">¡Talvez esto puede ayudarte!</p>

            </header>

            <section>
                
            <div class="card">
                <p>Celular📞: 6623893489</p>
                <p>Email📧: correo@correo.com</p>
                
            </div>

            <div class="preguntas">
                <h2>Preguntas Frecuentes</h2>
                <h3>¿Quién se encarga de las entregas?<h3>
                    <p><span>R:</span> Utilizamos nuestros repartidores para llevar la comida a los clientes lo más rápido posible.</p>
                <h3>¿Cuál es su radio de entregas?</h3>
                    <p><span>R:</span> Se realizan pedidos en toda la ciudad.</p>
                <h3>¿Cuánto cuesta el envío?</h3>
                    <p><span>R:</span> Se realiza un costo diferente dependiendo de donde esté ubicado el cliente.</p>
                <h3>¿Qué pasa si no encuentro el establecimiento?</h3>
                    <p><span>R:</span> Puedes comunicarte con nosotros en la sección de "Contactanos" en la cual se te brindara la información necesaria.</p>
                <h3>¿En qué horarios puedo realizar pedidos?</h3>
                    <p><span>R:</span> El padronili se encuentra abierto de 12 pm a 11 pm.</p>
                <h3>¿Se puede realizar el pago con tarjeta de crédito?</h3>
                    <p><span>R:</span> Nuestros repartidores cuentan con terminal portátil para pagos con tarjeta, aceptamos visa y mastercard</p>
            </div>
                
            </section>





        </div>


    </main>





</body>

</html>