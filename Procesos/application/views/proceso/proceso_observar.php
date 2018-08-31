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

  <script type="text/javascript">
    var ruta="<?php echo site_url();?>";
  </script>
  <script type="text/javascript" src="recursos/js/proceso.js"></script>
