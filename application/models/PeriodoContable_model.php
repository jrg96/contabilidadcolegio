<?php
class PeriodoContable_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_periodocontable($fecha_creacion, $fecha_inicio, $fecha_final, $meses_duracion, $perc_utilidad_retenida, $estado)
    {
        // Creando array de datos
        $datos = array(
                    'fecha_creacion' => $fecha_creacion, 
                    'fecha_inicio' => $fecha_inicio, 
                    'fecha_final' => $fecha_final, 
                    'meses_duracion' => $meses_duracion, 
                    'perc_utilidad_retenida' => $perc_utilidad_retenida, 
                    'estado' => $estado);
                    
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_periodo_contable', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function cerrar_periodo_contable()
	{        
        // Creando array de datos
        $datos = array(
            'estado' => 'cerrado'
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('estado', 'abierto');
        $this->db->update('tbl_periodo_contable', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
	}
	
	public function obtener_lista_periodo_contable()
	{
		$this->db->select('*');
        $this->db->from('tbl_periodo_contable');
		$this->db->order_by('fecha_creacion', 'DESC');
        $resultado = $this->db->get();
		
		return $resultado->result_array();
	}
    
    public function obtener_periodo_abierto()
    {
        return $this->db->get_where('tbl_periodo_contable', array('estado' => 'abierto'))->result_array();
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