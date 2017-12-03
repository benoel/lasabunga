<div id="dashboard">
		<div class="main-content">
			<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">

							<form class="form-inline">
								<div class="form-group col-md-4">
										<h3 class="panel-title">Project Detail </h3>
										<input type="text" placeholder="cari project..." id="project_name" name="project_name" class="form-control" value="<?= ($this->input->get('project_name') != "") ? $this->input->get('project_name') : "" ; ?>">
										<input type="submit" value="cari" class="btn btn-warning">
								</div>
							</form>
							</br>
							<?= $result ? $result : ""; ?>
							<?= $pagination ? $pagination : ""; ?>
							<a href ="<?= base_url("ctr_admin/createproject"); ?>" class="btn btn-xs btn-success pull-right"><span class="lnr lnr-file-add"></span> Tambahkan Kategori</a>
							<p class="panel-subtitle">Total Project : <?= $total ? $total : ""; ?></p>
						</div>
					</div>
			</div>
		</div>
</div>
