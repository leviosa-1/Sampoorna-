    <!--Header Open-->
    <!--Hide Navbar Open-->
   <?php 
include 'DBConnect.php';
include 'dbconnect.php';
//session_start();  
 if(isset($_POST['signIn1']))
 {
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $sql = mysqli_query($conn,"SELECT * FROM `userinfo` WHERE User_Id='$username' AND Pwd='$password' ");
    $result = mysqli_num_rows($sql);
    if($result > 0)
     {
        while($row=mysqli_fetch_assoc($sql))
        {
          $dbusername=$row['User_Id'];
          $dbpassword=$row['Pwd'];
          $level = $row['user_level'];
        }
        if($username==$dbusername && $password==$dbpassword)
        {
         //session_start();
         $_SESSION['username'] = $username ; 
        /* if ($level == 1) {        
               $_SESSION['username'] = $username ;     
               header("location:puser/admin.php");
         }
         elseif ($level == 2) {            
              $_SESSION['username'] = $username ;
              header("location:profile.php");
         }*/
         
        }
     }
    else
        echo "<script>alert('Invalid Username/Password')</script>";
   }
?>
    <div class="wrapper hidden-xs">
      <div id="header-style">
          <div>
                           
                            <ul class="nav navbar-nav">
                                <li><a href="https://davv.mponline.gov.in/Portal/Services/DAVV/SIS/Main_Page.aspx" target="_blank">Student</a></li>
                                <li><a href="#FacultyModal" data-toggle="modal">Faculty &amp; Staff</a></li>
                                <li><a href="alumni_reg.php">Alumni</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">     
                                <li><a href="sitemap.php">Sitemap</a></li>
                                <li><a href="feedbackForm.php">Feedback</a></li>
                                <li>
                                <!--<form class="navbar-form navbar-left" id="searchForm" action="https://www.google.co.in/webhp?hl=en#hl=en&q=iips davv " target="_blank">
                                    <div class="input-group input-group-sm">
                                        <input type="text" id="txtSearch" class="form-control" placeholder="Search IIPS Web">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                            </div>
                                    </div>
                                </form>-->
                                <script async src="https://cse.google.com/cse.js?cx=438e495522f404a2c">
                                </script>
                                <div class="gcse-search"></div>
                                </li>
                            </ul> 
          </div><!-- container-->
      </div><!--header-style-->
    </div>
    <!--Hide Navbar Close-->
    
    <!--Main navbar starts-->
    <div class="container">
        
          <div>
              <nav class="navbar navbar-default yamm">
                <div class="container" >
                    <div class="row"> 
                        <div class="navbar-header">
                            <h6>
                              <a href="index.php">
                                  <img src="images/iips_logo.png" class="img img-responsive iips-logo-css col-lg-6 col-sm-6" style="width:250px;box-shadow: 2px 2px 2px 2px gray;padding:0px ;border-radius:5px; ">
                              </a>
                            </h6>
                            <button type="button" class="navbar-toggle collapsed" id="no-border" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                            </button>
                        </div>
                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <!--Visible Content-->
                        <div class="collapse navbar-collapse" id="navbar-main">
                                <div class="wrapper visible-xs">
                                    <div class="container">
                                        <div class="row">
                                        <script async src="https://cse.google.com/cse.js?cx=438e495522f404a2c">
