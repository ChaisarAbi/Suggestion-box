<?php if (session()->get('isLoggedIn')): ?>
    <?php if (session()->get('role') === 'admin'): ?>
        <!-- Admin Menu -->
        <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/kotak-saran') ?>" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Kotak Saran</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/users') ?>" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>User Management</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    <?php else: ?>
        <!-- User Menu -->
      
        <li class="nav-item">
            <a href="<?= base_url('kotak-saran') ?>" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Kotak Saran</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
    <?php endif; ?>
<?php endif; ?>
