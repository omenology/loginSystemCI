<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?> (edite)</h1>
	<div class="row">
		<form action="" method="POST" class="col-6">
			<input type="hidden" name="id" value="<?=$roleEdite['id'] ?>">
			<div class="form-group">
				<label for="menuName">Role</label>
				<input type="text" class="form-control" id="menuName" placeholder="Role Name" name="role" value="<?=$roleEdite['role'] ?>">
			</div>
			<button type="submit" class="btn btn-primary">Save</button>
		</form>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->