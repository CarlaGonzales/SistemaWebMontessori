<?php
class CursoInscritoModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('auditoria');
    }

    public function createOne($id_curso)
    {
        $uid = $this->session->userdata('UID');
        $data = addDatosAuditoria([]);
        $data['id_usuario'] = $uid;
        $data['id_curso'] = $id_curso;
        $this->db->insert('curso_inscrito', $data);
    }

    public function deleteOne($id_curso)
    {
        $uid = $this->session->userdata('UID');
        $this->db->delete('curso_inscrito', array('ID_USUARIO' => $uid, 'ID_CURSO' => $id_curso));
    }
}
