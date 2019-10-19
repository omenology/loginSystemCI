<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?></h1>
	<div class="row">
		<?= $this->session->flashdata('message'); ?>
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add Menu</button>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Menu</th>
					<th scope="col">Sub Menu</th>
					<th scope="col">Icon</th>
					<th scope="col">Link</th>
					<th scope="col">Status</th>
					<th scope="col">handle</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$active = ['Off', 'On'];
					$i = 1;
				?>
				<?php foreach($subMenu as $sub): ?>
				<tr>
					<th scope="row"><?=$i ?></th>
					<td><?= $sub['menu']; ?></td>
					<td><?= $sub['title']; ?></td>
					<td><?= $sub['icon']; ?></td>
					<td><?= $sub['url']; ?></td>
					<td><?= $active[$sub['is_active']]; ?></td>
					<td>
						<a href="<?= base_url(); ?>menu/edite/editesubmenu/<?=$sub['id'] ?>" class="badge badge-primary">Edit</a>
						<a href="<?= base_url(); ?>menu/delete/submenu/<?=$sub['id'] ?>" class="badge badge-danger">Delete</a>
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
					<label>sub Menu</label>
					<input type="text" class="form-control" placeholder="Menu Name" name="submenu">
				</div>
				<div class="form-group">
					<label>Icon</label>
					<input type="text" class="form-control" placeholder="icon" name="icon">
				</div>
				<div class="form-group">
					<label>link</label>
					<input type="text" class="form-control" placeholder="example : menu/submenu" name="link">
				</div>
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="active">
						<option value="1">On</option>
						<option value="0">Off</option>
					</select>
				</div>
				<div class="form-group">
					<label for="role">Role User</label>
					<select id="role" class="form-control" name="menu_id">
						<?php foreach($menu as $m): ?>
						<option value="<?=$m['id'] ?>"><?=$m['menu'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
</div>