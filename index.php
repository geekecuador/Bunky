
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sorteo</title>
    <link rel="stylesheet" href="./estilos.css">
    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">

</head>
<body>
<!-- multistep form -->
<!-- multistep form -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!empty($_POST["submit"])) {
    if(!empty($_POST["nombres"])){
        $servername = "localhost:8889";
        $username = "root";
        $password = "root";
        $dbname = "bunky";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
       // if (!$conn) {
       // die("Connection failed: " . mysqli_connect_error());
       // }

        $sql = "SELECT `valor` FROM `premio` WHERE `nombre`='" . $_POST["premios"] . "'";
        $result = $conn->query($sql);
        global $valor;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $valor = $row["valor"] ;
            }
        } else {
            echo "<script>sweetAlert(\"Oops...\", \"Error en la conexion a la base de datos!\", \"error\");</script>";
        }
        if($valor>0){
            $int = (int)$valor - 1;
        }
        $sql = "SELECT `codigos` FROM `codigo` WHERE codigos='".$_POST["codigo"]."'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            $sql = "SELECT `codigo` FROM `ingreso` WHERE codigo='".$_POST["codigo"]."'";
            $resultado1 = $conn->query($sql);
           if($resultado1->num_rows == 0){
               $sql = "INSERT INTO `bunky`.`registro` (`nombres`, `ciudad`, `telefono`, `email`, `premio`, `codigo`)
             VALUES ('" . $_POST["nombres"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["telefono"] . "','" . $_POST["email"] .
                   "','" . $_POST["premios"] . "','" . $_POST["codigo"] . "')";

               if (mysqli_query($conn, $sql)) {
                   $sql = "UPDATE `premio` SET `valor`='" . $int . "' WHERE `nombre`='" . $_POST["premios"] . "'";

                   if (mysqli_query($conn, $sql)) {
                       echo "<script>swal(\"Ingreso exitoso ".$_POST["nombres"]."!\")</script>";
                   }
                   $sql = "INSERT INTO `bunky`.`ingreso` (`codigo`) VALUES ('".$_POST["codigo"]."');";
                   mysqli_query($conn, $sql);

               }
           }
            else{
                echo "<script>sweetAlert(\"Oops...\", \"El codigo ingresado ya fue registrado!\", \"error\");</script>";
            }
        }
        else{
            echo "<script>sweetAlert(\"Oops...\", \"El codigo ingresado es invalido, intentalo de nuevo!\", \"error\");</script>";
        }

        mysqli_close($conn);
    }
}
?>
<form id="msform" method="POST" action="">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Datos Personales</li>
        <li>Premios</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Ingresa tus datos personales</h2>
        <h3 class="fs-subtitle">Paso 1</h3>
        <input type="text" name="nombres"  placeholder="Nombre y Apellido" required/>
        <select name="ciudad">
            <option value="0">Seleccionar</option>
            <option value="Guayaquil">Guayaquil</option>
            <option value="Quito">Quito</option>
            <option value="Cuenca">Cuenca</option>
        </select>
        <input type="text" name="telefono" required placeholder="Telefono"/>
        <input type="text" name="email" required placeholder="Email"/>
        <input type="button" name="next" class="next action-button" value="Siguiente"/>
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Premios</h2>
        <h3 class="fs-subtitle">Elige tu premio</h3>
        <?php

        $servername = "localhost:8889";
        $username = "root";
        $password = "root";
        $dbname = "bunky";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, nombre, valor FROM premio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                echo "<input type='checkbox' name='premios' value='" . $row["nombre"] . "' />" . $row["nombre"] . " " .
                    $row["valor"] . " <br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

        <input type="text" name="codigo" required placeholder="Codigo de Producto"/>
        <input type="checkbox" name="condiciones" required value="condiciones">Terminos y Condiciones <br>
        <input type="button" name="previous" class="previous action-button" value="Previous"/>
        <input type="submit" name="submit" class="submit action-button" value="Submit"/>
    </fieldset>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="https:////cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"
        charset="utf-8"></script>

<script src="./codigo.js" type="text/javascript" charset="utf-8"></script>
<script>
    $('input[type="checkbox"]').on('change', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
</script>
</body>
</html>


