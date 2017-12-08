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
		$filter = $this->input->get("filter");
		$config['base_url'] = site_url('product');
		$config['total_rows'] = $this->get_project_count($filter);
		$config['per_page'] = "9";
		$config["uri_segment"] = 2;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

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
		$data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$result_menu = array("menu" => $this->session->userdata("menu"));
		$result = array(
			"pagination" =>$this->pagination->create_links(),
			"results" => $this->get_project($config["per_page"], $data['page'],$filter),
			"subcategory" => $this->db->get('material_sub_category'),
			"category" => $this->db->get('material_category'),
			"total" => $this->get_project_count($filter),
			"category_id" => isset($filter['category']) ? $filter['category'] : null,
			"sub_category_id" => isset($filter['subcategory']) ? $filter['subcategory'] : null,
			"name" => isset($filter['name']) ? $filter['name'] : null
		);

		$this->load->view('home/head');
		$this->load->view('home/product', $result);
		$this->load->view('home/footer');
	}

	public function get_project_count($filter){
		if (isset($filter['subcategory'])) {
			$subcategory = $filter['subcategory'];
		}else{
			$subcategory = null;
		}

		if (isset($filter['category'])) {
			$category = $filter['category'];
		}else{
			$category = null;
		}

		if (isset($filter['subcategory']) || isset($filter['category']) && isset($filter['name'])) {
			$name = " and p.project_name like '%".$filter['name']."%'";
		}elseif(!isset($filter['subcategory']) && !isset($filter['category']) && isset($filter['name'])){
			$name = " where p.project_name like '%".$filter['name']."%'";
		}else{
			$name = null;
		}


		if($category != "" && $subcategory != ""){
			$fltr = "where p.category_id =".$category." and p.sub_category_id =".$subcategory;
		}elseif($category !="" && $subcategory == ''){
			$fltr = "where p.category_id =".$category;
		}elseif($category == "" && $subcategory != ''){
			$fltr = "where p.sub_category_id =".$filter['subcategory'];
		}elseif($category == "" && $subcategory != ''){
			$fltr = "where p.sub_category_id =".$filter['subcategory'];
		}else{
			$fltr = "";	
		}
		$query = "SELECT p.project_id,p.project_name,p.photo,p.subject,p.deskripsi,mc.category_name,msc.material_sub_category_name
		FROM project p
		LEFT JOIN material_category mc ON mc.category_id = p.category_id
		LEFT JOIN material_sub_category msc ON msc.`material_sub_category_id` = p.sub_category_id
		".$fltr.$name;
		$sql = $this->db->query($query);
		return $sql->num_rows();
	}

	public function get_project($limit,$start,$filter){
		$output = "";

		if (isset($filter['subcategory'])) {
			$subcategory = $filter['subcategory'];
		}else{
			$subcategory = null;
		}

		if (isset($filter['category'])) {
			$category = $filter['category'];
		}else{
			$category = null;
		}

		if (isset($filter['subcategory']) || isset($filter['category']) && isset($filter['name'])) {
			$name = " and p.project_name like '%".$filter['name']."%'";
		}elseif(!isset($filter['subcategory']) && !isset($filter['category']) && isset($filter['name'])){
			$name = " where p.project_name like '%".$filter['name']."%'";
		}else{
			$name = null;
		}

		if($category != "" && $subcategory != ""){
			$fltr = "where p.category_id =".$category." and p.sub_category_id =".$subcategory;
		}elseif($category !="" && $subcategory == ''){
			$fltr = "where p.category_id =".$category;
		}elseif($category == "" && $subcategory != ''){
			$fltr = "where p.sub_category_id =".$filter['subcategory'];
		}else{
			$fltr = "";	
		}

		$qry = "SELECT p.project_id,p.project_name,p.photo,p.subject,p.deskripsi,mc.category_name,msc.material_sub_category_name
		FROM project p
		LEFT JOIN material_category mc ON mc.category_id = p.category_id
		LEFT JOIN material_sub_category msc ON msc.`material_sub_category_id` = p.sub_category_id
		".$fltr.$name." LIMIT $start,$limit";

		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		return $sql;
	}

	public function show_product($id){
		$this->db->where('project_id', $id);
		$q = $this->db->get('project');
		$data['md'] = $q->result_array();

		$this->load->view('home/head');
		$this->load->view('home/show_product', $data);
		$this->load->view('home/footer');
	}
	public function about(){
		$this->db->where('our_company_content_id', 1);
		$q = $this->db->get('our_company_content');
		$data['about'] = $q->result_array();

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
