<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

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

	public function add_paket()
	{
		$this->load->model('m_pelanggan');

		$output[''] = array();
		$id = $this->input->post('id_user');
		$paket = $this->input->post('paket');
		$tmp = $this->m_pelanggan->cek_paket_yang_telah_dibeli($id, $paket);
		if($tmp > 0)
		{
			$output['status'] = "ada";
		}
		else
		{
			$this->m_pelanggan->add_paket($id,$paket);
			$output['status'] = "berhasil";
		}
		echo json_encode($output);
	}

	public function upload_pembayaran_database($id_paket,$id_user,$data)
	{
		$this->load->model('m_pelanggan');
		$re = $this->m_pelanggan->upload_pembayaran_database($id_paket,$id_user,$data);
		if($re)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function upload_pembayaran()
	{


		$id_paket = $this->input->post('id_paket');
		$id_user = $this->session->userdata('id_user');

		if(!empty($_FILES['photo']['name']))
 		{
 			// echo "ada";
 			$config['upload_path'] = './assets/images/pembayaran';
 			$config['allowed_types'] = 'jpg|png|jpeg|gif';
 			$config['max_size'] = '20000';
 			$config['max_width'] = '10000';
 			$config['max_height'] = '10000';
 			$new_name = rand().".jpg";
 			$config['file_name'] = $new_name;
 			$data['bukti_pembayaran'] = $config['file_name'];
 			// $data['id_pemilik'] = $id_pemilik;
 			$data['status'] = 'progres';

 			$this->load->library('upload', $config);
 			if(!$this->upload->do_upload('photo'))
 			{
 				$this->session->set_flashdata('msgno', $this->upload->display_errors('',''));
				redirect('marker/upload_marker');
				// echo $this->upload->display_errors();
 			}
 			else
 			{
				$res = $this->upload_pembayaran_database($id_paket,$id_user,$data);
				
				if($res)
				{
					echo "Pembayaran berhasil diupload!";
				}
				else
				{
					echo "Pembayaran gagal diupload!";

				}
 			}
 		}
 		else
 		{
 			echo "Image tidak boleh kosong!";
 		}
	}

	public function perpanjang()
	{
		$this->load->model('m_pelanggan');
		$id_paket = $this->input->post('id_paket');
		$data['status'] = 'not verified';
		$data['tgl_limit'] = '';
		$data['perpanjang'] = 1;
		$this->m_pelanggan->perpanjang($id_paket,$data);
		echo "Berhasil!";
	} 

	public function index()
	{
		$this->load->model('m_security');
		$this->load->model('m_pelanggan');
		$this->m_security->login();
		$this->manage_limit();
		// echo "ada";
		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['id_user'] = $id_user;
    	$isi['sidebar'] = 'pelanggan/sidebar';
		$isi['content'] = 'pelanggan/data_paket';
		$isi['judul'] = 'Data paket';
		$isi['sub_judul'] = "paket";
		$isi['paket'] = $this->m_pelanggan->fetch_paket();
		$isi['data'] = $this->m_pelanggan->fetch_paket_pelanggan($id_user);
		$this->load->view('pelanggan/home', $isi);
	}

	public function manage_limit()
	{
		$this->load->model('m_security');
		$this->load->model('m_pelanggan');
		$this->m_security->login();
    	$id_user = $this->session->userdata('id_user');

    	//set limit jika sudah masuk waktu tenggangnya
    	$cek_waktu_limit = $this->m_pelanggan->cek_waktu_limit($id_user);
    	if($cek_waktu_limit->num_rows() > 0)
    	{
    		$now = date('Y-m-d');
    		foreach ($cek_waktu_limit->result() as $row) {
    			if($row->tgl_limit == $now)
    			{
    				//set limit
    				$id_p = $row->id_pembelian;
    				$this->m_pelanggan->set_limit($id_p);
    			}
    		}
    	}

		//cari pembelian yang limit
		$cari_paket_limit = $this->m_pelanggan->cari_paket_limit($id_user);
		foreach ($cari_paket_limit->result() as $row) {
			if($row->status == 'limit')
			{
				$id_paket_limit = $row->id_paket;

				//cari marker yang menggunakan paket tersebut
				$cari_marker = $this->m_pelanggan->cari_marker($id_user, $id_paket_limit);
				foreach ($cari_marker->result() as $row) {
					//setelah marker didapatkan cari video yang menggunakan marker tersebut
					$id_marker = $row->id_marker;

					$cari_video = $this->m_pelanggan->cari_video($id_user, $id_marker);
					foreach ($cari_video->result() as $rowz) {
						//lalu ambil id video kemudian ambzil nama video yang di log
						$id_video = $rowz->id_video;
						
						$target = 'assets/videos/'.$rowz->nama_file;
 
						$fetch_log = $this->m_pelanggan->fetch_log($id_video);
						foreach ($fetch_log->result() as $rows) {
							
							$data['nama_file'] = $rows->nama_file;
							$data['status'] = '1';
							$id_video_asli = $rows->id_video;

							//update total
							$this->m_pelanggan->update_nama_video_total($id_video_asli,$data);
							//rename
							$nama_baru = 'assets/videos/'.$rows->nama_file;
							if(file_exists($target))
							{
								rename($target, $nama_baru);
							}
						}
					}
				}
			}
		}
	}

	public function logout()
	{
		$this->load->model('m_security');
		$this->m_security->logout();
	}

}