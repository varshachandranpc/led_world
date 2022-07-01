
<?php include "header.php" ?>


  
  <section id="hero-secondary" class="carosal-section p-0">
    <div id="heroCarousel" data-bs-interval="3000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div  class="carousel-item active" style="background-image: url(../images/lit.jpg)" >
          <div class="carousel-container">
            
          </div>
        </div>


      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  

  
  <section id="light-clients" >
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <p>Lights</p>
       
      </div>
     
      <div class="row"  >
      <?php

include("../admin/dbconnection.php"); 
include("../admin/projectActions.php"); 
$select="SELECT * FROM products where type= 1"; 
$result=mysqli_query($GLOBALS['con'],$select); 
  
$cnt=1;
while($data = mysqli_fetch_array($result)) 
{ 
  $imageURL = '../admin/uploads/products_images/'.$data["image"];
  $fileURL = '../admin/uploads/brochure/'.$data["brochure"];


?>

       
      
<div class="col-lg-6 " id="light" >
  <div class="card mb-3 product-cards" id="">
    <div class="row g-0 h-100" >
      <div class="col-md-12 h-100 d-flex flex-column">
        <div class="card-body">
          <img class="light-logos"  src="<?php echo $imageURL; ?>"   alt="...">
          <h5 class="card-title" ><?php echo $data['title'];?></h5>
          <p id="des" class="card-text"> <?php echo substr( $data['description'], 0, 400);?></p>
        </div>
        <div class="p-2">
          <p class="card-text text-end"> <a id="adown" href="<?php echo $fileURL; ?>"  class="btn-download" target="_blank"><i class="bi bi-file-earmark-arrow-down-fill"></i>Download Brochure</a><small class="text-muted"></small></p>
        </div>
      </div>
    </div>
  </div>
 </div>
  
 <?php $cnt=$cnt+1; }?>
  
  
 
  
  
  
  
  
   
      </div>
    </div>
  </div>
  </div>
  
      </div>

    </div>
  </section>


  <?php include "footer.php" ?>