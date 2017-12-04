<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library("pagination");
		$this->load->helper(array('captcha','url'));
	}

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home/head');
		$this->load->view('home/home');
		$this->load->view('home/footer');
	}

	public function product(){
		// $query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
		$data['md'] = $this->db->get('material_detail');
		$data['category'] = $this->db->get('material_category');
		$data['subcategory'] = $this->db->get('material_sub_category');
		
		 //config for bootstrap pagination class integration
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('home/head');
		$this->load->view('home/product', $data);
		$this->load->view('home/footer');
	}

	public function show_product($id){
		$this->db->where('material_detail_id', $id);
		$q = $this->db->get('material_detail');
		$data['md'] = $q->result_array();

		$this->load->view('home/head');
		$this->load->view('home/show_product', $data);
		$this->load->view('home/footer');
	}
	public function about(){
		$data['about'] = 'about';

		$this->load->view('home/head');
		$this->load->view('home/about', $data);
		$this->load->view('home/footer');
	}

	public function contact(){
		$data['contact'] = 'contact';

		$this->load->view('home/head');
		$this->load->view('home/contact', $data);
		$this->load->view('home/footer');
	}
}
