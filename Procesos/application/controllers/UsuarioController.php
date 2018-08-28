<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  UsuarioController extends CI_Controller {

  // Renderiza la vista login o la vista de procesos segun 
  // los datos de sesion activos
  public function index()
  {
    $this->load->view('shared/header');
    //se comprueba la existencia de una sesion de usuario
    if($this->session->userdata('usuarioLogueado')!==null){ 
      $this->load->view('proceso/proceso_observar');
      $this->load->view('proceso/proceso_observar_funcion_automatica');
    }
    else
      $this->load->view('usuario/usuario_login');
    
    $this->load->view('shared/modalError');
    $this->load->view('shared/footer');
     
  }

  // Se muestra el formulario para el registro del Usuario
  public function mostrarRegistroUsuario()
  {
    $this->load->view('usuario/usuario_registro');
    $this->load->view('shared/modalError');
  }

  // Se registra el Usuario en la BD
  public function registrarUsuario()
  {
    $this->load->model('/UsuarioModel');
    $nombres= $this->input->post('nombres');
    $apellidos= $this->input->post('apellidos');
    $usuario= $this->input->post('usuario');
    $passw=sha1($this->input->post('passw'));

    $resultado=$this->UsuarioModel->registrarUsuario($nombres,$apellidos,$usuario,$passw);

    echo $resultado;

  }

  // El usuario inicia sesion y se almacenan sus datos
  // en uns variable de seesion
  public function loginUsuario()
  {
    $this->load->model('/UsuarioModel');
    $usuario= $this->input->post('usuario');
    $passw=sha1($this->input->post('passw'));

    $resultado=$this->UsuarioModel->loginUsuario($usuario,$passw);
    if($resultado==99)
      echo $resultado;
    else
    {
      $this->load->view('proceso/proceso_observar');
      $this->load->view('proceso/proceso_observar_funcion_automatica');
    }
      
     
  }
  
  // Se cierra la sesion
  public function cerrarSesion(){

    $this->session->unset_userdata('usuarioLogueado');

  }


}