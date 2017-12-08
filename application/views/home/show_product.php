
<div class="content row">
	<h4 class="title text-center"><?php echo $md[0]['project_name'] ?></h4>
	<br>
	<div class="divider"></div>
	<div class="col-md-12 detail">
		<div class="material-img">
			<img src="<?php echo base_url().$md[0]['photo'] ?>" class="responsive-img" alt="">
		</div>
		<h4 style="text-decoration: underline; ">Description</h4>
		<p>
			<?php echo $md[0]['deskripsi'] ?>
		</p>
	</div>
	<div class="text-center">
		<a href="<?php echo base_url('product') ?>" class="btn btn-default">Back</a>
	</div>


</div>

<style>
.detail{
	margin-top: 20px;
	margin-bottom: 30px;
	/*backface-visibility: visible !important;*/
}
.detail .material-img{
	width: 20%;
	float: left;
	display: inline;
	margin: 0 40px 40px 0;
}
.detail p{
	display: inline;
	vertical-align: top;
	text-align: left;
}
@media screen and (max-width: 480px) {
	.detail .material-img{
		background-color: red;
		width: 100%;
		float: none;
		display: block;
		margin: 0 0 20px 0;
	}
}
</style>
