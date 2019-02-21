<?php
session_start();
if($_SESSION['user_type']!=1){
  header("location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en_US">
<head>
    <!-- CSS/JS Online Links -->
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="icon" href="images/favicon.jpg" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta charset="utf-8">
    <title>Admin Posts</title>
    <!-- Main Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #050936">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <img src="images/logonav.png"><strong style="color: white">Control Panel</strong>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto mt-2 mt-lg">
                <li class="nav-item active">
                    <strong><a href="index.php" class="nav-link active">Home</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="adminListings.php" class="nav-link active">Listings</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="adminUsers.php" class="nav-link active">Users</a></strong>
                </li>
            </ul>
            <a class="btn btn-danger" href="logout.php">Log Out</a>
        </div>
    </nav>
</head>
<body>
    <div class="container">
        <div style="padding: 10px">
           <div class="row">
               <div class="col" style="padding: 10px">
                    <button class="btn btn-outline-primary" name="c_user" data-toggle="modal" data-target="#createuModal">Create Post</button>
                </div>
                <!-- search bar -->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" id="se_input" placeholder="Search by subject">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="se_submit">Search</button>  
                    <!-- Search results Modal -->
                    <div class="modal fade" id="loadUserResults" tabindex="-1" role="dialog" aria-labelledby="loadUserResults" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Search Results</h5>
                                </div>
                                <div class="modal-body">
                                    <!-- code here -->
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- search bar / --> 
                </form>
            </div> 
        </div>
        <!-- Create Post Modal -->
        <div class="modal fade" id="createuModal" tabindex="-1" role="dialog" aria-labelledby="createuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createuModal">Create Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <form class="" action="php/createPost.php" method="POST">
                            <input class="form-control" id="cr_subject" type="text" id="subject"  maxlength="45" placeholder="Subject">
                            <br>
                            <textarea class="form-control" id="cr_message" id="message" rows="4" cols="50" maxlength="255" placeholder="Message"></textarea>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="cr_submit">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Post Modal -->
        <div class="modal fade" id="updateuModal" tabindex="-1" role="dialog" aria-labelledby="updateuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateuModal">Update Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <div class="form-group" action="#" method="POST">
                            </select>
                            <input class="form-control" id="up_subject" type="text" id="subject"  maxlength="45" placeholder="Subject">
                            <br>
                            <textarea class="form-control" id="up_message" id="message" rows="4" cols="50" maxlength="255" placeholder="Message"></textarea>
                            <br>                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <small id="up_errorHelp" style="width:90%;" class="form-text text-muted"></small>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="up_submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remove Post Modal -->
        <div class="modal fade" id="removeuModal" tabindex="-1" role="dialog" aria-labelledby="removeuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id2="re_title" id="removeuModal">Remove Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        <div class="form-group" action="#" method="POST">
                            <br>
                            <small id="re_errorHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="re_submit">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Database Table -->
        <div class="">
            <table id="postsTable" class="table table-bordered table-striped">
                
            </table>
        </div>
        <!-- Database Table end -->
    <script src="javascript/adminPosts.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>