<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pengajuan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
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
                            <img src="avatar/<?= $user->avatar; ?>" class="img-circle elevation-2" width="250" height="250">
                        <?php else : ?>
                            <img src="<?= base_url(); ?>assets/default.jpg" width="250" height="250" class="img-circle elevation-2">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $user->username; ?></a>
                        <a href="#" class="d-block"><?= $user->email; ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/index">
                                    <i class="nav-icon fas fa-users"></i>
                                    User Account
                                </a>
                            </h6>
                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/datakendaraan">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    Data Kendaraan
                                </a>
                            </h6>
                        </li>

                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/konfirmasi">
                                    <i class="nav-icon far fa-calendar-check"></i>
                                    Konfirmasi Servis
                                </a>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <h6 class="nav-link">
                                <a href="<?= base_url(); ?>Admin/jadwalServis">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    Jadwal Servis
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
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
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
                    <h2 class="display-4">Konfirmasi Pengajuan</h2>
                </div>

                <div class="container my-5">
                    <div class="card">

                        <!-- /.modal -->
                        <?php foreach ($service as $services) : ?>
                            <div class="modal fade" id="modal-lg<?= $services->id; ?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Konfirmasi Pengajuan Servis</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="form" role="form" method="post" enctype="multipart/form-data" action="<?= base_url('Admin/updateSurat') ?>">

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="">Tanggal Pengajuan</label>
                                                        <input value="<?= $services->id; ?>" type="hidden" name="id">
                                                        <input class="form-control" id="created_at" name="created_at" value="<?= $services->created_at; ?>" type="text" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Nomor Polisi</label>
                                                        <input class="form-control" id="no_polisi" name="no_polisi" value="<?= $services->no_polisi; ?>" type="text" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Jenis Kendaraan</label>
                                                        <input class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" value="<?= $services->jenis_kendaraan; ?>" type="text" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Tipe</label>
                                                        <input class="form-control" id="tipe" name="tipe" value="<?= $services->tipe; ?>" type="text" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nomor Rangka</label>
                                                        <input class="form-control" id="no_rangka" name="no_rangka" value="<?= $services->no_rangka; ?>" type="text" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Operator</label>
                                                        <input class="form-control" id="operator" name="operator" value="<?= $services->operator; ?>" type="text" readonly>
                                                    </div>

                                                    <div>
                                                        <label for="">Konfrimasi Pengajuan</label>
                                                        <select class="form-control" id="status_pengajuan" name="status_pengajuan">
                                                            <option value="Diterima">Diterima</option>
                                                            <option value="Ditolak">Ditolak</option>

                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="">Tanggal Servis</label>
                                                        <input class="form-control" id="tgl_servis" name="tgl_servis" value="<?= $services->tgl_servis; ?>" type="date">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- /.modal -->

                    </div>
                </div>





                <div class="container my-5">
                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-hover table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal Pengajuan</th>
                                        <th scope="col">Nomor Polisi</th>
                                        <th scope="col">Jenis Kendaraan</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Nomor Rangka</th>
                                        <th scope="col">Operator</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Status Pengajuan</th>
                                        <th scope="col">Tanggal Servis</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($service as $services) : ?>
                                        <tr class="table-light">
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $services->created_at; ?></td>
                                            <td><?= $services->no_polisi; ?></td>
                                            <td><?= $services->jenis_kendaraan; ?></td>
                                            <td><?= $services->tipe; ?></td>
                                            <td><?= $services->no_rangka; ?></td>
                                            <td><?= $services->operator; ?></td>
                                            <td><?= $services->keterangan; ?></td>
                                            <td>
                                                <?php
                                                if ($services->status_pengajuan == "Diterima") {
                                                    echo '<span class="badge badge-success">Diterima</span>';
                                                } elseif ($services->status_pengajuan == "Ditolak") {
                                                    echo '<span class="badge badge-danger">Ditolak</span>';
                                                } else {
                                                    echo '<span class="badge badge-info">Dalam Proses Pengajuan</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $services->tgl_servis; ?></td>
                                            <td>
                                                <div class="wrapper-button">
                                                    <!-- DELETE -->
                                                    <a class="btn btn-danger btn-sm" href="delete_post/<?= $services->id; ?>"><i class="fas fa-trash-alt"></i></a>
                                                    <!-- EDIT -->
                                                    <a class="btn btn-primary btn-sm" id="editModal" data-toggle="modal" data-target="#modal-lg<?= $services->id; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- /.content-wrapper -->

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

        <!-- DataTables  & Plugins --> <?= base_url('') ?>
        <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('') ?>assets/dist/js/adminlte.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>




</body>

</html>