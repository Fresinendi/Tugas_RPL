<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>courses</title>

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
   
  <?php include 'components/user_header.php'; ?>

    <section class="courses">
      <h1 class="heading">Buku Gratis</h1>

      <div class="box-container">

<?php
   // Mengambil semua kursus tanpa filter status
   $select_courses = $conn->prepare("SELECT * FROM `playlist` ORDER BY date DESC");
   $select_courses->execute();
   if($select_courses->rowCount() > 0){
      while($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)){
         $course_id = $fetch_course['id'];

         $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
         $select_tutor->execute([$fetch_course['tutor_id']]);
         $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
?>
   <div class="box">
   <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
   <div>
   <h3 class="title"><?= $fetch_course['title']; ?></h3>
         <span><?= $fetch_course['date']; ?></span>
      </div>

    
   <a href="buku.php?get_id=<?= $course_id; ?>" class="inline-btn">lihat buku</a>
</div>
<?php
      }
   }else{
      echo '<p class="empty">belum ada buku yang ditambah</p>';
   }
?>

</div>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
  </body>
</html>