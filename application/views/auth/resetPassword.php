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
                    <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="New Password">
                      <?= form_error('password'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="rePassword" placeholder="Re type Password">
                      <?= form_error('rePassword'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                    Change
                    </button>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>