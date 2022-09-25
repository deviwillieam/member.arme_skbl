<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marker extends CI_Controller {

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
 
	public function cek_limit_paket()
	{
		$this->load->model('m_marker');
		$id_paket = $this->input->post('id_paket');
		$id_user = $this->input->post('id_user');
		$res = $this->m_marker->cek_limit_paket($id_paket,$id_user);
		if($res > 0)
		{
			$output['status'] = 'limit';
		}
		else
		{
			$output['status'] = 'no';
		}
		echo json_encode($output);
	}

	public function edit_marker()
	{
		$id_marker = $this->input->post('id_marker');
		$nama_lama = $this->input->post('nama');

		if(!empty($_FILES['image']['name']))
 		{
 			// echo "ada";
 			$config['upload_path'] = './assets/images/marker';
 			$config['allowed_types'] = 'jpg|png|jpeg|gif';
 			$config['max_size'] = '20000';
 			$config['max_width'] = '10000';
 			$config['max_height'] = '10000';
 			$new_name = $nama_lama;
 			$config['file_name'] = $new_name;
 			// $data['nama_file'] = $

 			$target = $_SERVER['DOCUMENT_ROOT']."assets/images/marker/".$nama_lama;
			
			if(file_exists($target))
			{
				unlink($target);
			}

 			$this->load->library('upload', $config);
 			if(!$this->upload->do_upload('image'))
 			{
 				$this->session->set_flashdata('msgno', $this->upload->display_errors('',''));
				redirect('marker/upload_marker');
				// echo $this->upload->display_errors();
 			}
 		}

 		echo "Berhasil!";

	}

	public function filter_marker_by_paket()
	{
		$this->load->model('m_marker');

		$id_paket = $this->input->post('id_paket');
		$id_user = $this->input->post('id_user');

		$res = $this->m_marker->cek_limit_paket($id_paket,$id_user);
		if($res > 0)
		{
			$output['status'] = 'limit';
		}
		else
		{
			$output['status'] = 'no';
		}


		$res = $this->m_marker->filter_marker_by_paket($id_user,$id_paket);
		if($res->num_rows() > 0)
		{
		    $increment = 1;
			foreach ($res->result() as $row) {
			    
        		if($output['status'] == 'limit')
        		{
        			if($row->status == '1')
	        		{
	        			echo
	    					"<tr>
	    						<td>".$row->id_pemilik."</td>
	    						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file."></td>
	    						<td><span class='badge badge-warning'>pending</span></td>
	    						<td>
	    							<button class='btn btn-info edit' data-nama='$row->nama_file' data-id_marker='$row->id_marker'>Edit</button>
	    						</td>
	    						<td> 
	    							
	    						</td>
	    					</tr>";  
	        		}
	        		else if($row->status == '2')
	        		{
	        			echo
	    					"<tr>
	    						<td>".$row->id_pemilik."</td>
	    						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file."></td>
	    						<td><span class='badge badge-success'>approve</span></td>
	    						<td>
	    							<button class='btn btn-info edit' data-nama='$row->nama_file' data-id_marker='$row->id_marker'>Edit</button>
	    						</td>
	    						<td> 
	    							<span class='badge badge-danger'>Paket telah limit!</span>
	    						</td>
	    					</tr>"; 
	        		}
        		}
        		else
        		{
        			if($row->status == '1')
	        		{
	        			echo
	    					"<tr>
	    						<td>".$row->id_pemilik."</td>
	    						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file."></td>
	    						<td><span class='badge badge-warning'>pending</span></td>
	    						<td>
	    							<button class='btn btn-info edit' data-nama='$row->nama_file' data-id_marker='$row->id_marker'>Edit</button>
	    						</td>
	    						<td> 
	    							
	    						</td>
	    					</tr>";  
	        		}
	        		else if($row->status == '2')
	        		{
	        			echo
	    					"<tr>
	    						<td>".$row->id_pemilik."</td>
	    						<td><img style='height: 50px; width:50px;' src=".base_url()."assets/images/marker/".$row->nama_file.">
	    						</td>
	    						<td><span class='badge badge-success'>approve</span></td>
	    						<td>
	    							<button class='btn btn-info edit' data-nama='$row->nama_file' data-id_marker='$row->id_marker'>Edit</button>
	    						</td>
	    						<td> 
	    							<a href=".base_url()."index.php/video/list_video/".$id_paket."/".$increment."  class='btn btn-primary'>Add video</a>
	    						</td>
	    					</tr>"; 
	        		}
        		}
            $increment++;
			}
		}
		else
		{
			echo "<h4>Data kosong!</h4>";
		}
	}

	public function list_marker()
	{
		$this->load->model('m_tools');
		$this->load->model('m_marker');
		$this->load->model('m_security');
		$this->m_security->login();

		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['id_user'] = $id_user;
    	$isi['sidebar'] = 'pelanggan/sidebar';
		$isi['content'] = 'pelanggan/list_marker';
		$isi['data'] = $this->m_tools->fetch_paket_user($id_user);
		$this->load->view('pelanggan/home', $isi);
	}
	

	public function save_marker()
	{
		$this->load->model('m_marker');

		$id_pemilik = $this->input->post('id_pemilik');
		$id_paket = $this->input->post('id_paket');

		if(!empty($_FILES['photo']['name']))
 		{
 			// echo "ada";
 			$config['upload_path'] = './assets/images/marker';
 			$config['allowed_types'] = 'jpg|png|jpeg|gif';
 			$config['max_size'] = '20000';
 			$config['max_width'] = '10000';
 			$config['max_height'] = '10000';
 			$new_name = rand().".jpg";
 			$config['file_name'] = $new_name;
 			$data['nama_file'] = $config['file_name'];
 			$data['id_pemilik'] = $id_pemilik;
 			$data['id_paket'] = $id_paket;
 			$data['status'] = '1';

 			$this->load->library('upload', $config);
 			if(!$this->upload->do_upload('photo'))
 			{
 				$this->session->set_flashdata('msgno', $this->upload->display_errors('',''));
				redirect('marker/upload_marker');
				// echo $this->upload->display_errors();
 			}
 			else
 			{
 				$res = $this->m_marker->insert_marker($data);
 				if($res)
 				{
 					$this->session->set_flashdata('msgok', 'Marker berhasil disimpan!');
 				}
 				else
 				{
 					$this->session->set_flashdata('msgno', 'Marker gagal disimpan!');
 				}
 				redirect('marker/upload_marker');
 			}
 		}
 		else
 		{
 			$this->session->set_flashdata('msgno', 'Image tidak boleh kosong!');
 			redirect('marker/upload_marker');
 		}
	}

	public function upload_marker()
	{
		$this->load->model('m_tools');
		$this->load->model('m_security');
		$this->m_security->login();

		$username = $this->session->userdata('username');
    	$id_user = $this->session->userdata('id_user');
    	$isi['nama_sidebar'] = $username;
    	$isi['id_user'] = $id_user;
    	$isi['sidebar'] = 'pelanggan/sidebar';
		$isi['content'] = 'pelanggan/upload_marker';
		$isi['data'] = $this->m_tools->fetch_paket_user($id_user);
		$this->load->view('pelanggan/home', $isi);
	}

}