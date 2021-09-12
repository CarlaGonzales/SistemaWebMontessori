<?php
class ActividadModel extends CI_Model
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
        $sql = "SELECT * FROM actividad WHERE estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getByCurso($idCurso)
    {
        $result = null;
        $sql = "SELECT * FROM actividad WHERE estado = 1 AND id_curso=$idCurso ";

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
        $sql = "SELECT actividad.*, persona.* 
                FROM actividad
                INNER JOIN usuario ON usuario.id_usuario = actividad.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                WHERE actividad.estado = 1 AND fecha_publicacion IS NOT NULL ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idActividad)
    {
        $result = null;
        $sql = "SELECT  actividad.*
                FROM actividad 
                WHERE ID_ACTIVIDAD = $idActividad AND actividad.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }

    public function createOne($idCurso)
    {
        $data = addDatosAuditoria($this->setData());
        $data['ID_CURSO'] = $idCurso;
        $this->db->insert('actividad', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateOne($idActividad)
    {
        $data = uptDatosAuditoria($this->setData());
        $this->db->update('actividad', $data, array('ID_ACTIVIDAD' => $idActividad));
    }

    public function publicar($idActividad, $publicar = true)
    {
        $data = [];
        if ($publicar) {
            $data['FECHA_PUBLICACION'] = (new DateTime())->format('Y-m-d');
        } else {
            $data['FECHA_PUBLICACION'] = null;
        }
        $this->db->update('actividad', $data, array('ID_ACTIVIDAD' => $idActividad));
    }

    public function deleteOne($idActividad)
    {
        //$this->db->delete('actividad', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('actividad', $this, array('ID_ACTIVIDAD' => $idActividad));
    }

    private function setData()
    {
        $data = [];

        if (isset($_POST['TITULO'])) {
            $data['TITULO'] = $_POST['TITULO'];
        }
        if (isset($_POST['DESCRIPCION'])) {
            $data['DESCRIPCION'] = $_POST['DESCRIPCION'];
        }
        return $data;
    }
}
