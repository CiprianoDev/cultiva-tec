<?php
require './code/functions/incluirTemplate.php';
session_start();

$usuario_nombre = "";


if (!isset($_SESSION['usuario_nombre'])) {
    header('Location: /login');
} else {
    $usuario_nombre = $_SESSION['usuario_nombre'];
}
incluirTemplate('header', true);

$conexion = new \Tec\CultivaTec\classes\Conexion();
$conexion->conectar();

$consulta = "SELECT * FROM frutas";
$resultado = $conexion->ejecutarConsulta($consulta);
?>

<main>
    <h1 class="administrador__titulo">Administrador de Cultivando-teC</h1>
    <a href="/create" class="boton boton-verde">Nueva Fruta</a>
    <table class="frutas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fruta</th>
                <th>Imagen</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado  as $fila) {
                $id = $fila['idfruta'];
                $nombre = $fila['nombre'];
                $imagen = $fila['imagen'];
            ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $nombre ?></td>
                    <td>
                        <div class="imagen">
                            <img class="imagen-tabla" src="/code/imagenes/<?php echo $imagen; ?>">
                        </div>
                    </td>
                    <td class="opciones">

                        <a class="boton-verde-block" href="/normas?idfruta= <?php echo $id ?>"> Normas </a>

                        <a class="boton-amarillo-block" href="/actualizar?fruta= <?php echo $id ?>">Actualizar</a>
                        <form action="" method="post">
                            <input type="hidden" name="delete" value="<?php echo $id ?>">
                            <input class="boton-rojo-block" type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="linea"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</main>

<?php
incluirTemplate('footer');
?>