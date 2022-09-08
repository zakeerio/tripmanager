<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    

    
    <title> Crew Members - Create </title>
  </head>

  <body>
  <header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-6" id="logo-col">
                <div class="logo">
                    <a href="#!">
                        <img src="./assets/images/logo.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-6" id="icon-col">
                <div class="icon-div">
                    <ul>
                        <li class="notification">
                            <span>12</span>
                            <a href="#!"><img src="./assets/images/notify.svg" class="alrt-img" alt=""></a>
                        </li>
                        <li>
                            <div class="profile">
                                <img src="./assets/images/Chacha.png" class="img-fluid" alt="">
                                   <div class="profile-matter">
                                    <p> <strong> Rod Auton </strong></p>
                                    <p class="teck-name-color">Crew Member</p>
                                   </div>
                               </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="banner-section">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-2 col-md-12" id="sidebar">


            <div id="burger-menu">
                    <span class="open-menu">
                        <img src="./assets/images/burger-menu.svg" class="img-fluid" />
                    </span>
                    <span class="close-menu">
                        <img src="./assets/images/burger-menu-close.svg" class="img-fluid" />
                    </span>
                </div>




                <h3 class="heading-menu"> MAIN MENU </h3>

                <ul class="main-menu">
                    <li class="menu-item">
                        <a href="./index.php">
                            <img src="./assets/images/dashboard.png" class="img-fluid" alt="">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./all-activities.php">
                            <img src="./assets/images/All-Activities.png" class="img-fluid" alt="">
                            <span>All Activities</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./my-activities.php">
                            <img src="./assets/images/locution-icon-2.png" class="img-fluid" alt="">
                            <span>My Activities</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./documents.php">
                            <img src="./assets/images/Documents.png" class="img-fluid" alt="">
                            <span>Documents</span>
                        </a>
                    </li>

                    <li class="menu-item active">
                        <a href="./crew-members.php">
                            <img src="./assets/images/Crew.png" class="img-fluid" alt="">
                            <span>Crew Members</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./activity-items.php">
                            <img src="./assets/images/Activity-Items.png" class="img-fluid" alt="">
                            <span>Activity Items</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./analytics.php">
                            <img src="./assets/images/Analysis.png" class="img-fluid" alt="">
                            <span>Analytics</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./my-account.php">
                            <img src="./assets/images/My-Account.png" class="img-fluid" alt="">
                            <span>My Account</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#!">
                            <img src="./assets/images/Setting.png" class="img-fluid" alt="">
                            <span>Settings</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#!">
                            <img src="./assets/images/Logout.png" class="img-fluid" alt="">
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>



                <p class="last-text">

                    CCT Activity Manager <br>

                    Maintained by Voteq

                </p>

            </div>

            

            <div class="col-lg-10 col-md-12" id="main">

                <div class="row dashboard_col" id="crew-members-create">

                    <div class="col-md-12 dashboard_Sec">

                        <h1>Crew Members - Create a new member</h1>
                        <p class="sub-pages-text">Please fill out the information below to create a new crew memb.</p>

                    </div>

                    

                    

                    

                    <div class="col-md-12 activies_table">

                        <div class="row activity_col">

                            <div class="col-md-12 dashboard-heading-desc">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 upcoming_activities">
                                        <h4>Member Information</h4>
                                        <p class="col-12-descrapction">These details will be editable by the crew member once logged into their account.</p>
                                    </div>
                                </div>
                           </div>     
                            

                            <div class="col-md-12">

                                <form class="teck-form">
                                  <div class="form-row">
                                      
                                        <div class="form-group col-xl-8 col-lg-12">
                                            <div class="form-row">
                                                <div class="form-group col-xl-4 col-lg-6">
                                                  <label for="Name">NAME</label>
                                                  <input type="text" class="form-control" id="Name">
                                                </div>
                                                
                                                <div class="form-group col-xl-4 col-lg-6">
                                                  <label for="EmailAddress">EMAIL ADDRESS</label>
                                                  <input type="email" class="form-control" id="EmailAddress">
                                                </div>
                                                
                                                
                                                <div class="form-group col-xl-4 col-lg-6">
                                                  <label for="PrimaryNumber">PRIMARY NUMBER</label>
                                                  <input type="number" class="form-control" id="PrimaryNumber">
                                                </div>
                                                
                                                
                                                <div class="form-group col-xl-4 col-lg-6">
                                                  <label for="SecondaryNumber">SECONDARY NUMBER</label>
                                                  <input type="number" class="form-control" id="SecondaryNumber">
                                                </div>
                                                
                                                <div class="form-group col-xl-4 col-lg-12">
                                                  <label for="ActivityPreference">ACTIVITY PREFERENCE</label>
                                                  <select id="ActivityPreference" class="form-control">
                                                    <option selected>Please Select...</option>
                                                    <option>...</option>
                                                    <option>...</option>
                                                    <option>...</option>
                                                  </select>
                                                </div>
                                                
                                                
                                                <div class="col-lg-12 col-md-12 upcoming_activities">
                                                    <h4>System Information</h4>
                                                    <p class="col-12-descrapction">This information is not editable by the crew member and they will not be able to update it themselves.</p>
                                                </div>
                                                
                                                
                                                <div class="form-group col-xl-8 col-lg-12">
                                                    <div class="form-row">
                                                        
                                                        <div class="form-group col-md-6">
                                                          <label for="Initials">INITIALS</label>
                                                          <input type="text" class="form-control" id="Initials">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                          <label for="Username">USERNAME</label>
                                                          <input type="text" class="form-control" id="Username">
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group col-md-6">
                                                          <label for="AccountRole">ACCOUNT ROLE</label>
                                                          <select id="AccountRole" class="form-control">
                                                            <option selected>Please Select...</option>
                                                            <option>...</option>
                                                            <option>...</option>
                                                            <option>...</option>
                                                          </select>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="form-group col-md-6">
                                                          <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>
                                                          <input type="text" class="form-control" id="CctMembershipNumber">
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group col-xl-4 col-lg-12">
                                                    <div class="form-group col-md-12">
                                                            <div><label>ADDITIONAL</label></div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="First Aid">
                                                                <label class="form-check-label" for="First Aid">First Aid</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="CBA">
                                                                <label class="form-check-label" for="CBA">CBA</label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="RYA">
                                                                <label class="form-check-label" for="RYA">RYA</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="Key Holder">
                                                                <label class="form-check-label" for="Key Holder">Key Holder</label>
                                                            </div>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="IWA">
                                                                <label class="form-check-label" for="IWA">IWA</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="Skipper">
                                                                <label class="form-check-label" for="Skipper">Skipper</label>
                                                            </div>
                                                        </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                <div class="col-lg-12 col-md-12 upcoming_activities">
                                                    <h4>Account Password</h4>
                                                    <p class="col-12-descrapction">Please set a temporary password for the crew member. They can update this once logged in.</p>
                                                </div>
                                                
                                                
                                                
                                                <div class="form-group col-xl-8 col-lg-12">
                                                    <div class="form-row">
                                                
                                                        <div class="form-group col-md-6">
                                                          <label for="TypeNewPassword">TYPE NEW PASSWORD</label>
                                                          <input type="password" class="form-control" id="TypeNewPassword">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                          <label for="ReTypePassword">RE TYPE PASSWORD</label>
                                                          <input type="password" class="form-control" id="ReTypePassword">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                              </div>
                                                
                                                
                                                
                                      </div>
                                      
                                      <div class="form-group col-xl-4 col-lg-12">
                                        <div class="profile-picture">
                                            <label>PROFILE PICTURE</label>
                                            <img src="./assets/images/profile-picture.svg" />
                                            
                                            <div class="teck-btn bg-white upload-btn">
                                                <input type="file" />
                                                <a href="#!"><img src="./assets/images/camera.svg" class="btn-icon-2" alt=""> Update Image </a>
                                            </div>
                                        </div>
                                      </div>
                                      
                                      
                                  </div>
                                  
                                  
                                  
                                    <div class="teck-btn">
                                        <button type="submit" class="btn btn-primary"> <img src="./assets/images/save.svg" class="img-fluid"> Create User </button>
                                    </div>
                                </form>
                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>





    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


<!--Custom JS-->
<script src="./assets/js/script.js"></script>


  </body>

</html>