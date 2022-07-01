
<?php include "header.php" ?>

<?php 
           include("../admin/dbconnection.php"); 
           
           $solar_id=$_GET['solar_id'];
           $select="SELECT solars.id,solars.title,solars.description, solar_images.image FROM solars INNER JOIN solar_images ON 
           solars.id=solar_images.solar_id WHERE solar_id=$solar_id"; 
         $results=mysqli_query($GLOBALS['con'],$select); 
        
        
          ?>



<section id="hero">
    <div id="heroCarousel" data-bs-interval="2000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">
  <?php    $cnt=1;  
    while($row = mysqli_fetch_array($results)) 
{ 
  $solar_id = $row["id"];
  $imageURL = '../admin/uploads/solars/'.$row["image"];


?>
        <!-- Slide 1 -->
        <div class="carousel-item <?php 
                            if($cnt==1){
                              echo "active";  
                            }
                            else{
                                echo " ";
                            }
                        ?>" style="background-image: url('<?php echo $imageURL; ?>')">
          <div class="carousel-container">

          </div>
        </div>
 
      <?php $cnt=$cnt+1;  } ?> 
       
      

       

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
        <p>SOLAR PRODUCTS</p>
       
      </div>
     
<div class="row" >
      
        
  <div class="col-lg-12 " id="philips" >



<?php 
 $qresult=mysqli_query($GLOBALS['con'],$select); 

$data = mysqli_fetch_array($qresult) ;

$solar_imageURL1 = '../admin/uploads/solars/'.$data["image"];
?>
 
  <div class="card mb-3 product-cards">
    <div class="row g-0 h-100" >
      <div class="col-md-12 d-flex flex-column">
        <div class="card-body">
        <img class="light-logos" src="<?php echo $solar_imageURL1; ?>"  class="img-fluid rounded-start" alt="..." >
          <h5 class="card-title" ><?php  echo $data['title']; ?></h5>
          <p id="des" class="card-text"><?php  echo substr( $data['description'], 0, 400);?> </p>
        </div>
        <div class="p-2">
          <p class="card-text text-end"><small class="text-muted"></small></p>
        </div>
      </div>
    </div>
  </div>






  </div>
  
  
  </div>
  
  
       
  
        
   
      </div>
    </div>
  </div>
  </div>
  
      </div>

    </div>
  </section>

  


  <?php include "footer.php" ?>
 

