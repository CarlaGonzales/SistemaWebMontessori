<?php
class EstadoActividadModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('auditoria');
    }

    public function createOne($id_actividad)
    {
        $uid = $this->session->userdata('UID');
        $data = addDatosAuditoria($_POST);
        $data['id_usuario'] = $uid;
        $data['id_actividad'] = $id_actividad;
        /**echo "CREANDO <pre>";
        print_r($data);*/
        $this->db->insert('estado_actividad', $data);
    }

    public function updateOne($id_actividad)
    {
        $uid = $this->session->userdata('UID');
        $data = uptDatosAuditoria($_POST);
        /*echo "ACTUALIZANDO <pre>";
        print_r($data);*/
        $this->db->update('estado_actividad', $data, array('ID_USUARIO' => $uid, 'ID_ACTIVIDAD' => $id_actividad));
    }

    public function deleteOne($id_actividad)
    {
        $uid = $this->session->userdata('UID');
        $this->db->delete('estado_actividad', array('ID_USUARIO' => $uid, 'ID_ACTIVIDAD' => $id_actividad));
    }

    public function getOne($id_actividad)
    {
        $result = null;
        $uid = $this->session->userdata('UID');
        $sql = "SELECT *
                FROM estado_actividad 
                WHERE ID_ACTIVIDAD = $id_actividad AND ID_USUARIO = $uid ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }

    public function getAll($id_curso)
    {
        $result = null;
        $uid = $this->session->userdata('UID');
        $sql = "SELECT estado_actividad.*, actividad.*
                FROM actividad
                LEFT JOIN estado_actividad ON estado_actividad.id_actividad = actividad.id_actividad AND estado_actividad.id_usuario = $uid
                WHERE actividad.id_curso = $id_curso
                AND actividad.estado = 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }
}
