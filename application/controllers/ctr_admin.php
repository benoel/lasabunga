<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctr_Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("mdl_admin");
		$this->load->library("pagination");
		$this->load->library('session','upload');
		$this->load->helper(array('captcha','url'));

	}
	
	public function index($notif=NULL)
	{
		if(!empty($this->session->userdata("email"))){
			$this->dashboard(TRUE);
		}else{
			$data = array("notif" => $notif);
			$this->load->view('admin/index',$data);
		}

	}
	public function login(){
		$email = $this->input->post("email");
		$password = md5($this->input->post("password"));
		if($email==""){
			$this->index('Email Kosong, Silahkan login kembali');
		}else if($password==""){
			$this->index('Password Kosong,Silahkan login kembali');
		}else{
			$get_data = $this->mdl_admin->login($email,$password);
			if($get_data == false){
				$this->index("Email dan Password tidak cocok");
			}else{
				if($get_data){
					foreach($get_data->result() as $data_auth){
						$sess_array = array("name" => ucwords($data_auth->name),
											"email" => ucwords($data_auth->email),
											"menu" => $this->menu($email)
											);
					}
					//print_r($this->menu($email));die();

					if($sess_array){
						$this->session->set_userdata($sess_array);
					}
					$this->dashboard();
				}
			}
		}

	}
	public function dashboard(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$data = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$data);
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('ctr_admin/index','refresh');
	}
	public function menu($email){
		$get_data = $this->mdl_admin->menu($email);
		return $get_data;
	}
	public function barang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
		$filter = $this->input->get("material_name");
		//echo $filter;die();
		$config['base_url'] = site_url('ctr_admin/barang');
        $config['total_rows'] = $this->mdl_admin->material_detail_count($filter);
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
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
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$result_menu = array("menu" => $this->session->userdata("menu"));
		$result_barang = array("pagination"=>$this->pagination->create_links(),
								"barang" => $this->mdl_admin->get_barang($config["per_page"], $data['page'],$filter),
								"total"=> $this->mdl_admin->material_detail_count($filter));
			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/barang',$result_barang);
			$this->load->view('admin/footer');
		}
	}
	public function viewbarang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);

			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result_view = array("barang" => $this->mdl_admin->get_view_barang($id));

			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/viewbarang',$result_view);
			$this->load->view('admin/footer');
		}
	}
	public function updatebarang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$this->upload->do_upload('berkas');


			$result = $this->upload->data();
			$photo = "upload/".$result['file_name'];
			if($result['file_name']){
				$photo = "upload/".$result['file_name'];
			}else{
				$photo = "";
			}

			$data = array(	"material_detail_id" => $this->input->post("material_detail_id"),
							"material_name" => $this->input->post("material_name"),
							"material_subject" => $this->input->post("material_subject"),
							"material_desc" => $this->input->post("material_desc"),
							"photo" => $photo
						);

			if($this->mdl_admin->updatebarang($data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/barang");
			}
		}

	}
	public function deletebarang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);
			$this->mdl_admin->deletebarang($id);
			redirect('ctr_admin/barang');
		}
	}
	public function createbarang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createbarang");
			$this->load->view('admin/footer');
		}
	}
	public function insertbarang(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$output['message'] = "";
			$this->upload->do_upload('berkas');

				$result = $this->upload->data();
				if($result['file_name']){
					$photo = "upload/".$result['file_name'];
				}else{
					$photo = "";
				}

				$data = array(	"material_name" => $this->input->post("material_name"),
								"material_subject" => $this->input->post("material_subject"),
								"material_desc" => $this->input->post("material_desc"),
								"photo" => $photo
							);

				$insert = $this->mdl_admin->insert('material_detail',$data);

				if($insert == false){
					echo "Tambah Material Gagal";die();
				}else{
					redirect("ctr_admin/barang");
				}
		}
	}
	public function category(){
		$filter = $this->input->get("category_name");
		//echo $filter;die();
		$config['base_url'] = site_url('ctr_admin/category');
        $config['total_rows'] = $this->mdl_admin->material_category_count($filter);
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
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
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$result_menu = array("menu" => $this->session->userdata("menu"));
		$result = array("pagination"=>$this->pagination->create_links(),
								"result" => $this->mdl_admin->get_category($config["per_page"], $data['page'],$filter),
								"total"=> $this->mdl_admin->material_category_count($filter));
			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/category',$result);
			$this->load->view('admin/footer');
	}
	public function viewcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);

			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result_view = array("result" => $this->mdl_admin->get_view_category($id));

			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/viewcategory',$result_view);
			$this->load->view('admin/footer');
		}
	}
	public function updatecategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$this->upload->do_upload('berkas');


			$result = $this->upload->data();
			$photo = "upload/".$result['file_name'];
			if($result['file_name']){
				$photo = "upload/".$result['file_name'];
			}else{
				$photo = "";
			}

			$data = array(	"category_id" => $this->input->post("category_id"),
							"category_name" => $this->input->post("category_name"),
							"photo" => $photo
						);

			if($this->mdl_admin->updatecategory($data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/category");
			}
		}

	}
	public function deletecategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);
			$this->mdl_admin->deletecategory($id);
			redirect('ctr_admin/category');
		}
	}
	public function createcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createcategory");
			$this->load->view('admin/footer');
		}
	}
	public function insertcategory(){
		//PRINT_R($_POST);DIE();
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$output['message'] = "";
			$this->upload->do_upload('berkas');

				$result = $this->upload->data();
				if($result['file_name']){
					$photo = "upload/".$result['file_name'];
				}else{
					$photo = "";
				}

				$data = array(	"category_name" => $this->input->post("category_name"),
								"photo" => $photo
							);

				$insert = $this->mdl_admin->insert('material_category',$data);

				if($insert == false){
					echo "Tambah Kategori Gagal";die();
				}else{
					redirect("ctr_admin/category");
				}
		}
	}
	public function sub_category(){
		$filter = $this->input->get("sub_category_name");
		//echo $filter;die();
		$config['base_url'] = site_url('ctr_admin/sub_category');
        $config['total_rows'] = $this->mdl_admin->material_sub_category_count($filter);
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
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
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$result_menu = array("menu" => $this->session->userdata("menu"));
		$result = array("pagination"=>$this->pagination->create_links(),
								"result" => $this->mdl_admin->get_sub_category($config["per_page"], $data['page'],$filter),
								"total"=> $this->mdl_admin->material_sub_category_count($filter));
			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/subcategory',$result);
			$this->load->view('admin/footer');
	}
	public function viewsubcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);

			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result_view = array("result" => $this->mdl_admin->get_view_sub_category($id));

			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/viewsubcategory',$result_view);
			$this->load->view('admin/footer');
		}
	}
	public function updatesubcategory(){
		print_r($_POST);
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$this->upload->do_upload('berkas');


			$result = $this->upload->data();
			$photo = "upload/".$result['file_name'];
			if($result['file_name']){
				$photo = "upload/".$result['file_name'];
			}else{
				$photo = "";
			}

			$data = array(	"material_sub_category_id" => $this->input->post("material_sub_category_id"),
							"material_sub_category_name" => $this->input->post("material_sub_category_name"),
							"photo" => $photo
						);

			if($this->mdl_admin->updatesubcategory($data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/sub_category");
			}
		}
	}
	public function createsubcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createsubcategory");
			$this->load->view('admin/footer');
		}
	}
	public function insertsubcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$output['message'] = "";
			$this->upload->do_upload('berkas');

				$result = $this->upload->data();
				if($result['file_name']){
					$photo = "upload/".$result['file_name'];
				}else{
					$photo = "";
				}

				$data = array(	"material_sub_category_name" => $this->input->post("material_sub_category_name"),
								"photo" => $photo
							);

				$insert = $this->mdl_admin->insert('material_sub_category',$data);

				if($insert == false){
					echo "Tambah Kategori Gagal";die();
				}else{
					redirect("ctr_admin/sub_category");
				}
		}
	}


	public function project(){
		$filter = $this->input->get("project_name");
		//echo $filter;die();
		$config['base_url'] = site_url('ctr_admin/project');
        $config['total_rows'] = $this->mdl_admin->get_project_count($filter);
        $config['per_page'] = "5";
        $config["uri_segment"] = 3;
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
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$result_menu = array("menu" => $this->session->userdata("menu"));
		$result = array("pagination"=>$this->pagination->create_links(),
								"result" => $this->mdl_admin->get_project($config["per_page"], $data['page'],$filter),
								"total"=> $this->mdl_admin->get_project_count($filter));
			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/project',$result);
			$this->load->view('admin/footer');
	}

	public function insertproject(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$output['message'] = "";
			$this->upload->do_upload('berkas');

				$result = $this->upload->data();
				if($result['file_name']){
					$photo = "upload/".$result['file_name'];
				}else{
					$photo = "";
				}

				$data = array(	"project_name" => $this->input->post("project_name"),
								"photo" => $photo
							);

				$insert = $this->mdl_admin->insert('project',$data);

				if($insert == false){
					echo "Tambah Kategori Gagal";die();
				}else{
					redirect("ctr_admin/project");
				}
		}
	}
	public function createproject(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createproject");
			$this->load->view('admin/footer');
		}
	}
	public function viewproject(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);

			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result_view = array("result" => $this->mdl_admin->get_view_project($id));

			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/viewproject',$result_view);
			$this->load->view('admin/footer');
		}
	}
	public function updateproject(){
		//print_r($_POST);
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);
			$this->upload->do_upload('berkas');


			$result = $this->upload->data();
			$photo = "upload/".$result['file_name'];
			if($result['file_name']){
				$photo = "upload/".$result['file_name'];
			}else{
				$photo = "";
			}

			$data = array(	"project_id" => $this->input->post("project_id"),
							"project_name" => $this->input->post("project_name"),
							"photo" => $photo
						);

			if($this->mdl_admin->updateproject($data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/project");
			}
		}
	}
	public function deleteproject(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);
			if($this->mdl_admin->deleteproject($id)==false){
				echo "Error";
			}else{
					redirect('ctr_admin/project');
			}

		}
	}
	public function fullcategory(){

	}
	public function datagridfullcategory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result = array("category"=> $this->mdl_admin->get_category("","",""),
											"sub_category"=>$this->mdl_admin->get_sub_category("","",""));
			//print_r($result_category);die();
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createfullcategory",$result);
			$this->load->view('admin/footer');
		}
	}
	public function createfullcategory(){
		$filter = $this->input->post("project_name");
		//echo $filter;die();
		$config['base_url'] = site_url('ctr_admin/createfullcategory');
        $config['total_rows'] = $this->mdl_admin->get_project_count($filter);
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
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
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$result_menu = array("menu" => $this->session->userdata("menu"));
				$result = array("pagination"=>$this->pagination->create_links(),
										"result" => $this->mdl_admin->get_project_full($config["per_page"], $data['page'],$filter),
										"total"=> '<div class="form-group"><label class="form-control">Total Project :'.$this->mdl_admin->get_project_count($filter).'</label></div>',
										"category"=> $this->mdl_admin->get_category("","",""),
										"sub_category"=>$this->mdl_admin->get_sub_category("","","")
							);

				$this->load->view('admin/header',$result_menu);
				$this->load->view("admin/createfullcategory",$result);
				$this->load->view('admin/footer');
	}
	public function insertfullcatgory(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$count_pilihan = count($this->input->post("pilih"));
			//echo $count_pilihan;die();
			if($count_pilihan < 1){
				echo "Anda Belum Menentukan Pilihan Project";die();
			}else if(empty($this->input->post("category_id"))){
				echo "Anda Belum Menentukan Pilihan Kategori";die();
			}else if(empty($this->input->post("sub_category_id"))){
				echo "Anda Belum Menentukan Pilihan Sub Kategori";die();
			}else{

				$i = 0;
				for($i;$i<$count_pilihan;$i++){
					$data[$i] = array("category_id"=>$this->input->post("category_id"),
														"sub_category_id" => $this->input->post("sub_category_id"),
														"user_id" => $this->session->userdata("name"),
														"project_id" => $this->input->post("pilih")[$i]
														);
				}
				foreach($this->mdl_admin->insertfullcatgory("material_full_category",$data) as $row){
					echo $row;
				}


			}
		}
	}
	public function about(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result = array(
									"result" => $this->mdl_admin->get_about()
						);

			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/about",$result);
			$this->load->view('admin/footer');
		}
	}
	public function viewabout(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$id = $this->uri->segment(3);

			$result_menu = array("menu" => $this->session->userdata("menu"));
			$result_view = array("result" => $this->mdl_admin->get_view_about($id));

			$this->load->view('admin/header',$result_menu);
			$this->load->view('admin/viewabout',$result_view);
			$this->load->view('admin/footer');
		}
	}
	public function udpateabout(){
		//print_r($_POST);
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{


			$data = array(	"our_company_content_id" => $this->input->post("our_company_content_id"),
											"subject_content" => $this->input->post("subject_content"),
											"body_content" => $this->input->post("body_content")
						);

			if($this->mdl_admin->updateabout($data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/about");
			}
		}
	}

	public function insertabout(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{


			$data = array(	"subject_content" => $this->input->post("subject_content"),
											"body_content" => $this->input->post("body_content")
						);

			if($this->mdl_admin->insert('our_company_content',$data)==false){
				echo "Update Data Gagal, silahkan coba kembali";die();
			}else{
				redirect("ctr_admin/about");
			}
		}
	}
	public function createabout(){
		if($this->session->userdata("email")==""){
			redirect('ctr_admin/index');
		}else{
			$result_menu = array("menu" => $this->session->userdata("menu"));
			$this->load->view('admin/header',$result_menu);
			$this->load->view("admin/createabout");
			$this->load->view('admin/footer');
		}
	}
}
