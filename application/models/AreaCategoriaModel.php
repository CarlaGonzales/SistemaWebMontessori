<?php
class AreaCategoriaModel extends CI_Model
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
        $sql = "SELECT ac.*, a.NOMBRE AREA, c.NOMBRE CATEGORIA
                FROM area_categoria ac
                INNER JOIN area a ON ac.ID_AREA = a.ID_AREA
                INNER JOIN categoria c ON ac.ID_CATEGORIA =c.ID_CATEGORIA
                WHERE ac.estado = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getAreasByCategoria($idCategoria)
    {
        $result = null;
        $sql = "SELECT  area.*
                FROM area_categoria 
                INNER JOIN area ON area.ID_AREA = area_categoria.ID_AREA
                WHERE area_categoria.ID_CATEGORIA = $idCategoria AND area_categoria.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function getCategoriasByArea($idArea)
    {
        $result = null;
        $sql = "SELECT  categoria.*
                FROM area_categoria 
                INNER JOIN categoria ON categoria.ID_CATEGORIA = area_categoria.ID_CATEGORIA
                WHERE area_categoria.ID_AREA = $idArea AND area_categoria.ESTADO = 1 ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }

        return $result;
    }

    public function createAreas($idCategoria)
    {
        $this->deleteByCategoria($idCategoria);
        $datas = $this->setDataAreas($idCategoria);
        if (isset($datas)) {
            foreach ($datas as $data) {
                $areaCategoria = $this->getOne($data['ID_CATEGORIA'], $data['ID_AREA']);
                if (!isset($areaCategoria)) {
                    $this->db->insert('area_categoria', $data);
                } else {
                    $this->db->update('area_categoria', uptDatosAuditoria(array('ESTADO' => 1)), array('ID_CATEGORIA' => $data['ID_CATEGORIA'], 'ID_AREA' => $data['ID_AREA']));
                }
            }
        }
    }

    public function getOne($idCategoria, $idArea)
    {
        $result = null;
        $sql = "SELECT *
                FROM area_categoria 
                WHERE ID_AREA = $idCategoria AND ID_AREA = $idArea ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        }

        return $result;
    }

    private function setDataAreas($idCategoria)
    {
        $data = [];
        if (isset($_POST['AREAS'])) {
            if (is_array($_POST['AREAS'])) {
                foreach ($_POST['AREAS'] as $area) {
                    $oneData = [];


                    $oneData['ID_AREA'] = $area;
                    $oneData['ID_CATEGORIA'] = strval($idCategoria);
                    array_push($data, addDatosAuditoria($oneData));
                }
            } else {
                $oneData = [];
                $oneData['ID_AREA'] = $_POST['AREAS'];
                $oneData['ID_CATEGORIA'] = strval($idCategoria);
                array_push($data, addDatosAuditoria($oneData));
            }
        }

        return $data;
    }

    public function deleteByCategoria($idCategoria)
    {
        $this->db->update('area_categoria', array('ESTADO' => 0), array('ID_CATEGORIA' => $idCategoria));
    }
}
