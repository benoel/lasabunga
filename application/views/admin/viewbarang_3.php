<div id="dashboard">
		<div class="main-content">
			<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Detail barang</h3>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-16">
										<?php //print_r($barang); ?>
										
											<form enctype="multipart/form-data" action="<?php echo base_url("ctr_admin\updatebarang"); ?>" method="post">
											<input type="text" hidden readonly="" name="material_detail_id" value="<?= $barang[0]['material_detail_id']; ?>">
												<table>
													<tr>
														<td width="250px"><label>Nama Barang</label></td>
														<td><input type="text" name="material_name" class="form-control" value="<?=$barang[0]['material_name']; ?>"></td>
													</tr>
													<tr>
														<td width="250px"><label>Subject Barang</label></td>
														<td><input type="text" name="material_subject" class="form-control" value="<?=$barang[0]['material_subject']?>"></td>
													</tr>
													<tr>
														<td width="250px"><label>Subject Barang</label></td>
														<td><textarea class="form-control" name="material_desc"><?= $barang[0]['material_desc'] ?></textarea></td>
													</tr>
													<tr>
														<td width="250px"><label>Poto Barang</label></td>
														<td><input type="file" name="berkas"></td>
													</tr>
													<tr>
														<td width="250px"></td>
														<td><img src="<?= base_url($barang[0]['photo']);?>" width="300px" height="220px"></td>
														
													</tr>
													
													<tr>
														<td><input type="submit" class="btn btn-success" value="Update"></td>
														<td><a href="<?php echo base_url("ctr_admin\barang");?>" class="btn btn-warning">Cancel</a></td>
													</tr>
												<table>
											</form>
										</div>
									</div>
								</div>
						</div>
					</div>
			</div>
		</div>
</div>	
