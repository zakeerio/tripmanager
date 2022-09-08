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


    <title> My Activities </title>
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

                    <ul class="main-menu-crew">
                        <li class="menu-item" id="menu-item-pag-3">
                            <a href="./index-crew.php">
                                <img src="./assets/images/dashboard.png" class="img-fluid" alt="">
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-item" id="menu-item-pag-3">
                            <a href="./all-activities-crew.php">
                                <img src="./assets/images/All-Activities.png" class="img-fluid" alt="">
                                <span>All Activities</span>
                            </a>
                        </li>

                        <li class="menu-item active" id="menu-item-pag-3">
                            <a href="./my-activities-crew.php">
                                <img src="./assets/images/locution-icon-2.png" class="img-fluid" alt="">
                                <span>My Activities</span>
                            </a>
                        </li>

                        <li class="menu-item" id="menu-item-pag-3">
                            <a href="./documents-crew.php">
                                <img src="./assets/images/Documents.png" class="img-fluid" alt="">
                                <span>Documents</span>
                            </a>
                        </li>





                        <li class="menu-item" id="menu-item-pag-3">
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
                    <div class="row dashboard_col" id="my-activities">
                        <div class="col-md-12 dashboard_Sec">
                            <div class="row">
                                <div class="col-xl-8 col-lg-12 teck-acticites">
                                    <h1>My Activities</h1>
                                    <p>This is a list of all the scheduled activities in the Activity Manager system..</p>
                                </div>


                            </div>
                        </div>


                        <div class="col-md-12 activies_table">
                            <div class="row activity_col">
                                <div class="col-md-12">
                                    <div class="teck-table">
                                        <table class="rwd-table">
                                            <tbody>
                                                <tr>
                                                    <th class="th-heading">Activity</th>
                                                    <th class="th-heading">Activity Date</th>
                                                    <th class="th-heading-brief">Brief</th>
                                                    <th class="th-heading">Duration</th>
                                                    <th class="th-heading">Crew Needed</th>
                                                    <th class="th-heading">Crew</th>
                                                    <th class="th-heading">Status</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="crew-table-div">
                                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">
                                                            <p> <b> Hugh Henshall</b> <br> #7083 </p>
                                                        </div>
                                                    </td>
                                                    <td> Tue 26th July '22 <br> 09:00 AM </td>
                                                    <td> Tuesday Bacon Cob Cruise </td>
                                                    <td> 8 hours </td>
                                                    <td> 6 Crew Members </td>
                                                    <td> ADL, CH, KW1, <br> </td>
                                                    <td> <span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span> </td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="crew-table-div">
                                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">
                                                            <p> <b> Hugh Henshall</b> <br> #7083 </p>
                                                        </div>
                                                    </td>
                                                    <td> Tue 26th July '22 <br> 09:00 AM </td>
                                                    <td> Tuesday Bacon Cob Cruise </td>
                                                    <td> 8 hours </td>
                                                    <td> 6 Crew Members </td>
                                                    <td> ADL, CH, KW1, <br> </td>
                                                    <td> <span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span> </td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>


                                                <tr>
                                                    <td>
                                                        <div class="crew-table-div">
                                                            <img src="./assets/images/Picture-02.png" class="img-fluid" alt="">
                                                            <p> <b> Henshall </b> <br> #7083 </p>
                                                        </div>
                                                    </td>
                                                    <td> Tue 26th July '22 <br> 09:00 AM </td>
                                                    <td> Tuesday Bacon Cob Cruise </td>
                                                    <td> 8 hours </td>
                                                    <td> 6 Crew Members </td>
                                                    <td> ADL, CH, KW1,<br> PLE, AB, JKL </td>
                                                    <td> <span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span> </td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>



                                                <tr>
                                                    <td>
                                                        <div class="crew-table-div">
                                                            <img src="./assets/images/Picture-02.png" class="img-fluid" alt="">
                                                            <p> <b> Henshall </b> <br> #7083 </p>
                                                        </div>
                                                    </td>
                                                    <td> Tue 26th July '22 <br> 09:00 AM</td>
                                                    <td>Tuesday Bacon Cob Cruise </td>
                                                    <td>8 hours</td>
                                                    <td>6 Crew Members</td>
                                                    <td>ADL, CH, KW1,<br>PLE, AB, JKL </td>
                                                    <td><span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span></td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="crew-table-div"><img src="./assets/images/Picture-02.png" class="img-fluid" alt="">
                                                            <p> <b> Henshall </b> <br> #7083 </p>
                                                        </div>
                                                    </td>
                                                    <td>Tue 26th July '22 <br> 09:00 AM</td>
                                                    <td>Tuesday Bacon Cob Cruise</td>
                                                    <td> 8 hours</td>
                                                    <td>6 Crew Members</td>
                                                    <td> ADL, CH, KW1,<br> PLE, AB, JKL </td>
                                                    <td><span class="active-btn"><img src="./assets/images/Activity-Ready-Button.png" class="img-fluid" alt=""> Activity Ready</span> </td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="teck-danger">
                                                    <td>
                                                        <div class="crew-table-div">
                                                            <img src="./assets/images/Picture-02.png" class="img-fluid" alt="">
                                                            <p> <b> Seth Ellis </b> <br> #7084 </p>
                                                        </div>
                                                    </td>
                                                    <td> Wed 27th July '22 <br> 09:15 AM </td>
                                                    <td> Drakehouse 2 hour cruises </td>
                                                    <td> 7.5 hours </td>
                                                    <td> 4 Crew Members </td>
                                                    <td> ADL, CH, </td>
                                                    <td class="crew_btn"> <span class="active-btn-2"><img src="./assets/images/Button-Crew-Needed.png" class="alrt-image" alt=""> Crew Needed</span> </td>

                                                    <td class="action">
                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="./all-activities-edit.php">View Activity</a>
                                                                <a class="dropdown-item" href="#">I’m not available</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                        <div class="teck-table"> </div>


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