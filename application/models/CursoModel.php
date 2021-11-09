<?php
class CursoModel extends CI_Model
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

    public function getSugerencias($filtro = "")
    {
        $result = null;
        $filtroQuery = (isset($filtro) && $filtro != "") ? "INNER JOIN clasificacion_curso ON clasificacion_curso.id_curso = curso.id_curso AND clasificacion_curso.id_catdim IN ($filtro)" : "";
        $uid = $this->session->userdata('UID');
        $sql = "SELECT DISTINCT curso.*, persona.*, (SELECT a.id_area 
                                                     FROM area a
                                                     INNER JOIN area_categoria ac ON a.ID_AREA=ac.ID_AREA
                                                     INNER JOIN clasificacion_curso cc ON ac.ID_CATDIM = cc.ID_CATDIM
                                                     WHERE cc.id_curso = curso.id_curso
                                                     ORDER BY RAND() 
                                                     LIMIT 1) AS ID_AREA 
                FROM curso
                INNER JOIN usuario ON usuario.id_usuario = curso.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                $filtroQuery
                WHERE curso.estado = 1 AND fecha_publicacion IS NOT NULL
                AND curso.id_curso NOT IN ( SELECT curso_inscrito.id_curso
                                            FROM curso_inscrito
                                            WHERE curso_inscrito.id_usuario = $uid )";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function misCursosInscritos($filtro = "")
    {
        $result = null;
        $uid = $this->session->userdata('UID');
        $filtroQuery = (isset($filtro) && $filtro != "") ? "INNER JOIN clasificacion_curso ON clasificacion_curso.id_curso = curso.id_curso AND clasificacion_curso.id_catdim IN ($filtro)" : "";
        $sql = "SELECT DISTINCT curso.*, persona.*, (SELECT a.id_area 
                                                     FROM area a
                                                     INNER JOIN area_categoria ac ON a.ID_AREA=ac.ID_AREA
                                                     INNER JOIN clasificacion_curso cc ON ac.ID_CATDIM = cc.ID_CATDIM
                                                     WHERE cc.id_curso = curso.id_curso
                                                     ORDER BY RAND() 
                                                     LIMIT 1) AS ID_AREA 
                FROM curso
                INNER JOIN usuario ON usuario.id_usuario = curso.id_usuario
                INNER JOIN persona ON persona.id_persona = usuario.id_persona
                INNER JOIN curso_inscrito ON curso_inscrito.id_curso = curso.id_curso AND curso_inscrito.id_usuario = $uid
                $filtroQuery
                WHERE curso.estado = 1 AND curso.fecha_publicacion IS NOT NULL ";
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
        $data = addDatosAuditoria($this->setData());
        $this->db->insert('curso', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateOne($idCurso)
    {
        $data = uptDatosAuditoria($this->setData());
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

    public function getAllByUsuario($idUsuario)
    {
        $result = null;
        $sql = "SELECT curso.*, curso_actividad.NUM_ACTIVIDAD, estado_actividad.CANT_FIN_ACT 
                FROM curso
INNER JOIN curso_inscrito ON curso_inscrito.ID_CURSO = curso.ID_CURSO AND curso_inscrito.ID_USUARIO = $idUsuario
                LEFT JOIN ( SELECT ID_CURSO, COUNT(ID_ACTIVIDAD) NUM_ACTIVIDAD
                            FROM actividad
                            WHERE actividad.ESTADO = 1
                            GROUP BY ID_CURSO) curso_actividad ON  curso_actividad.ID_CURSO = curso.ID_CURSO
                LEFT JOIN ( SELECT usuario.ID_USUARIO, actividad.ID_CURSO, COUNT(estado_actividad.ID_ACTIVIDAD) CANT_FIN_ACT
                            FROM estado_actividad
                            INNER JOIN actividad ON actividad.ID_ACTIVIDAD=estado_actividad.ID_ACTIVIDAD
							INNER JOIN usuario ON usuario.ID_USUARIO=estado_actividad.ID_USUARIO AND usuario.ID_USUARIO = $idUsuario
                            WHERE estado_actividad.TERMINADO = 1
                            GROUP BY usuario.ID_USUARIO, actividad.ID_CURSO) estado_actividad ON estado_actividad.ID_CURSO = curso.ID_CURSO
                WHERE curso.estado = 1 ";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }
}
