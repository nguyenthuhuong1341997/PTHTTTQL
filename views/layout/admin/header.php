<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QUẢN LÝ - YOURSTORE</title>
    <link rel="icon" type="image/png" href="public/Login/images/icons/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="public/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="public/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="public/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="public/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="public/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="public/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="public/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="public/admin/build/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/admin/me.css">
    <link rel="stylesheet" type="text/css" href="public/css/book.css">
    <link rel="stylesheet" type="text/css" href="public/admin/js/toastr.min.css">
    <script src="public/admin/js/ckeditor.js"></script>
    <script src="public/admin/js/sweetalert.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>PTIT</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="public/image/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Xin chào,</span>
                <h2 style="text-transform: capitalize;"><?php
echo $_SESSION['user']['name'];
?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Quản lý</h3>
                <ul class="nav side-menu" data-widget="tree">
                  <?php
if ($_SESSION['user']['rcode'] == 'ROLE_BOSS') {
	?>
                  <li <?php if (isset($_GET['act'])) {
		if ($_GET['act'] == 'user') {echo 'class="active"';}
	}
	?> ><a href="?mod=admin&act=user"><i class="fa fa-users"></i> Quản lý nhân viên</a>
                  </li>
                  <?php }?>
                                    <?php
if ($_SESSION['user']['rcode'] == 'ROLE_BOSS' || $_SESSION['user']['rcode'] == 'ROLE_ADMIN') {
	?>
<li <?php if (isset($_GET['act'])) {
		if ($_GET['act'] == 'customer') {echo 'class="active"';}
	}
	?>>
  <a href="?mod=admin&act=customer"><i class="fa fa-users"></i> Quản lý khách hàng</a>

      </li>
      <?php }?>
                                    <?php
if ($_SESSION['user']['rcode'] == 'ROLE_BOSS' || $_SESSION['user']['rcode'] == 'ROLE_ADMIN') {
	?>
                  <li <?php if (isset($_GET['act'])) {
		if ($_GET['act'] == 'book') {echo 'class="active"';}
	}
	?>><a href="?mod=admin&act=book"><i class="fa fa-book"></i> Quản lý sách </a>
                  </li>
                   <?php }?>
                  <li <?php if (isset($_GET['act'])) {
	if ($_GET['act'] == 'order') {echo 'class="active"';}
}
?>><a href="?mod=admin&act=order"><i class="fa fa-truck"></i> Quản lý đơn hàng </a></li>
                                    <?php
if ($_SESSION['user']['rcode'] == 'ROLE_BOSS') {
	?>
                  <li <?php if (isset($_GET['act'])) {
		if ($_GET['act'] == 'statistical') {echo 'class="active"';}
	}
	?>><a href="?mod=admin&act=statistical"><i class="fa fa-line-chart"></i> Thống kê </a></li>
 <?php }?>
<li <?php if (isset($_GET['act'])) {
	if ($_GET['act'] == 'top-sale') {echo 'class="active"';}
}
?>>
  <a href="?mod=admin&act=top-sale"><i class="fa fa-line-chart"></i> Sản phẩm bán chạy</a>
      </li>
      <li <?php if (isset($_GET['act'])) {
	if ($_GET['act'] == 'order-in-date') {echo 'class="active"';}
}
?>>
  <a href="?mod=admin&act=order-in-date"><i class="fa fa-line-chart"></i> Báo cáo ngày</a>

      </li>
 <?php
if ($_SESSION['user']['rcode'] == 'ROLE_BOSS') {
	?>
                  <li <?php if (isset($_GET['act'])) {
		if ($_GET['act'] == 'statistical-staff') {echo 'class="active"';}
	}
	?> ><a href="?mod=admin&act=statistical-staff"><i class="fa fa-line-chart"></i> Thống kê theo nhân viên</a>
                  </li>
                  <?php }?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="?mod=login">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a style="text-transform: capitalize;" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $_SESSION['user']['image'] ?>" alt="">
                    <?php
echo $_SESSION['user']['name'];
?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="?mod=admin&act=account"> Tài khoản</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Cài đặt</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Trợ giúp</a></li>
                    <li><a href="?mod=logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="public/admin/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="public/admin/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="public/admin/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="public/admin/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->