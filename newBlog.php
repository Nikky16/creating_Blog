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
                    echo 'exits';
                    return true;
                }
                else{
                    echo 'not exits';
                    return false;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBlog'])){

            if((isset($_POST['addBlogTit']) && $_POST['addBlogTit'] != '') && (isset($_POST['addBlogContent']) && $_POST['addBlogContent'] != '')){

                $title_add = $_POST['addBlogTit'];
                $content_add = $_POST['addBlogContent'];

                if(blogExits($title_add, $content_add) == false){

                    include('databaseConnect.php');
                    echo $title_add .' and '. $content_add;
                    $sql_add = "INSERT INTO `allblogs` (`s.no`, `blog_title`, `blog_content`) VALUES (NULL,'$title_add','$content_add')";

                    $res_add = mysqli_query($con, $sql_add);
                    if($res_add){
                        // echo 'Blog Added!';
                        header('location: main.php?blogAdded=true');
                    }
                    else{
                        showAlert('danger', 'OOPS', 'Some error has occured!!');
                    }
                }
                else{
                    showAlert('danger', 'OOPS', 'Blog already exits!! Please write a new one!!');
                }
            }
            else{
                showAlert('danger', 'OOPS', 'Write blog first before adding!!');
            }
        }
    ?>

    <!-- UPDATE BLOG -->
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateBlog'])){
            if((isset($_POST['updateBlogTit']) && $_POST['updateBlogTit'] != '') && (isset($_POST['updateBlogContent'])&& $_POST['updateBlogContent'] != '')){

                $new_title = $_POST['updateBlogTit'];
                $new_content = $_POST['updateBlogContent'];
                $blog_Id = $_GET['update'];

                // UPDATE DATA
                include('databaseConnect.php');
                $update_sql = "UPDATE `allblogs` SET `blog_title`='$new_title',`blog_content`='$new_content' WHERE `s.no` = '$blog_Id'";

                $update_res = mysqli_query($con, $update_sql);
                if($update_res){
                    header('location: main.php?blogUpdated=true');
                }
                else{
                    showAlert('danger', 'OOPS', 'Some error has occured!!');
                }
            }
            else{
                showAlert('danger', 'OOPS', 'Write blog first before updating!!');
            }
        }
    ?>

    <div class="cont backLight">
        <div class="newBlogCont">
            <div class="blogCont backLight">
                <?php
                    if(isset($_GET['update'])){
                        // UPDATE FORM                       

                        echo '<form action="" class="blogCont_form updateBlog backLight" method="post">
                                <div class="tit">
                                    <input type="text" name="updateBlogTit" class="inputTag backLight" placeholder="Update blog title..." >
                                </div>
                                <div class="content">
                                    <textarea name="updateBlogContent" id="" class="textAreaTag backLight" placeholder="Update blog content..." ></textarea>
                                </div>
                                <input type="hidden" name="updateBlog">
                                <div class="addBlogBtn">
                                    <button type="submit" name="updateBlogBtn" class="mybtn backLight">Update Blog</button>
                                </div>
                            </form>  ';                        
                    }
                    else{
                        // ADD BLOG FORM
                        echo '<form action="" class="blogCont_form addBlog " method="post">
                                <div class="tit">
                                    <input type="text" name="addBlogTit" class="inputTag backLight" placeholder="Enter blog title...">
                                </div>
                                <div class="content">
                                    <textarea name="addBlogContent" id="" class="textAreaTag backLight" placeholder="Enter blog content..."></textarea>
                                </div>
                                <input type="hidden" name="addBlog">
                                <div class="addBlogBtn">
                                    <button type="submit" name="addBlogBtn" class=" mybtn backLight">Add Blog</button>
                                </div>
                            </form> ';
                    }
                ?>
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