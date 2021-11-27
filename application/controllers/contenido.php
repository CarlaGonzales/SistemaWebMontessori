<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contenido extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('ContenidoModel', 'mContenido');
		$this->load->model('AreaCategoriaModel', 'mAreaCategoria');
		$this->load->model('ClasificacionContenidoModel', 'mClasificacionContenido');
		if ($this->session->userdata('username') == '') {
			redirect('/ingreso');
		}

		$this->layouts->add_include_css('plugins/select2/css/select2.min.css');
		$this->layouts->add_include_css('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');
		$this->layouts->add_include_css('plugins/summernote/summernote-bs4.min.css');
		$this->layouts->add_include_js('plugins/summernote/summernote-bs4.min.js');
		$this->layouts->add_include_js('plugins/summernote/lang/summernote-es-ES.js');
		$this->layouts->add_include_js('plugins/select2/js/select2.full.min.js');
		$this->layouts->add_include_js('dist/pages/contenido/formContenido.js');
	}

	public function index()
	{
		$contenidos = $this->mContenido->getMisContenidos();
		$this->layouts->view('contenidos', compact('contenidos'));
	}

	public function listar()
	{
		$imagenes = array(
			'0' => $this->listarArchivos(getcwd() . "/img/areas/0/"),
			'1' => $this->listarArchivos(getcwd() . "/img/areas/1/"),
			'2' => $this->listarArchivos(getcwd() . "/img/areas/2/"),
			'3' => $this->listarArchivos(getcwd() . "/img/areas/3/"),
			'4' => $this->listarArchivos(getcwd() . "/img/areas/4/")
		);
		$contenidos = $this->mContenido->getPublicados();
		$this->layouts->view('publicados', compact('contenidos', 'imagenes'));
	}

	function listarArchivos($path)
	{
		// Abrimos la carpeta que nos pasan como parámetro
		$dir = opendir($path);
		$respuesta = array();
		// Leo todos los ficheros de la carpeta
		while ($elemento = readdir($dir)) {
			// Tratamos los elementos . y .. que tienen todas las carpetas
			if ($elemento != "." && $elemento != "..") {
				// Si es una carpeta
				if (is_dir($path . $elemento)) {
					// Muestro la carpeta
					//echo "<p><strong>CARPETA: " . $elemento . "</strong></p>";
					// Si es un fichero
				} else {
					// Muestro el fichero
					array_push($respuesta, $elemento);
					//echo "<br />" . $elemento;
				}
			}
		}
		return $respuesta;
	}

	public function numero($idContenido)
	{
		$contenido = $this->mContenido->getOne($idContenido);
		$this->layouts->view('readContenido', compact('contenido'));
	}

	public function nuevo()
	{
		$boton = "Guardar";
		$action = "saveNuevo";
		$isPost = true;
		$area_categoria_sel = [];
		$area_categoria = $this->mAreaCategoria->getAll();
		$this->layouts->view('formContenido', compact('boton', 'action', 'isPost', 'area_categoria', 'area_categoria_sel'));
	}

	public function saveNuevo()
	{
		$idContenido = $this->mContenido->createOne();
		$this->mClasificacionContenido->createOne($idContenido);
		redirect('contenido/index');
	}

	public function editar($idContenido)
	{
		$boton = "Actualizar";
		$action = "saveEditar/$idContenido";
		$isPost = true;
		$area_categoria = $this->mAreaCategoria->getAll();
		$area_categoria_sel = $this->mClasificacionContenido->getByContenido($idContenido);
		$contenido = $this->mContenido->getOne($idContenido);
		$this->layouts->view('formContenido', compact('boton', 'action', 'isPost', 'area_categoria', 'contenido', 'area_categoria_sel'));
	}

	public function saveEditar($idContenido)
	{
		$this->mContenido->updateOne($idContenido);
		$this->mClasificacionContenido->updateOne($idContenido);
		redirect('contenido/index');
	}

	public function eliminar($idContenido)
	{
		$boton = "Eliminar";
		$action = "saveEliminar/$idContenido";
		$isPost = false;
		$contenido = $this->mContenido->getOne($idContenido);
		$this->layouts->view('formContenido', compact('boton', 'action', 'isPost', 'contenido'));
	}

	public function saveEliminar($idContenido)
	{
		$this->mContenido->deleteOne($idContenido);
		redirect('contenido/index');
	}

	public function publicar($idContenido)
	{
		$this->mContenido->publicar($idContenido, true);
		redirect('contenido/index');
	}

	public function ocultar($idContenido)
	{
		$this->mContenido->publicar($idContenido, false);
		redirect('contenido/index');
	}
}
