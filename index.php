<?php 
    include('partials/siteHeader.php');
?>
<?php
session_start();

include 'partials/db_conn.php';
?>

    <nav class="navbar navbar-expand-lg navbar-info navbar-light" style="background-color:#ccc;">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
      <img src="images/logo1.png" alt="..." width="50" height="50">
    </a>
    
    <a class="navbar-brand" href="#"><strong style="color:#ff6702 !important;"><em><i>CAREHUB</i></em></strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-dark ul_nav">
        <li class="nav-item">
          <a class="nav-link active n-btn" style="color:black !important;" aria-current="page" href="#"><b>Home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link n-btn" style="color:black !important;" href="#about"><b>About us</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link n-btn" style="color:black !important;" href="#gallery"><b>Gallery</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link n-btn" style="color:black !important;" href="#team"><b>Team</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link n-btn" style="color:black !important;" href="#contact"><b>Contact</b></a>
        </li>
</ul>
<ul class="navbar-nav me-end mb-2 mb-lg-0 ul_nav">
          <li class="nav-item">
            <a class="nav-link n-btn" style="color:black !important;" href="#" data-bs-toggle="modal" data-bs-target="#insertModal" id="change_pass"><b>DONATION</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link n-btn" style="color:black !important;" href="/Inventory/php/login.php"><b>ADMIN</b></a>
          </li>

      </ul>
    </div>
  </div>
</nav>

<div class="modal fade " id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content text-light bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel"><strong>ADD-DONATION</strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                      
                            <form action="/Inventory/php/donation_Table.php" method="POST">
                                <fieldset>
                                    <input type="hidden" name="snoEdit" id="snoEdit">
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your First Name*" class="form-control" id="f_name" name="f_name" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Last Name*" name="l_name" id="l_name" class="form-control" aria-describedby="nameHelp" required>
                                        </div>
                                       
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="email" placeholder="Your Email*" maxlength="40" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Country" name="country" class="form-control" id="country" name="country" aria-describedby="nameHelp" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your City" name="city" id="city" class="form-control" aria-describedby="nameHelp">
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Address" maxlength="100" class="form-control" id="address" name="address" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Info" placeholder="Select Donation Info*" name="d_info" id="d_info" required>
                                            <datalist id="Donation_Info">
                                                <option value="For Children Eduction">
                                                <option value="For Food">
                                        </div>
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Type" placeholder="Select Donation Type*" name="d_type" id="d_type" required>
                                            <datalist id="Donation_Type">
                                                <option value="Cash">
                                                <option value="PayPal">
                                                <option value="Easy Pasia">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Enter Phone No*" minlength="11" maxlength="18" class="form-control" id="phone" name="phone" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" placeholder=" Amount*" maxlength="40" class="form-control" id="amount" name="amount" required>
                                        </div>
                                    </div>

                                    <br>
                                    <HR>
                                    <div class="text-center">
                                        <button type="submit" NAME="DForm_Submit" class="btn btn-primary">ADD</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    <div class="card header-card">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner text-dark">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="images/slide1.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="color:black !important;"><b>Giving Is Not Just About Making A Donation. It's About Making A Difference.</b></h1>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/slide2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 style="color:black !important;"><b>Kindness Is A Gift Everyone Can Afford To Give.</b></h1>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="images/slide3.png" class="d-block w-100" alt="..." >
      <div class="carousel-caption d-none d-md-block">
        <h1 style="color:black !important;"><b>Be The Reason Someone Belives In The Goodness Of People.</b></h1>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      
    </div>

    <!-- about -->
<section class="main-heading my-3 pt-3">
    <div class="text-center">
      <h1 class="display-4 fw-bold" id="about">About Us</h1>
      <hr class="w-25 mx-auto"/>
    </div>
    <div class="container">
      <div class="row my-1">
        <div class="col-lg-4 col-md-4 col-xxl-4 col-4">
          <figure>
            <img src="images/logo.png" alt="..." class="img-fluid rounded-start rounded-3 w-80">
          </figure>
        </div>
        
        <div class="col-lg-8 col-md-8 col-xxl-8 justify-content-center my-5">
          <div class="d-flex justify-content-start fs-1"><b>What We Do?</b></div>
          <p>Searching where help is needed, Promoting a culture of <strong>Care and sharing</strong>.
        <br>
        <strong>Blood Donation:</strong> DrivesActively raising awareness of the need to visit local public blood donation banks and donating to the blood stocks being rapidly depleted.<br>
        <strong>Support for Local Poor Children:</strong> CampaignVolunteers take children from at-risk homes to theaters, museums, art galleries, etc. and help them engage in entertaining and cultural activities.<br>
        <strong>Local Cultural Heritage Protection Campaign:</strong> Volunteers regularly participate in projects for restoring, maintaining and renovating local cultural properties.<br>
        <strong>Disability Awareness Campaign:</strong> Volunteers participate in visual and physical impairment programs to get hands-on experience with these disabilities, and visit local social enterprises hiring employees with disabilities to help them with management and operations.
