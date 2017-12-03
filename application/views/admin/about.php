<div id="dashboard">
		<div class="main-content">
			<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">

							<form class="form-inline">
								<div class="form-group col-md-4">
										<h3 class="panel-title">About Detail </h3>
								</div>
							</form>
							</br>
							<?= $result ? $result : ""; ?>
							<a href ="<?= base_url("ctr_admin/createsubcategory"); ?>" class="btn btn-xs btn-success pull-right"><span class="lnr lnr-file-add"></span> Tambahkan Kategori</a>
						</div>
					</div>
			</div>
		</div>
</div>
