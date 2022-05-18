<?php
include('../../Modelo/db.php');

if (isset($_POST['validacion_Login'])) {
    $Correo_Usuario = $_POST['correo'];
    $constrasena = $_POST['contrasena'];
    $buscarCorreo = "SELECT id_usuario FROM `usuarios` WHERE (id_usuario ='$Correo_Usuario' or correo = '$Correo_Usuario')";
    $resultado = $conn->query($buscarCorreo);

    $contador = mysqli_num_rows($resultado);

    if ($contador == 1) {
        $busquedaContra = "SELECT contrasena from usuarios WHERE (id_usuario ='$Correo_Usuario' or correo = '$Correo_Usuario')";
        $resultadoBusqueda = mysqli_query($conn, $busquedaContra);

        if (mysqli_num_rows($resultadoBusqueda) == 1) {
                $row = mysqli_fetch_array($resultadoBusqueda);
                $resultadoConsulta = $row['contrasena'];

                if ($Correo_Usuario == 'Don Burritos' || $Correo_Usuario == 'adrian28588@gmail.com' || 
                    $Correo_Usuario == 'josh' || $Correo_Usuario == 'jorge@hotmail.com'){
                    session_start();
                    $_SESSION['login'] = TRUE;    
                    $_SESSION['correo'] = $usuario;  
                    $_POST[$usuario];  
                    header("location: ../../Vista/pages/admin/pages/homepage.php");
                }else{
                    session_start();
                    $_SESSION['login'] = TRUE;    
                    $_SESSION['correo'] = $usuario;  
                    $_POST[$usuario];  
                    header("Location: ../../Vista/pages/users/pages/homeuser.php");
                }
        }else{
            echo'<script>;
            alert("Contraseña incorrecta, vuelva a intentarlo");
            window.location=" ../../Vista/pages/login.html";
            </script>';
        }
    }else{
        echo '<script>;
        alert("Usuario o Correo Incorrecto, vuelva a intentarlo");
        window.location=" ../../Vista/pages/login.html";
        </script>';
    }
}
?>