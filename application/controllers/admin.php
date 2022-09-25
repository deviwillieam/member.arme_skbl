<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	public function add_user()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = md5($this->input->post('password'));
		$data['email'] = $this->input->post('email');
		$data['umur'] = $this->input->post('umur');
		$data['alamat'] = $this->input->post('alamat');
		$data['perusahaan'] = $this->input->post('perusahaan');
		$data['level'] = $this->input->post('level');
		$data['no_hp'] = $this->input->post('no_hp');
		$data['tgl_insert'] = date('Y-m-d');
		
		$res = $this->m_admin->add_user($data);
		if($res)
		{
			echo "Data berhasil di simpan!";
		}
		else
		{
			echo "Data gagal di simpan!";
		}
	}

	public function delete_user()
	{
		$id_user = $this->input->post('id_user');
		$res = $this->m_admin->delete_user($id_user);
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
		
		// echo "ada";
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/data_user';
		$isi['data'] = $this->m_admin->fetch_user();
		$this->load->view('admin/home', $isi);
	}

	public function logout()
	{
		$this->m_security->logout();
	}

}