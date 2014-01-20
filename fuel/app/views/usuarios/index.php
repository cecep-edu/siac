<h1>Lista de usuarios</h1>
<a href="/usuarios/nuevo" role="button" class="btn btn-info btn-xs">Crear Usuario</a>

<table class="table table-hover">
	<thead>
    	<tr>
        	<th>#</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach($usuarios as $usuario): ?>
        	<tr>
        		<td><?php echo $usuario->id; ?></td>
        		<td><?php echo $usuario->username; ?></td>
        		<td><?php echo $usuario->email; ?></td>
        		<td>
        			<?php echo Html::anchor('/usuarios/'.$usuario->id, 'Mostrar', array('class' => 'btn btn-success btn-xs')); ?>
        			<?php echo Html::anchor('/usuarios/'.$usuario->id.'/editar', 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
        			<?php echo Html::anchor('/usuarios/'.$usuario->id.'/eliminar', 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
        		</td>
        	</tr>
        <?php endforeach; ?>
    </tbody>
</table>