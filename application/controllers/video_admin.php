<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_admin extends CI_Controller {

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

	public function delete_video()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$res = $this->m_admin->delete_video($id,$nama);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function index()
	{
		
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/video_list';
		$isi['total_video'] = $this->m_admin->count_video();
		$isi['switch_video'] = $this->m_admin->count_switch_video();
		$isi['pending_video'] = $this->m_admin->count_pending_video();
		$isi['data'] = $this->m_admin->fetch_video();
		$this->load->view('admin/home', $isi);
	}


}