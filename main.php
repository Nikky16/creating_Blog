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
</head>
<body>
    <?php
        function showAlert($type, $main, $context){
            echo '<div class="alert alert-'.$type.' hataAlert alert-dismissible fade show" role="alert">
                    <strong>'. $main .'!!</strong> '. $context .'    
                </div>';
        }
    ?>
    <?php
        include('navbar.php');
        include('databaseConnect.php');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createBlog'])){
            header('location: newBlog.php');
        }
    ?>

    <!-- BLOG ADDED ALERT -->
    <?php
        if(isset($_GET['blogAdded'])){
            showAlert('success', 'SUCCESS', 'The blog has been added successfully!!');
        }
    ?>

    <!-- BLOG UPDATED ALERT -->
    <?php
        if(isset($_GET['blogUpdated'])){
            showAlert('success', 'SUCCESS', 'The blog has been updated successfully!!');
        }
    ?>

    <!-- BLOG DELETED ALERT -->
    <?php
        if(isset($_GET['blogDeleted'])){
            showAlert('success', 'SUCCESS', 'The blog has been deleted successfully!!');
        }
    ?>

    <!-- BLOG NOT FOUND ALERT -->
    <?php
        if(isset($_GET['blogFound'])){
            showAlert('danger', 'OOPS', 'Blog not found!!');
        }
    ?>

    <!-- READ BLOG -->
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['readMore'])){
            $blogId = $_POST['readMore'];
            header('location: readBlog.php?Id='. $blogId);
        }
    ?>

    <!-- MAIN CONTENT STARTS HERE -->
    <div class="maincont backLight">
        <div class="createBlogCont">
            <form action="" method="post" class="add_blog">
                <input type="hidden" name="createBlog">
                <button class="mybtn backLight" type="submit" id="mybtn2">Create Blog</button>
            </form>
        </div>
        <div class="displayAllBlogs">
            
            <?php                
                include('databaseConnect.php');
                $allBlogs_Sql = "SELECT * FROM `allblogs`";
                $allBlogs_Res = mysqli_query($con, $allBlogs_Sql);

                if($allBlogs_Res){
                    if(mysqli_num_rows($allBlogs_Res) > 0){
                        $rows = mysqli_num_rows($allBlogs_Res);

                        while($rows > 0){
                            $data = mysqli_fetch_assoc($allBlogs_Res);

                            $data_title = $data['blog_title'];
                            $shortTit = substr($data_title, 0, 22);

                            $data_content = $data['blog_content'];
                            $shortCon = substr($data_content, 0, 150);

                            echo '<div class="eachBlog">
                                    <div class="blogTitle">
                                        <h5>'. $shortTit .'...</h5><hr>
                                    </div>
                                    <div class="blogContent">
                                        <p>'. $shortCon.'...</p>
                                    </div>
                                    <div class="blogRead">
                                        <form action="" method="post" class="blogRead_form">
                                            <input type="hidden" name="readMore" value="'.$data['s.no'].'">
                                            <button class="mybtn backLight">Read More-></button>
                                        </form>
                                    </div>
                                </div>';

                            $rows = $rows-1;
                        }
                    }
                    else{
                        echo '<div class="noBlog">
                                <div class="noBlogCon">
                                    <h1><strong>No Blog Present!! Write some Blogs first!!</strong></h1>
                                </div>
                            </div> ';
                    }
                }
            ?>                       
        </div>
    </div>
</body>
<!-- OUR JS -->
<script src="index.js"></script>
<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>