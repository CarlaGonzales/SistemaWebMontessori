<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actividad extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('ActividadModel', 'mActividad');
		$this->load->model('CursoModel', 'mCurso');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}

		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_css('plugins/summernote/summernote-bs4.min.css');
		$this->layouts->add_include_js('plugins/summernote/summernote-bs4.min.js');
		$this->layouts->add_include_js('plugins/summernote/lang/summernote-es-ES.js');

		$this->layouts->add_include_css('plugins/dropzone/dropzone.css');
		$this->layouts->add_include_js('plugins/dropzone/dropzone.js');

		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
		$this->layouts->add_include_js('dist/pages/actividad/formActividad.js');
		$this->layouts->add_include_js('dist/pages/upload/upload.js');
	}

	public function index($idCurso)
	{
		$actividades = $this->mActividad->getByCurso($idCurso);
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('actividades', compact('actividades', 'idCurso', 'curso'));
	}

	public function nuevo($idCurso)
	{
		$boton = "Guardar";
		$action = "saveNuevo/" . $idCurso;
		$isPost = true;
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('formActividad', compact('idCurso', 'boton', 'action', 'isPost', 'curso'));
	}

	public function saveNuevo($idCurso)
	{
		$idActividad = $this->mActividad->createOne($idCurso);
		redirect('actividad/index/' . $idCurso);
	}

	public function editar($idActividad)
	{
		$boton = "Actualizar";
		$actividad = $this->mActividad->getOne($idActividad);
		$idCurso = $actividad->ID_CURSO;
		$action = "saveEditar/$idCurso/$idActividad";
		$isPost = true;
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('formActividad', compact('idCurso', 'boton', 'action', 'isPost', 'actividad', 'curso'));
	}

	public function saveEditar($idCurso, $idActividad)
	{
		$this->mActividad->updateOne($idActividad);
		redirect('actividad/index/' . $idCurso);
	}

	public function eliminar($idActividad)
	{
		$boton = "Eliminar";
		$actividad = $this->mActividad->getOne($idActividad);
		$idCurso = $actividad->ID_CURSO;
		$action = "saveEliminar/$idCurso/$idActividad";
		$curso = $this->mCurso->getOne($idCurso);
		$isPost = false;
		$this->layouts->view('formActividad', compact('idCurso', 'boton', 'action', 'isPost', 'actividad', 'curso'));
	}

	public function saveEliminar($idCurso, $idActividad)
	{
		$this->mActividad->deleteOne($idActividad);
		redirect('actividad/index/' . $idCurso);
	}

	public function publicar($idActividad)
	{
		$this->mActividad->publicar($idActividad, true);
		redirect('actividad/index');
	}

	public function ocultar($idActividad)
	{
		$this->mActividad->publicar($idActividad, false);
		redirect('actividad/index');
	}
}
