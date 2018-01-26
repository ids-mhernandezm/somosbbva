<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Aplicaciones BBVA</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="admin.php?page=add-app" class="btn btn-info btn-sm"> <i class="fa fa-plus"></i> Agregar Aplicación</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#ID</th>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Perfilado</th>
							<td colspan="2"></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($apps as $row): ?>
							<tr>
								<td width="40"><?php echo $row->id; ?></td>
								<td><?php echo $row->name; ?></td>
								<td width="30"><?php echo $row->type; ?></td>
								<td width="30"><?php echo $row->perfilado; ?></td>
								<td class="text-center"><a class="btn btn-danger btn-sm deleteProduct" data-target="<?php echo $row->id; ?>"> <i class="fa fa-trash"></i> Eliminar </a></td>
								<td class="text-center"><a href="admin.php?page=edit-app&itemid=<?php echo $row->id; ?>" class="btn btn-sm btn-warning"> <i class="fa fa-edit"></i> Editar </a></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>