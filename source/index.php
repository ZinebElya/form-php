<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://kit.fontawesome.com/f18291f973.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <title>Register</title>
</head>

<body id="bg2">

  <nav class="navbar navbar-expand-md p-0 navbar-light bg-white shadow sticky-top">
    <div class="container-fluid ">
      <a class="navbar-brand mx-0" href="#"> The Dream</a>
      <a class="nav-link text-warning" href="#">Login</a>
    </div>
  </nav>

  <div class="container my-5">

    <h1 class="bg-warning text-white text-center mb-5"> Register</h1>

    <div class="border rounded border-warning p-5">
      <form action="submit_form.php" method="POST">
        <div class="form-row">
          <div class="form-group col-12">
            <label for="name" class="text-warning font-weight-bold">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Your name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-12">
            <label for="email" class="text-warning font-weight-bold">Email</label>
            <input type="email" class="form-control" name="email" placeholder="email@exemple.com">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-12">
            <label for="password" class="text-warning font-weight-bold">Password</label>
            <input type="password" class="form-control" name="password" placeholder="****">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-12">
            <label for="confirm_password" class="text-warning font-weight-bold"> Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="****">
          </div>
        </div>
        <button type="submit" class="btn btn-warning">Submit</button>
      </form>
    </div>
  </div>
</body>

</html>