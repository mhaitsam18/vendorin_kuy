<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/index') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?php if ($title=="Data Vendor"): echo "active"; endif ?>">
                <a class="nav-link" href="<?php echo base_url('admin/vendor') ?>">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Data Vendor</span></a>
            </li>

            <li class="nav-item <?php if ($title=="Data Mahasiswa"): echo "active"; endif ?>">
                <a class="nav-link" href="<?php echo base_url('admin/mahasiswa') ?>">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Data Mahasiswa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <?php 
                            $this->db->order_by('id', 'DESC');
                            $notifikasi = $this->db->get_where('tb_notifikasi', ['id_user' => $user['id']], 5)->result_array();
                            $notifikasi_unread = $this->db->get_where('tb_notifikasi', ['id_user' => $user['id'], 'is_read' => 0])->num_rows();
                         ?>
                        <li class="nav-item dropdown no-arrow mx-1" id="show">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">
                                    <?php if ($notifikasi_unread > 5): ?>
                                        5+
                                    <?php else: ?>
                                        <?= $notifikasi_unread ?>
                                    <?php endif ?>
                                </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a href="" class="float-right mr-3" style="color: #A3D0EF;" onclick="notifikasi()">
                                    <small class="text-primary">Tandai Semua Sudah dibaca</small>
                                </a>
                                <?php $icon = ''; ?>
                                <?php $bg = ''; ?>
                                <?php foreach ($notifikasi as $key): ?>
                                    <?php 
                                    switch ($key['id_kategori_notifikasi']) {
                                         case 1: $bg = 'bg-warning'; $icon = 'fas fa-exclamation-triangle'; break;
                                         case 2: $bg = 'bg-primary'; $icon = 'fas fa-user-plus'; break;
                                         case 3: $bg = 'bg-success'; $icon = 'fas fa-donate'; break;
                                         case 4: $bg = 'bg-info'; $icon = 'fas fa-users'; break;
                                         default: $bg = 'bg-info'; $icon = 'fas fa-file-alt'; break;
                                     } ?>
                                    <span class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle <?= $bg ?>">
                                                <i class="<?= $icon ?> text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= date('j F Y, H:i:s', strtotime($key['waktu_notifikasi'])) ?></div>
                                            <?php if ($key['is_read'] == 0): ?>
                                                <span class="font-weight-bold"><?= $key['pesan'] ?></span>
                                            <?php else: ?>
                                                <?= $key['pesan'] ?>
                                            <?php endif ?>
                                            <!-- <?php if ($key['id_kategori_notifikasi'] == 2): ?>
                                                <br>
                                                <a class="font-weight-bold" href="<?= base_url('User/terimaPertemanan/'.$key['sub_id'].'/'.$key['id']) ?>">Terima</a>
                                                <a class="font-weight-bold" href="<?= base_url('User/tolakPertemanan/'.$key['sub_id'].'/'.$key['id']) ?>">Tolak</a>
                                            <?php elseif($key['id_kategori_notifikasi'] == 4): ?>
                                                <br>
                                                <a class="font-weight-bold" href="<?= base_url('User/terimaUndangan/'.$key['sub_id'].'/'.$key['id']) ?>">Terima</a>
                                                <a class="font-weight-bold" href="<?= base_url('User/tolakUndangan/'.$key['sub_id'].'/'.$key['id']) ?>">Tolak</a>
                                            <?php endif ?> -->
                                        </div>
                                    </span>
                                <?php endforeach ?>
                                <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a> -->
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                            <ul class="nav navbar-nav navbar-right">
                                <?php if($this->session->userdata('username')) { ?>
                                    <li><div>Selamat datang <?php echo $this->session->userdata('username') ?></div></li>
                                    <li class="ml-2"><?php echo anchor('auth/logout','Logout') ?></li>
                                <?php } else { ?>
                                    <li><?php echo anchor('auth/login','Login') ?></li>
                                <?php } ?>

                            </ul>

                    </ul>

                </nav>
                <!-- End of Topbar -->