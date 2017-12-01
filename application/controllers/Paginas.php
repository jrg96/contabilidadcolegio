<?php
class Paginas extends CI_Controller { 

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
	
    public function index($page = 'index')
    {
        $this->load->helper('url');
        
        if (!file_exists(APPPATH.'views/paginas/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        
        $data['title'] = ucfirst($page);
        $this->load->view('paginas/'.$page, $data);
    }
    
    public function contabilidadgeneral($page = 'contabilidad_general')
    {
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
        $this->load->helper('url');
        
        if (!file_exists(APPPATH.'views/templates/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        
        $data['title'] = ucfirst($page);
        $this->load->view('templates/'.$page, $data);
    }
}