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

    <title> Dashboard </title>

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

                                    <p> <strong> Anthony </strong></p>

                                    <p class="teck-name-color" >Crew Member</p>   

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



                <ul class="main-menu-crew">
                    <li class="menu-item active">
                        <a href="./index-crew.php">
                            <img src="./assets/images/dashboard.png" class="img-fluid" alt="">
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-item">
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

                <div class="row dashboard_col" id="dashboard">

                    <div class="col-md-12 dashboard_Sec">

                        <h1>Dashboard</h1>

                        <p class="D-paragraph">Hey Anthony, welcome to your dashboard.</p>

                    </div>

                    

                    <div class="col-lg-12 row-2">

                        <div class="row">

                          

                        </div>

                    </div>

                    

                    <div class="col-md-12 activies_table">

                        <div class="row activity_col">

                            <div class="col-md-12 dashboard-heading-desc">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 upcoming_activities">
                                        <h4> upcoming activities 
                                        <p class="col-12-descrapction">Below is a list of the upcoming activities you are scheduled to attend within the next 30 days.</p>
                                    </div>
        
                                    <div class="col-lg-4 col-md-12">
                                        <div class="teck-btn-view-activites justify-content-end">
                                            <a href="./my-activities.php"><img src="./assets/images/All-Activities.png" class="view-activites-icon">View all my activities</a>
                                        </div>
                                    </div>
                                </div>
                           </div>     
                            

                            <div class="col-md-12">
                            <div class="teck-table">
                                <table class="rwd-table">

                                    <tbody>

                                      <tr>

                                        <th>Activity</th>

                                        <th>Activity Date</th>

                                        <th>Brief</th>

                                        <th>Duration</th>

                                        <th>Crew Needed</th>

                                        <th>Crew</th>

                                        <th>Status</th>

                                      </tr>

                                      <tr>

                                        <td data-th="Supplier Code">

                                          <div class="crew-table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p><b>Hugh Henshall </b><br> #7083 </p>

                                          </div>

                                        </td>

                                        <td data-th="Supplier Name">

                                          <p>

                                            Tue 26th July '22 <br> 09:00 AM

                                          </p>

                                        </td>

                                        <td data-th="Invoice Number">

                                            Tuesday Bacon Cob Cruise

                                        </td>

                                        <td data-th="Invoice Date">

                                            8 hours

                                        </td>

                                        <td data-th="Due Date">

                                            6 Crew Members

                                            

                                            

                                        </td>

                                        <td data-th="Net Amount">

                                          <p>ADL, CH, KW1,

                                            PLE, AB, JKL</p>

                                        </td>

                                        <td data-th="Net Amount">

                                            <span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span>

                                          </td>
                                         
                                          
                                          <td class="action">
                                      
                                              
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    <a class="dropdown-item" href="activities-details-crew.php">View Activity</a>
                                                    <a class="dropdown-item" href="#">I’m not available</a>
                                                </div>
                                            </div>
                                            
                                            
                                          </td>
                                      </tr>

                                      <tr class="teck-danger">

                                        <td data-th="Supplier Code">

                                          <div class="crew-table-div">

                                            <img src="./assets/images/Picture-02.png" class="img-fluid" alt="">

                                            <p><b>Seth Ellis</b><br> #7084 </p>

                                          </div>

                                        </td>

                                        <td data-th="Supplier Name">

                                          <p>

                                            Wed 27th July '22 <br> 09:15 AM

                                          </p>

                                        </td>

                                        <td data-th="Invoice Number">

                                            Drakehouse 2 hour cruises

                                        </td>

                                        <td data-th="Invoice Date">

                                            7.5 hours

                                        </td>

                                        <td data-th="Due Date">

                                            4 Crew Members

                                        </td>

                                        <td data-th="Net Amount">

                                          <p>ADL, CH,</p>

                                        </td>

                                        <td data-th="Net Amount" class="crew_btn">

                                            <span class="active-btn-2"><img src="./assets/images/Button-Crew-Needed.png" class="img-fluid" alt=""> Crew Needed</span>

                                          </td>
                                          <td class="action">
                                              
                                              <div class="dropdown">
                                                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    <a class="dropdown-item" href="./activities-details-crew.php">View Activity</a>
                                                    <a class="dropdown-item" href="#">I’m not available</a>
                                                </div>
                                            </div>
                                            
                                          </td>

                                      </tr>                                    

                                      <tr>

                                        <td data-th="Supplier Code">

                                          <div class="crew-table-div">

                                            <img src="./assets/images/Picture-02.png" class="img-fluid" alt="">

                                            <p><b>Hugh Henshall</b><br> #7083 </p>

                                          </div>

                                        </td>

                                        <td data-th="Supplier Name">

                                          <p>

                                            Tue 26th July '22 <br> 09:00 AM

                                          </p>

                                        </td>

                                        <td data-th="Invoice Number">

                                            Tuesday Bacon Cob Cruise

                                        </td>

                                        <td data-th="Invoice Date">

                                            8 hours

                                        </td>

                                        <td data-th="Due Date">

                                            6 Crew Members

                                        </td>

                                        <td data-th="Net Amount">

                                          <p>ADL, CH, KW1,

                                            PLE, AB, JKL</p>

                                        </td>

                                        <td data-th="Net Amount">

                                             <span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span>

                                          </td>
                                          <td class="action">
                                              
                                              <div class="dropdown">
                                                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    <a class="dropdown-item" href="./activities-details-crew.php">View Activity</a>
                                                    <a class="dropdown-item" href="#">I’m not available</a>
                                                </div>
                                            </div>
                                              
                                          </td>

                                      </tr>

                                    </tbody>
                                    

                                  </table>
                                  
                                  <div class="col-md-12">
                            <div class="row btm-row">
                                <div class="col-md-6 teck-showin-text">Showing <b>1-50</b> of <b>46</b> available activities.</div>
                                <div class="col-md-6">
                                    <div class="pagination-row">
                                        <button class="btn-prev teck-arrow"><</button>
                                        <ul class="pagination">
                                            <li class="active"> 1 </li>
                                            <li> 2 </li>
                                            <li> 3 </li>
                                            <li> 4 </li>
                                        </ul>
                                        <button class="btn-next teck-arrow">></button>
                                    </div>
                                </div>
                            </div>
                                  </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!--Custom JS-->
<script src="./assets/js/script.js"></script>

</body>
</html>