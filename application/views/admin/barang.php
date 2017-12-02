<div id="dashboard">
		<div class="main-content">
			<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
						
							<form class="form-inline">
								<div class="form-group col-md-4">
										<h3 class="panel-title">Material </h3>
										<input type="text" placeholder="cari barang..." id="nama_barang" name="material_name" class="form-control" value="<?= ($this->input->get('material_name') != "") ? $this->input->get('material_name') : "" ; ?>">
										<input type="submit" value="cari" class="btn btn-warning">
								</div>
							</form>
							</br>
							<?= $barang ? $barang : ""; ?>
							<?= $pagination ? $pagination : ""; ?>
							<a href ="<?= base_url("ctr_admin/createbarang"); ?>" class="btn btn-xs btn-success pull-right"><span class="lnr lnr-file-add"></span> Tambahkan Material</a>
							<p class="panel-subtitle">Total Barang : <?= $total ? $total : ""; ?></p>
						</div>
					</div>
			</div>
		</div>
</div>	
