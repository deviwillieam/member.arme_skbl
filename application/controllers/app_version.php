<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_version extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_security');
		$this->load->model('m_admin');
		$this->m_security->login();
	}
	
	public function fetch_ajax()
	{
	    $id = $this->input->post('id');
	    $query = $this->m_admin->fetch_ajax_version($id);
	    foreach($query->result() as $row)
	    {
	        $output['news'] = $row->news;
	        $output['version'] = $row->version;
	    }
	    
	    echo json_encode($output);
	}
	
	public function update_version()
	{
	    $isi['version'] = $this->input->post('version');
	    $isi['news'] = $this->input->post('news');
	    $id = $this->input->post('version_id');
	    $query = $this->m_admin->update_version($isi, $id);
	    if( $query )
	    {
	        echo "berhasil";
	    }
	    else
	    {
	        echo "gagal";
	    }
	}
	
	public function index()
	{
	
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/app_version';
		$isi['data'] = $this->m_admin->fetch_version();
		$this->load->view('admin/home', $isi);
	}

	
	
}
















