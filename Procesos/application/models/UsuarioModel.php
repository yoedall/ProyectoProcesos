<?php
Class UsuarioModel extends CI_Model
{

  // Todas las consultas son realizadas mediante procedimientos almacenados

  function __construct()
  {
    parent::__construct();
    $this->load->database('default');
  }

  
  public function registrarUsuario($nombres,$apellidos,$usuario,$passw)
  {
    $llamar="CALL sp_create_tbl_usuario('";
    $llamar.=$usuario."','";
    $llamar.=$nombres."','";
    $llamar.=$apellidos."','";
    $llamar.=$passw."');"; 
    
    $resultado = $this->db->query($llamar)->row()->respuesta;
    
    return $resultado;
      
  }
  
  public function loginUsuario($usuario,$passw)
   {
    
    $llamar="CALL sp_login_tbl_usuario('";
    $llamar.=$usuario."','";
    $llamar.=$passw."');"; 

    $resultado = $this->db->query($llamar);
    mysqli_next_result( $this->db->conn_id );
    if($resultado->num_rows()>0){

        $row = $resultado->row(); 
        $session_data = array(
            'id_usuario' => $row->id_usuario,
            'usuario' => $row->usuario,
            'nombres' => $row->nombres,
            'apellidos' => $row->apellidos
        );
        // Los datos del usuario son ingresados a una variable de sesión
        $this->session->set_userdata('usuarioLogueado', $session_data);
        $row=200;
    }
    else
        $row = 99; 
    
      $resultado->free_result();
      return $row;

   }

}