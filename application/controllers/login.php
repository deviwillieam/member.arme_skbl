<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
    public function prosesregister()
    {
        $this->load->model('m_login');
        
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $data['email'] = $this->input->post('email');
        $data['alamat'] = $this->input->post('alamat');
        $data['perusahaan'] = $this->input->post('perusahaan');
        $data['no_hp'] = $this->input->post('no_hp');
        $data['level'] = 'pelanggan';
        $data['tgl_insert'] = date('Y-m-d');
        $result = $this->m_login->prosesregister($data);
        if( $result )
        {
            $output['result'] = 'berhasil';
        }else
        {
            $output['result'] = 'gagal';
        }
        
        echo json_encode($output);
        
    }
    
	public function cekusername()
	{
	    $this->load->model('m_login');
	    $user = $this->input->post('username');
	    
	    $query = $this->m_login->cekusername($user);
	    
	    if ($query)
	    {
	        $output['result'] = 'ada';
	    }
	    else
	    {
	        $output['result'] = 'kosong';
	    }
	    
	    echo json_encode($output);
	    
	}
	 
	public function register()
	{
	    $this->load->view('register');
	}
	 
	public function getlogin()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$this->load->model('m_login');
		$this->m_login->get_login($user,$pass);
	}

	public function index()
	{
		$this->load->view('login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */