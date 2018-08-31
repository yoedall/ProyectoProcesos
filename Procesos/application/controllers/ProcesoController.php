<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProcesoController extends CI_Controller {

// Muestra la lista de todos los Procesos (con o sin filtro de busqueda).{{{..... 

public function observarProcesos(){
    $this->load->model('/ProcesoModel');
      
      $fechaDesde= $this->input->post('fechaDesde');
      if($fechaDesde)
        $fechaDesde= date('Y-m-d',strtotime($this->input->post('fechaDesde')));

      $fechaHasta= $this->input->post('fechaHasta');
      if($fechaDesde)
        $fechaHasta= date('Y-m-d',strtotime($this->input->post('fechaHasta')));

    $data['resultado']=$this->ProcesoModel->obtenerProceso($fechaDesde,$fechaHasta,0);
    
    $this->load->view("proceso/proceso_observar",$data);
}

// Renderiza el formulario para el Registro del Proceso
public function mostrarRegistroProceso(){

  $this->load->model('/SedeModel');
  $data['sedes']=$this->SedeModel->obtenerSedes();
  $this->load->view("proceso/proceso_registro",$data);
  $this->load->view('shared/modalError');
}

// Se registra el Proceso en la BD
public function registrarProceso(){
  $this->load->model('/ProcesoModel');
  $descripcion= $this->input->post('descripcion');
  $sede= $this->input->post('sede');
  $presupuesto= $this->input->post('presupuesto');
  $resultado=$this->ProcesoModel->registrarProceso($descripcion,$sede,$presupuesto);
  $this->load->view("proceso/proceso_observar");
  $this->load->view('proceso/proceso_observar_funcion_automatica');

}

// Renderiza el formulario para el Editar el Proceso
public function mostrarEditarProceso(){

  $id= $this->input->post('id');

  $this->load->model('/SedeModel');
  $data['sedes']=$this->SedeModel->obtenerSedes();

  $this->load->model('/ProcesoModel');
  $data['resultado']=$this->ProcesoModel->obtenerProceso('','',$id);

  $this->load->view("proceso/proceso_registro",$data);
  $this->load->view('shared/modalError');
}

// Se actualizan los cambios del Proceso seleccionado
public function editarProceso(){
  $this->load->model('/ProcesoModel');
  $descripcion= $this->input->post('descripcion');
  $sede= $this->input->post('sede');
  $id= $this->input->post('id');
  $presupuesto= $this->input->post('presupuesto');
  $resultado=$this->ProcesoModel->editarProceso($descripcion,$sede,$presupuesto,$id);
  $this->load->view("proceso/proceso_observar");
  $this->load->view('proceso/proceso_observar_funcion_automatica');

}

// Se elimina un proceso de acuerdo a su numero (PK)
public function eliminarProceso(){
  $this->load->model('/ProcesoModel');
  $id= $this->input->post('id');
  $resultado=$this->ProcesoModel->eliminarProceso($id);
  $this->load->view("proceso/proceso_observar");
  $this->load->view('proceso/proceso_observar_funcion_automatica');

}

}