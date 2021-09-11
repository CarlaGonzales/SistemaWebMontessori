<?php
class ClasificacionContenidoModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getByContenido($idContenido)
    {
        $result = null;
        $sql = "SELECT ID_CATDIM
                FROM clasificacion_contenido cc
                WHERE cc.ID_CONTENIDO = $idContenido
                AND cc.estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function createOne($idContenido)
    {
        $this->db->insert_batch('clasificacion_contenido', $this->setData($idContenido));
    }
    
    public function updateOne($idContenido)
    {
        $this->db->delete('clasificacion_contenido', array('ID_CONTENIDO' => $idContenido));
        $this->createOne($idContenido);
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
    
    private function setData($idContenido)
    {
        $data = [];
        if (isset($_POST['AREA_CATEGORIA'])) {
            if (is_array($_POST['AREA_CATEGORIA'])) {
                foreach ($_POST['AREA_CATEGORIA'] as $areaCategoria) {
                    $oneData = [];
                    $oneData['ID_CATDIM'] = $areaCategoria;
                    $oneData['ID_CONTENIDO'] = strval($idContenido);
                    array_push($data, $this->addDatosAuditoria($oneData));
                }
            } else {
                $oneData = [];
                $oneData['ID_CATDIM'] = $_POST['AREA_CATEGORIA'];
                $oneData['ID_CONTENIDO'] = strval($idContenido);
                array_push($data, $this->addDatosAuditoria($oneData));
            }
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
