<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- my css -->
  <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">

  <title><?= $title; ?></title>

  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&family=Orbitron:wght@400..900&display=swap" rel="stylesheet">


  <!-- css bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <?= $this->include('layout/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <!-- js bootsrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- my js -->
  <script>
    function previewImg() {
      const sampul = document.querySelector('#sampul');
      const imgPreview = document.querySelector('.img-preview');
  
      const fileSampul = new FileReader();
      fileSampul.readAsDataURL(sampul.files[0]);
  
      fileSampul.onload = function(e){
        imgPreview.src = e.target.result;
      }
    }
  </script>
</body>

</html>