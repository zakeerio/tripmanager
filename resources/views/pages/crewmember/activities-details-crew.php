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

  
    <title>  Activities Details  </title>
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
                                <img src="./assets/images/profile-img.jpg" class="crew-profil-img" alt="">
                                   <div class="profile-matter">
                                    <p> <strong>  Anthony </strong></p>
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

                <ul class="main-menu-crew2">
                    <li class="menu-item">
                        <a href="./index-crew.php">
                            <img src="./assets/images/dashboard.png" class="img-fluid" alt="">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item active">
                        <a href="./all-activities-crew.php">
                            <img src="./assets/images/All-Activities.png" class="img-fluid" alt="">
                            <span>All Activities</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./my-activities-crew.php">
                        
                            <img src="./assets/images/locution-icon-2.png" class="img-fluid" alt="">
                            <span>My Activities</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./documents-crew.php">
                            <img src="./assets/images/Documents.png" class="img-fluid" alt="">
                            <span>Documents</span>
                        </a>
                    </li>

                   

                 


                    <li class="menu-item">
                        <a href="./my-account-crew.php">
                            <img src="./assets/images/My-Account.png" class="img-fluid" alt="">
                            <span>My Account</span>
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

                <div class="row dashboard_col" id="all-activities-create">

                    <div class="col-md-12 dashboard_Sec">

                        <h1> Activities Details </h1>
                        <p class="sub-pages-text">Please fill out the information below to create a activity.</p>

                    </div>

                    

                    

                    

                    <div class="col-md-12 activies_table">

                        <div class="row activity_col">

                            <div class="col-md-12 dashboard-heading-desc">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 upcoming_activities">
                                        <h4>Activity Information</h4>
                                        <p class="col-12-descrapction">These details will be visible throughout the Activity Manager system.</p>
                                    </div>
                                </div>
                           </div>     
                            

                            <div class="col-md-12">

                                
                                
                                <form class="teck-form">
                                  <div class="form-row">
                                    <div class="form-group col-xl-4 col-lg-6">
                                      <label for="ActivityNumber">ACTIVITY NUMBER</label>
                                      <input type="number" class="form-control" id="ActivityNumber" value="9001">
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-6">
                                    <label for="Name">ACTIVITY ITEM</label>
                                    <input type="text" class="form-control" id="Name" value="item 01">
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                    <label for="Name">ACTIVITY DATE</label>
                                    <input type="text" class="form-control" id="Name" value="November 6th, 2020">
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="form-row">
                                 

                                    <div class="form-group col-xl-4 col-lg-6">
                                    <label for="Name">ACTIVITY TIME</label>
                                    <input type="text" class="form-control" id="Name" value="10 : 40 AM">
                                    
                                    </div>


                                    <div class="form-group col-xl-4 col-lg-6">
                                    <label for="Name">ACTIVITY DURATION</label>
                                    <input type="text" class="form-control" id="Name" value="15 Days">
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                     
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="form-row">
                                  <div class="col-lg-12 col-md-12 upcoming_activities">
                                        <h4>Crew Information</h4>
                                        <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                      <label for="NotesCrew">BRIEF DESCRIPTION</label>
                                      <textarea class="form-control" id="NotesCrew" rows="5" placeholder="lorem ipsum"></textarea>
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="form-row form-multi">
                                    <div class="form-group col-xl-4 col-lg-12">
                                        <label for="ConfirmedCrew">Confirmed Crew</label>
                                        <select multiple class="form-control" id="ConfirmedCrew">
                                            <option>No one to show</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-xl-4 col-lg-12">
                                        <label for="AvailableCrew">Available Crew</label>
                                        <select multiple class="form-control" id="AvailableCrew">
                                            <option>No one to show</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group col-xl-4 col-lg-12">
                                        <label for="UnavailableCrew">Unavailable Crew</label>
                                        <select multiple class="form-control" id="UnavailableCrew">
                                        
                                            <option> divAndy Karen </option>        
                                            <option> Karen Gillan</option>
                                            <option>Anderson Smith</option>
                                            <option>William</option>
                                            <option>Hughei Jack</option>
                                            <option>Micheal</option>
                                            <option>Jimmy M.</option>
                                            <option>Francis Ann</option>
                                            <option>Ali Brownes</option>
                                            <option>Karen Gillan</option> 
                                        </select>
                                    </div>
                                    
                                  </div>
                                  
                                  
                                  
                                  
                                  
                                    <div class="teck-btn">
                                        <button type="submit" class="btn btn-primary">  I'm Available</button>
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