<?php
    $sede=0;
    $descripcion="";
    $presupuesto="";
    $titulo="Registrar Proceso";
    if(isset($resultado))
    {
        $titulo="Editar Proceso";
        foreach ($resultado as $item) {
            $id=$item->id_numero_proceso;
            $sede=$item->id_sede;
            $descripcion=$item->descripcion;
            $presupuesto=$item->presupuesto;
        }
    }

    
    function cargarSedes($sedes,$elemento){
    echo '<select id="sede" class="selectpicker form-control" data-live-search="true">';
    echo '<option value="0">Seleccione la Sede...</option>';
   foreach($sedes as $item){
     if($elemento==$item->id_sede){
       echo '<option value="'.$item->id_sede.'" selected>'.$item->descripcion.'</option>';
     }else {
       echo '<option value="'.$item->id_sede.'" >'.$item->descripcion.'</option>';
     }
   
     }
     echo '</select>';
   }
   
?>

  <h1 class="titulo"><?php echo $titulo;?></h1>
  <div class="login-page">
    <div class="form">
      <div class="login-form">
      <textarea rows="4" cols="35" class="campoRegistro" id="descripcion" placeholder="Descripcion" maxlength="200" ><?php echo $descripcion;?></textarea>
      <br>
      <?php cargarSedes($sedes,$sede);?>
      <br>
      <input type="number" step="any" value="<?php echo $presupuesto;?>" id="presupuesto" placeholder="Presupuesto en COP" class="campoRegistro"/>
        <button onclick="<?php echo isset($resultado) ? 'editarProceso('.$id.')' : 'registrarProceso()' ;?>">
            <?php echo isset($resultado) ? 'Editar' : 'Registrar' ;?>
        </button>
        <p class="message"><a href="#" onclick="mostrarProcesos()">Regresar</a></p>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var ruta="<?php echo site_url();?>";
  </script>
  <script type="text/javascript" src="recursos/js/proceso.js"></script>
