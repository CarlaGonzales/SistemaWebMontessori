<?php
class AreaModel extends CI_Model
{
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
        $sql = "SELECT * FROM area WHERE estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idArea)
    {
        $result = null;
        $sql = "SELECT  area.*
                FROM area 
                WHERE ID_AREA = $idArea AND area.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }

    public function createOne()
    {
        $data = addDatosAuditoria($this->setData());
        $this->db->insert('area', $data);
    }

    public function updateOne($idArea)
    {
        $data = uptDatosAuditoria($this->setData());
        $this->db->update('area', $data, array('ID_AREA' => $idArea));
    }

    public function deleteOne($idArea)
    {
        //$this->db->delete('area', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('area', $this, array('ID_AREA' => $idArea));
    }

    private function setData()
    {
        $data = [];

        if (isset($_POST['NOMBRE'])) {
            $data['NOMBRE'] = $_POST['NOMBRE'];
        }

        if (isset($_POST['DESCRIPCION'])) {
            $data['DESCRIPCION'] = $_POST['DESCRIPCION'];
        }
        
        return $data;
    }
}
