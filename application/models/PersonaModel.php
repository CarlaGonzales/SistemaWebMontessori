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
}
