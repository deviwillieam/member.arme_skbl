<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {

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
	 
	public function fetch_ajax_version($id)
	{
	    $this->db->where('id', $id);
	    return $this->db->get('app_version');
	}
	
	public function fetch_version()
	{
	    return $this->db->get('app_version');
	}
	 
    public function update_version($isi, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('app_version', $isi);
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

	public function hitung_video($id_marker)
	{
		$query = $this->db->query("SELECT * from video where id_marker = $id_marker");
		return $query->num_rows();
	}

	public function get_id_marker($id_paket,$id_user)
	{
		$this->db->where('id_paket', $id_paket);
		$this->db->where('id_pemilik', $id_user);
		return $this->db->get('marker');
	}

	public function approve_perpanjang_tanpa_limit($id, $id_paket)
	{
		$this->db->where('id_paket', $id_paket); 
		$tmp = $this->db->get('paket');
		foreach ($tmp->result() as $row) {
			$waktu_limit = $row->masa_aktif;
		}

		$now =date('Y-m-d');
		$data['tgl_verifikasi'] = $now;
		$data['status'] = 'verified';
		$data['perpanjang'] = '';
		$this->db->where('id_pembelian',$id);
		$this->db->update('pembelian',$data);
	}

	public function approve_perpanjang($id, $id_paket)
	{
		$this->db->where('id_paket', $id_paket); 
		$tmp = $this->db->get('paket');
		foreach ($tmp->result() as $row) {
			$waktu_limit = $row->masa_aktif;
		}

		$now =date('Y-m-d');
		$data['tgl_limit'] = date('Y-m-d', strtotime('+'.$waktu_limit.' days', strtotime($now)));
		$data['tgl_verifikasi'] = $now;
		$data['perpanjang'] = '';
		$data['status'] = 'verified';
		$this->db->where('id_pembelian',$id);
		$this->db->update('pembelian',$data);
	}

	public function cek_perpanjang($id)
	{
		$query = "SELECT * FROM pembelian where id_pembelian = $id && perpanjang = 1";
		return $this->db->query($query);
	}

	public function pending_pembelian($id)
	{
		$data['status'] = 'not verified';
		$this->db->where('id_pembelian', $id);
		$this->db->update('pembelian', $data);
		if($this->db->affected_rows()  >0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function approve_pembelian($id)
	{
		$data['status'] = 'verified';
		$data['tgl_verifikasi'] = date('Y-m-d');
		$this->db->where('id_pembelian', $id);
		$this->db->update('pembelian', $data);
		if($this->db->affected_rows()  >0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function delete_pembelian($id)
	{
		$this->db->where('id_pembelian', $id);
		$this->db->delete('pembelian');
		if($this->db->affected_rows()  >0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function fetch_pembelian($status)
	{
		$query = "SELECT * FROM pembelian, users where pembelian.id_users = users.id_users && pembelian.status = '$status'";
		return $this->db->query($query);
	}

	public function count_acc_pembelian()
	{
		$query = $this->db->query("SELECT * FROM pembelian where status = 'verified'");
		return $query->num_rows();
	}


	public function count_limit_pembelian()
	{
		$query = $this->db->query("SELECT * FROM pembelian where status = 'limit'");
		return $query->num_rows();
	}

	public function count_progres_pembelian()
	{
		$query = $this->db->query("SELECT * FROM pembelian where status = 'progres'");
		return $query->num_rows();
	}

	public function count_not_pembelian()
	{
		$query = $this->db->query("SELECT * FROM pembelian where status = 'not verified'");
		return $query->num_rows();
	}

	public function count_pembelian()
	{
		$query = $this->db->query("SELECT * FROM pembelian");
		return $query->num_rows();
	}

	public function pending_marker($id)
	{
		$data['status'] = 1;
		$this->db->where('id_marker', $id);
		$this->db->update('marker', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function delete_marker($id,$nama)
	{
		$target = 'assets/images/marker/'.$nama;
		if(file_exists($target))
		{
			unlink($target);
		}
		$this->db->where('id_marker', $id);
		$this->db->delete('marker');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function approve_marker($id)
	{
		$data['status'] = 2;
		$this->db->where('id_marker', $id);
		$this->db->update('marker', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function count_pending_marker()
	{
		$query = $this->db->query("SELECT * FROM marker where status = '1'");
		return $query->num_rows();
	}

	public function count_approve_marker()
	{
		$query = $this->db->query("SELECT * FROM marker where status = '2'");
		return $query->num_rows();
	}

	public function count_marker()
	{
		$query = $this->db->query("SELECT * FROM marker");
		return $query->num_rows();
	}

	public function fetch_marker($status)
	{
		$query = "SELECT * FROM marker, users where marker.id_pemilik = users.id_users && status = '$status'";
		
		return $this->db->query($query);
	}

	public function delete_video($id,$nama)
	{
		$this->db->where('id_video', $id);
		$this->db->delete('video');
		$target = $_SERVER['DOCUMENT_ROOT'].'assets/videos/'.$nama;
		if(file_exists($target))
		{
			unlink($target);
		}
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function count_pending_video()
	{
		$query = $this->db->query("SELECT * FROM video where status = '1'");
		return $query->num_rows();
	}

	public function count_switch_video()
	{
		$query = $this->db->query("SELECT * FROM video where status = '2'");
		return $query->num_rows();
	}

	public function count_video()
	{
		$query = $this->db->query("SELECT * FROM video");
		return $query->num_rows();
	}

	public function fetch_video()
	{
		$query = 'SELECT * FROM video, users where video.id_pemilik = users.id_users';
		return $this->db->query($query);
	}

	public function add_user($data)
	{
		$this->db->insert('users', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete_user($id_user)
	{
		$this->db->where('id_users', $id_user);
		$this->db->delete('users');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function fetch_user()
	{
		return $this->db->get('users');
	}

}