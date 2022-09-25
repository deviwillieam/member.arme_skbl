<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pelanggan extends CI_Controller {

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
	public function add_paket($id,$paket)
	{
		$data['id_paket'] = $paket;
		$data['id_users'] = $id;
		$data['status'] = 'not verified';
		$this->db->insert('pembelian', $data);
	}

	public function cek_paket_yang_telah_dibeli($id, $paket)
	{
		$query = $this->db->query("SELECT * FROM pembelian where id_users = $id && id_paket = $paket");
		return $query->num_rows();
	}

	public function fetch_paket()
	{
		return $this->db->get('paket');
	}

	public function set_limit($id_p)
	{
		$data['status'] = 'limit';
		$this->db->where('id_pembelian', $id_p);
		$this->db->update('pembelian', $data);
	}

	public function cek_waktu_limit($id_user)
	{
		$query = "SELECT * FROM pembelian where id_users = $id_user";
		return $this->db->query($query);
	}

	public function upload_pembayaran_database($id_paket,$id_user,$data)
	{
		$this->db->where('id_paket', $id_paket);
		$this->db->where('id_users', $id_user);
		$this->db->update('pembelian', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function perpanjang($id_paket,$data)
	{
		$this->db->where('id_paket', $id_paket);
		$this->db->update('pembelian', $data);
	}

	public function update_nama_video_total($id_video,$data)
	{
		$this->db->where('id_video', $id_video);
		$this->db->update('video', $data);
	}

	public function fetch_log($id_video)
	{
		$this->db->where('id_video', $id_video);
		return $this->db->get('log_switch_video');
	}

	public function cari_video($id_user, $id_marker)
	{
		$this->db->where('id_pemilik', $id_user);
		$this->db->where('id_marker', $id_marker);
		return $this->db->get('video');
	}

	public function cari_marker($id_user, $id_paket_limit)
	{
		$this->db->where('id_pemilik', $id_user);
		$this->db->where('id_paket', $id_paket_limit);
		return $this->db->get('marker');
	}

	public function cari_paket_limit($id_user)
	{
		$this->db->where('id_users', $id_user);
		return $this->db->get('pembelian');
	}

	public function fetch_paket_pelanggan($id_user)
	{
		$query = "SELECT * FROM pembelian, users, paket where pembelian.id_users = users.id_users && pembelian.id_paket = paket.id_paket && pembelian.id_users = '$id_user'";
		return $this->db->query($query);
	}

}