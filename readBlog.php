<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Blogs</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- OUR CSS -->
    <link rel="stylesheet" href="index.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Baloo+Bhaijaan+2:wght@500;700&family=Bitter&family=Lobster&family=Sacramento&family=Shadows+Into+Light&family=Titan+One&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        function showAlert($type, $main, $context){
            echo '<div class="alert alert-'.$type. ' hataAlert alert-dismissible fade show" role="alert">
                    <strong>'. $main .'!!</strong> '. $context .'    
                </div>';
        }
    ?>
    <?php
        include('navbar.php');
        include('databaseConnect.php');

        function blogExits($tit, $cont_ent){
            include('databaseConnect.php');

            $checkSql = "SELECT * FROM `allblogs` WHERE `blog_title` = '$tit' AND `blog_content` = '$cont_ent'";
            $checkRes = mysqli_query($con, $checkSql);

            if($checkRes){
                if(mysqli_num_rows($checkRes) > 0){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    ?>

    <?php
        if(isset($_GET['Id'])){
            $blogId = $_GET['Id'];

            include('databaseConnect.php');
            $blogRead_sql = "SELECT * FROM `allblogs` WHERE `s.no` = '$blogId'";
            $blogRead_res = mysqli_query($con, $blogRead_sql);

            if($blogRead_res){
                $data = mysqli_fetch_assoc($blogRead_res);
            }
        }
        
        // UPDATE AND DELETE BLOG
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if(isset($_POST['update_Blog'])){
                $updateBlog_Id = $_POST['update_Blog'];
                header('location: newBlog.php?update='. $updateBlog_Id);
            }
            else if(isset($_POST['delete_Blog'])){
                
                $deleteBlog_Id = $_POST['delete_Blog'];

                include('databaseConnect.php');
                $delete_sql = "DELETE FROM `allblogs` WHERE `s.no` = '$deleteBlog_Id'";
                $delete_res = mysqli_query($con, $delete_sql);

                if($delete_res){
                    header('location: main.php?blogDeleted=true');
                }
                else{
                    showAlert('danger', 'OOPS', 'Some error has occured!!');
                }
            }
        }
    ?>
    <div class="maincont blogReadContainer backLight">
        <div class="selectedBlog_Con">
                <div class="blog_Title">
                    <h5><?php echo $data['blog_title'] ?></h5><hr>
                </div>
                <div class="blog_Content">
                    <p><?php echo $data['blog_content'] ?></p>
                </div>
                <div class="blog_Author">
                    <p><strong style="font-size:16px;">~<?php echo $data['blog_author'] ?></strong></p>
                    <p style="margin-left: 10px; font-size:16px;"><strong><em>(<?php echo $data['blog_time'] ?>)</em></strong></p>
                </div>

                <div class="blog_Read">
                    <form action="" method="post" class="blogRead_update">
                        <input type="hidden" name="update_Blog" value="<?php echo $data['s.no'] ?>">
                        <button class="mybtn" id="update_Blog_Btn">Update Blog</button>
                    </form>
                    <form action="" method="post" class="blogRead_delete">
                        <input type="hidden" name="delete_Blog" value="<?php echo $data['s.no'] ?>">
                        <button class="mybtn" id="delete_Blog_Btn">Delete Blog</button>
                    </form>
            </div>
        </div>
        </div>
    </div>
</body>
<!-- OUR JS -->
<script src="index.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>