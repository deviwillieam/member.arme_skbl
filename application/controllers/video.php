<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

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
	public function pending_video()
	{
		$this->load->model('m_video');

		$id_paket = $this->input->post('id_paket');
		$id_marker = $this->input->post('id_marker');
		$username = $this->session->userdata('username');
		$id_video = $this->input->post('id_video');

		//ambil nama dari log switch video
		$tmp = $this->m_video->fetch_log_switch_video($id_video);
		foreach ($tmp->result() as $row) {
			$nama_lama = $row->nama_file;
		}

		//ganti nama video database
		$data['nama_file'] = $nama_lama;
		$this->m_video->update_nama_video($id_video,$data);

		//update status
		$status['status'] = '1';
		$this->m_video->update_status_video_to_pending($id_video,$status);

		//rename
		$target = $_SERVER['DOCUMENT_ROOT'].'/assets/videos/'.$username.$id_paket.$id_marker.'0.mp4';
		$nama_baru = $_SERVER['DOCUMENT_ROOT'].'/assets/videos/'.$nama_lama;
		if(file_exists($target))
		{
			rename($target, $nama_baru);
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function switch_video()
	{
		$this->load->model('m_video');

		$id_paket = $this->input->post('id_paket');
		$id_marker = $this->input->post('id_marker');
		$username = $this->session->userdata('username');
		$nama_lama = $this->input->post('nama');
		$id_video = $this->input->post('id_video');
		
		//cek apakah video sudah ada didalam log
		$log['id_video'] = $id_video;
		$log['nama_file'] = $nama_lama;
		$tmp = $this->m_video->cek_video_didalam_log($id_video);
		if($tmp > 0)
		{
			$this->m_video->update_log_switch_video($id_video,$log);
		}
		else
		{
			$this->m_video->insert_log_switch_video($log);
		}
		
		//ganti nama video database
		$data['nama_file'] = $username.$id_paket.$id_marker.'0.mp4';
		$this->m_video->update_nama_video($id_video,$data);

		//update status
		$status['status'] = '2';
		$this->m_video->update_status_video_to_pending($id_video,$status);

		$nama_baru = $_SERVER['DOCUMENT_ROOT'].'/assets/videos/'.$username.$id_paket.$id_marker.'0.mp4';
		$target = $_SERVER['DOCUMENT_ROOT'].'/assets/videos/'.$nama_lama;
		if(file_exists($target))
		{
			rename($target, $nama_baru);
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}

	}

	public function edit_video()
	{
		$this->load->model('m_video');
		$old = $this->input->post('nama_old');
		$id_user = $this->input->post('id_user');
		$id_marker = $this->input->post('id_marker');
		$id_video = $this->input->post('id_video');

		if(isset($_FILES["video"]["name"]))
		{
			$date = date("ymd");
	        $configVideo['upload_path'] = './assets/videos';
	        $configVideo['max_size'] = '40000';
	        $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
	        $configVideo['overwrite'] = FALSE;
	        $configVideo['remove_spaces'] = TRUE;
	        $configVideo['file_name'] = rand().".mp4";

	        //hapus video lama
	        $target = 'assets/videos/'.$old;
			if(file_exists($target))
			{
				unlink($target);
			}

	        $data['nama_file'] = $configVideo['file_name'];
	        $data['status'] = '1';
	        $data['id_pemilik'] = $id_user;
	        $data['id_marker'] = $id_marker;
	        $data['judul'] = $this->input->post('judul1');

	        $this->load->library('upload', $configVideo);
	        $this->upload->initialize($configVideo);
	        if(!$this->upload->do_upload('video')) 
	        {
	            
	            echo $this->session->set_flashdata('msg', $this->upload->display_errors('',''));
	            // redirect('video/upload_video');
			}
			else
			{
				$res = $this->m_video->update_video($id_video,$data);
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
		else
		{
			$data['nama_file'] = $old;
	        $data['status'] = '1';
	        $data['id_pemilik'] = $id_user;
	        $data['id_marker'] = $id_marker;
	        $data['judul'] = $this->input->post('judul1');

	        $res = $this->m_video->update_video($id_video,$data);
			if($res)
			{
				echo "Berhasil!";
			}
			else
			{
				echo "Gagal1!";
			}

		}
	}

	public function delete_video()
	{
		$this->load->model('m_video');
		$id = $this->input->post('id_video');
		$nama= $this->input->post('nama');
		$res = $this->m_video->delete_video($id,$nama);
		if($res)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal!";
		}
	}

	public function simpan_video()
	{
		$this->load->model('m_video');

		$id_user = $this->input->post('id_user');
		$id_marker = $this->input->post('id_marker');
		$id_paket = $this->input->post('id_paket');

		//cek video apakah sudah pernah di upload
		//jika belum set limit
		$cek_video_upload = $this->m_video->cek_video_upload($id_user, $id_marker);
		if($cek_video_upload <= 0)
		{
			//cari id pembelian
			$cari = $this->m_video->cari_id_pembelian($id_user, $id_paket);
			foreach ($cari->result() as $row) {
				$id_pembelian = $row->id_pembelian;
			}

			//set limit
			$this->m_video->set_limit($id_pembelian,$id_paket);
		}


		if(isset($_FILES["video"]["name"]))
		{
			$date = date("ymd");
	        $configVideo['upload_path'] = './assets/videos';
	        $configVideo['max_size'] = '40000';
	        $configVideo['allowed_types'] = 'avi|flv|wmv|mp3|mp4';
	        $configVideo['overwrite'] = FALSE;
	        $configVideo['remove_spaces'] = TRUE;
	        $configVideo['file_name'] = rand().".mp4";

	        $data['nama_file'] = $configVideo['file_name'];
	        $data['status'] = '1';
	        $data['id_pemilik'] = $id_user;
	        $data['id_marker'] = $id_marker;
	        $data['judul'] = $this->input->post('judul');

	        $this->load->library('upload', $configVideo);
	        $this->upload->initialize($configVideo);
	        if(!$this->upload->do_upload('video')) 
	        {
	            
	            echo $this->session->set_flashdata('msg', $this->upload->display_errors('',''));
	            // redirect('video/upload_video');
			}
			else
			{
				$res = $this->m_video->insert_video($data);
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
	}

	public function list_video()
	{
		$this->load->model('m_tools');
		$this->load->model('m_marker');
		$this->load->model('m_security');
		$this->load->model('m_video');
		$this->m_security->login();


		$id_paket = $this->uri->segment(3);
		$id_marker = $this->uri->segment(4);
		$id_user = $this->session->userdata('id_user');
		$username = $this->session->userdata('username');

		//cek pending
		$switch = $this->m_video->cek_status_switch($id_marker,$id_user);
		if($switch > 0)
		{
			$isi['switch'] = 'ada';
		}else
		{
			$isi['switch'] = 'kosong';
		}
    	$isi['nama_sidebar'] = $username;
    	$isi['id_user'] = $id_user;
    	$isi['id_paket'] = $id_paket;
    	$isi['id_marker'] = $id_marker;
    	$isi['sidebar'] = 'pelanggan/sidebar';
		$isi['content'] = 'pelanggan/list_video';
		$isi['data'] = $this->m_video->filter_video_by_marker($id_marker,$id_user);
		$this->load->view('pelanggan/home', $isi);
	}

}