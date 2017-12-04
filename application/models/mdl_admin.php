<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_Admin extends CI_Model {

	public function login($email,$password){
		$qry = "SELECT *
		FROM USER
		WHERE email = '".$email."'
		and password = '".$password."'";
				//echo $qry;die();
		$sql =  $this->db->query($qry);
		if($sql->num_rows() == 1){
			$output =  $sql;
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function menu($email){
		$qry = "select ur.role_id from user_role ur
		join user u on u.user_id = ur.user_id
		where u.email = '".$email."'";
		$sql = $this->db->query($qry);
		if($sql->num_rows()>0){
			$get_role = $sql->result_array();
		}
		$role_id =  $get_role[0]['role_id'];
		$qry = "select m.menu_name,m.menu_url
		from role_menu rm
		join menu m on rm.menu_id = m.menu_id
		where role_id = '".$role_id."'";
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0){
			$output =  $sql->result_array();
		}else{
			$output  = false;
		}
		return $output;
	}
	public function material_detail_count($filter){
		if($filter != ""){
			$fltr = "where material_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$query = "SELECT * FROM material_detail ".$fltr;
		$sql = $this->db->query($query);
		return $sql->num_rows();

	}
	public function get_barang($limit,$start,$filter){
		$output = "";

		if($filter !=""){
			$fltr = "where material_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$qry = "select * from material_detail ".$fltr." LIMIT $start,$limit";

		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		//print_r($sql);die();
		if($sql->num_rows() > 0){
			$output .= '<table class="table table-bordered">
			<thead>
			<tr>
			<td>Material name</td>
			<td>Material subject</td>
			<td>Material pict</td>
			<td>Edit</td>
			<td>Delete</td>
			</tr>
			</thead>
			';
			$output .= '<tbody>';
			foreach($sql->result() as $row_data){
				if($row_data->photo!=""){
					$photo = '<img width = "30px" height="24px" src="'.base_url($row_data->photo).'">';
				}else{
					$photo = "not found";
				}
				$output .= '<tr>
				<td>'.ucwords($row_data->material_name).'</td>
				<td>'.ucwords($row_data->material_subject).'</td>
				<td>'.$photo.'</td>
				<td><a href="'.base_url("ctr_admin/viewbarang/".$row_data->material_detail_id).'" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"></span></a></td>
				<td><a href="'.base_url("ctr_admin/deletebarang/".$row_data->material_detail_id).'" class="btn btn-danger btn-xs"><span class="lnr lnr-trash"></span></a></td>

				</tr>';
			}
			$output .= '</tbody>
			</table>';

		}else{
			$output = "Data Kosong";
		}
		return $output;
	}
	public function get_view_barang($id){
		$qry = "select * from material_detail where material_detail_id = '".$id."'";
		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0 ){
			$output = $sql->result_array();
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function updatebarang($data){
		$photo = $data['photo']=="" ? "photo = photo" : "photo = '".$data['photo']."'";
		$qry = "update material_detail
		set material_name = '".$data['material_name']."',
		material_subject = '".$data['material_subject']."',
		material_desc = '".$data['material_desc']."',
		".$photo."
		where material_detail_id = '".$data['material_detail_id']."'
		";
		$sql = $this->db->query($qry);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function deletebarang($id){
		$qry = "delete from material_detail where material_detail_id = '".$id."'";
		$sql = $this->db->query($qry);
		if(!$sql){
			return false;
		}else{
			return true;
		}
	}
	public function insert($table,$data){

		$sql = $this->db->insert($table,$data);
		if(!$sql){
			return false;
		}else{
			return true;
		}
	}
	public function material_category_count($filter){
		if($filter != ""){
			$fltr = "where category_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$query = "SELECT * FROM material_category ".$fltr;
		$sql = $this->db->query($query);
		return $sql->num_rows();

	}
	public function get_category($limit,$start,$filter){
		$output = "";

		if($filter !=""){
			$fltr = "where category_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		if($limit!=""){
			$qry = "select * from material_category ".$fltr." LIMIT $start,$limit";
			$sql = $this->db->query($qry);
			if($sql->num_rows() > 0){
				$output .= '<table class="table table-bordered">
				<thead>
				<tr>
				<td>Category name</td>
				<td>Photo</td>
				<td>Edit</td>
				<td>Delete</td>
				</tr>
				</thead>
				';
				$output .= '<tbody>';
				foreach($sql->result() as $row_data){
					if($row_data->photo!=""){
						$photo = '<img width = "30px" height="24px" src="'.base_url($row_data->photo).'">';
					}else{
						$photo = "not found";
					}
					$output .= '<tr>
					<td>'.ucwords($row_data->category_name).'</td>
					<td>'.$photo.'</td>
					<td><a href="'.base_url("ctr_admin/viewcategory/".$row_data->category_id).'" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"></span></a></td>
					<td><a href="'.base_url("ctr_admin/deletecategory/".$row_data->category_id).'" class="btn btn-danger btn-xs"><span class="lnr lnr-trash"></span></a></td>

					</tr>';
				}
				$output .= '</tbody>
				</table>';

			}else{
				$output = "Data Kosong";
			}

		}else{
			$qry = "select * from material_category ".$fltr;
			$sql = $this->db->query($qry);
			$output .= '<div class="form-group">
			<label for="cetegory_id">Pilih Kategori</label>
			<select class="form-control" id="category_id" name="category_id">';
			$output .= '<option value="">Choose Category</option>';
			if($sql->num_rows() > 0){
				foreach($sql->result() as $row){
					if($this->input->post("category_id") == $row->category_id ){
						$output .= '<option value="'.$row->category_id.'" selected>'.$row->category_name.'</option>';
					}else{
						$output .= '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
					}

				}
			}else{

			}

			$output .='</select>
			</div>';
		}
		return $output;
	}
	public function get_view_category($id){
		$qry = "select * from material_category where category_id = '".$id."'";
		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0 ){
			$output = $sql->result_array();
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function updatecategory($data){
		$photo = $data['photo']=="" ? "photo = photo" : "photo = '".$data['photo']."'";
		$qry = "update material_category
		set category_name = '".$data['category_name']."',
		".$photo."
		where category_id = '".$data['category_id']."'
		";
		$sql = $this->db->query($qry);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function deletecategory($id){
		$qry = "delete from material_category where category_id = '".$id."'";
		$sql = $this->db->query($qry);
		if(!$sql){
			return false;
		}else{
			return true;
		}
	}
	public function material_sub_category_count($filter){
		if($filter != ""){
			$fltr = "where material_sub_category_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$query = "SELECT * FROM material_sub_category ".$fltr;
		$sql = $this->db->query($query);
		return $sql->num_rows();

	}
	public function get_sub_category($limit,$start,$filter){
		$output = "";

		if($filter !=""){
			$fltr = "where material_sub_category_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		if($limit!=""){
			$qry = "select * from material_sub_category ".$fltr." LIMIT $start,$limit";

		//echo nl2br($qry);die();
			$sql = $this->db->query($qry);
		//print_r($sql);die();
			if($sql->num_rows() > 0){
				$output .= '<table class="table table-bordered">
				<thead>
				<tr>
				<td>Sub Category Name</td>
				<td>Photo</td>
				<td>Edit</td>
				<td>Delete</td>
				</tr>
				</thead>
				';
				$output .= '<tbody>';
				foreach($sql->result() as $row_data){
					if($row_data->photo!=""){
						$photo = '<img width = "30px" height="24px" src="'.base_url($row_data->photo).'">';
					}else{
						$photo = "not found";
					}
					$output .= '<tr>
					<td>'.ucwords($row_data->material_sub_category_name).'</td>
					<td>'.$photo.'</td>
					<td><a href="'.base_url("ctr_admin/viewsubcategory/".$row_data->material_sub_category_id).'" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"></span></a></td>
					<td><a href="'.base_url("ctr_admin/deletesubcategory/".$row_data->material_sub_category_id).'" class="btn btn-danger btn-xs"><span class="lnr lnr-trash"></span></a></td>
					</tr>';
				}
				$output .= '</tbody>
				</table>';

			}else{
				$output = "Data Kosong";
			}

		}else{
			$qry = "select * from material_sub_category ".$fltr;
			$sql = $this->db->query($qry);
			$output .= '<div class="form-group">
			<label for="sub_category_id">Pilih Sub Kategori</label>
			<select class="form-control" id="sub_category_id" name="sub_category_id">';
			$output .= '<option value="">Choose Sub Category</option>';
			if($sql->num_rows() > 0){
				foreach($sql->result() as $row){
					if($this->input->post("sub_category_id") == $row->material_sub_category_id){
						$output .= '<option value="'.$row->material_sub_category_id.'" selected>'.$row->material_sub_category_name.'</option>';
					}else{
						$output .= '<option value="'.$row->material_sub_category_id.'">'.$row->material_sub_category_name.'</option>';
					}

				}
			}else{

			}

			$output .='</select>
			</div>';
		}
		return $output;
	}
	public function get_view_sub_category($id){
		$qry = "select * from material_sub_category where material_sub_category_id = '".$id."'";
		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0 ){
			$output = $sql->result_array();
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function updatesubcategory($data){
		//print_r($data);die();
		$photo = $data['photo']=="" ? "photo = photo" : "photo = '".$data['photo']."'";
		$qry = "update material_sub_category
		set material_sub_category_name = '".$data['material_sub_category_name']."',
		".$photo."
		where material_sub_category_id = '".$data['material_sub_category_id']."'
		";
		$sql = $this->db->query($qry);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function insertfullcatgory($table,$data){
		$i = 0;
		$count_arr = count($data);
		for($i;$i<$count_arr;$i++){
			if($sql = $this->db->insert($table,$data[$i])){
				$output [$i]= "Pilihan ".$i." Tersimpan";
			}else{
				$output [$i]= "Pilihan ".$i." Gagal Tersimpan";
			}

		}
		return $output;
	}
	public function get_project($limit,$start,$filter){
		$output = "";

		if($filter !=""){
			$fltr = "where project_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$qry = "select * from project ".$fltr." LIMIT $start,$limit";

		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		//print_r($sql);die();
		if($sql->num_rows() > 0){
			$output .= '<table class="table table-bordered">
			<thead>
			<tr>
			<td>Project name</td>
			<td>Photo</td>
			<td>Edit</td>
			<td>Delete</td>
			</tr>
			</thead>
			';
			$output .= '<tbody>';
			foreach($sql->result() as $row_data){
				if($row_data->photo!=""){
					$photo = '<img width = "30px" height="24px" src="'.base_url($row_data->photo).'">';
				}else{
					$photo = "not found";
				}
				$output .= '<tr>
				<td>'.ucwords($row_data->project_name).'</td>

				<td>'.$photo.'</td>
				<td><a href="'.base_url("ctr_admin/viewproject/".$row_data->project_id).'" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"></span></a></td>
				<td><a href="'.base_url("ctr_admin/deleteproject/".$row_data->project_id).'" class="btn btn-danger btn-xs"><span class="lnr lnr-trash"></span></a></td>

				</tr>';
			}
			$output .= '</tbody>
			</table>';

		}else{
			$output = "Data Kosong";
		}
		return $output;
	}
	public function get_project_full($limit,$start,$filter){
		$output = "";

		if($filter !=""){
			$fltr = "where project_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$qry = "select * from project ".$fltr." LIMIT $start,$limit";

		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		//print_r($sql);die();
		if($sql->num_rows() > 0){
			$output .= '<table class="table table-bordered">
			<thead>
			<tr>
			<td>Project name</td>
			<td>Photo</td>
			<td>Pilih</td>
			</tr>
			</thead>
			';
			$output .= '<tbody>';
			foreach($sql->result() as $row_data){
				if($row_data->photo!=""){
					$photo = '<img width = "30px" height="24px" src="'.base_url($row_data->photo).'">';
				}else{
					$photo = "not found";
				}
				$output .= '<tr>
				<td>'.ucwords($row_data->project_name).'</td>

				<td>'.$photo.'</td>
				<td><input type="checkbox" name="pilih[]" value="'.$row_data->project_id.'"></td>
				</tr>';
			}
			$output .= '</tbody>
			</table>';

		}else{
			$output = "Data Kosong";
		}
		return $output;
	}
	public function get_project_count($filter){
		if($filter != ""){
			$fltr = "where project_name like '%".$filter."%'";
		}else{
			$fltr = "";
		}
		$query = "SELECT * FROM project ".$fltr;
		$sql = $this->db->query($query);
		return $sql->num_rows();

	}
	public function get_view_project($id){
		$qry = "select * from project where project_id = '".$id."'";
		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0 ){
			$output = $sql->result_array();
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function updateproject($data){
		//print_r($data);die();
		$photo = $data['photo']=="" ? "photo = photo" : "photo = '".$data['photo']."'";
		$qry = "update project
		set project_name = '".$data['project_name']."',
		".$photo."
		where project_id = '".$data['project_id']."'
		";
		$sql = $this->db->query($qry);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
	public function deleteproject($id){
		$qry = "delete from project where project_id = '".$id."'";
		$sql = $this->db->query($qry);
		if(!$sql){
			return false;
		}else{
			return true;
		}
	}
	public function get_about(){
		$output = "";


		$qry = "select * from our_company_content";

		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		//print_r($sql);die();
		if($sql->num_rows() > 0){
			$output .= '<table class="table table-bordered">
			<thead>
			<tr>
			<td>Subject Content</td>
			<td>Body Content</td>
			<td>Edit</td>
			</tr>
			</thead>
			';
			$output .= '<tbody>';
			foreach($sql->result() as $row_data){

				$output .= '<tr>
				<td>'.ucwords($row_data->subject_content).'</td>
				<td>'.ucwords($row_data->body_content).'</td>
				<td><a href="'.base_url("ctr_admin/viewabout/".$row_data->our_company_content_id).'" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"></span></a></td>
				</tr>';
			}
			$output .= '</tbody>
			</table>';

		}else{
			$output = "Data Kosong";
		}
		return $output;
	}
	public function get_view_about($id){
		$qry = "select * from our_company_content where our_company_content_id = '".$id."'";
		//echo nl2br($qry);die();
		$sql = $this->db->query($qry);
		if($sql->num_rows() > 0 ){
			$output = $sql->result_array();
		}else{
			$output = NULL;
		}
		return $output;
	}
	public function updateabout($data){
		//print_r($data);die();
		$qry = "update our_company_content
		set subject_content = '".$data['subject_content']."',
		body_content = '".$data['body_content']."'

		where our_company_content_id = '".$data['our_company_content_id']."'
		";
		$sql = $this->db->query($qry);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
}
?>
