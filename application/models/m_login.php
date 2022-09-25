<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

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
    public function prosesregister($data)
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
    
    public function cekusername($user)
    {
        $this->db->where('username', $user);
        $result = $this->db->get('users');
        if ($result->num_rows() > 0 )
        {
            return true;
        }
    }

	public function get_login($user,$pass)
	{
	
	    $pass = md5($pass);
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		$result = $this->db->get('users');
	

		if($result->num_rows() > 0)
		{
			foreach ($result->result() as $row) {
				$data = array (
					'id_user' 	=> $row->id_users,
					'username'	=> $row->username,
					'level'		=> $row->level
				);

				$level = $row->level;
			}
			$this->session->set_userdata($data);

			if($level == 'pelanggan')
			{
				redirect('pelanggan');
			}
			else if($level == 'admin')
			{
				redirect('admin');
			}
			else
			{
				redirect('login');
			}
		}
		else
		{
			$this->session->set_flashdata('info', 'Data yang anda masukkan salah!');
			redirect('login');
		}
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */