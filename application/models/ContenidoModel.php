<?php
class ContenidoModel extends CI_Model
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
        $sql = "SELECT * FROM contenido WHERE estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getMisContenidos()
    {
        $result = null;
        $uid = $this->session->userdata('UID');
        $sql = "SELECT * FROM contenido WHERE estado = 1 AND id_usuario=$uid ";

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
        $sql = "SELECT contenido.*, persona.*, (SELECT a.id_area 
                                                FROM area a
                                                INNER JOIN area_categoria ac ON a.ID_AREA=ac.ID_AREA
                                                INNER JOIN clasificacion_contenido cc ON ac.ID_CATDIM = cc.ID_CATDIM
                                                WHERE cc.id_contenido = contenido.id_contenido
                                                ORDER BY RAND() 
                                                LIMIT 1) AS ID_AREA 
                FROM contenido
                INNER JOIN usuario ON usuario.id_usuario = contenido.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                WHERE contenido.estado = 1 AND fecha_publicacion IS NOT NULL ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idContenido)
    {
        $result = null;
        $sql = "SELECT  contenido.*, persona.*
                FROM contenido 
                INNER JOIN usuario ON usuario.id_usuario = contenido.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                WHERE ID_CONTENIDO = $idContenido AND contenido.ESTADO = 1 ";

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
        $this->db->insert('contenido', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateOne($idContenido)
    {
        $data = uptDatosAuditoria($this->setData());
        $this->db->update('contenido', $data, array('ID_CONTENIDO' => $idContenido));
    }

    public function publicar($idContenido, $publicar = true)
    {
        $data = [];
        if ($publicar) {
            $data['FECHA_PUBLICACION'] = (new DateTime())->format('Y-m-d');
        } else {
            $data['FECHA_PUBLICACION'] = null;
        }
        $this->db->update('contenido', $data, array('ID_CONTENIDO' => $idContenido));
    }

    public function deleteOne($idContenido)
    {
        //$this->db->delete('contenido', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('contenido', $this, array('ID_CONTENIDO' => $idContenido));
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
}
