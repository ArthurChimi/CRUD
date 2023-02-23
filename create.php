<?php
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Validate name
$input_name = trim($_POST["name"]);
if(empty($input_name)){
$name_err = "Please enter a name.";
} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, 
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
$name_err = "Please enter a valid name.";
} else{
$name = $input_name;
}
// Validate address
$input_address = trim($_POST["address"]);
if(empty($input_address)){
$address_err = "Please enter an address."; 
} else{
$address = $input_address;
}
// Validate salary
$input_salary = trim($_POST["salary"]);
if(empty($input_salary)){
$salary_err = "Please enter the salary amount."; 
} elseif(!ctype_digit($input_salary)){
$salary_err = "Please enter a positive integer value.";
} else{
$salary = $input_salary;
}
// Check input errors before inserting in database
if(empty($name_err) && empty($address_err) && empty($salary_err)){
// Prepare an insert statement
$sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, 
?)";
if($stmt = $mysqli->prepare($sql)){
// Bind variables to the prepared statement as parameters
$stmt->bind_param("sss", $param_name, $param_address, $param_salary);
// Set parameters
$param_name = $name;
$param_address = $address;
$param_salary = $salary;
// Attempt to execute the prepared statement
if($stmt->execute()){
// Records created successfully. Redirect to landing page
header("location: index.php");
exit();
} else{
echo "Oops! Something went wrong. Please try again later.";
}
}
// Close statement
$stmt->close();
}
// Close connection
$mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer Un Enregistrement</title>
<meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.wrapper{
width: 600px;
margin: 0 auto;
}
</style>
</head>
<body>
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">CRUD

                  </span>
                </a>
              </div><!-- End Logo -->
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<h2 class="mt-5">Créer Un Enregistrement</h2>
<p>Remplissez ce formulaire et soumettez-le pour ajouter un employé(e) a la base de donnée.</p>
<form action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group">
<label>Nom</label>
<input type="text" name="name" class="form-control 
<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo
$name; ?>">
<span class="invalid-feedback"><?php echo
$name_err;?></span>
</div>
<div class="form-group">
<label>Addresse</label>
<textarea name="address" class="form-control <?php
echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
<span class="invalid-feedback"><?php echo
$address_err;?></span>
</div>
<div class="form-group">
<label>Salaire</label>
<input type="text" name="salary" class="formcontrol <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php
echo $salary; ?>">
<span class="invalid-feedback"><?php echo
$salary_err;?></span>
</div>
<input type="submit" class="btn btn-primary"
value="Soumettre">
<a href="index.php" class="btn btn-danger">Supprimer</a>
</form>
<div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <strong> <a> Arthur Chimi</a></stong>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</div>
</div>
</div>
</div>
</body>
</html>
