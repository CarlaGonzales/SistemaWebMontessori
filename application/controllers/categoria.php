<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('CategoriaModel', 'mCategoria');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}

		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_css('plugins/summernote/summernote-bs4.min.css');
		$this->layouts->add_include_js('plugins/summernote/summernote-bs4.min.js');
		$this->layouts->add_include_js('plugins/summernote/lang/summernote-es-ES.js');
		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
		$this->layouts->add_include_js('dist/pages/categoria/formCategoria.js');
	}

	public function index()
	{
		$categorias = $this->mCategoria->getAll();
		$this->layouts->view('categorias', compact('categorias'));
	}

	public function nuevo()
	{
		$boton = "Guardar";
		$action = "saveNuevo";
		$isPost = true;
		$this->layouts->view('formCategoria', compact('boton', 'action', 'isPost'));
	}

	public function saveNuevo()
	{
		$this->mCategoria->createOne();
		redirect('categoria/index');
	}

	public function editar($idCategoria)
	{
		$boton = "Actualizar";
		$action = "saveEditar/$idCategoria";
		$isPost = true;
		$categoria = $this->mCategoria->getOne($idCategoria);
		$this->layouts->view('formCategoria', compact('boton', 'action', 'isPost', 'categoria'));
	}

	public function saveEditar($idCategoria)
	{
		$this->mCategoria->updateOne($idCategoria);
		redirect('categoria/index');
	}

	public function eliminar($idCategoria)
	{
		$boton = "Eliminar";
		$action = "saveEliminar/$idCategoria";
		$isPost = false;
		$categoria = $this->mCategoria->getOne($idCategoria);
		$this->layouts->view('formCategoria', compact('boton', 'action', 'isPost', 'categoria'));
	}

	public function saveEliminar($idCategoria)
	{
		$this->mCategoria->deleteOne($idCategoria);
		redirect('categoria/index');
	}
}
