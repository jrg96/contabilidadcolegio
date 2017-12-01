<?php
class Configuracion_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function obtener_configuracion()
    {
        return $this->db->get('tbl_configuracion')->result_array();
    }
    
    public function actualizar_configuracion($perc_utilidad_retenida, $longitud_periodo_contable)
    {
        $datos = array(
                    'perc_utilidad_retenida' => $perc_utilidad_retenida, 
                    'longitud_periodo_contable' => $longitud_periodo_contable);
                    
        $this->db->db_debug = FALSE;
        $this->db->empty_table('tbl_configuracion');
        $this->db->insert('tbl_configuracion', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
}