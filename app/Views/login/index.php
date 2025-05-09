<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<html lang="en">
<!-- <link rel="stylesheet" href="/css/login.css"> -->
<link rel="stylesheet" href="<?= base_url(); ?>/css/login.css">
<!-- <link rel="stylesheet" href="/css/signin.css"> -->

<head>

  <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>


  <!-- Custom styles for this template -->
  <!-- <link href="signin.css" rel="stylesheet"> -->
</head>

<body class="text-center">

  <main class="form-signin w-100 m-auto">

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('error'); ?>
      </div>
    <?php endif ?>

    <form method="post" action="<?= base_url(); ?>/login/process">
      <?= csrf_field(); ?>
      <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <!-- <h1 class="h3 mb-3 fw-normal">Login</h1> -->
      <h1 class="h3 mb-3 fw-normal">Toko Alisa</h1>

      <div class="form-floating">
        <input type="text" name="username" class="form-control" id="floatingInput" placeholder=" ">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder=" ">
        <label for="floatingPassword">Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
      <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p> -->
    </form>
  </main>



</body>



<?= $this->endSection(); ?>