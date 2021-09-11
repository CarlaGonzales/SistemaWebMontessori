<?php
class CursoModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        $result = null;
        $sql = "SELECT * FROM curso WHERE estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getMisCursos()
    {
        $result = null;
        $uid = $this->session->userdata('UID');
        $sql = "SELECT * FROM curso WHERE estado = 1 AND id_usuario=$uid ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getPublicados()
    {
        $result = null;
        $sql = "SELECT curso.*, persona.* 
                FROM curso
                INNER JOIN usuario ON usuario.id_usuario = curso.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                WHERE curso.estado = 1 AND fecha_publicacion IS NOT NULL ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idCurso)
    {
        $result = null;
        $sql = "SELECT  curso.*, persona.*
                FROM curso 
                INNER JOIN usuario ON usuario.id_usuario = curso.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                WHERE ID_CURSO = $idCurso AND curso.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }

    public function createOne()
    {
        $data = $this->addDatosAuditoria($this->setData());
        $this->db->insert('curso', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateOne($idCurso)
    {
        $data = $this->uptDatosAuditoria($this->setData());
        $this->db->update('curso', $data, array('ID_CURSO' => $idCurso));
    }

    public function publicar($idCurso, $publicar = true)
    {
        $data = [];
        if ($publicar) {
            $data['FECHA_PUBLICACION'] = (new DateTime())->format('Y-m-d');
        } else {
            $data['FECHA_PUBLICACION'] = null;
        }
        $this->db->update('curso', $data, array('ID_CURSO' => $idCurso));
    }

    public function deleteOne($idCurso)
    {
        //$this->db->delete('curso', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('curso', $this, array('ID_CURSO' => $idCurso));
    }

    private function setData()
    {
        $data = [];

        $data['ID_USUARIO'] = $this->session->userdata('UID');

        if (isset($_POST['TITULO'])) {
            $data['TITULO'] = $_POST['TITULO'];
        }
        if (isset($_POST['SUB_TITULO'])) {
            $data['SUB_TITULO'] = $_POST['SUB_TITULO'];
        }
        if (isset($_POST['DESCRIPCION'])) {
            $data['DESCRIPCION'] = $_POST['DESCRIPCION'];
        }
        if (isset($_POST['PUBLICAR'])) {
            $data['FECHA_PUBLICACION'] = (new DateTime())->format('Y-m-d');
        } else {
            $data['FECHA_PUBLICACION'] = null;
        }
        return $data;
    }

    private function addDatosAuditoria($data)
    {
        $data['FECHA_REG'] = (new DateTime())->format('Y-m-d H:i:s');
        $data['USUARIO_REG'] =  $this->session->userdata('email');
        $data['ESTADO'] = 1;
        return $data;
    }

    private function uptDatosAuditoria($data)
    {
        $data['FECHA_ACT'] = (new DateTime())->format('Y-m-d H:i:s');
        $data['USUARIO_ACT'] =  $this->session->userdata('email');
        return $data;
    }
}
