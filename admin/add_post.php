<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 
if (!empty($_POST) AND isset($_POST['submit'])) {
  
  $post_detail=$_POST['post_detail'];

$enter=mysqli_query($conn,"SELECT * FROM posts WHERE post_detail='$post_detail'");
if(mysqli_num_rows($enter)> 0){
      $msg="Post is already Published.";
      $status="warning";
}elseif(mysqli_num_rows($enter) == 0){
    $temp = explode(".", $_FILES["post_image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    if (move_uploaded_file($_FILES["post_image"]["tmp_name"], "../upload/" . $newfilename)) {
  
        $query=mysqli_query($conn,"INSERT INTO posts (post_detail, post_image) VALUES('$post_detail','$newfilename') ");
        $msg="Post Published.";
        $status="success";
    }else{
        $msg="Error in uploading";
        $status="danger";
    }
    }else{
    
        $msg="Error.";
        $status="danger";
        }
    

}

 ?>

<div class="col-lg-8 mx-auto">
  
    <div class="container">
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
        <div class="card o-hidden border-1 shadow-lg my-5 bg-light">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Post Something</h1>
                            </div>
                            <form class="user" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">

                                <div class="form-group col-12">
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control-file " name="post_image" id=""
                                            placeholder="Upload Image" required>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="col-sm-12">
                                        <textarea class="form-control " name="post_detail" id="" cols="30" rows="3" required ></textarea>
                                    </div>
                                </div>
                                
                                
                                <button type="submit" name="submit" class="btn btn-danger btn-user btn-block">
                                    Submit
                                </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

 
 
<?php include 'include/footer.php'; ?>
