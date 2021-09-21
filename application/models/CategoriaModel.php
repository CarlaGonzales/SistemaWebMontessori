<?php
class CategoriaModel extends CI_Model
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
        $sql = "SELECT * FROM categoria WHERE estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idCategoria)
    {
        $result = null;
        $sql = "SELECT  categoria.*
                FROM categoria 
                WHERE ID_CATEGORIA = $idCategoria AND categoria.ESTADO = 1 ";

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
        $this->db->insert('categoria', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;

    }

    public function updateOne($idCategoria)
    {
        $data = uptDatosAuditoria($this->setData());
        $this->db->update('categoria', $data, array('ID_CATEGORIA' => $idCategoria));
    }

    public function deleteOne($idCategoria)
    {
        //$this->db->delete('categoria', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('categoria', $this, array('ID_CATEGORIA' => $idCategoria));
    }

    private function setData()
    {
        $data = [];

        if (isset($_POST['NOMBRE'])) {
            $data['NOMBRE'] = $_POST['NOMBRE'];
        }
        
        return $data;
    }
}
