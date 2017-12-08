
<div class="content row">
	<h4 class="title text-center">Our Product</h4>
	<br>
	<div class="col-md-2">
		<p class="title" style="font-size: 16px;">Filter</p>
		<div class="divider"></div>
		<form class="" action="<?php echo base_url('product') ?>" method="GET">
			<div class="form-group">
				<label for="category">Category</label>
				<select name="filter[category]" class="form-control" id="category">
					<option disabled selected>Select Category</option>
					<?php
					foreach ($category->result() as $row){
						?>
						<option <?php echo $category_id == $row->category_id ? 'selected' : '' ?> value="<?php echo $row->category_id ?>"><?php echo $row->category_name ?></option>
						<?php
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="subcategory">Sub Category</label>
				<select name="filter[subcategory]" class="form-control" id="subcategory">
					<option disabled selected>Select Subcategory</option>
					<?php
					foreach ($subcategory->result() as $row){
						?>
						<option <?php echo $sub_category_id == $row->material_sub_category_id ? 'selected' : '' ?> value="<?php echo $row->material_sub_category_id ?>"><?php echo $row->material_sub_category_name ?></option>
						<?php
					} ?>
				</select>
			</div>
			<div class="form-group">
				<label for="searcg">Search</label>
				<input type="text" value="<?php echo $name ?>" name="filter[name]" placeholder="Search" id="search" class="form-control">
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		<br>
	</div>
	<div class="col-md-10">
		<div class="row">
			<?php if ($total == 0): ?>
				<h3 class="text-center">Maaf kata kunci yang anda cari tidak ditemukan.</h3>
			<?php endif ?>
			<?php
			foreach ($results->result() as $row){
				?>

				<div class="col-md-4">
					<div class="card-product">
						<a class="name" href="<?php echo base_url('product/show/').$row->project_id ?>"><?php echo $row->project_name ?></a>
						<a href="<?php echo base_url('product/show/').$row->project_id ?>">
							<img src="<?php echo base_url().$row->photo ?>" class="responsive-img" alt="">
						</a>
					</div>
				</div>
				<?php
			} ?>
		</div>
		<div class="pag text-center">
			<?= $pagination ? $pagination : ""; ?>
			<?php if ($total == 0): ?>
				<a href="<?php echo base_url('product') ?>" class="btn btn-default">Back</a>
			<?php endif ?>
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
