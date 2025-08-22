<?php
function currenturl($url, $echo)
{
  if (current_url() == base_url('admin/' . $url)) {
    echo $echo;
  }
}
?>
<style>
  .sidebar-dark-primary {
    background-color: #6495ED;
    /* Change this to the desired sidebar background color */
    color: white;
    /* Change this to the desired text color */
  }

  .brand-link {
    background-color: #6495ED;

  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <?php $site = $this->db->get('site')->result(); ?>
  <a href="<?php echo base_url() ?>" class="brand-link text-center border-bottom border-white pb-2">
    <img src="<?php echo base_url('files/site/' . $site[0]->logo) ?>" alt="Logo" style="opacity: .8; width: 50px"><br>
    <span class="brand-text font-weight-light">
      <?php echo $site[0]->title ?>
    </span>
  </a>



  <style>
    .sidebar {
      background-color: #6495ED;

    }
  </style>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom border-white pb-2">
      <div class="image">
        <?php $userprofile = $this->db->get_where('user', ['level' => 'Admin'])->result(); ?>
        <img src="<?php echo base_url('files/userprofil/' . $userprofile[0]->image) ?>"
          style="background-color: white; border-radius: 50%">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php echo $this->session->nama_lengkap; ?>
        </a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- HOME -->
        <li class="nav-item">
          <a href="<?php echo base_url() ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
            </p>
          </a>
        </li>

        <!-- USER MANAGEMENT -->
        <li class="nav-item has-treeview <?php currenturl('newuser', 'menu-open');
        currenturl('users', 'menu-open'); ?>">
          <a href="#" class="nav-link <?php currenturl('newuser', 'active');
          currenturl('users', 'active'); ?>">
            <i class="nav-icon fas fa-users"></i>
            <?php $query = "SELECT count(*) as total FROM user WHERE status=0";
            $row = $this->db->query($query)->result(); ?>
            <p>
              Manajemen Pengguna
            </p>
            <?php if ($row[0]->total == 0) {
            } else { ?>
              <span class="badge badge-primary">
                <?php echo $row[0]->total; ?>
              </span>
            <?php } ?>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item <?php currenturl('newuser', 'active') ?>">
              <a href="<?php echo base_url('admin/newuser') ?>"
                class="nav-link <?php currenturl('newuser', 'active') ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Pendaftar Baru &nbsp;&nbsp;&nbsp;
                  <?php if ($row[0]->total > 0) { ?>
                    <span class="badge badge-primary">
                      <?php echo $row[0]->total; ?>
                    </span>
                  <?php } ?>
                </p>
              </a>
            </li>
            <li class="nav-item <?php currenturl('users', 'active') ?>">
              <a href="<?php echo base_url('admin/users') ?>" class="nav-link <?php currenturl('users', 'active') ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Kelola Data User
                </p>
              </a>
            </li>
          </ul>
        </li>

        <!-- LOANS MANAGEMENT -->
        <li class="nav-item has-treeview <?php currenturl('request', 'menu-open');
        currenturl('jadwal', 'menu-open'); ?>">
          <a href="#" class="nav-link <?php currenturl('request', 'active');
          currenturl('jadwal', 'active'); ?>">
            <i class="nav-icon fas fa-bookmark"></i>
            <?php
            $query2 = "SELECT count(*) as total FROM peminjaman WHERE status_peminjaman=0";
            $row2 = $this->db->query($query2)->result(); ?>
            <p>
              Kelola Peminjaman
            </p>
            <?php if ($row2[0]->total == 0) {
            } else { ?>
              <span class="badge badge-primary">
                <?php echo $row2[0]->total; ?>
              </span>
            <?php } ?>
          </a>
          <ul class="nav nav-treeview">
            <?php
            $query2 = "SELECT count(*) as total FROM peminjaman WHERE status_peminjaman=0";
            $row2 = $this->db->query($query2)->result(); ?>
            <li class="nav-item <?php currenturl('request', 'active'); ?>">
              <a href="<?php echo base_url('admin/request') ?>"
                class="nav-link <?php currenturl('request', 'active'); ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Peminjaman &nbsp;&nbsp;&nbsp;
                  <?php if ($row2[0]->total > 0) { ?>
                    <span class="badge badge-primary">
                      <?php echo $row2[0]->total; ?>
                    </span>
                  <?php } ?>
                </p>
              </a>
            </li>
            <li class="nav-item <?php currenturl('jadwal', 'active') ?>">
              <a href="<?php echo base_url('admin/jadwal') ?>" class="nav-link <?php currenturl('jadwal', 'active') ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Jadwal
                </p>
              </a>
            </li>
          </ul>
        </li>

        <!-- REPORT -->
        <li class="nav-item <?php currenturl('jadwalreport', 'active'); ?>">
          <a href="<?php echo base_url('admin/jadwalreport') ?>"
            class="nav-link <?php currenturl('jadwalreport', 'active'); ?>">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>

        <!-- HELP -->
        <li class="nav-item <?php currenturl('help', 'active'); ?>">
          <a href="<?php echo base_url('admin/help') ?>" class="nav-link <?php currenturl('help', 'active'); ?>">
            <i class="nav-icon fas fa-question"></i>
            <?php $query3 = $this->db->query('SELECT count(*) AS total FROM ask')->result(); ?>
            <p>
              Bantuan
            </p>
            <?php if ($query3[0]->total == 0) {
            } else { ?>
              <span class="badge badge-primary">
                <?php echo $query3[0]->total; ?>
              </span>
            <?php } ?>
          </a>
        </li>

        <!-- SETTING -->
        <li
          class="nav-item has-treeview <?php currenturl('myprofile/' . $this->session->userdata('id_user'), 'menu-open'); ?>">
          <a href="#"
            class="nav-link <?php currenturl('myprofile/' . $this->session->userdata('id_user'), 'active'); ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Pengaturan
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item <?php currenturl('myprofile/' . $this->session->userdata('id_user'), 'active'); ?>">
              <a href="<?php echo base_url('admin/myprofile/' . $this->session->userdata('id_user')) ?>"
                class="nav-link <?php currenturl('myprofile/' . $this->session->userdata('id_user'), 'active'); ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Profil Saya
                </p>
              </a>
            </li>
            <li class="nav-item <?php currenturl('sitesetting', 'active'); ?>">
              <a href="<?php echo base_url('admin/sitesetting') ?>"
                class="nav-link <?php currenturl('sitesetting', 'active'); ?>">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Situs
                </p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>