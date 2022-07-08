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
    ?>

    <!-- READ BLOG -->
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['read_More'])){
            $blogId = $_POST['read_More'];
            header('location: readBlog.php?Id='. $blogId);
        }
    ?>

    <!-- MAIN CONTENT STARTS HERE -->
    <div class="maincont backLight">
        <div class="displayselectedBlogs">

        <!-- FINDING REQUIRED BLOGS -->
        <?php
            if(isset($_GET['searchedString'])){
                $searchedString = $_GET['searchedString'];

                $search_sql = "SELECT * FROM `allblogs`";
                $search_res = mysqli_query($con, $search_sql);

                if($search_res){
                    $rows = mysqli_num_rows($search_res);

                    // Checking whether any blog with selected string exits or not
                    $noResult = true;

                    if($rows > 0){
                        while($rows > 0){
                            $data = mysqli_fetch_assoc($search_res);
                            $data_tit = $data['blog_title'];
                            $shortTit = substr($data_tit, 0, 22);                            
    
                            $data_content = $data['blog_content'];
                            $shortCon = substr($data_content, 0, 150);
    
                            if(strpos($data_tit, $searchedString)){
                                $noResult = false;
                                echo '<div class="eachBlog">
                                        <div class="blogTitle">
                                            <h5>'. $shortTit .'...</h5><hr>
                                        </div>
                                        <div class="blogContent">
                                            <p>'. $shortCon.'...</p>
                                        </div>
                                        <div class="blogRead">
                                            <form action="" method="post" class="blogRead_form">
                                                <input type="hidden" name="read_More" value="'.$data['s.no'].'">
                                                <button class="mybtn backLight">Read More-></button>
                                            </form>
                                        </div>
                                    </div>';
                            }
                            $rows = $rows -1;
                        }

                        if($noResult == true){
                            header('location: main.php?blogFound=false');
                        }
                    }                   
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