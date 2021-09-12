<?php
class RolModel extends CI_Model
{
    public $ID_ROL;
    public $NOMBRE;
   
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
        $sql = "SELECT * FROM rol ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
         
    }

    public function getOne($idRol)
    {
        $result = null;
        $sql = "SELECT * FROM rol WHERE ID_ROL = $idRol ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
         
    }

    public function createOne()
    {
        $this->ID_ROL = $_POST['NOMBRE'];
        $this->ESTADO = 1;
        $this->db->insert('usuario', $this);       
    }

    public function updateOne($idRol)
    {
        $this->ID_ROL = $_POST['NOMBRE'];
        $this->ESTADO = 1;
        $this->db->update('rol', $this, array('ID_USUARIO' => $idRol));
    }

    public function deleteOne($idRol)
    {
        $this->db->delete('rol', array('ID_ROL' => $idRol));
    }
}
