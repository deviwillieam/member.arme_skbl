<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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

	public function pending_pembelian()
	{
		$id = $this->input->post('id');
		$res = $this->m_admin->pending_pembelian($id);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function approve_pembelian()
	{
		$id = $this->input->post('id');

		//cek perpanjang 
		$cek = $this->m_admin->cek_perpanjang($id);
		if($cek->num_rows() > 0)
		{
			foreach ($cek->result() as $row) {
				$id_paket  = $row->id_paket;
				$id_user = $row->id_users;
			}

			//ambil id marker 
			$tmp_marker = $this->m_admin->get_id_marker($id_paket,$id_user);
			if($tmp_marker->num_rows()  > 0)
			{
				foreach ($tmp_marker->result() as $row) {
					$id_marker = $row->id_marker;
				}
			}

			//cek video sesuai marker
			$tmp_video = $this->m_admin->hitung_video($id_marker);
			if($tmp_video > 0)
			{
				$this->m_admin->approve_perpanjang($id, $id_paket);
			}
			else
			{
				$this->m_admin->approve_perpanjang_tanpa_limit($id, $id_paket);
			}
			echo "Berhasil!";
		}
		else
		{
			$res = $this->m_admin->approve_pembelian($id);
			if($res) 
			{
				echo "Berhasil!";
			}
			else
			{
				echo "Gagal!";
			}
		}
		
	}


	public function delete_pembelian()
	{
		$id = $this->input->post('id');
		$res = $this->m_admin->delete_pembelian($id);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function filter_pembelian()
	{
		$status = $this->input->post('status');
		$isi['data'] = $this->m_admin->fetch_pembelian($status);
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/filter_pembelian';
		$isi['filter'] = 'admin/filter_list_pembelian';
		$isi['total_pembelian'] = $this->m_admin->count_pembelian();
		$isi['not_pembelian'] = $this->m_admin->count_not_pembelian();
		$isi['progres_pembelian'] = $this->m_admin->count_progres_pembelian();
		$isi['limit_pembelian'] = $this->m_admin->count_limit_pembelian();
		$isi['acc_pembelian'] = $this->m_admin->count_acc_pembelian();
		$this->load->view('admin/home', $isi);
	}

	public function index()
	{
		
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['sidebar'] = 'admin/sidebar';
		$isi['content'] = 'admin/filter_list_pembelian';
		$isi['total_pembelian'] = $this->m_admin->count_pembelian();
		$isi['not_pembelian'] = $this->m_admin->count_not_pembelian();
		$isi['progres_pembelian'] = $this->m_admin->count_progres_pembelian();
		$isi['limit_pembelian'] = $this->m_admin->count_limit_pembelian();
		$isi['acc_pembelian'] = $this->m_admin->count_acc_pembelian();
		// $isi['data'] = $this->m_admin->fetch_pembelian();
		$this->load->view('admin/home', $isi);
	}

}