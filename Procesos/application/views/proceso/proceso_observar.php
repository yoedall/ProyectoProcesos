<?php 
    if(!isset($resultado))
        $resultado=99;
?>

<script>
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: "+0d",
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
        monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ]
    });
  } );
</script>

<div class="container mt-5">
<h1 align="center">Lista de Procesos</h1>
<div class="row mt-5">
    <p class="col-3"><b>Desde:</b> <input type="text" class="datepicker" id="fechaDesde" readOnly></p>
    <p class="col-3"><b>Hasta:</b> <input type="text" class="datepicker" id="fechaHasta" readOnly></p>
    <p class="col-2"><button class="btn btn-primary" onclick="mostrarProcesosFiltrados()">Buscar</button></p>
    <a href="#" title="Nuevo Proceso" class="col-2"><button class="btn btn-default" onclick="mostrarRegistroProceso()"><b>+</b></button></a>
    <p class="col-2"><button class="btn btn-warning" onclick="cerrarSesion()"><b>Cerrar Sesión</b></button></p>
</div>

<div class="table-responsive mt-3 mb-5">
    
    <table class="table table-primary table-hover">
    <thead>
        <tr>
        <th scope="col">Número</th>
        <th scope="col">Descripción</th>
        <th scope="col">Fecha de Creación</th>
        <th scope="col">Sede</th>
        <th scope="col">Presupuesto (COP)</th>
        <th scope="col">Presupuesto (USD)</th>
        <th scope="col">Usuario</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($resultado!=99){ 
            foreach ($resultado as $item) {
                
                echo "<tr>";
                echo "<td scope='row'>".$item->id_numero_proceso."</td>";
                echo "<td scope='row'>".$item->desc_proceso."</td>";
                echo "<td scope='row'>".date('d/m/Y', strtotime($item->fecha_creacion))."</td>";
                echo "<td scope='row'>".$item->desc_sede."</td>";
                echo "<td scope='row'>".number_format($item->presupuesto, 2, ',', '')."</td>";
                echo "<td scope='row'>".number_format(($item->presupuesto/2931.95), 2, ',', '')." $</td>";
                echo "<td scope='row'>".$item->usuario."</td>";
            ?>
                <td scope='row'>
                    <a href="#" class='btn btn-success' title='Editar Proceso' onclick="mostrarEditarProceso('<?php echo  $item->id_numero_proceso;?>');" >Editar</a> 
                    <a href="#" class='btn btn-danger' title='Borrar Proceso' onclick="eliminarProceso('<?php echo  $item->id_numero_proceso; ?>')">Eliminar</a>
                    
                </td>
                </tr>
                                            
            <?php
            }
            
        }
        ?>
        
    </tbody>
    </table>
</div>
</div>

  <script type="text/javascript">
    var ruta="<?php echo site_url();?>";
  </script>
  <script type="text/javascript" src="recursos/js/proceso.js"></script>
