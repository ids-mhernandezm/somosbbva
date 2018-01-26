<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Nueva aplicación</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="admin-post.php">
					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="name" value="<?php echo (isset($profile->name)) ? $profile->name : "" ?>">
					</div>
					
					<div class="form-group">
						<label>CD funcion</label>
						<input type="text" class="form-control" name="description" value="<?php echo (isset($profile->description)) ? $profile->description : "" ?>">
					</div>
					
					<div class="form-group">
						<label>Palabras clave para busqueda (separadas por coma)</label>
						<input type="text" class="form-control" name="attachment" value="<?php echo (isset($profile->attachment)) ? $profile->attachment : "" ?>">
					</div>
												
					
					<div class="form-group">
						
						<input type="hidden" name="origin"  	value="aplicaciones" />
						<label>Tipo</label><br>
						<select 	name="type">
						  <option value="bbva-app">Aplicación BBVA</option>
						  <option value="Pagina">Pagina</option>
						  <option value="Boton">Boton</option>
						  <option value="Seccion">Sección</option>
						</select>
						<br>
						<div class="form-group">
						<label>Perfilado (empresas separadas por comas)</label>
						<input type="text" class="form-control" name="perfilado" value="<?php echo (isset($profile->perfilado)) ? $profile->perfilado : "" ?>">
						</div>
						<hr/>
					
						<input type="hidden"	name="category" 	value="0" />
						<input type="hidden" name="action" 	value="<?php echo $method; ?>"/>
						
						<?php if(isset($profile->id)):?>
							<input type="hidden"	name="id" 	value="<?php echo $profile->id; ?>" />
						<?php endif;?>
						
						<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> <?php echo (isset($profile->id) ) ? 'Actualizar' : 'Guardar'; ?> cambios</button>
	
					</div>
				</form>
				
			</div>
		</div>		
	</div>
</section>