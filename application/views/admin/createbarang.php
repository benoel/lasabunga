<div id="dashboard">
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Detail barang</h3>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<form enctype="multipart/form-data" action="<?php echo base_url("ctr_admin\insertbarang"); ?>" method="post">
									
									<div class="form-group">
										<label for="nama_barang">Nama Barang</label>
										<input type="text" id="nama_barang" name="material_name" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="suvject_barang">Subject Barang</label>
										<input type="text" id="subject_barang" name="material_subject" class="form-control" >
									</div>
									<div class="form-group">
										<label for="nama_barang">Deskripsi</label>
										<textarea class="form-control" rows="4" name="material_desc"></textarea>
									</div>
									<div class="form-group">
										<label for="nama_barang">Foto Barang</label> 
										<br>
										<input class="inputfile" type="file" id="img" onchange="readURL(this);" name="berkas">
										<label class="btn btn-info labelImg" for="img">Upload Photo</label>

										<script type="text/javascript">
										function readURL(input) {
												if (input.files && input.files[0]) {
													var reader = new FileReader();
													reader.onload = function (e) {
														$('#blah').attr('src', e.target.result);
													}
													reader.readAsDataURL(input.files[0]);
												}
											}
										</script>
										<div class="previewfoto">
											<img class="responsive-img" width="450px" height="350px" id="blah" src="<?= base_url("upload/no_image.jpg"); ?>" alt=""/>
										</div>
									</div>
									<input type="submit" class="btn btn-success" value="Insert">
									<a href="<?php echo base_url("ctr_admin\barang");?>" class="btn btn-warning">Cancel</a>
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
