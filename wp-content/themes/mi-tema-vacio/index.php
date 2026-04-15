<?php
/** LÓGICA (El cerebro)
 * Aquí procesamos todo antes de mostrar la página
 */
global $wpdb;
$tabla = $wpdb->prefix . 'contactos';
$mensaje = "";

// Borrar
if ( isset($_GET['borrar']) ) {
    $wpdb->delete($tabla, array('id' => $_GET['borrar']));
    $mensaje = "Eliminado con éxito.";
}

// Guardar o Actualizar
if ( isset($_POST['boton_guardar']) ) {
    $datos = array(
        'nombre'   => $_POST['f_nombre'],
        'apellido' => $_POST['f_apellido'],
        'email'    => $_POST['f_email']
    );

    if ( !empty($_POST['f_id']) ) {
        $wpdb->update($tabla, $datos, array('id' => $_POST['f_id']));
    } else {
        $wpdb->insert($tabla, $datos);
    }
    $mensaje = "Datos guardados.";
}

// Cargar datos si vamos a editar
$editar_usuario = null;
if ( isset($_GET['editar']) ) {
    $id = $_GET['editar'];
    $editar_usuario = $wpdb->get_row("SELECT * FROM $tabla WHERE id = $id");
}

// Traer la lista de la base de datos
$lista_usuarios = $wpdb->get_results("SELECT * FROM $tabla");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ecomerce-Ideal</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body>

    <h1>Gestión de Usuarios</h1>

    <?php if($mensaje): ?>
        <p style="color: blue;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <div class="box">
        <form method="POST">
            <input type="hidden" name="f_id" value="<?php echo $editar_usuario->id ?? ''; ?>">

            <label>Nombre:</label>
            <input type="text" name="f_nombre" value="<?php echo $editar_usuario->nombre ?? ''; ?>" required>

            <label>Apellido:</label>
            <input type="text" name="f_apellido" value="<?php echo $editar_usuario->apellido ?? ''; ?>" required>

            <label>Email:</label>
            <input type="email" name="f_email" value="<?php echo $editar_usuario->email ?? ''; ?>" required>

            <button type="submit" name="boton_guardar">
                <?php echo $editar_usuario ? "ACTUALIZAR" : "CREAR NUEVO"; ?>
            </button>
            
            <?php if($editar_usuario): ?>
                <a href="index.php">Cancelar</a>
            <?php endif; ?>
        </form>
    </div>

    <h2>Usuarios en la Base de Datos</h2>
    <table border="1" style="width:100%; text-align:left;">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($lista_usuarios as $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->nombre . " " . $user->apellido; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>
                <a href="?editar=<?php echo $user->id; ?>">Editar</a>
                <a href="?borrar=<?php echo $user->id; ?>" style="color:red;">Borrar</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <?php wp_footer(); ?>
</body>
</html> 
 
