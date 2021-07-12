<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="/Inventory/css/style.css">
    <title>Register</title>
  </head>
  <body>
  <div class="container">
        <div class="row w-100 main_div d-flex justify-content-center align-items-center">
            <div class="col-12 col-lg-6 col-md-8 col-xxl-5">
                <div class="card py-3 px-2">
                    <div class="data">
                        <div class="row">
                        <div class="row justify-content-center align-items-center d-flex">
                            <a href="#" class="head-logo">
                        <i class="las la-hand-holding-heart icon"></i>Do<span>N</span>or</a>
                        </div>
                            <div class="col-6 my-2 mx-auto">
                                <span class="main-heading">Registration Form</span>
                            </div>
                        </div>
        <form action="login.php" method="post" enctype="multi/form-data">
                <div class="row jumbotron">
                    <div class="col-sm-6 form-group">
                    
                        <input type="text" class="form-control" name="fname" id="name-f" placeholder="First Name." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="text" class="form-control" name="lname" id="name-l" placeholder="Last Name." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="address" class="form-control" name="Locality" id="address-1" placeholder="City" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="tel" name="phone" class="form-control" id="tel" placeholder="Contact Number." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <div class="input-group mb-3">
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Country...</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 form-group">
                    <div class="input-group mb-3">
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Gender...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="unspesified">Unspecified</option>
                            </select>
                        </div>
                    </div>
            
                    <div class="col-sm-6 form-group">
                        <input type="Password" name="password" class="form-control" id="password" placeholder="Password." required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input type="Password" name="cpassword" class="form-control" id="cpasswprd" placeholder="Re-enter Password." required>
                    </div>

                    <?php if (isset($_GET['error'])): ?>
                        <p><?php echo $_GET['error']; ?></p>
                    <?php endif ?>
                    <div class="col-sm-6 form-group justify-content-center align-items-center" required>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="my_image">
                            <!-- <input type="upload" name="upload" value="Upload"> -->
                        </form>
                    </div>

                    <div class="col-md-8 col-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="" required>
                                    <label for="" class="form-check-label">&nbsp; I accept all terms and conditions</label>
                                </div>
                            </div>

                    <div class="col-sm-12 register-btn">
                        <button type="reset" class="btn  btn-1 btn-block btn-primary btn-lg">Reset</button>
                        <button type="submit" name="submit" class="btn btn-2 btn-block btn-primary btn-lg">Submit</button>
                        <button type="back" class="btn btn-block btn-primary btn-lg">Back</button>
                    </div>
                    
                </div>
                </form>
            
                </div>

</div>
</div>
</div>
</div>

<?php
    include('../partials/footer.php');

?>