<?php
defined('BASEPATH') or exit('No direct script access allowed');

class upload extends CI_Controller
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
	}

	public function index()
	{
		$ds = "/";

		$storeFolder = '../../uploads';

		if (!empty($_FILES)) {

			$tempFile = $_FILES['file']['tmp_name'];

			$targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;

			//$targetFile =  $targetPath . $_FILES['file']['name'];
			$name = $_FILES['file']['name'];
			$array_name = explode(".", $name);
			$ext = end($array_name);
			$today = new DateTime();
			$newfile = $today->getTimestamp() . '.' . $ext;
			$targetFile = $targetPath . $newfile;

			$result = array("uploaded" => false);
			if (move_uploaded_file($tempFile, $targetFile)) {
				$result = array("uploaded" => true, "name" => $newfile);
			}
			header('Content-type: text/json');              //3
			header('Content-type: application/json');
			echo json_encode($result);
		} else {
			$result  = array();

			$files = scandir($storeFolder);                 //1
			if (false !== $files) {
				foreach ($files as $file) {
					if ('.' != $file && '..' != $file) {       //2
						$obj['name'] = $file;
						$obj['size'] = filesize($storeFolder . $ds . $file);
						$result[] = $obj;
					}
				}
			}

			header('Content-type: text/json');              //3
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}
}
