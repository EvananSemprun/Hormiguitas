<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = '¡Dirección guardada!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Direccion</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Tu dirección</h3>
      <input type="text" class="box" placeholder="Número de piso" required maxlength="50" name="flat">
      <input type="text" class="box" placeholder="Número del edificio" required maxlength="50" name="building">
      <input type="text" class="box" placeholder="Nombre de la zona" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="Nombre de la parroquia" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="Nombre de la ciudad" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="Nombre del Estado" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="Nombre del pais" required maxlength="50" name="country">
      <input type="number" class="box" placeholder="Código postal" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="submit" value="Guardar dirección" name="submit" class="btn">
   </form>

</section>










<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>