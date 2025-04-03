<?php include 'include/header.php'; ?>
<?php include '../connection/connectdatabase.php'; ?>
<?php 

if (isset($_GET['id'])){ $id=$_GET['id'];}else{echo "<script>window.location='view_posts.php'</script>";}


if (isset($_POST['submit'])) {
  
  $post_detail=$_POST['post_detail'];


    $temp = explode(".", $_FILES["post_image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    if (move_uploaded_file($_FILES["post_image"]["tmp_name"], "../upload/" . $newfilename)) {
        $query=mysqli_query($conn,"UPDATE posts SET post_detail='$post_detail',post_image='$newfilename' WHERE post_id='$id'");
        if ($query) {
        echo "<script>window.location='view_posts.php'</script>";
    }else{
        $msg="Error";
        $status= 'danger';
        }
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
<?php  $query= mysqli_query($conn,"SELECT * FROM posts WHERE post_id='$id' ");
    $row=mysqli_fetch_assoc($query); ?>
                            <form class="user" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">

                                <div class="form-group col-12">
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control-file " name="post_image" id=""
                                            placeholder="Upload Image" value="<?=$row['post_image']?>">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="col-sm-12">
                                        <textarea class="form-control " name="post_detail" id="" cols="30" rows="3" required ><?=$row['post_detail']?>"</textarea>
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
