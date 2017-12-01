<?php
date_default_timezone_set('America/El_Salvador');

class Prestaciones_model extends CI_Model {
	private $salario_base_diario;
	private $fecha_contratacion;
	
	private $salario_semanal_nominal;
	private $anios_trabajados;
	private $dias_aguinaldo;
	private $aguinaldo_semanal;
	private $vacaciones_semanal;
	private $seguro_afp_vacaciones;
	private $insaforp_semanal;
	private $seguro_afp_semanal;
	private $salario_real_semanal;

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_prestaciones_ley()
	{
		// Paso 1: calcular salario semanal nominal
		$this->salario_semanal_nominal = $this->salario_base_diario * 7;
		
		// Paso 2: calcular el aguinaldo a aplicar semanalmente
		$fecha_inicio = new DateTime($this->fecha_contratacion);
		$fecha_final = new DateTime('now');
		$diferencia = $fecha_final->diff($fecha_inicio);
		$diferencia = intval($diferencia->format('%d'))/360.0;
		
		$this->anios_trabajados = $diferencia;
		
		if ($this->anios_trabajados <= 3.0)
		{
			$this->dias_aguinaldo = 15;
		}
		else if ($this->anios_trabajados <= 10.0)
		{
			$this->dias_aguinaldo = 19;
		}
		else
		{
			$this->dias_aguinaldo = 21;
		}
		
		$this->aguinaldo_semanal = ($this->dias_aguinaldo * $this->salario_base_diario)/52.0;
		
		// Paso 3: calcular vacaciones a nivel semanal
		$this->vacaciones_semanal = (15*$this->salario_base_diario*1.3)/52.0;
		
		// Paso 4: calcular afp y seguro social en vacaciones
		$this->seguro_afp_vacaciones = (0.1425*15*$this->salario_base_diario)/52.0;
		
		// Paso 5: calculo de insaforp aprovicionamiento
		$this->insaforp_semanal = $this->salario_semanal_nominal * 0.01;
		
		// Paso 6: calculo seguro y afp semanal
		$this->seguro_afp_semanal = $this->salario_semanal_nominal * 0.1425;
		
		// Paso 7: calculo del salario real semanal
		$this->salario_real_semanal = $this->salario_semanal_nominal + $this->aguinaldo_semanal + $this->vacaciones_semanal;
		$this->salario_real_semanal += $this->seguro_afp_vacaciones + $this->insaforp_semanal + $this->seguro_afp_semanal;
		$this->salario_real_semanal = round($this->salario_real_semanal, 2);
	}
	
	public function obtener_dias_aguinaldo()
	{
		return $this->dias_aguinaldo;
	}
	
	public function obtener_aguinaldo_semanal()
	{
		return $this->aguinaldo_semanal;
	}
	
	public function obtener_vacaciones_semanal()
	{
		return $this->vacaciones_semanal;
	}
	
	public function obtener_seguro_afp_vacaciones()
	{
		return $this->seguro_afp_vacaciones;
	}
	
	public function obtener_insaforp_semanal()
	{
		return $this->insaforp_semanal;
	}
	
	public function obtener_seguro_afp_semanal()
	{
		return $this->seguro_afp_semanal;
	}
	
	public function obtener_salario_real_semanal()
	{
		return $this->salario_real_semanal;
	}
	
	public function set_salario_base($salario)
	{
		$this->salario_base_diario = $salario;
	}
	
	public function set_fecha_contratacion($fecha)
	{
		$this->fecha_contratacion = $fecha;
	}
}