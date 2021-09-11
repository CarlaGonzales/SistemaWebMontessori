<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Layouts');
		$this->load->library('session');
		if($this->session->userdata('username') == ''){
			redirect('/ingreso');
		}
		//$this->layouts->add_include('css/main.css');
	}
	
	public function index()
	{
		$this->layouts->view('inicio');
	}

	//public function historia()
	//{
	//	$this->layouts->view('historia');
	//}

	//public function carreras()
	//{
//$this->layouts->view('carreras');
	//}

	//public function agenda()
	//{
	//	$this->layouts->view('agenda');
	//}

	//public function contactos()
	//{
		//$this->layouts->view('contactos');
	//}
}