<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ingreso extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('UsuarioModel', 'mUsuario');
		$this->load->model('PersonaModel', 'mPersona');
		$this->load->model('RolModel', 'mRol');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$password = $_POST['password'];
        $email = $_POST['email'];
		$usuario = $this->mUsuario->existUsuario($email, $password);
		if(isset($usuario)){
			$persona = $this->mPersona->getOne($usuario->ID_PERSONA);
			//print_r($usuario);
			//exit;
			$rol = $this->mRol->getOne($usuario->ID_ROL);
			//print_r($rol);
		    //exit;
			$newdata = array(
				'username'  => $persona->NOMBRE." ".$persona->APELLIDO_PAT." ".$persona->APELLIDO_MAT,
				'rol'  => $rol->NOMBRE ,
				'email'     => $email,
				'UID'     => $usuario->ID_USUARIO,
				'logged_in' => TRUE
			);
		
			$this->session->set_userdata($newdata);
			redirect('inicio');
		}else{
			redirect('ingreso');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		session_destroy();
		redirect('ingreso');
	}
}
