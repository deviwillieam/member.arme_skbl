<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_marker extends CI_Model {

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
	public function cek_limit_paket($id_paket,$id_user)
	{
		$query = $this->db->query("SELECT * FROM pembelian where id_paket = $id_paket && id_users = $id_user && status = 'limit'");
		$limit = $query->num_rows(); 
		if($limit > 0)
		{
			return $limit;
		}
		else
		{
			$query = $this->db->query("SELECT * FROM pembelian where id_paket = $id_paket && id_users = $id_user && status = 'progres'");
			$progres = $query->num_rows(); 
			if($progres > 0)
			{
				return $progres;
			}
			else
			{
				$query = $this->db->query("SELECT * FROM pembelian where id_paket = $id_paket && id_users = $id_user && status = 'not verified'");
				$not = $query->num_rows(); 
				if($not > 0)
				{
					return $not;
				}
				else
				{
					$hasil = 0;
					return $hasil;
				}
			}
		}
	}

	public function filter_marker_by_paket($id_user,$id_paket)
	{
		$query = "SELECT * FROM marker where id_pemilik = $id_user && id_paket = $id_paket";
		return $this->db->query($query);
	}

	public function insert_marker($data)
	{
		$this->db->insert('marker', $data);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}