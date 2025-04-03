<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>

<section class="main-content">
		<div class="container">
			<br>
			<div class="row">
<?php 
$query = mysqli_query($conn,"SELECT * FROM posts ORDER BY post_id DESC");
if(mysqli_num_rows($query)> 0){
      while ($data = mysqli_fetch_assoc($query)) {
 ?>
				<div class="col-sm-6 offset-sm-3">
					<div class="post-block">
						<div class="d-flex justify-content-between">
							<div class="d-flex mb-3">
								<div class="mr-2">
									<a href="#!" class="text-dark"><img src="../fireEngine/include/fireStation.png" alt="User" height="30px" class="author-img"></a>
								</div>
								<div>
									<h5 class="mb-0"><a href="#!" class="text-dark">Fire Brigade</a></h5>
									<p class="mb-0 text-muted"><?=$data['post_date']?></p>
								</div>
							</div>
							<div class="post-block__user-options">
								<a href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
											<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
									<a class="dropdown-item text-dark" href="edit_posts.php?id=<?=$data['post_id']?>"><i class="fa fa-pencil mr-1"></i>Edit</a>
									<a class="dropdown-item text-danger" href="#!"><i class="fa fa-trash mr-1"></i>Delete</a>
								</div>
							</div>
						</div>
						<div class="post-block__content mb-2">
							<p><?=$data['post_detail']?></p>
							<img src="../upload/<?=$data['post_image']?>" width="100%" alt="Content img">
						</div>
						<div class=""></div>
						<hr class="my-5">
					</div>
				</div>
<?php }} 

?>
			</div>
		</div>
	</section>
<?php include 'include/footer.php'; ?>
