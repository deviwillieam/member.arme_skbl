<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tools extends CI_Model {

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
	public function fetch_paket_user($id_user)
	{
		$query = "SELECT * FROM pembelian, paket where pembelian.id_paket = paket.id_paket && pembelian.id_users = $id_user";
		return $this->db->query($query);
	}

	public function get_id_user($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('users');
	}
}
