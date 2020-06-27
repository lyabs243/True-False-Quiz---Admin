<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 19:07
 */
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url(); ?>index.php/" class="nav-link">Home</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url(); ?>index.php/admin/question" class="nav-link">Questions</a>
		</li>
		<?php
		if($this->ion_auth->is_admin()) {
			?>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="<?php echo base_url(); ?>index.php/admin/user" class="nav-link">Users</a>
			</li>
			<?php
		}
		?>
	</ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url(); ?>" class="brand-link">
		<img src="<?php echo base_url(); ?>images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light">True or False</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="info">
				<a href="#" class="d-block"><?php echo $user->first_name . ' ' . $user->last_name; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->

				<li class="nav-item">
					<a href="<?php echo base_url(); ?>index.php/admin/question" class="nav-link">
						<i class="nav-icon far fa-question-circle"></i>
						<p>
							Manage Questions
						</p>
					</a>
				</li>
				<?php
				if($this->ion_auth->is_admin()) {
					?>
					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/admin/user" class="nav-link">
							<i class="nav-icon far fa-user"></i>
							<p>
								Manage Users
							</p>
						</a>
					</li>
					<?php
				}
				?>
				<li class="nav-header">USER</li>
				<li class="nav-item">
					<a href="<?php echo base_url(); ?>index.php/user/logout/" class="nav-link">
						<i class="nav-icon far fa fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
