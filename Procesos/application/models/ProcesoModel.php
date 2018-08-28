<?php
Class ProcesoModel extends CI_Model
{

  // Todas las consultas son realizadas mediante procedimientos almacenados

  function __construct()
  {
    parent::__construct();
    $this->load->database('default');
  }
  
  public function obtenerProceso($fechaDesde,$fechaHasta,$id)
   {
    
    $llamar="CALL sp_select_tbl_proceso('";
    $llamar.=$fechaDesde."','";
    $llamar.=$fechaHasta."','";
    $llamar.=$id."');"; 
    $resultado = $this->db->query($llamar);
    mysqli_next_result( $this->db->conn_id );
    if($resultado->num_rows()>0){

        $row = $resultado->result(); 
    }
    else
        $row = 99; 
    
      $resultado->free_result();
      return $row;

   }

   public function registrarProceso($descripcion,$sede,$presupuesto){

    $llamar="CALL sp_create_tbl_proceso('";
    $llamar.=$descripcion."',";
    $llamar.=$sede.",";
    $llamar.=$presupuesto.",";
    $llamar.=$this->session->userdata('usuarioLogueado')['id_usuario'].");"; 
    $resultado = $this->db->query($llamar);
      return $resultado;
   }

   public function editarProceso($descripcion,$sede,$presupuesto,$id){

    $llamar="CALL sp_update_tbl_proceso('";
    $llamar.=$descripcion."',";
    $llamar.=$sede.",";
    $llamar.=$presupuesto.",'";
    $llamar.=$id."',";
    $llamar.=$this->session->userdata('usuarioLogueado')['id_usuario'].");"; 
    $resultado = $this->db->query($llamar);
      return $resultado;
   }

   public function eliminarProceso($id){

    $llamar="CALL sp_delete_tbl_proceso('".$id."');"; 
    $resultado = $this->db->query($llamar);
      return $resultado;
   }

}