<?php
/**
 * Created by PhpStorm.
 * User: lyabs
 * Date: 27/06/2020
 * Time: 21:15
 */
?>
<!DOCTYPE html>
<html>
<?php
$data['title'] = 'True or False | Dashboard';
$this->view('admin_head', $data);
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

	<?php $this->view('admin_navbar'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Manage Users</h1>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
			<?php
			if(isset($success)) {
				?>
				<div class="card-tools">
					<div class="alert <?php if($success) echo 'alert-success'; else echo 'alert-danger';?>" role="alert">
						<?php echo $message; ?>
					</div>
				</div>
				<?php
			}
			?>
			<div class="card-tools">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-user">
					Add new user
				</button>
			</div>
		</div>

		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<table class="table table-striped">
				<thead style="background-color: #343a40; color: white">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Username</th>
					<th scope="col">Email</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Edit</th>
					<th scope="col">Delete</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$index = 1;
				foreach ($users as $userMngr) {
					?>
					<tr>
						<th scope="row"><?php echo $index; ?></th>
						<td><?php echo $userMngr->username; ?></td>
						<td><?php echo $userMngr->email; ?></td>
						<td><?php echo $userMngr->first_name; ?></td>
						<td><?php echo $userMngr->last_name; ?></td>
						<td>
							<a href="" data-toggle="modal" data-target="#edit-user-<?php echo $userMngr->id; ?>">
								<img src="<?php echo base_url(); ?>images/icons/ic_edit.png" width="30" height="30"
									 alt="edit" title="Edit">
							</a>
						</td>
						<td>
							<a href="" data-toggle="modal" data-target="#delete-user-<?php echo $userMngr->id; ?>">
								<img src="<?php echo base_url(); ?>images/icons/ic_delete.png" width="30" height="30"
									 alt="delete" title="Delete">
							</a>
						</td>
					</tr>
					<?php
					$index++;
				}
				?>
				</tbody>
			</table>
		</section>
		<!-- /.content -->
	</div>
	<!-- Modal edit/delete users -->
	<?php
	foreach ($users as $userMngr) {
		?>
		<div class="modal fade" id="edit-user-<?php echo $userMngr->id; ?>" tabindex="-1" role="dialog"
			 aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="<?php echo base_url(); ?>index.php/user/update/<?php echo $userMngr->id; ?>">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $userMngr->username; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" id="username"
									   aria-describedby="emailHelp" placeholder="Username" value="<?php echo $userMngr->username; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" name="email" class="form-control" id="exampleInputEmail1"
									   aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $userMngr->email; ?>">
							</div>
							<div class="row">
								<div class="col">
									<label for="edit_password">Edit password:</label>
								</div>
								<div class="col">
									<input type="checkbox" name="edit_password" id="edit_password">
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" name="password" class="form-control" id="exampleInputPassword1"
									   placeholder="Password">
							</div>
							<label>Names</label>
							<div class="row">
								<div class="col">
									<input name="first_name" type="text" class="form-control" placeholder="First name" value="<?php echo $userMngr->first_name; ?>">
								</div>
								<div class="col">
									<input name="last_name" type="text" class="form-control" placeholder="Last name" value="<?php echo $userMngr->last_name; ?>">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Modal delete -->
		<div class="modal fade" id="delete-user-<?php echo $userMngr->id; ?>" tabindex="-1" role="dialog"
			 aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="<?php echo base_url(); ?>index.php/user/delete/<?php echo $userMngr->id; ?>">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Delete  <?php echo $userMngr->username; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<label>Do you want to delete  <?php echo $userMngr->first_name . ' ' . $userMngr->last_name; ?> ?</label>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Delete</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
	}
	?>

	<!-- Modal add user -->
	<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="<?php echo base_url(); ?>index.php/user/add">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add user</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<label>Names</label>
						<div class="row">
							<div class="col">
								<input name="first_name" type="text" class="form-control" placeholder="First name">
							</div>
							<div class="col">
								<input name="last_name" type="text" class="form-control" placeholder="Last name">
							</div>
						</div>
						<div class="form-group">
							<label>User group</label>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="user_group" id="gridRadios1" value="2" checked>
									<label class="form-check-label" for="gridRadios1">
										Member
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="user_group" id="gridRadios2" value="1">
									<label class="form-check-label" for="gridRadios2">
										Admin
									</label>
								</div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php $this->view('admin_footer'); ?>
</div>
<!-- ./wrapper -->

<?php $this->view('admin_scripts'); ?>
</body>
</html>

