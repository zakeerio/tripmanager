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


    <title> All Activities - Edit </title>

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

                    <li class="menu-item active">
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

                <div class="row dashboard_col" id="all-activities-edit">

                    <div class="col-md-12 dashboard_Sec">

                        <h1>Activities - Edit an existing activity</h1>
                        <p>Please amend any details below and click save changes to submit</p>

                    </div>







                    <div class="col-md-12 activies_table">

                        <div class="row activity_col">

                            <div class="col-md-12 dashboard-heading-desc">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 upcoming_activities">
                                        <h4>Activity Information</h4>
                                        <p class="col-12-descrapction">These details will be visible throughout the Activity Manager system.</p>
                                    </div>
                                    <div class="col-lg-4 col-md-12 ready">
                                        <lable>ACTIVITY STATUS</lable>
                                        <span class="active-btn-ready"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span>
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
                                      <label for="ActivityItem">SELECT ACTIVITY ITEM</label>
                                      <select id="ActivityItem" class="form-control">
                                        <option selected>Please Select...</option>
                                        <option>...</option>
                                        <option>...</option>
                                        <option>...</option>
                                      </select>
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                      <label for="ActivityDate">ACTIVITY DATE</label>
                                      <input type="date" class="form-control" id="ActivityDate" value="2020-11-06">
                                    </div>
                                  </div>



                                  <div class="form-row">
                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="ActivityTime">ACTIVITY TIME</label>
                                        <input type="time" class="form-control" id="ActivityTime" value="10:40:00">
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-6">
                                      <label for="ActivityDuration">ACTIVITY DURATION</label>
                                      <input type="number" class="form-control" id="ActivityDuration" value="7.5 hour/s">
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                      <label for="BriefDescription">BRIEF DESCRIPTION</label>
                                      <input type="text" class="form-control" id="BriefDescription" value="Boat trips to Staveley">
                                    </div>
                                  </div>



                                  <div class="form-row">
                                    <div class="col-lg-12 col-md-12 upcoming_activities">
                                        <h4>Crew Information</h4>
                                        <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                      <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                                      <input type="text" class="form-control" id="NumberCrewNeeded" value="6 Crew Members">
                                    </div>

                                    <div class="form-group col-md-12">
                                      <label for="NotesCrew">NOTES FOR CREW</label>
                                      <textarea class="form-control" id="NotesCrew" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare orci sit amet dui sagittis porttitor. Aliquam suscipit ligula et nisl ullamcorper lacinia. Nunc sagittis vitae lectus sit amet tincidunt. Nullam tristique, orci a consequat vehicula, arcu diam vehicula eros.</textarea>
                                    </div>
                                  </div>



                                  <div class="form-row">
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
                                            <option>Andy Karen</option>
                                            <option>Karen Gillan</option>
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
                                        <button type="submit" class="btn btn-primary"> <img src="./assets/images/save.svg" class="img-fluid"> Update Activity</button>
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
