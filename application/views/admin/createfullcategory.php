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
								<form enctype="multipart/form-data" action="<?php echo base_url("ctr_admin\insertfullcatgory"); ?>" method="post">
									<?= $category; ?>
									<?= $sub_category?>
										<!--<input type="text" id="material_sub_category_name" name="material_sub_category_name" class="form-control" required>-->
										<div class="form-group">
													<input type="file" id="files"  name="files[]" multiple />
										</div>
							</div>
							</div>


						<div class="form-group">
							<output id="list"></output>
						</div>
						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Insert">
						<a href="<?php echo base_url("ctr_admin\barang");?>" class="btn btn-warning">Cancel</a>
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
<script>
	function handleFileSelect(evt) {
		var files = evt.target.files; // FileList object

		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {

			// Only process image files.
			if (!f.type.match('image.*')) {
				continue;
			}

			var reader = new FileReader();

			// Closure to capture the file information.
			reader.onload = (function(theFile) {
				return function(e) {
					// Render thumbnail.
					var span = document.createElement('span');
					span.innerHTML = ['<img class="thumb" src="', e.target.result,
														'" title="', escape(theFile.name), '"/>'].join('');
					document.getElementById('list').insertBefore(span, null);
				};
			})(f);

			// Read in the image file as a data URL.
			reader.readAsDataURL(f);
		}
	}

	document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>
