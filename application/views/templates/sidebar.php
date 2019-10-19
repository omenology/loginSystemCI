<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Login CI</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <?php foreach ($menu as $m):?>
        <!-- Heading -->
        <div class="sidebar-heading"><?=$m['menu'] ?></div>
        <?php $subMenu = $this->db->get_where('user_sub_menu', ['menu_id' => $m['id'], 'is_active' => 1])->result_array(); ?>
        <?php foreach($subMenu as $sm): ?>
          <?php if($title == $sm['title']): ?>
            <li class="nav-item active">
          <?php else: ?>
            <li class="nav-item">
          <?php endif; ?>
            <a class="nav-link pb-0" href="<?= base_url(); ?><?=$sm['url'] ?>">
              <i class="<?=$sm['icon'] ?>"></i>
              <span><?=$sm['title'] ?></span>
            </a>
          </li>
        <?php endforeach; ?>
        <!-- Divider -->
        <hr class="sidebar-divider mt-3">
      <?php endforeach; ?>
      <!-- Nav Item - Logout -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>auth/logout">
          <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
          <span>Logout</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->