<?php
include "../../controllers/login_controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
  rel="stylesheet"
/>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"
></script>

  <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

           <img src="../../public/IMG/LOGO.png" class="logo" alt="Logo" />
            <?php if ($error): ?>
       <div class="alert alert-danger  "><?php echo $error; ?>
    </div>
     <?php endif; ?>

        <form method="POST"> 
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="typeEmailX-2" class="form-control form-control-lg"name="employee_id" />
              <label class="form-label" for="typeEmailX-2">Employee_id</label>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>
            <div class="form-check d-flex justify-content-start mb-4">
              <a class="form-check-label forget" for="form1Example3"> forget password ? </label>
            </div>

            <button type="submit" class="btn btn-light">LogIn</button>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
