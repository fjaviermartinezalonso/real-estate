<?php
    // Autenticación de usuario
    require "includes/config/database.php";
    $db = conectarDB();

    $errores = [];
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST["password"]);

        if(!$email) {
            $errores[] = "Es necesario introducir un correo válido";
        }
        if(!$password) {
            $errores[] = "Es necesario introducir una contraseña";
        }

        if(empty($errores)) {
            // Verificar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);
            
            if($resultado->num_rows) {
                // Verificar password
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario["password"]);

                if($auth) {
                    // Usuario autenticado. Abrimos sesión y añadimos información
                    session_start();
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true;
                    header("location: /admin");
                }
                else {
                    $errores[] = "La contraseña es incorrecta";
                }
            }
            else {
                $errores[] = "El usuario no existe";
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <p><?php echo $error; ?></p>
        </div>
        <?php endforeach; ?>

        <form method="POST" class="form contenido-centrado alinear-centro" novalidate>
            <fieldset>
                <legend>Información personal</legend>
                <label for="useremail">Correo electrónico</label>
                <input name="email" type="email" placeholder="email@email.com" id="useremail">

                <label for="password">Contraseña</label>
                <input name="password" type="password" placeholder="Tu contraseña" id="password">
            </fieldset>

            <div class="alinear-derecha">
                <input type="submit" class="boton-verde" value="Iniciar sesión">
            </div>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>