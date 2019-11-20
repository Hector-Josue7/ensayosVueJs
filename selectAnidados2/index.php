<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    </head>
    <body>
            <?php
            /*****************************/
            /***DESARROLLO HIDROCALIDO****/
            /*****************************/
            require 'connector.php';
            if (isset($_REQUEST['metodo'])) {
               $metodo = trim($_REQUEST['metodo']);
            }else{
               $metodo = "";
            }
            if( $metodo == 'obtenerCategorias' ){
              obtenerCategorias();
            }else if ($metodo == 'obtenerPistos') {
                if (isset($_REQUEST['idCategoria'])) {
                 $idCategoria = trim($_REQUEST['idCategoria']);
                }else{
                 $idCategoria = "";
                }
               obtenerPistos($idCategoria);
            }
            function obtenerPistos($idCategoria){
                $sql ="SELECT * FROM categorias AS CA INNER JOIN pistos AS PI ON CA.idCategoria = PI.idCategoria WHERE PI.idCategoria = '$idCategoria' "; 
                try {
                    $db = getConnection();
                    $stmt = $db->query($sql);  
                    $detalle = $stmt->fetchAll(PDO::FETCH_OBJ);
                    $db = null;
                    echo '{"pistos": ' . json_encode($detalle) . '}';
                } catch(PDOException $e) {
                    echo '{"error":{"text":'. $e-S>getMessage() .'}}'; 
                }
            }
            function obtenerCategorias(){
                $sql ="SELECT * FROM categorias"; 
                try {
                    $db = getConnection();
                    $stmt = $db->query($sql);  
                    $detalle = $stmt->fetchAll(PDO::FETCH_OBJ);
                    $db = null;
                    echo '{"categorias": ' . json_encode($detalle) . '}';
                } catch(PDOException $e) {
                    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                }
            }
            ?>
    <div class="container">
     <br>
         <div class="row">
            <div class="col-md-5 col-md-offset-3">
              <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Desarrollo Hidrocálido - Selects Anidados con JQuery</h3>
                </div>
                  <div class="panel-body">
                    <form>
                        <fieldset>
                            <div class="form-group">
                             <select id="selCategorias" class="form-control">
                             </select>
                          </div>
                          <div class="form-group">
                             <select id="selPistos" class="form-control">
                             </select> 
                          </div>
                          <div class="row">
                           <div class="col-md-12">
                            <input type="reset" class="btn btn-lg btn-default btn-block" type="button" value="Limpiar">
                           </div>
                          </div>
                        </fieldset>
                     </form>
                  </div>
              </div> <!-- Fin del panel panel-default -->
            </div>
          </div> <!-- Fin del Row --> 
     </div> <!-- Fin del Container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="js/main.js"></script> -->
    <script>
    $(document).ready(function(){
 obtenerCategorias();
});
  function obtenerCategorias(){
    $.ajax({
        type: 'GET',
        data: { metodo : 'obtenerCategorias' },
        url: 'php/index.php',
        dataType: "json",
	success: renderListaCategorias
    });
  }
 function renderListaCategorias(data){
    $('#selCategorias option').remove();
    var list = data == null ? [] : (data.categorias instanceof Array ? data.categorias : [data.categorias ]);
    if (list.length < 1) {
       alert("SIN NINGÚN RESULTADO EN LA BD");
    } else {
        $('#selCategorias').append('<option value="0">SELECCIONAR...</option>');
        $.each(list, function(index, categoria) {
            $('#selCategorias').append('<option value='+categoria.idCategoria+'>'+categoria.descripcion+'</option>');
        });
        $('#selCategorias').focus();
    }
 }
 $('#selCategorias').change(function(){
   obtenerPistos($(this).val());
 });
  function obtenerPistos(idCategoria){
    $.ajax({
        type: 'GET',
        data: { metodo : 'obtenerPistos' , idCategoria : idCategoria },
        url: 'php/index.php',
        dataType: "json",
        success: rendeListaPistos
    });
  }
 function rendeListaPistos(data){
    $('#selPistos option').remove();
    var list = data == null ? [] : (data.pistos instanceof Array ? data.pistos : [data.pistos ]);
    if (list.length < 1) {
       alert("SIN NINGÚN RESULTADO EN LA BD");
    } else {
        $('#selPistos').append('<option value="0">SELECCIONAR...</option>');
        $.each(list, function(index, pisto) {
            $('#selPistos').append('<option value='+pisto.descripcion+'>'+pisto.descripcion+'</option>');
        });
        $('#selPistos').focus();
    }
 }
 $('#selPistos ').change(function(){
   alert("Seleccionaste: "+$(this).val());
 });
    </script>
    </body>
</html>