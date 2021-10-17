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
		$this->load->model('CursoInscritoModel', 'mCursoInscrito');
		$this->load->model('AreaCategoriaModel', 'mAreaCategoria');
		$this->load->model('ClasificacionCursoModel', 'mClasificacionCurso');
		$this->load->model('AreaCategoriaModel', 'mAreaCategoria');
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

	public function sugerencias($filtro = "")
	{
		$this->load->model('ContenidoModel', 'mContenido');
		$filtro = (isset($filtro)) ? explode("-", $filtro) : [];
		$cursos = $this->mCurso->getSugerencias(implode(',', $filtro));
		$area_categoria = $this->mAreaCategoria->getAll();
		$this->layouts->view('curso/sugerencia', compact('cursos', 'area_categoria', 'filtro'));
	}

	public function miscursos($filtro = "")
	{
		$this->load->model('ContenidoModel', 'mContenido');
		$filtro = (isset($filtro)) ? explode("-", $filtro) : [];
		$cursos = $this->mCurso->misCursosInscritos(implode(',', $filtro));
		$area_categoria = $this->mAreaCategoria->getAll();
		$this->layouts->view('curso/miscursos', compact('cursos', 'area_categoria', 'filtro'));
	}

	public function inscribirse($idCurso)
	{
		$curso = $this->mCurso->getOne($idCurso);
		$lblBoton = 'Inscribirse';
		$lnkBoton = 'save_inscripcion';
		$lnkCancel = 'sugerencias';
		$this->layouts->view('curso/readCurso', compact('curso', 'lblBoton', 'lnkBoton', 'lnkCancel'));
	}

	public function save_inscripcion($idCurso)
	{
		$this->mCursoInscrito->createOne($idCurso);
		redirect('curso/sugerencias');
	}

	public function desinscribirse($idCurso)
	{
		$curso = $this->mCurso->getOne($idCurso);
		$lblBoton = "Desinscribirse";
		$lnkBoton = 'save_desinscripcion';
		$lnkCancel = 'miscursos';
		$this->layouts->view('curso/readCurso', compact('curso', 'lblBoton', 'lnkBoton', 'lnkCancel'));
	}

	public function save_desinscripcion($idCurso)
	{
		$this->mCursoInscrito->deleteOne($idCurso);
		redirect('curso/miscursos');
	}

	public function tutorial()
	{
		$this->layouts->view('curso/tutorial');
	}
}
