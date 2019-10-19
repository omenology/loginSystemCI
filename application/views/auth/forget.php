<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Forget Password !</h1>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="email" placeholder="Enter Email Address...">
                      <?= form_error('email'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>