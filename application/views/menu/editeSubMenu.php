<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?> (edite)</h1>
	<div class="row">
		<form action="" method="POST" class="col-6">
			<input type="hidden" name="id" value="<?= $submenuEdite['id'] ?>">
			<div class="form-group">
				<label>Title</label>
				<input type="text" class="form-control" placeholder="Menu Name" name="submenu" value="<?= $submenuEdite['title'] ?>">
			</div>
			<div class="form-group">
				<label>Icon</label>
				<input type="text" class="form-control" placeholder="icon" name="icon" value="<?= $submenuEdite['icon'] ?>">
			</div>
			<div class="form-group">
				<label>Url</label>
				<input type="text" class="form-control" placeholder="example : menu/submenu" name="link" value="<?= $submenuEdite['url'] ?>">
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="active">
					<option value="1">On</option>
					<option value="0">Off</option>
				</select>
			</div>
			<div class="form-group">
				<label for="role">Menu</label>
				<select id="role" class="form-control" name="menu_id">
					<?php foreach($menu as $m): ?>
					<option value="<?=$m['id'] ?>"><?=$m['menu'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>	
			<button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->