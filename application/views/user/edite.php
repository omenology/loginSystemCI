<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?=$title; ?></h1>
	<div class="row">
		<div class="col-6">
			<?= form_open_multipart('user/edite');?>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="text" readonly class="form-control-plaintext" value="<?= $user['email'] ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Full Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
					<?= form_error('name'); ?>	
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Photo</label>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-3">
							<img src="<?= base_url(); ?>asset/img/profile/<?=$user['image'] ?>" class="img-thumbnail">
						</div>
						<div class="col-9">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="image" name="image">
								<label class="custom-file-label" for="image">Choose file</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row justify-content-end">
				<div class="col-10">
					<button type="submit" name="submit" class="btn btn-primary">Edite</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->