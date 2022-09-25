<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marker_admin extends CI_Controller {

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

	public function pending_marker()
	{
		$id = $this->input->post('id');
		$res = $this->m_admin->pending_marker($id);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function delete_marker()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$res = $this->m_admin->delete_marker($id,$nama);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function approve_marker()
	{
		$id = $this->input->post('id');
		$res = $this->m_admin->approve_marker($id);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function filter_marker()
	{
		$status = $this->input->post('status');
		
		$isi['data'] = $this->m_admin->fetch_marker($status);
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
    	$isi['filter'] = 'admin/filter_list_marker';
		$isi['content'] = 'admin/filter_marker';
		$isi['total_marker'] = $this->m_admin->count_marker();
		$isi['approve_marker'] = $this->m_admin->count_approve_marker();
		$isi['pending_marker'] = $this->m_admin->count_pending_marker();
		$this->load->view('admin/home', $isi);
	}	

	public function index()
	{
		
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/filter_list_marker';
		$isi['total_marker'] = $this->m_admin->count_marker();
		$isi['approve_marker'] = $this->m_admin->count_approve_marker();
		$isi['pending_marker'] = $this->m_admin->count_pending_marker();
		$this->load->view('admin/home', $isi);
	}


}