<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchBlog'])){
        $string_toBe_searched = $_POST['searchString'];
        header('location: searchResults.php?searchedString='. $string_toBe_searched);
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="main.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="newBlog.php">NewBlog <span class="sr-only">(current)</span></a>
      </li>      
    </ul>
    <form action="" class="search_Form" method="post">
      <input type="text" name="searchString" id="searchString" placeholder="Search Blog Title...">
      <input type="hidden" name="searchBlog">
      <button class="mybtn" id="searchBtn">Search</button>
    </form>
      <div class="darkMode">
        <h5 style="margin: 0px" id="dark">Dark Mode</h5>
        <h5 style="margin: 0px" id="light">Light Mode</h5>
        <div>
          <img src="icons/moon.png" width="25px" height="25px" alt="" id="moon" style="cursor:pointer;">
          <img src="icons/sun.png" width="25px" height="25px" alt="" id="sun" style="cursor:pointer;">
        </div>
      </div>
  </div>
</nav>