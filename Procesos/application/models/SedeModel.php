<?php
Class SedeModel extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database('default');
  }

  
  public function obtenerSedes()
   {
    
    $llamar="CALL sp_select_cat_sede();"; 

    $resultado = $this->db->query($llamar);
    mysqli_next_result( $this->db->conn_id );
    $row = $resultado->result();
    $resultado->free_result();
    return $row;

   }

}