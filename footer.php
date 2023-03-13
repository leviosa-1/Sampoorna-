<footer id="site-footer">
      <div class="container" id="i13">
        <div class="row">
          <div class="col-md-5">
            <a href="index.php"><img src="images/iips_logo2.png" id="logo"></a><br><br><br>
           <!-- <a href="https://www.facebook.com/expressions12/?ref=br_rs" target="_blank"><span class="fa fa-facebook fa-15x faa-tada animated-hover faa-fast" id="i14"></span></a>
            <a href="https://twitter.com/iipsdavv" target="_blank"><span class="fa fa-twitter fa-15x faa-tada animated-hover faa-fast icon-color"></span></a>
            <a href="https://www.linkedin.com/vsearch/f?type=all&keywords=iips+davv&orig=GLHD&rsid=&pageKey=oz-winner&trkInfo=tarId%3A1467819142685&search=Search" target="_blank"><span class="fa fa-linkedin fa-15x faa-tada animated-hover faa-fast icon-color"></span></a>
            <a href="https://plus.google.com/u/0/110977532784004536112/videos" target="_blank"><span class="fa fa-google-plus fa-15x faa-tada animated-hover faa-fast icon-color"></span></a>
            <a href="https://www.instagram.com/explore/locations/275894915/" target="_blank"><span class="fa fa-instagram fa-15x faa-tada animated-hover faa-fast icon-color"></span></a>-->
            <br><br>
            
          </div>
          <div class="col-md-7">
              <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <ul class="nav">
                    <h4>Admission</h4>
                    <li><a href="fee_structure.php" >Fees Structure</a></li>
                    <li><a href="https://www.dauniv.ac.in/cet2021/" target="_blank">CET</a></li>
                    
                  </ul>
                </div>
                          
                <!--<div class="col-md-3 col-sm-3 col-xs-6"> 
                  <ul class="nav">
                    <h4 class="visible-xs visible-sm">RTI</h4>
                    <h4 class="visible-md visible-lg" style="padding-left:10%">RTI</h4>
                    <li><a href="press_release.php" >Press Release</a></li>
                    <li><a href="http://www.dauniv.ac.in/DAVV_Ordinance.php" >Ordinances</a></li>
                    <li><a href="iqac.php" >IQAC</a></li>
                    <li><a href="recruitments.php" >Recruitments</a></li>
                    <li><a href="greviances.php" >Greviances</a></li>
                  </ul>
                </div>-->

                <div class="col-md-3 col-sm-3 col-xs-6">
                  <ul class="nav">
                    <h4>Miscellaneous</h4>
                    <li><a href="https://www.dauniv.ac.in/davv-ordinance" target="_blank" >Ordinances</a></li>
                    <!--<li><a href="iqac.php" >IQAC</a></li>-->
                     <li><a href="grievance.php" >Grievance </a></li>
                    <li><a href="faculty_profile.php" >Faculty Profile</a></li>
                    <li><a href="staff_profile.php" >Staff Profile</a></li>
                    <!--<li><a href="under_construction.php" >Student Verification</a></li>-->
                    <li><a href="video_channel.php" >Video Channel</a></li>
                    <li><a href="nss.php" >NSS</a></li>
                  </ul>                
                </div>
                            
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <ul class="nav">
                    <h4>Downloads</h4>
                    <li><a href="/images/academics/academic calendar 19-20.pdf" target= "_blank" >Academic Calendar</a></li>
                    <li><a href="syllabus.php" >Syllabus</a></li>
                    <!--<li><a href="results.php" >Results </a></li>
                    <li><a href="downloads.php" >Faculty CV</a></li>-->
                  </ul>
                </div>
                
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                &copy; 2021 International Institute of Professional Studies
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-2 col-xs-6">
                <a href="developers.php" style="color:#AEAEAE;">About Developers</a>
            </div>          
            <div class="col-xs-6 visible-xs">
              <a class="back-to-top" href=" "><i class="glyphicon glyphicon-menu-up" style="color:white;font-size:160%;float:right;"></i> </a>
            </div>
        </div>
      </div>
    </footer>

    

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
     <script>
      $(function() {
        window.prettyPrint && prettyPrint()
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
          e.stopPropagation()
        })
      });
     
    </script>
    
    <script >
                                        $("#searchForm").submit(function(){
                                                var searchtext ='https://www.google.co.in/webhp?hl=en#hl=en&q=site:iips.edu.in '+ $("#txtSearch").val();
                                                
                                                $("#searchForm").attr('action',searchtext);
                                          }                                        
                                         );
                                         $("#searchFormResponsive").submit(function(){
                                                var searchtext ='https://www.google.co.in/webhp?hl=en#hl=en&q=site:iips.edu.in '+ $("#txtSearchResponsive").val();
                                                
                                                $("#searchFormResponsive").attr('action',searchtext);
                                          }                                        
                                         );
      </script>
    
     <script src="js/jquery.colorbox.js"></script>
     <script>
            $(document).ready(function(){
                             
                $(".event_tourista_group2").colorbox({rel:'event_tourista_group2', transition:"fade",width:"75%", height:"75%"});
                $(".event_maya_group2").colorbox({rel:'event_maya_group2', transition:"fade",width:"75%", height:"75%"});
                $(".event_ms2_group2").colorbox({rel:'event_ms2_group2', transition:"fade",width:"75%", height:"75%"});
                $(".mca_ai_group2").colorbox({rel:'mca_ai_group2', transition:"fade",width:"75%", height:"75%"});
                $(".mtech_ai_group2").colorbox({rel:'mtech_ai_group2', transition:"fade",width:"75%", height:"75%"});
                $(".placement_media_group2").colorbox({rel:'placement_media_group2', transition:"fade",width:"75%", height:"75%"});
                $(".event_xpression_group2").colorbox({rel:'event_xpression_group2', transition:"fade",width:"75%", height:"75%"});
            });
    </script>   
   </div> <!--End of id = OuterDiv of header-->    
  </body>
</html>