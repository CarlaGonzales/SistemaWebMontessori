<?php
class PersonaModel extends CI_Model
{
    public $NOMBRE;
    public $APELLIDO_PAT;
    public $APELLIDO_MAT;
    public $FECHA_NAC;
    public $DIRECCION;
    public $CORREO;
    public $CELULAR;
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
        $sql = "SELECT persona.*, usuario.ID_USUARIO, rol.NOMBRE ROL
                FROM persona
                LEFT JOIN usuario ON usuario.ID_PERSONA = persona.ID_PERSONA
                LEFT JOIN rol ON rol.ID_ROL = usuario.ID_ROL";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getOne($idPersona)
    {
        $result = null;
        $sql = "SELECT * FROM persona WHERE ID_PERSONA = $idPersona ";

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
        $this->db->insert('persona', $data);
    }

    public function updateOne($idPersona)
    {
        $data = uptDatosAuditoria($this->setData());
        $this->db->update('persona', $data, array('ID_PERSONA' => $idPersona));
    }

    public function deleteOne($idPersona)
    {
        //$this->db->delete('persona', array('ID_PERSONA' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('persona', $this, array('ID_PERSONA' => $idPersona));
    }

    private function setData()
    {
        $data = [];

        if (isset($_POST['NOMBRE'])) {
            $data['NOMBRE'] = $_POST['NOMBRE'];
        }
        if (isset($_POST['APELLIDO_PAT'])) {
            $data['APELLIDO_PAT'] = $_POST['APELLIDO_PAT'];
        }
        if (isset($_POST['APELLIDO_MAT'])) {
            $data['APELLIDO_MAT'] = $_POST['APELLIDO_MAT'];
        }
        if (isset($_POST['FECHA_NAC'])) {
            $data['FECHA_NAC'] = $_POST['FECHA_NAC'];
        }
        if (isset($_POST['DIRECCION'])) {
            $data['DIRECCION'] = $_POST['DIRECCION'];
        }
        if (isset($_POST['CORREO'])) {
            $data['CORREO'] = $_POST['CORREO'];
        }
        if (isset($_POST['CELULAR'])) {
            $data['CELULAR'] = $_POST['CELULAR'];
        }
        return $data;
    }

    public function getAllByCurso($idCurso)
    {
        $result = null;
        $sql = "SELECT persona.*, curso_actividad.NUM_ACTIVIDAD, estado_actividad.CANT_FIN_ACT
                FROM persona
                INNER JOIN usuario ON usuario.ID_PERSONA = persona.ID_PERSONA
                INNER JOIN curso_inscrito ON curso_inscrito.ID_USUARIO = usuario.ID_USUARIO AND curso_inscrito.ID_CURSO = $idCurso
                LEFT JOIN (SELECT ID_CURSO, COUNT(ID_ACTIVIDAD) NUM_ACTIVIDAD
                            FROM actividad
                            WHERE actividad.ESTADO = 1
                            GROUP BY ID_CURSO) curso_actividad ON  curso_actividad.ID_CURSO = curso_inscrito.ID_CURSO
                LEFT JOIN ( SELECT usuario.ID_PERSONA, actividad.ID_CURSO, COUNT(estado_actividad.ID_ACTIVIDAD) CANT_FIN_ACT
                            FROM estado_actividad
                            INNER JOIN actividad ON actividad.ID_ACTIVIDAD=estado_actividad.ID_ACTIVIDAD
							INNER JOIN usuario ON usuario.ID_USUARIO=estado_actividad.ID_USUARIO
                            WHERE estado_actividad.TERMINADO = 1
                            GROUP BY usuario.ID_PERSONA, actividad.ID_CURSO) estado_actividad ON estado_actividad.ID_CURSO = curso_inscrito.ID_CURSO AND estado_actividad.ID_PERSONA = persona.ID_PERSONA
                ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
        }

        return $result;
    }
}
