<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_video extends CI_Model {

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
	public function set_limit($id_pembelian,$id_paket)
	{
		//ambil bulan dari paket
		$this->db->where('id_paket', $id_paket); 
		$tmp = $this->db->get('paket');
		foreach ($tmp->result() as $row) {
			$waktu_limit = $row->masa_aktif;
		}
		
		//tambah waktu limit
		$data['tgl_verifikasi'] = date('Y-m-d');
		$now =date('Y-m-d');
		$data['tgl_limit'] = date('Y-m-d', strtotime('+'.$waktu_limit.' days', strtotime($now)));
		$this->db->where('id_pembelian',$id_pembelian);
		$this->db->update('pembelian',$data);
	}

	public function cari_id_pembelian($id_user, $id_paket)
	{
		$query = "SELECT * FROM pembelian where id_users = $id_user && id_paket = $id_paket";
		return $this->db->query($query);
	}

	public function cek_video_upload($id_user, $id_marker)
	{
		$query = $this->db->query("SELECT * FROM video where id_pemilik = $id_user && id_marker = $id_marker");
		return $query->num_rows();
	}

	public function cek_video_didalam_log($id_video)
	{
		$query = $this->db->query("SELECT * FROM log_switch_video where id_video = $id_video");
		return $query->num_rows();
	}

	public function fetch_log_switch_video($id_video)
	{
		$this->db->where('id_video',$id_video);
		return $this->db->get('log_switch_video');
	}

	public function update_nama_video($id_video,$data)
	{
		$this->db->where('id_video', $id_video);
		$this->db->update('video',$data);
	}

	public function cek_status_switch($id_marker,$id_user)
	{
		$query = $this->db->query("SELECT * FROM video where id_marker = $id_marker && id_pemilik = $id_user && status = 2");
		return $query->num_rows();
	}

	public function update_status_video_to_pending($id_video,$status)
	{
		$this->db->where('id_video', $id_video);
		$this->db->update('video',$status);
	}

	public function update_log_switch_video($id_video,$log)
	{
		$this->db->where('id_video', $id_video);
		$this->db->update('log_switch_video',$log);
	}

	public function insert_log_switch_video($log)
	{
		$this->db->insert('log_switch_video', $log);
	}

	public function update_video($id_video,$data)
	{
		$this->db->where('id_video', $id_video);
		$this->db->update('video',$data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete_video($id,$nama)
	{
		$_SERVER['DOCUMENT_ROOT'].$target = 'assets/videos/'.$nama;
		if(file_exists($target))
		{
			unlink($target);
		}
		$this->db->where('id_video', $id);
		$this->db->delete('video');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function insert_video($data)
	{
		$this->db->insert('video', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function filter_video_by_marker($id_marker,$id_user)
	{
		$query = "SELECT * FROM video where id_marker = $id_marker && id_pemilik = $id_user";
		return $this->db->query($query);
	}

}