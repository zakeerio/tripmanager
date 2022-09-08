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



    

    <title> Activity Items - Edit </title>

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



                    <li class="menu-item">

                        <a href="./crew-members.php">

                            <img src="./assets/images/Crew.png" class="img-fluid" alt="">

                            <span>Crew Members</span>

                        </a>

                    </li>



                    <li class="menu-item active">

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



                <div class="row dashboard_col" id="activity-items-edit">



                    <div class="col-md-12 dashboard_Sec">



                        <h1>Activity Items - Edit existing activity item</h1>

                        <p class="sub-pages-text">Please amend any details below and click save changes to submit the updated infromation.</p>



                    </div>



                    



                    



                    



                    <div class="col-md-12 activies_table">



                        <div class="row activity_col">



                            <div class="col-md-12 dashboard-heading-desc">
    
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 upcoming_activities">
                                        <h4>Activity Information</h4>
                                        <p class="col-12-descrapction">These details are used within the Activity Manager.</p>
                                    </div>
                                </div>

                           </div>     

                            



                            <div class="col-md-12">



                                <form class="teck-form">

                                  <div class="form-row">

                                      

                                        <div class="form-group col-xl-8 col-lg-12">

                                            <div class="form-row">

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="ActivityName">ACTIVITY NAME</label>

                                                  <input type="text" class="form-control" id="ActivityName" value="Hugh Henshall">

                                                </div>

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="ActivityType">ACTIVITY TYPE</label>

                                                  <select id="ActivityType" class="form-control">

                                                    <option>Please Select...</option>

                                                    <option selected>Boat Trips</option>

                                                    <option>...</option>

                                                    <option>...</option>

                                                  </select>

                                                </div>

                                                

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="ActivityCapacity">ACTIVITY CAPACITY</label>

                                                  <input type="number" class="form-control" id="ActivityCapacity" value="20">

                                                </div>

                                                

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="MinimumCrewRequired">MINIMUM CREW REQUIRED</label>

                                                  <input type="number" class="form-control" id="MinimumCrewRequired" value="5">

                                                </div>

                                                

                                                <div class="form-group col-xl-4 col-lg-12">

                                                  <label for="ColourTag">COLOUR TAG</label>

                                                  <select id="ColourTag" class="form-control">

                                                    <option>RGB Selector</option>

                                                    <option selected>#99ff66</option>

                                                    <option>...</option>

                                                    <option>...</option>

                                                  </select>

                                                </div>

                                                

                                                

                                              </div>

                                      </div>

                                      

                                      

                                      

                                      <div class="form-group col-xl-4 col-lg-12">

                                        <div class="profile-picture">

                                            <label>ACTIVITY PICTURE</label>

                                            <img src="./assets/images/activity-picture.png" />

                                            

                                            <div class="teck-btn bg-white upload-btn">

                                                <input type="file" />

                                                <a href="#!"><img src="./assets/images/camera.svg" class="btn-icon-2" alt=""> Update Image </a>

                                            </div>

                                        </div>

                                      </div>

                                      

                                      

                                  </div>

                                  

                                  

                                  

                                    <div class="teck-btn">

                                        <button type="submit" class="btn btn-primary"> <img src="./assets/images/save.svg" class="img-fluid"> Create Activity </button>

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