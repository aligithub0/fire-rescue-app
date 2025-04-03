<?php include 'include/header.php'; ?>
<?php include "connection/connectdatabase.php";?>

    <section class="hero">
      <div class="container">
        <div class="hero__image" style="background:url('hero.png');background-size: cover; object-fit: cover;"></div>

        <div class="hero__text container--pall">
          <h1>Fire Rescue Management System</h1>
          <p>
             A web-based application that allows users to report complaints to the Rescue Control Center.Users take real-time image and send them, along with their GPS Location, to the Rescue control center. 
          </p>
          <a href="complaint.php" class="button hero__cta">Urgent Complaint</a>
        </div>
      </div>
    </section>
	<section class="main-content" style="background: linear-gradient(to left, #FFBFBF, #C1FBFF);">
		<div class="container">
			<!-- <h1 class="text-center text-uppercase">Social Media Post</h1> -->
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
									<a href="#!" class="text-dark"><img src="fireEngine/include/fireStation.png" alt="User" height="50px" class="author-img"></a>
								</div>
								<div>
									<h5 class="mb-0"><a href="#!" class="text-dark font-weight-bold">Fire Brigade</a></h5>
									<p class="mb-0 text-muted"><?=$data['post_date']?></p>
								</div>
							</div>
						</div>
						<div class="post-block__content mb-2">
							<p><?=$data['post_detail']?></p>
							<img src="upload/<?=$data['post_image']?>" width="100%" alt="Content img">
						</div>
						<div class=""></div>
						<hr>
					</div>
				</div>
<?php }} 

?>
			</div>
		</div>
	</section>

	
  <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
<?php include 'include/footer.php'; ?>








