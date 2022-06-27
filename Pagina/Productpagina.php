<?php
include "header.php";
$lamp = $_GET['lamp'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="productoverzichtpagina">

        <input type="submit"  onclick="localStorage.setItem()" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
               value="voeg toe aan winkelwagen"

            <?php
            $aantal =1;
            if ($lamp !='') {
                $_SESSION['cart'][] = array('id' => $lamp, 'aantal' => $aantal);
            }




                   ?>/>
        <div class="productwinkelmandtoevoeg">





        </div>
        <div class="productoverzicht">
            <?php
                $Lampenfunctie = Lamptonen($conn, $lamp);
            ?>










    </div>
    </div>
</body>
</html>
<script>
    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>