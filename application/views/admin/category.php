<div id="dashboard">
	<div class="main-content">
		<div class="container-fluid">
			<!-- OVERVIEW -->
			<div class="panel panel-headline">
				<div class="panel-heading">

					<form class="form-inline row">
						<div class="form-group col-md-4">
							<h3 class="panel-title">Category </h3>
							<input type="text" placeholder="cari kategori..." id="category_name" name="category_name" class="form-control" value="<?= ($this->input->get('category_name') != "") ? $this->input->get('category_name') : "" ; ?>">
							<input type="submit" value="cari" class="btn btn-warning">
						</div>
						<div class="panel-btn left">
							<a href ="<?= base_url("ctr_admin/createcategory"); ?>" class="btn btn-xs btn-success pull-right"><span class="lnr lnr-file-add"></span> Tambahkan Kategori</a>
						</div>
					</form>
					<br>
					<?= $result ? $result : ""; ?>
					<?= $pagination ? $pagination : ""; ?>
					<p class="panel-subtitle">Total Barang : <?= $total ? $total : ""; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
