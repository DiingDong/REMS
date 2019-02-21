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
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="icon" href="images/favicon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<title>Listings Table</title>
    <link rel="stylesheet" href="css/datepicker.min.css">
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
                    <strong><a href="adminPosts.php" class="nav-link active">Posts</a></strong>
                </li>
                <li class="nav-item active">
                    <strong><a href="adminUsers.php" class="nav-link active">Users</a></strong>
                </li>
            </ul>
            <a class="btn btn-outline-danger" href="logout.php">Log Out</a></button></li>
        </div>
    </nav>
</head>
<body>
    <div class="container">
        <div style="padding: 10px">
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary" name="c_listing" data-toggle="modal" data-target="#createuModal">Create Listing</button>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <input type="text" class="form-control mr-sm-2" id="se_input" placeholder="Search Listing" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="se_submit" type="button">Search</button>
                </div>
            </div>            
        </div>
        <!-- Create User Modal -->
        <div class="modal fade" id="createuModal" tabindex="-1" role="dialog" aria-labelledby="createuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createuModal">Create a new listing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        Status:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cr_status" checked value="1">&nbsp;Active&nbsp;&nbsp; 
                        <input type="radio" name="cr_status" value="0">&nbsp;Inactive
                        <br><br>
                        <input id="cr_address" type="text"  maxlength="100" class="form-control" placeholder="Address">
                        <br>
                        <input id="cr_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="Price">
                        <br>
                        <input id="cr_listing_member" type="text"  maxlength="45" class="form-control" placeholder="Listing Member">
                        <br>
                        End Date: <input id="cr_end_date" type="date" class="form-control">
                        <br>

                        <input id="cr_due_per_month" type="number"  maxlength="12" class="form-control" step="1" placeholder="*Due Per Month">
                        <br>
                        Property Type:&nbsp;<select id="cr_property_type" class="form-control" placeholder="Property Type">
                            <option value="Land">Land</option>
                            <option value="House">House</option>
                            <option value="Condominium">Condominium</option>
                        </select>   
                        <br>
                        <input id="cr_listing_side" type="text"  maxlength="45" class="form-control" placeholder="Listing Side">
                        <br>
                        <input id="cr_selling_side" type="text"  maxlength="45" class="form-control" placeholder="Selling Side">
                        <br>
                        <input id="cr_area" type="text"  maxlength="45" class="form-control" placeholder="Area">
                        <br>

                        <input id="cr_zone" type="text"  maxlength="45" class="form-control" placeholder="Zone">
                        <br>
                        <input id="cr_community" type="text"  maxlength="45" class="form-control" placeholder="Community">
                        <br>
                        <input id="cr_bedrooms" type="number"  maxlength="50" class="form-control" step="1" placeholder="*Bedrooms">
                        <br>
                        <input id="cr_full_baths" type="number"  maxlength="50" class="form-control" step="1" placeholder="Full Baths">
                        <br>
                        <input id="cr_half_baths" type="number"  maxlength="50" class="form-control" step="1" placeholder="Half Baths">
                        <br>

                        <input id="cr_year_built" type="number"  maxlength="50" class="form-control" min="1900" max="2099" step="1" placeholder="Year Built" />
                        <br>
                        <input id="cr_listing_office" type="text"  maxlength="100" class="form-control" placeholder="Listing Office">
                        <br>
                        <input id="cr_directions" type="text"  maxlength="100" class="form-control" placeholder="Directions">
                        <br>
                        <textarea id="cr_legal" rows="4" cols="60"  maxlength="200" class="form-control" placeholder="Legal"></textarea>
                        <br>
                        View:&nbsp;<select id="cr_view" class="form-control" placeholder="View">
                            <option value="Canal">Canal</option>
                            <option value="City">City</option>
                            <option value="Golf Course">Golf Course</option>
                            <option value="Jungle">Jungle</option>
                            <option value="Marina">Marina</option>
                            <option value="Mountain">Mountain</option>
                            <option value="Ocean">Ocean</option>
                        </select>
                        <br>

                        Pet Friendly:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cr_pet_friendly" checked value="1">&nbsp;Yes&nbsp;&nbsp; 
                        <input type="radio" name="cr_pet_friendly" value="0">&nbsp;No
                        <br><br>
                        <input id="cr_list_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="List Price" />
                        <br>
                        <input id="cr_sold_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="Sold Price" />
                        <br>
                        <input id="cr_image" type="file" placeholder="Select an image" onChange="verifyImage(this, 'cr_show_image')"/>
                        <br>
                        <img id="cr_show_image" class="form-control" style="width: 100%; height: 250px;" accept="image/x-png, image/gif, image/jpeg, image/jpg" src="#"/>
                        <br>
                        
                    </div>
                    <div class="modal-footer">
                        <small id="cr_errorHelp" Style="width:90%;" class="form-text text-muted"></small>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="cr_submit">Create Listing</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update User Modal -->
        <div class="modal fade" id="updateuModal" tabindex="-1" role="dialog" aria-labelledby="updateuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateuModal">Update listing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>       
                    </div>
                    <div class="modal-body">
                        Status:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="up_status" checked value="1">&nbsp;Active&nbsp;&nbsp; 
                        <input type="radio" name="up_status" value="0">&nbsp;Inactive
                        <br><br>
                        <input id="up_address" type="text"  maxlength="100" class="form-control" placeholder="Address">
                        <br>
                        <input id="up_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="Price">
                        <br>
                        <input id="up_listing_member" type="text"  maxlength="45" class="form-control" placeholder="Listing Member">
                        <br>
                        End Date: <input id="up_end_date" type="date" class="form-control">
                        <br>

                        <input id="up_due_per_month" type="number"  maxlength="12" class="form-control" step="1" placeholder="*Due Per Month">
                        <br>
                        Property Type:&nbsp;<select id="up_property_type" class="form-control" placeholder="Property Type">
                            <option value="Land">Land</option>
                            <option value="House">House</option>
                            <option value="Condominium">Condominium</option>
                        </select>   
                        <br>
                        <input id="up_listing_side" type="text"  maxlength="45" class="form-control" placeholder="Listing Side">
                        <br>
                        <input id="up_selling_side" type="text"  maxlength="45" class="form-control" placeholder="Selling Side">
                        <br>
                        <input id="up_area" type="text"  maxlength="45" class="form-control" placeholder="Area">
                        <br>

                        <input id="up_zone" type="text"  maxlength="45" class="form-control" placeholder="Zone">
                        <br>
                        <input id="up_community" type="text"  maxlength="45" class="form-control" placeholder="Community">
                        <br>
                        <input id="up_bedrooms" type="number"  maxlength="50" class="form-control" step="1" placeholder="*Bedrooms">
                        <br>
                        <input id="up_full_baths" type="number"  maxlength="50" class="form-control" step="1" placeholder="Full Baths">
                        <br>
                        <input id="up_half_baths" type="number"  maxlength="50" class="form-control" step="1" placeholder="Half Baths">
                        <br>

                        <input id="up_year_built" type="number"  maxlength="50" class="form-control" min="1900" max="2099" step="1" placeholder="Year Built" />
                        <br>
                        <input id="up_listing_office" type="text"  maxlength="100" class="form-control" placeholder="Listing Office">
                        <br>
                        <input id="up_directions" type="text"  maxlength="100" class="form-control" placeholder="Directions">
                        <br>
                        <textarea id="up_legal" rows="4" cols="60"  maxlength="200" class="form-control" placeholder="Legal"></textarea>
                        <br>
                        View:&nbsp;<select id="up_view" class="form-control" placeholder="View">
                            <option value="Canal">Canal</option>
                            <option value="City">City</option>
                            <option value="Golf Course">Golf Course</option>
                            <option value="Jungle">Jungle</option>
                            <option value="Marina">Marina</option>
                            <option value="Mountain">Mountain</option>
                            <option value="Ocean">Ocean</option>
                        </select>
                        <br>

                        Pet Friendly:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="up_pet_friendly" checked value="1">&nbsp;Yes&nbsp;&nbsp; 
                        <input type="radio" name="up_pet_friendly" value="0">&nbsp;No
                        <br><br>
                        <input id="up_list_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="List Price" />
                        <br>
                        <input id="up_sold_price" type="number"  maxlength="12" class="form-control" step="1" placeholder="Sold Price" />
                        <br>
                        <input id="up_image" type="file"  placeholder="Select an image" onChange="verifyImage(this, 'up_show_image')"/>
                        <br>
                        <img id="up_show_image" class="form-control" style="width: 100%; height: 250px;" accept="image/x-png, image/gif, image/jpeg, image/jpg" src="#"/>
                        <br>
                        
                    </div>
                    <div class="modal-footer">
                        <small id="up_errorHelp" Style="width:90%;" class="form-text text-muted"></small>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="up_submit">Update Listing</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Remove User Modal, when the ID is selected the whole user will be removed -->
        <div class="modal fade" id="removeuModal" tabindex="-1" role="dialog" aria-labelledby="removeuModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id2="re_title" id="removeuModal">Remove Listing</h5>
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
        <!-- Modal buttons -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Create a new Listing</h5>
                    <button>
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <!-- Body content here: -->
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Listings Database Table Display -->
        <div class="container">
            <table id="listingsTable" class="table table-bordered table-striped table-responsive">
                
            </table>
        </div>
    </div>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="javascript/adminListings.js"></script>
    <script src="javascript/verifyImage.js"></script>
</body>
</html>