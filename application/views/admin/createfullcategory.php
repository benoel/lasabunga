<div id="dashboard">
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Upload Detil Photo</h3>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<form enctype="multipart/form-data" action="<?= base_url("ctr_admin\insertfullcatgory"); ?>" method="post">
									<?= $category; ?>
									<?= $sub_category;?>

									<?= $result;?>
									<?= $pagination;?>
									<?= $total;?>


										<!--<input type="text" id="material_sub_category_name" name="material_sub_category_name" class="form-control" required>-->
										<div class="form-group">


										</div>
							</div>
							</div>
							<div class="pop">
							</div>

						<div class="form-group">
							<output id="list"></output>
						</div>
						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Insert" name="insert">
						<a href="<?php echo base_url("ctr_admin\barang");?>" class="btn btn-warning">Cancel</a>
						</div>
					</form>
					<form enctype="multipart/form-data" action="<?= base_url("ctr_admin\createfullcategory"); ?>" method="post">
						<div class="form-group">
							<input type="text" name="project_name" value="<?= $this->input->post("project_name"); ?>" class="form-control" placeholder="cari project">

						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-info" name="cari" value="cari">
						</div>
					</form>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<style>

/*styling input:file*/
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
/*styling inputfile label*/
.labelImg{
	right: 0.75rem;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}

.thumb {
	border: 1px solid #eaeaea;
	border-radius: 2px;
	margin-top: 10px;
	width: 20%;
	min-height: 173px;
	overflow: hidden;
}

</style>
