<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Aduan Penaggulangan Bencana</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/custom.css') ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url(); ?>auth/logout" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url(); ?>Admin/about" class="brand-link">
                <img src="<?= base_url('assets/dist/img/pupr.png') ?>" alt="PUPR Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <h3>SIPEKA</h3>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if ($user->avatar != null) : ?>
                            <img src="avatar/<?= $user->avatar; ?>" class="img-circle elevation-2" width="450" height="450">
                        <?php else : ?>
                            <img src="<?= base_url(); ?>assets/img/default.jpg" width="250" height="250" class="img-circle elevation-2">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user->username; ?></a>
                        <a href="#" class="d-block"><?= $user->email; ?></a>
                    </div>

                    <a class="btn-sm" id="editModal" data-toggle="modal" data-target="#modal-lg">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>member/index">
                                    <i class="nav-icon fas fa-home"></i>
                                    HOME
                                </a>
                            </h6>
                        </li>

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>member/pengajuanServis">
                                    <i class="nav-icon far fa-envelope"></i>
                                    Pengajuan Servis
                                </a>
                            </h6>
                        </li>

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>member/jadwalServis">
                                    <i class="nav-icon fas fa-eye"></i>
                                    Jadwal Servis
                                </a>
                            </h6>
                        </li>

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/suratMasuk">
                                    <i class="nav-icon far fa-envelope"></i>
                                    Pengajuan Servis
                                </a>
                            </h6>
                        </li>


                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/about">
                                    <i class="nav-icon fas fa-info-circle"></i>
                                    About
                                </a>
                            </h6>
                        </li>

                        <li>
                            <hr />
                        </li>

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>auth/logout">
                                    <i class="nav-icon fas fa-door-open"></i>
                                    Logout
                                </a>
                            </h6>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">

            <div class="tab-content pt-5">
                <div class="tab-empty">
                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Profile</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form class="form" role="form" method="post" enctype="multipart/form-data" action="updateProfile">

                                    <input value="<?= $user->id; ?>" type="hidden" name="id">
                                    <input value="<?= $user->avatar; ?>" type="hidden" name="old_avatar">

                                    <div class="card">
                                        <div class="card-body">

                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                                    </div>
                                                    <input class="form-control" value="<?= $user->username; ?>" type="text" name="username" required>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                    </div>
                                                    <input class="form-control" value="<?= $user->email; ?>" type="email" name="email" required>
                                                </div>
                                            </div>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="new_avatar">
                                                <label class="custom-file-label" for="customFile">Pilih gambar</label>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary my-4">Simpan</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                            <div class="info-box-content">
                                <a href="<?= base_url(); ?>member/massage">
                                    <h5 class="info-box-text">Messages</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-eye"></i></span>

                            <div class="info-box-content">
                                <a href="<?= base_url(); ?>member/lihatSurat">
                                    <h5 class="info-box-text">Surat Saya</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-mail-bulk"></i></span>

                            <div class="info-box-content">
                                <a href="<?= base_url(); ?>member/semuaSurat">
                                    <h5 class="info-box-text">Semua Surat</h5>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
</body>

</html>