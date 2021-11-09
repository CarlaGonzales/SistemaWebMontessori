<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('PersonaModel', 'mPersona');
		$this->load->model('UsuarioModel', 'mUsuario');
		$this->load->model('CursoModel', 'mCurso');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}
		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
	}

	public function index()
	{
		$personas = $this->mPersona->getAll();
		$this->layouts->view('personas', compact('personas'));
	}

	public function nuevo()
	{
		$boton = "Guardar";
		$action = "saveNuevo";
		$isPost = true;
		$this->layouts->view('formPersona', compact('boton', 'action', 'isPost'));
	}

	public function editar($idPersona)
	{
		$boton = "Actualizar";
		$action = "saveEditar/$idPersona";
		$isPost = true;
		$persona = $this->mPersona->getOne($idPersona);
		$this->layouts->view('formPersona', compact('boton', 'action', 'isPost', 'persona'));
	}

	public function eliminar($idPersona)
	{
		$boton = "Eliminar";
		$action = "saveEliminar/$idPersona";
		$isPost = false;
		$persona = $this->mPersona->getOne($idPersona);
		$usuario = $this->mUsuario->getByPersona($idPersona);
		$this->layouts->view('formPersona', compact('boton', 'action', 'isPost', 'persona', 'usuario'));
	}

	public function saveNuevo()
	{
		$this->mPersona->createOne();
		redirect('personas/index');
	}

	public function saveEditar($idPersona)
	{
		$this->mPersona->updateOne($idPersona);
		redirect('personas/index');
	}

	public function saveEliminar($idPersona)
	{
		$this->mPersona->deleteOne($idPersona);
		redirect('personas/index');
	}

	public function reporte($idUsuario=0)
	{
		$this->layouts->add_include_js('plugins/chart.js/Chart.min.js');
		$this->layouts->add_include_js('dist/pages/persona/reporte.js');
		
		$estudiantes = $this->mPersona->getAllEstudiantes();
		$cursos = null;
		if (isset($idUsuario)) {
			$cursos = $this->mCurso->getAllByUsuario($idUsuario);
		}
		$this->layouts->view('persona/reporte', compact('cursos', 'idUsuario', 'estudiantes'));
	}
}
