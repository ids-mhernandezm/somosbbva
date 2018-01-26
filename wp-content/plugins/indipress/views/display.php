<?php echo get_header(); ?>

<?php 

	$uid = $_SESSION["profile"]->gid;
	
	//$favs = Indipress::get_instance()->getWhere("_indipress",  array( "name" => $uid,  "type" => "favs"));

?>


<section class="container-wrap">

	<div class="row">

		<div class="container">
	
			<div class="col-md-12">
				<h3><i class="icon-heart-empty"></i> Mis favoritos: </h3>
			</div>

			<div class="col-md-12">
				<ul class="list-group">
					
					<?php foreach($favs as $row): ?>

						<li class="list-group-item">
							<a href="<?php echo site_url("/").$row->description; ?>"> 
								<i class="fa fa-check"></i>  <?php echo  ucfirst($row->description);  ?>
							</a>
						</li>

					<?php endforeach; ?>

				</ul>
			</div>

		</div>

	</div>

</section>

<?php echo get_footer(); ?>