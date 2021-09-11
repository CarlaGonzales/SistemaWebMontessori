<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curso extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('CursoModel', 'mCurso');
		$this->load->model('AreaCategoriaModel', 'mAreaCategoria');
		$this->load->model('ClasificacionCursoModel', 'mClasificacionCurso');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}

		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_css('plugins/summernote/summernote-bs4.min.css');
		$this->layouts->add_include_js('plugins/summernote/summernote-bs4.min.js');
		$this->layouts->add_include_js('plugins/summernote/lang/summernote-es-ES.js');
		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
		$this->layouts->add_include_js('dist/pages/curso/formCurso.js');
	}

	public function index()
	{
		$cursos = $this->mCurso->getMisCursos();
		$this->layouts->view('cursos', compact('cursos'));
	}

	public function listar()
	{
		$cursos = $this->mCurso->getPublicados();
		$this->layouts->view('publicados', compact('cursos'));
	}

	public function numero($idCurso)
	{
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('readCurso', compact('curso'));
	}

	public function nuevo()
	{
		$boton = "Guardar";
		$action = "saveNuevo";
		$isPost = true;
		$area_categoria_sel = [];
		$area_categoria = $this->mAreaCategoria->getAll();
		$this->layouts->view('formCurso', compact('boton', 'action', 'isPost', 'area_categoria', 'area_categoria_sel'));
	}

	public function saveNuevo()
	{
		$idCurso = $this->mCurso->createOne();
		$this->mClasificacionCurso->createOne($idCurso);
		redirect('curso/index');
	}

	public function editar($idCurso)
	{
		$boton = "Actualizar";
		$action = "saveEditar/$idCurso";
		$isPost = true;
		$area_categoria = $this->mAreaCategoria->getAll();
		$area_categoria_sel = $this->mClasificacionCurso->getByCurso($idCurso);
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('formCurso', compact('boton', 'action', 'isPost', 'area_categoria', 'curso', 'area_categoria_sel'));
	}

	public function saveEditar($idCurso)
	{
		$this->mCurso->updateOne($idCurso);
		$this->mClasificacionCurso->updateOne($idCurso);
		redirect('curso/index');
	}

	public function eliminar($idCurso)
	{
		$boton = "Eliminar";
		$action = "saveEliminar/$idCurso";
		$isPost = false;
		$curso = $this->mCurso->getOne($idCurso);
		$this->layouts->view('formCurso', compact('boton', 'action', 'isPost', 'curso'));
	}

	public function saveEliminar($idCurso)
	{
		$this->mCurso->deleteOne($idCurso);
		redirect('curso/index');
	}

	public function publicar($idCurso)
	{
		$this->mCurso->publicar($idCurso, true);
		redirect('curso/index');
	}

	public function ocultar($idCurso)
	{
		$this->mCurso->publicar($idCurso, false);
		redirect('curso/index');
	}
}
