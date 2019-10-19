<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="row">
		<h1 class="h3 mb-4 text-gray-800"><?=$title; ?> Access</h1>
		<?= $this->session->flashdata('message'); ?>
	</div>
	<div class="row">
		<h5>Role : <?=$role['role'] ?></h5>
	</div>
	<div class="row">
		<table class="table table-striped col-6">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Menu</th>
					<th class="text-center" scope="col">Access</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 1;
				?>
				<?php foreach($menuAll as $menu): ?>
				<tr>
					<th scope="row"><?=$i ?></th>
					<td><?=$menu['menu'] ?></td>
					<td class="d-flex justify-content-center">
						<div class="form-check">
							<input class = "form-check-input" type="checkbox" <?php if(check_access($role['id'], $menu['id']) > 0) echo "checked"; ?> data-role = <?=$role['id'] ?> data-menu = <?=$menu['id'] ?>>
						</div>
					</td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->