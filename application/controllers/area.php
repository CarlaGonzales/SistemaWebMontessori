<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('AreaModel', 'mArea');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}

		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_css('plugins/summernote/summernote-bs4.min.css');
		$this->layouts->add_include_js('plugins/summernote/summernote-bs4.min.js');
		$this->layouts->add_include_js('plugins/summernote/lang/summernote-es-ES.js');
		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
		$this->layouts->add_include_js('dist/pages/area/formArea.js');
	}

	public function index()
	{
		$areas = $this->mArea->getAll();
		$this->layouts->view('areas', compact('areas'));
	}

	public function nuevo()
	{
		$boton = "Guardar";
		$action = "saveNuevo";
		$isPost = true;
		$this->layouts->view('formArea', compact('boton', 'action', 'isPost'));
	}

	public function saveNuevo()
	{
		$this->mArea->createOne();
		redirect('area/index');
	}

	public function editar($idArea)
	{
		$boton = "Actualizar";
		$action = "saveEditar/$idArea";
		$isPost = true;
		$area = $this->mArea->getOne($idArea);
		$this->layouts->view('formArea', compact('boton', 'action', 'isPost', 'area'));
	}

	public function saveEditar($idArea)
	{
		$this->mArea->updateOne($idArea);
		redirect('area/index');
	}

	public function eliminar($idArea)
	{
		$boton = "Eliminar";
		$action = "saveEliminar/$idArea";
		$isPost = false;
		$area = $this->mArea->getOne($idArea);
		$this->layouts->view('formArea', compact('boton', 'action', 'isPost', 'area'));
	}

	public function saveEliminar($idArea)
	{
		$this->mArea->deleteOne($idArea);
		redirect('area/index');
	}
}
