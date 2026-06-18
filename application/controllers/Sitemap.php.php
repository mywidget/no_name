<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Sitemap extends CI_Controller {
		
		public function index() {
			// Jika mengambil data dari database (Contoh: artikel)
			// $this->load->model('Post_model');
			// $data['posts'] = $this->Post_model->get_all_published();
			
			// Mengatur response header menjadi XML
			$this->output->set_content_type('text/xml');
			
			// Data halaman statis
			$data['urls'] = [
            ['loc' => base_url(), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => base_url('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => base_url('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
			];
			
			// Memanggil view sitemap
			$this->load->view('sitemap_view', $data);
		}
	}	