<?php
class Usuario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_usuario($usuario, $password, $nombre, $tipo)
    {
		$password_md5 = md5($password);
		$datos = array(
			'email' => $usuario,
			'password' => $password_md5,
			'nombre_completo' => $nombre,
			'tipo' => $tipo
		);
		
		// Insertandolo en la base de datos
		$this->db->db_debug = FALSE;
		$this->db->insert('tbl_usuario', $datos);
		$err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function usuario_ya_existe($email)
	{
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$this->db->where('email', $email);
		$query = $this->db->get()->result_array();
		$coincidencias = count($query);
		
		if ($coincidencias == 0)
		{
			return false;
		}
		return true;
	}
	
	public function comprobar_credenciales($email, $password)
	{
		$password_md5 = md5($password);
		$datos = array(
			'email' => $email,
			'password' => $password_md5
		);
		
		// Realizando consulta
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$this->db->where($datos);
		$query = $this->db->get()->result_array();
		$coincidencias = count($query);
		
		if ($coincidencias > 0)
		{
			return true;
		}
		return false;
	}
	
	public function obtener_usuario($email)
	{
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$this->db->where('email', $email);
		$query = $this->db->get()->result_array();
		
		return $query[0];
	}
	
	public function obtener_usuario_porid($id_usuario)
	{
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$this->db->where('id_usuario', $id_usuario);
		$query = $this->db->get()->result_array();
		
		return $query[0];
	}
	
	public function obtener_lista_usuario()
	{
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	public function obtener_lista_abogado()
	{
		$this->db->select('*');
        $this->db->from('tbl_usuario');
		$this->db->where('tipo', 'emp');
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	public function modificar_datos_usuario($id_usuario, $nombre_completo, $tipo, $password, $modificar_password)
	{
		$password_md5 = null;
		$datos = null;
		
		if ($modificar_password)
		{
			$password_md5 = md5($password);
			
			$datos = array(
				'nombre_completo' => $nombre_completo,
				'tipo' => $tipo,
				'password' => $password_md5
			);
		}
		else
		{
			$datos = array(
				'nombre_completo' => $nombre_completo,
				'tipo' => $tipo
			);
		}
		
		
		$condicion = array(
			'id_usuario' => $id_usuario
		);
		
		// Realizar update
        $this->db->db_debug = FALSE;
        $this->db->where($condicion);
        $this->db->update('tbl_usuario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
		
		// Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
	}
	
	public function eliminar_usuario($id_usuario)
	{
		$this->db->delete('tbl_usuario', array('id_usuario' => $id_usuario));
	}
}