
<div class="content row">
	<h4 class="title text-center">Our Product</h4>
	<br>
	<div class="col-md-2">
		<form class="">
			<div class="form-group">
				<label for="category">Category</label>
				<select class="form-control" id="category">
					<option disabled selected>Select Category</option>
					<?php 
					foreach ($category->result() as $row){
						?>
						<option value="<?php echo $row->category_id ?>"><?php echo $row->category_name ?></option>
						<?php 
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="subcategory">Sub Category</label>
				<select class="form-control" id="subcategory">
					<option disabled selected>Select Subcategory</option>
					<?php 
					foreach ($subcategory->result() as $row){
						?>
						<option value="<?php echo $row->material_sub_category_id ?>"><?php echo $row->material_sub_category_name ?></option>
						<?php 
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="searcg">Search</label>
				<input type="text" placeholder="Search" id="search" class="form-control">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		<br>
	</div>
	<div class="col-md-10">
		<div class="row">
			<?php 
			foreach ($md->result() as $row){
				?>

				<div class="col-md-4">
					<div class="card-product">
						<a class="name" href="<?php echo base_url('product/show/').$row->material_detail_id ?>"><?php echo $row->material_name ?></a>
						<a href="<?php echo base_url('product/show/').$row->material_detail_id ?>">
							<img src="<?php echo base_url().$row->photo ?>" class="responsive-img" alt="">
						</a>
					</div>
				</div>
				<?php 
			} ?>
		</div>
	</div>
</div>

<style>
.form-control,
select.form-control{
	display: block;
	width: 100%;
	border-radius: 0;
	-webkit-appearance: none;
	/*border-color: #eee;*/
}
.card-product{
	border: 1px solid #eee;
	margin-bottom: 30px;
}
.card-product .name{
	background-color: #D9E5EB!important;
	font-weight: 300;
	font-size: 1.2em;
	color: #353535!important;
	padding: 7px 15px;
	display: block;
	position: absolute;
	bottom: 30px;
	width: calc(100% - 30px);
	text-align: center;

}
@media screen and (max-width: 480px) {
	.card-product .name {
		bottom: 0px;
	}
}
.card-product .name:hover{
	opacity: .5;
}
</style>