</p>
        </div>
      </div>
    </div>

  </section>

    <!-- !about -->
  <section class="main-heading my-3 pt-3">
    <div class="text-center">
        <h1 class="display-4 fw-bold" id="gallery">Gallery</h1>
        <hr class="w-25 mx-auto"/>
    </div>
    <div class="container">
      <div class="row gy-2">
      <div class="flex-wrap text-center" data-aos="fade-up">
          <?php
          $query = "SELECT * FROM `Gallery` ORDER BY `SID` DESC";
          $res = mysqli_query($Connect_DB,  $query);

          if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {
              echo '<img src="/Inventory/gallery/' . $images['image_url'] . '" class="card-img-top pic_size_2 m-2" style="height:200px; width:273px;" alt="...">';
            }
          } ?>
        </div>
      </div>
    </div>

  </section>
 
  <section class="our-team my-3 pt-3" style="background-image: url('images/t_bg.jpg');  background-attachment: fixed;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 fw-bold" id="team"><i>Our Team</i></h1>
                    </div>
                </div>
                <hr class="mb-5 mt-4">
                <div class="row">
                    <div class="col-md-4 col-10 col-xxl-4 mx-auto">
                        <div class="member">
                            <img src="images/team1.jpeg" class="img-fluid" alt="..." />
                            <div class="member-info">
                                <div class="member-detail">
                                    <h4>CHENHUA</h4>
                                    <span>Web Designer</span>
                                </div>
                                <div class="social">
                                    <a href="#" aria-label="Facebook"><i class="lab la-facebook-f"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="lab la-twitter"></i></a>
                                    <a href="#" aria-label="linkedin"><i class="lab la-linkedin-in"></i></a>
                                    <a href="#" aria-label="instagram"><i class="lab la-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-10 col-xxl-4 mx-auto">
                        <div class="member">
                            <img src="images/team2.jpeg" class="img-fluid" alt="" />
                            <div class="member-info">
                                <div class="member-detail">
                                    <h4>MEI ZHEN</h4>
                                    <span>Senior dev</span>
                                </div>
                                <div class="social">
                                    <a href="#" aria-label="Facebook"><i class="lab la-facebook-f"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="lab la-twitter"></i></a>
                                    <a href="#" aria-label="linkedin"><i class="lab la-linkedin-in"></i></a>
                                    <a href="#" aria-label="instagram"><i class="lab la-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-10 col-xxl-4 mx-auto">
                        <div class="member">
                            <img src="images/team3.png" class="img-fluid" alt="" />
                            <div class="member-info">
                                <div class="member-detail">
                                    <h4>SOPHIA</h4>
                                    <span>Graphic designer</span>
                                </div>
                                <div class="social">
                                    <a href="#" aria-label="Facebook"><i class="lab la-facebook-f"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="lab la-twitter"></i></a>
                                    <a href="#" aria-label="linkedin"><i class="lab la-linkedin-in"></i></a>
                                    <a href="#" aria-label="instagram"><i class="lab la-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </section>


        <!-- Contact us -->
        <section class="main-heading my-5 pt-5">
    <div class="text-center">
        <h1 class="display-4 fw-bold" id="contact">Contact Us</h1>
        <hr class="w-25 mx-auto">
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-center">
        <div class="col-lg-4 col-md-4 col-xxl-4 col-4">
          <figure>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108838.021199699!2d74.3556470744624!3d31.51899161312403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391908dd6138ade3%3A0xa6cc469044e1fbc1!2sLahore%20Garrison%20University.!5e0!3m2!1sen!2s!4v1622717424468!5m2!1sen!2s" 
            allowfullscreen="" loading="lazy"></iframe>
         
          </figure>
        </div>
          <div class="col-lg-6 col-md-6 col-xxl-6 mx-3">
            <div class="col-xxl-10 col-10 col-md-8 mx-auto">
            <form action="/Inventory/php/contact.php" method="POST">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email*" id="_email" name="_email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" list="datalistOptions" id="_country" name="_country" placeholder="Enter Your Country...">
                                <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                                </datalist>
                            </div>
                            <div class="mb-3">
                            <textarea class="form-control" id="_msg" name="_msg" rows="3" placeholder="Type Your Msg here..."></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="form_submit" class="btn btn-info">Submit</button>
                    </div>
                    </form>
            </div>
            </div>
        </div>
    </div>

</section>

<!-- Footer -->
<footer class="mainfooter" >
  <div class="footer-middle">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-3 col-sm-6">
        <div class="footer-pad">
          <h3><b>Plateform</b></h3>
          <ul class="list-unstyled">
            <li><a href="#">Plateform Login</a></li>
            <li><a href="#">Plateform Status</a></li>
            <li><a href="#">News and Updates</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="footer-pad">
          <h3><b>Company</b></h3>
          <ul class="list-unstyled">
            <li><a href="#">Carees</a></li>
            <li><a href="#">Reviews</a></li>
            <li><a href="#">COVID-19</a></li>
            <li><a href="#">Resources</a></li>
            
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <!--Column1-->
        <div class="footer-pad">
          <h3><b>Contact Us</b></h3>
          <ul class="list-unstyled">
            <li><a href="#">Contact Number</a></li>
            <li><a href="#">+92 339194349</a></li>
            <li><a href="#">LGU.edu@gmail.com</a></li>
            <li><a href="#">DHA phase#6 Lahore</a></li>
          </ul>
        </div>
      </div>
    	<div class="col-md-3">
    		<h3 class="px-4"><b>Follow Us</b></h3>
            <ul class="social-media social-circle d-flex justify-content-start">
             <li><a href="#" aria-label="Facebook" class="fb fs-2" ><i class="lab la-facebook-square"></i></a></li>
             <li><a href="#" aria-label="linkedin" class="linkedin fs-2"><i class="lab la-linkedin"></i></a></li>
             <li><a href="#" aria-label="instagram" class="insta fs-2"><i class="lab la-instagram"></i></a></li>
             <li><a href="#" aria-label="instagram" class="git fs-2"><i class="lab la-github"></i></a></li>
            </ul>				
		</div>
    </div>
	<div class="row">
		<div class="col-md-12 copy">
			<p class="text-center">&copy; Copyright 2021 - CAREHUB. All rights reserved.</p>
		</div>
	</div>


  </div>
  </div>
</footer>
        <!-- ---------------------------- -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
    <script src="/Inventory/JS/typer.js"></script>
  </body>
</html>