</script>
<div class="gcse-search"></div>
                                            <!--<form id ="searchFormResponsive" class="navbar-form navbar-left" role="search" target="_blank">
                                                <div class="form-group">
                                                    <input type="text" id="txtSearchResponsive" class="form-control" placeholder="Search">
                                                </div>
                                            </form> -->
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5 mybutton">
                                                <a href="sitemap.php">Sitemap</a>
                                            </div>
                                            <div class="col-xs-1"></div>
                                            <div class="col-xs-5 mybutton">
                                                <a href="feedbackForm.php">Feedback</a>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            <ul class="nav navbar-nav" id="test">
								<!-- Home -->
								<li class="dropdown yamm-fw" id="test_home">
                                    <a href="index.php" class="dropdown-toggle navbar-underline navbar-two"  id="no-underline">Home</a>
								</li>
                                <!--About-->
                                <li class="dropdown yamm-fw" id="test_about">
                                    <a href="#" class="dropdown-toggle navbar-underline navbar-two" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="no-underline">About<span class="caret"></span></a>
                                    <ul class="dropdown-menu nav-margin" id="yamm-down-about" role="menu" style="margin:12px">
                                        <div class="row image2">                
                                            <div class="col-md-7 col-sm-9 hidden-xs" id="i6">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="images/about/image1.png" class="img-responsive" alt="About IIPS image">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    The International Institute of Professional Studies, a department of Devi Ahilya Vishwavidyalaya established in the year 1992 is an academic mentor of its kind and an eminently practical institute, recognized by AICTE. With the quality in the content, scope and professionalism of its programs.
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-3">
                                                <div class="col-md-6">                 
                                                    <!--<li id="link-style"><a href="about.php">Overview</a></li>-->
                                                    <li id="link-style"><a href="about_university.php">About University</a></li>
                                                    <li id="link-style"><a href="history.php">History</a></li>
                                                </div>
                                                <div class="col-md-6">
                                                    <li id="link-style"><a href="infrastructure.php">Infrastructure</a></li>
                                                    <li id="link-style"><a href="about_iips.php">About IIPS</a></li>
                                                    <li id="link-style"><a href="reach_us.php">Reach Us</a></li>
                                                </div>
                                            </div>
                                        </div>     
                                    </ul>
                                </li>

                                <!--Programs-->
                                <li class="dropdown yamm-fw" id="test_programs">
                                    <a href="#" class="dropdown-toggle navbar-underline navbar-two" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" id="no-underline">Programmes<span class="caret"></span></a>
                                    <ul class="dropdown-menu nav-margin" id="yamm-down-programmes" style="margin:12px">
                                        <div class="row image2">
                                            <div class="col-md-6 col-sm-3 hidden-xs" id="i6">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="images/admission/auditorium.jpg" class="img-responsive" alt="Responsive image">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    Every year CET is conducted in the month of JUNE for various courses at Graduate and post graduate level. The students from all over India apply to get admission through this exam. In this written exam. the student’s general aptitude, language knowledge and mathematical ability is tested.
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-9">
                                                <div class="col-md-8    ">
                                                    <div class="panel-group" id="accordion">

                                                    
                                                        <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                                  Integrated Programmes</a>
                                                                </h4>
                                                              </div>
                                                              <div id="collapse3" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                  <div class="nav nav-stacked" role="tablist">
                                                         
                                                                      <li ><a href="p_mca.php" class="menuLi" style="padding:0px" >MCA(5 Yrs.)</a></li>
                                                                      <li ><a href="p_mtech.php" class="menuLi" style="padding:0px">M.Tech.(IT)(5 Yrs.)</a></li>
                                                                      <li ><a href="p_mbams5.php" class="menuLi" style="padding:0px">MBA(MS)(5 Yrs.)</a></li>            
                                                                      <li ><a href="p_mbat5.php" class="menuLi" style="padding:0px">MBA(Tourism)(5 Yrs.)</a></li>
                                                                  </div>

                                                                </div>
                                                              </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                                  UG Programmes</a>
                                                                </h4>
                                                              </div>
                                                              <div id="collapse1" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                  <div class="nav nav-stacked" role="tablist">
                                                         
                                                                      <li><a href="p_bcom.php" class="menuLi"style="padding:0px" >B.Com.(Hons.)(3 Yrs.)</a></li>
                                                                      
                                                                  </div>

                                                                </div>
                                                              </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                                  PG Programmes</a>
                                                                </h4>
                                                              </div>
                                                              <div id="collapse2" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                  <div class="nav nav-stacked" role="tablist">
                                                         
                                                                      <li><a href="p_mbams2.php" class="menuLi" style="padding:0px" >MBA(MS)(2 Yrs.)</a></li>
                                                                      <li><a href="p_mbata2.php" class="menuLi" style="padding:0px" >MBA(TA)(2 Yrs.)</a></li>
                                                                      <li><a href="p_mbaapr2.php" class="menuLi" style="padding:0px" >MBA(APR)(2 Yrs.)</a></li>
                                                                      <li><a href="p_mbaent2.php" class="menuLi" style="padding:0px" >MBA(Entrepreneurship)(2 Yrs.)</a></li>
                                                                  </div>

                                                                </div>
                                                              </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                                  Doctoral Programmes</a>
                                                                </h4>
                                                              </div>
                                                              <div id="collapse4" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                  <div class="nav nav-stacked" role="tablist">
                                                         
                                                                      <li><a href="https://www.dauniv.ac.in/det" target="_blank" class="menuLi" style="padding:0px" >Ph.D. in Computer Science</a></li>
                                                                      <li><a href="https://www.dauniv.ac.in/det" target="_blank"  class="menuLi" style="padding:0px" >Ph.D. in Management</a></li>
                                                                      
                                                                  </div>

                                                                </div>
                                                              </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                    
                                                <div class="col-md-4"> 
                                                    <!--<li id="link-style"><a href="courses.php">Courses</a></li>-->
                                                    <li id="link-style"><a href="fee_structure.php">Fees Structure</a></li>
                                                    <li id="link-style"><a href="how_to_apply.php" >How to Apply</a></li>
                                                </div>
                                                
                                            </div>
                                        </div><!--container-->        
                                    </ul>
                                </li>
                                

                                <!--Academics-->
                                <li class="dropdown yamm-fw" id="test_academics">
                                    <a href="#" class="dropdown-toggle navbar-underline" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="no-underline">Academics<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu nav-margin" id="yamm-down-academics" style="margin:12px">
                                        <div class="row image2">
                                            <div class="col-md-7 col-sm-8 hidden-xs" id="i6">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="images/academics/012.jpg" class="img img-responsive" alt="Responsive image">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    The institute provides ample opportunities to students with a rigorous and challenging curriculum with flexibility to allow students to tailor their education to meet their professional and personal interests and goals.      
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-4">
                                                <div class="col-md-6">
                                                    <!--<li id="link-style"><a href="academics.php">Overview</a></li>-->
                                                    <li id="link-style"><a href="syllabus.php">Syllabus</a></li>
                                                    <li id="link-style"><a href="images/academics/academic calendar 19-20.pdf" target="_blank">Academic Calendar</a></li>
                                                  <!--  <li id="link-style"><a href="results.php">Results</a></li> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- <li id="link-style"><a href="news_and_announcements.php">News &amp; Announcements</a></li> -->
                                                    <li id="link-style"><a href="faculty_profile.php">Faculty Profile</a></li>
                                                    <li id="link-style"><a href="staff_profile.php">Staff Profile</a></li>
                                                     <li id="link-style"><a href="feedback.php">Feedback Report</a></li>
                                                      <li id="link-style"><a href="academic_audit.php" >Academic Audit Report</a></li>
                                                </div>
                                            </div>
                                        </div><!--container-->        
                                    </ul>  
                                </li>

                                <!--Research -->
                                <li class="dropdown yamm-fw" id="test-research">
                                    <a href="#" class="dropdown-toggle navbar-underline navbar-two" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="no-underline">Research<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu nav-margin" id="yamm-down-research" style="margin:12px">
                                        <div class="row image2">      
                                            <div class="col-md-7 col-sm-9 hidden-xs" id="i6">
                                                <div class="col-md-6 col-sm-6">
                                                    <img src="images/research/research_.png" class="img img-responsive" alt="Responsive image">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    Research is a process to discover new knowledge. The development and research center allow students to learn standards that are currently adapted by industry. Mentors also guide students to publish new research papers.
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-3">
                                                <div class="col-md-6">
                                                    <!--<li id="link-style"><a href="research.php">Overview</a></li>-->
													<li id="link-style"><a href="publication.php">Publication</a></li>
                                                    <li id="link-style"><a href="research_cell.php">Research Center</a></li>
                                                    <li id="link-style"><a href="development_center.php">Development Center</a></li>
													<!--<li id="link-style"><a href="consultancy.php">Consultancy</a></li>-->
                                                </div>
                                                <div class="col-md-6">
                                                    
                                                </div>
                                            </div>
                                        </div>        
                                    </ul>
                                </li>
								<!-- Placement -->
								<li class="dropdown yamm-fw" id="test_placement">
                                    <a href="placement.php" class="dropdown-toggle navbar-underline navbar-two"  id="no-underline">Placements</a>
								</li>
                                <!--Campus Life-->
                                <li class="dropdown yamm-fw" id="campus_life">
                                    <a href="#" class="dropdown-toggle navbar-underline navbar-two" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="no-underline">Student Zone<span class="caret"></span>
                                    </a>
            	                     <ul class="dropdown-menu nav-margin" id="yamm-down-campus" style="margin:12px">
                                      <div class="row image2">
                                          <div class="col-md-7 col-sm-9 hidden-xs" id="i6">
                                              <div class="col-md-6 col-sm-6">
                                                  <img src="images/campuslife/campus.jpg" class="img-responsive" alt="Responsive image">
                                              </div>
                                              <div class="col-md-6 col-sm-6">
                                                  Other than studies students also enjoy their college life by participating in different events.                                         </div>
                                          </div>
                                          <div class="col-md-5 col-sm-3">
                                              <div class="col-md-6">
                                                  <!--<li id="link-style"><a href="campus_life.php">Overview</a></li>-->
                                                  <li id="link-style"><a href="event.php">Events </a></li>
                                                  <li id="link-style"><a href="clubs.php">Students Club </a></li>
                                                  <li id="link-style"><a href="scholarship.php">Scholarship </a></li>
                                                  <!--<li id="link-style"><a href="placement.php">Placements</a></li>-->
                                              </div>
                                              <div class="col-md-6">
                                                  <li id="link-style"><a href="video_channel.php">Video Channels</a></li>
                                                  <li id="link-style"><a href="gallery.php">Gallery</a></li>
                                                  <li id="link-style"><a href="nss.php">NSS</a></li>
                                              </div>
                                          </div>
                                      </div>        
                                    </ul>
                                </li>
                                <?php 
                                    if(isset($_SESSION['username']))
                                    { 
                                ?>
                                <!-- Faculty  Profile-->
                                <li class="dropdown yamm-fw" id="test-faculty" style='margin-right:50px'>
                                    <a href="#" class="dropdown-toggle navbar-underline navbar-two" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="no-underline">Faculty Profile<span class="caret"></span>
                                    </a>
                                    
                                     <ul class="dropdown-menu nav-margin" id="yamm-down-faculty" style="margin:12px">
                                      <div class="image2">
                                          <div class="col-md-6 col-sm-9 hidden-xs" id="i6">
                                            <!-- <div class="col-md-2"> -->
                                              <div class="col-md-6 col-sm-6">
                                               <?php  
                                                      
                                                      $query = "SELECT * FROM image WHERE User_Id='".$_SESSION['username']."'";  
                                                      $result = mysqli_query($conn, $query);  
                                                      $row = mysqli_fetch_array($result);
                                                ?>
                                                  <?php echo '<img src="images/faculty_pic/'.$row["image"].'" class="img-responsive" alt="Responsive image " style="width:250px; height: 215px">';
                                                  ?>
                                              </div>
                                              <div class="col-md-6 col-sm-6">
                                                  Here, you can update your academic and research related information for IIPS website.                                        </div>
                                          </div>
                                          <div class="col-md-5 col-sm-3">
                                              <div class="col-md-6">
                                                  <!--<li id="link-style"><a href="over.php">Overview</a></li>-->
                                                  <li id="link-style"><a href="myprofile.php">Profile</a></li>
                                                  <!--<li id="link-style"><a href="dompdf/pdf1.php">Pdf Report</a></li>-->
                                                  <li id="link-style"><a href="../../logout.php">Logout</a></li>
                                              </div>
                                              <div class="col-md-6">
                                                  <li id="link-style"><a href="research_pub.php">Research Publication and Academic Contribution</a></li>
                                                  <li id="link-style"><a href="cocurricular.php">Co-curricular Extension, Professional Development</a></li>
                                              </div>
                                          </div>
                                      </div>        
                                    </ul>
                                </li>
                                <?php 
                                   } 
                                ?>
                            </ul>

                            <div class="wrapper visible-xs">
                              <h3 id="i38">Information for...</h3>
                              <ul class="nav navbar-nav">
                                  <li><a href="https://davv.mponline.gov.in/Portal/Services/DAVV/SIS/Main_Page.aspx" target="_blank">Students</a></li>
                                  <li><a href="#FacultyModal" data-toggle="modal">Faculty &amp; Staff</a></li>
                                  <li><a href="alumni_reg.php">Alumni</a></li>
                              </ul>
                            </div>
                        </div>
                    </div><!--Visible Content-->
                </div>
              </nav>
          </div><!-- container-fluid -->
          
    </div><!-- row end-->
   <!-- </div>--><!--Container Close--><!--Main navbar close-->
   <br>
   <div id="outerDiv">
    <!-- modal -->
    <div class="modal fade" id="FacultyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sign-In</h4>
                </div>
                <div class="modal-body ">
                    <form class="form-horizontal" role="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" id="signUp">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">User ID</label>
                        <div class="col-lg-8">
                            <input type="text" required="required" class="form-control" placeholder="User ID" name="username" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" required="required" name="password" placeholder="Password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <button type="submit" name="signIn1" class="btn btn-large btn-primary">OK</button>
                            <button type="button" class="btn btn-large btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
