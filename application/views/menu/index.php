<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?></h1>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<!-- Button Modal -->
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add Menu</button>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Menu</th>
					<th scope="col">Handle</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 1;
				?>
				<?php foreach($menu as $m): ?>
				<tr>
					<th scope="row"><?=$i ?></th>
					<td><?=$m['menu'] ?></td>
					<td>
						<a href="<?= base_url(); ?>menu/edite/editemenu/<?=$m['id'] ?>" class="badge badge-primary">Edit</a>
						<a href="<?= base_url(); ?>menu/delete/menu/<?=$m['id'] ?>" class="badge badge-danger">Delete</a>
					</td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?= form_error('menu'); ?>	
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<form action="" method="POST">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="menuName">Menu</label>
					<input type="text" class="form-control" id="menuName" placeholder="Menu Name" name="menu">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>