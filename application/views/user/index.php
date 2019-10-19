<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?=$title; ?></h1>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-6">
      <?= $this->session->flashdata('message'); ?>
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            
            <div class="col-md-4">
              <img src="<?= base_url(); ?>asset/img/profile/<?=$user['image'] ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title font-weight-bold text-primary text-uppercase mb-1"><?=$user['name'] ?></h5>
                <h6><?=$user['email'] ?></h6>
                <p class="card-text text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sodales mauris massa, a eleifend mi placerat sed. Donec quis lacus.</p>
                <p class="card-text"><small class="text-muted">Member since <?=date('d F Y', $user['date_created']); ?></small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
