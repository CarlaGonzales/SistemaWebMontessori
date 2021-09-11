<?php
class ContenidoModel extends CI_Model
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
        $sql = "SELECT contenido.*, persona.* 
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
        $data = $this->addDatosAuditoria($this->setData());
        $this->db->insert('contenido', $data);
    }

    public function updateOne($idContenido)
    {
        $data = $this->uptDatosAuditoria($this->setData());
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
