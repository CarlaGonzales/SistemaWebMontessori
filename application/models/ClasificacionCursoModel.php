<?php
class ClasificacionCursoModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $ci = get_instance();
        $ci->load->helper('auditoria');
    }

    public function getByCurso($idCurso)
    {
        $result = null;
        $sql = "SELECT ID_CATDIM
                FROM clasificacion_curso cc
                WHERE cc.ID_CURSO = $idCurso
                AND cc.estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function createOne($idCurso)
    {
        $this->db->insert_batch('clasificacion_curso', $this->setData($idCurso));
    }
    
    public function updateOne($idCurso)
    {
        $this->db->delete('clasificacion_curso', array('ID_CURSO' => $idCurso));
        $this->createOne($idCurso);
    }
    /*public function getOne($idArea)
    {
        $result = null;
        $sql = "SELECT  area.*
                FROM area 
                WHERE ID_AREA = $idArea AND area.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }
    
    
    
    
    public function deleteOne($idArea)
    {
        //$this->db->delete('area', array('ID_ROL' => $idPersona));
        $this->ESTADO = 0;
        $this->db->update('area', $this, array('ID_AREA' => $idArea));
    }
    */
    
    private function setData($idCurso)
    {
        $data = [];
        if (isset($_POST['AREA_CATEGORIA'])) {
            if (is_array($_POST['AREA_CATEGORIA'])) {
                foreach ($_POST['AREA_CATEGORIA'] as $areaCategoria) {
                    $oneData = [];
                    $oneData['ID_CATDIM'] = $areaCategoria;
                    $oneData['ID_CURSO'] = strval($idCurso);
                    array_push($data, addDatosAuditoria($oneData));
                }
            } else {
                $oneData = [];
                $oneData['ID_CATDIM'] = $_POST['AREA_CATEGORIA'];
                $oneData['ID_CURSO'] = strval($idCurso);
                array_push($data, addDatosAuditoria($oneData));
            }
        }

        return $data;
    }
}
