<?php
if (!function_exists('addDatosAuditoria')) {
    function addDatosAuditoria($data)
    {
        $CI = &get_instance();
        $data['FECHA_REG'] = (new DateTime())->format('Y-m-d H:i:s');
        //$data['USUARIO_REG'] = $CI->session->userdata('UID');
        $data['USUARIO_REG'] = $CI->session->userdata('email');
        $data['ESTADO'] = 1;
        return $data;
    }
}

if (!function_exists('uptDatosAuditoria')) {
    function uptDatosAuditoria($data)
    {
        $CI = &get_instance();
        $data['FECHA_ACT'] = (new DateTime())->format('Y-m-d H:i:s');
        //$data['USUARIO_ACT'] = $CI->session->userdata('UID');
        $data['USUARIO_ACT'] = $CI->session->userdata('email');
        return $data;
    }
}
