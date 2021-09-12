<?php
class UsuarioModel extends CI_Model
{
    public $ID_ROL;
    public $ID_PERSONA;
    public $USERNAME;
    public $PASSWORD;
    public $ESTADO;
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('auditoria');
    }

    public function getAll()
    {
        $result = null;
        $sql = "SELECT * FROM usuario ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
         
    }

    public function getOne($idUsuario)
    {
        $result = null;
        $sql = "SELECT * FROM usuario WHERE ID_USUARIO = $idUsuario ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
         
    }

    public function getByPersona($idPersona)
    {
        $result = null;
        $sql = "SELECT * FROM usuario WHERE ID_PERSONA = $idPersona ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
         
    }

    public function createOne()
    {
        $this->ID_ROL = $_POST['ID_ROL'];
        $this->ID_PERSONA = $_POST['ID_PERSONA'];
        $this->USERNAME = $_POST['USERNAME'];
        $this->PASSWORD = $_POST['PASSWORD'];
        $this->ESTADO = 1;
        $this->db->insert('usuario', $this);       
    }

    public function updateOne($idPersona)
    {
        $this->ID_ROL = $_POST['ID_ROL'];
        $this->ID_PERSONA = $_POST['ID_PERSONA'];
        $this->USERNAME = $_POST['USERNAME'];
        $this->PASSWORD = $_POST['PASSWORD'];
        $this->ESTADO = 1;
        $this->db->update('usuario', $this, array('ID_USUARIO' => $idPersona));
    }

    public function deleteOne($idPersona)
    {
        $this->db->delete('usuario', array('ID_USUARIO' => $idPersona));
    }

    public function existUsuario($correo, $password)
    {
        $result = null;
        $sql = "SELECT * FROM usuario WHERE USERNAME = '$correo' AND PASSWORD = '$password'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
         
    }
}
