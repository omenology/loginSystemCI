<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?></h1>
	<div class="row">
		<div class="col-6">
			<?= $this->session->flashdata('message'); ?>
			<form action="" method="POST">
				<div class="form-group row">
					<label class="col-sm-3 col-form-label">Current Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" placeholder="Current Password" name="currentPassword">
						<?= form_error('currentPassword'); ?>	
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label">New Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" placeholder="New Password" name="newPassword">
						<?= form_error('newPassword'); ?>	
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-form-label">Re-type Password</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" placeholder="Password" name="rePassword">
						<?= form_error('rePassword'); ?>	
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-9">
						<button type="submit" class="btn btn-primary">Change</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->