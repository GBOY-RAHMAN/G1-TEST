
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="output.css">
  <!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<style>
  #ex1{
    background:"none !important"
  }
</style>
</head>
<body class="min-h-screen flex flex-col">

<?php include_once 'nav.inc.php' ?>

<main class="flex overflow-auto">
  <div class="h-[100vh] ">
  <?php include_once 'sidebar.php' ?>
  </div>
  <!-- Sidebar -->
  
  <div class="">
      <?php include_once 'dasboarddata.php' ?>
    </div>

  
</main>

<?php include_once 'footer.php' ?>

<script src="../javascript/script.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/891c2fc307.js" crossorigin="anonymous"></script>
</body>
</html>
