<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		$this->load->model('PersonaModel', 'mPersona');
		$this->load->model('UsuarioModel', 'mUsuario');
		if($this->session->userdata('username') == ''){
			redirect('/ingreso');
		}
		//$this->layouts->add_include('css/main.css');
	}

	public function index()
	{
		$personas = $this->mPersona->getAll();
		$this->layouts->view('personas', compact('personas'));
	}

	public function habilitar($idPersona = 0)
	{
		$boton = "Habilitar";
		$action = "saveHabilitar";
		$isPost = true;
		$persona = $this->mPersona->getOne($idPersona);
		$this->layouts->view('formUsuario', compact('boton', 'action', 'isPost', 'persona'));
	}

	public function deshabilitar($idUsuario)
	{
		$boton = "Deshabilitar";
		$action = "saveDeshabilitar/$idUsuario";
		$isPost = false;
		$usuario = $this->mUsuario->getOne($idUsuario);
		$persona = $this->mPersona->getOne($usuario->ID_PERSONA);
		$this->layouts->view('formUsuario', compact('boton', 'action', 'isPost', 'usuario', 'persona'));
	}

	public function saveHabilitar(){
		$this->mUsuario->createOne();
		redirect('personas/index');
	}

	public function saveDeshabilitar($idUsuario){
		$this->mUsuario->deleteOne($idUsuario);
		redirect('personas/index');
	}
}
	


