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

<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$servername = "localhost";
$username = "bdus3rbun";
$password = "I%JKw($(b[Tm";
$dbname = "bdbunky";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "<script>sweetAlert(\"Oops...\", \"Error en la conexion a la base de datos!\", \"error\");</script>";
}
if (!empty($_POST["submit"])) {
    if (!empty($_POST["nombres"])) {
        $sql = "SELECT `valor` FROM `premio` WHERE `nombre`='" . $_POST["premios"] . "'";
        $result = $conn->query($sql);
        global $valor;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $valor = $row["valor"];
            }
        }
        if ($valor > 0) {
            $int = (int)$valor - 1;
        }
        $sql = "SELECT `codigos` FROM `codigo` WHERE codigos='" . $_POST["codigo"] . "'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            $sql = "SELECT `codigo` FROM `ingreso` WHERE codigo='" . $_POST["codigo"] . "'";
            $resultado1 = $conn->query($sql);
            if ($resultado1->num_rows == 0) {
                $sql = "INSERT INTO `bdbunky`.`registro` (`nombres`, `ciudad`, `telefono`, `email`, `premio`, `codigo`)
             VALUES ('" . $_POST["nombres"] . "', '" . $_POST["ciudad"] . "', '" . $_POST["telefono"] . "','" . $_POST["email"] .
                    "','" . $_POST["premios"] . "','" . $_POST["codigo"] . "')";
                if (mysqli_query($conn, $sql)) {
                    $sql = "UPDATE `premio` SET `valor`='" . $int . "' WHERE `nombre`='" . $_POST["premios"] . "'";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>swal(\"Ingreso exitoso " . $_POST["nombres"] . "!\")</script>";
                    }
                    $sql = "INSERT INTO `bdbunky`.`ingreso` (`codigo`) VALUES ('" . $_POST["codigo"] . "');";
                    mysqli_query($conn, $sql);
                }
            } else {
                echo "<script>sweetAlert(\"Oops...\", \"El codigo ingresado ya fue registrado!\", \"error\");</script>";
            }
        } else {
            echo "<script>sweetAlert(\"Oops...\", \"El codigo ingresado es invalido, intentalo de nuevo!\", \"error\");</script>";
        }
    } else {
        echo "<script>sweetAlert(\"Oops...\", \"Debes ingresar tus datos personales completos!\", \"error\");</script>";
    }
}
?>
<form id="msform" method="POST" action="">
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Ingresa tus datos personales</h2>
        <input type="text" name="nombres" placeholder="Nombre y Apellido" required/>
        <select name="ciudad">
            <option value="0">Seleccionar</option>
            <option value="Guayaquil">Guayaquil</option>
            <option value="Quito">Quito</option>
            <option value="Cuenca">Cuenca</option>
            <option value="Santo Domingo">Santo Domingo</option>
            <option value="Machala">Machala</option>
            <option value="Durán">Durán</option>
            <option value="Manta">Manta</option>
            <option value="Portoviejo">Portoviejo</option>
            <option value="Ambato">Ambato</option>
            <option value="Riobamba">Riobamba</option>
            <option value="Quevedo">Quevedo</option>
            <option value="Loja">Loja</option>
            <option value="Ibarra">Ibarra</option>
            <option value="Milagro">Milagro</option>
            <option value="Esmeraldas">Esmeraldas</option>
            <option value="La Libertad">La Libertad</option>
            <option value="Babahoyo">Babahoyo</option>
            <option value="Tulcán">Tulcán</option>
            <option value="Sangolquí">Sangolquí</option>
            <option value="Latacunga">Latacunga</option>
            <option value="Pasaje">Pasaje</option>
            <option value="Chone">Chone</option>
            <option value="Santa Rosa">Santa Rosa</option>
            <option value="Huaquillas">Huaquillas</option>
            <option value="Nueva Loja">Nueva Loja</option>
            <option value="El Carmen">El Carmen</option>
            <option value="Jipijapa">Jipijapa</option>
            <option value="Ventanas">Ventanas</option>
            <option value="Daule">Daule</option>
            <option value="Cayambe">Cayambe</option>
            <option value="Otavalo">Otavalo</option>
            <option value="Velasco Ibarra">Velasco Ibarra</option>
            <option value="Azogues">Azogues</option>
            <option value="Santa Elena">Santa Elena</option>
            <option value="Salinas">Salinas</option>
            <option value="La Troncal">La Troncal</option>
        </select>
        <input type="number" name="telefono" required placeholder="Telefono"/>
        <input type="email" name="email" required placeholder="Email"/>
        <input type="button" name="next" id="sig" class="next action-button" value="Siguiente"/>
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Premios</h2>
        <h3 class="fs-subtitle">Elige tu premio</h3>
        <div class='win'>
            <ul><?php
                $sql = "SELECT id, nombre, valor FROM premio";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><img src='".$row["url"]."'><input type='checkbox' name='premios' value='" . $row["nombre"] . "' /></li> <label class='pep'>" . $row["nombre"] . "</label> <span class='nu'>" .
                            $row["valor"] . "</span>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </ul>
        </div>
        <input type="number" name="codigo" required placeholder="Codigo de Producto"/>
        <input type="radio" name="condiciones" id="condiciones" required value="condiciones" onclick="deshabilita()">
        <a href="http://www.tumundobunky.com/terminos-y-condiciones/" target="_blank" class="terminos">*Términos y
            Condiciones</a><br><span class="term2">He leído y acepto los términos y condiciones</span><br>
        <input type="button" name="previous" class="previous action-button" value="Regresar"/>
        <input type="submit" name="submit" id="submit" class="submit action-button" value="Enviar"/>
    </fieldset>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"
        charset="utf-8"></script>
<script src="https:////cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"
        charset="utf-8"></script>

<script src="./codigo.js" type="text/javascript" charset="utf-8"></script>
<script>
    $('input[type="checkbox"]').on('change', function () {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
</script>
<script>
    function deshabilita() {
        if (document.getElementById('condiciones').checked) {
            document.getElementById('submit').disabled = false;
        }
        else {
            document.getElementById('submit').disabled = true;
        }
    }
    deshabilita();
</script>
</body>
</html>