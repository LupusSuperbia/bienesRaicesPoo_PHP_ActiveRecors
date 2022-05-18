<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor();

//----------------------------------------------------------------//
// ---------------- Arreglo con mensajes de errores ------------- //
//----------------------------------------------------------------//

$errores = Vendedor::getErrores();



//----------------------------------------------------------------//
// Ejecutar el código después de que el usuario envia el formulario //
//----------------------------------------------------------------//
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // -------------- CREAR UNA NUEVA INSTANCIA ------------- //
    $vendedor = new Vendedor($_POST['vendedor']);

     // -------------- VALIDAR DATOS VACIOS ------------- //
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }

}

incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>


    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/admin/vendedores/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_vendedores.php' ?>'

        <input type="submit" value="Registrar Vendedores" class="boton boton-verde" name="" id="">
    </form>
</main>



<?php incluirTemplate('footer'); ?>