<div id="dashboard">
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">View About</h3>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<form enctype="multipart/form-data" action="<?php echo base_url("ctr_admin\insertabout"); ?>" method="post">

									<div class="form-group">
										<label for="nama_barang">Subject</label>
										<input type="text" id="material_sub_category_name" name="subject_content" class="form-control" value="" required>
									</div>
									<div class="form-group">
										<label for="nama_barang">Body Content</label>
										<textarea id="body_content" name="body_content" class="form-control" required ></textarea>
									</div>

									<input type="submit" class="btn btn-success" value="insert">
									<a href="<?php echo base_url("ctr_admin\about");?>" class="btn btn-warning">Cancel</a>
								</form>
							</div>
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
.previewfoto{
	border: 1px solid #eaeaea;
	border-radius: 2px;
	margin-top: 10px;
	width: 100%;
	min-height: 173px;
	overflow: hidden;
}

</style>
