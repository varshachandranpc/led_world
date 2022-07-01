
<?php include "header.php" ?>
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
    <div class="section-title" id="solar">
        
        <p>Solar PRODUCTS</p>
      </div>

      
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200" style="word-wrap: break-word;">
      
      

      <?php 
           include("../admin/dbconnection.php"); 
           
           $select="SELECT solars.id,solars.title, solar_images.image FROM solars INNER JOIN solar_images ON solars.id=solar_images.solar_id"; 
            $results=mysqli_query($GLOBALS['con'],$select); 
  
            $cnt=1;  
    while($row = mysqli_fetch_array($results)) 
{ 
  $solar_id = $row["id"];
  $imageURL = '../admin/uploads/solars/'.$row["image"];


?>




     
        
        <div class="col-lg-4 col-md-6 portfolio-item filter-sd" style="margin-top:5%;">
        <div class="portfolio-wrap">
          <img id="portimg" src="<?php echo $imageURL; ?>" alt="" class="img-fluid">
          <div class="portfolio-info">
            <h4><?php echo $row["title"]; ?></h4>
            <!-- <p style=" word-wrap: break-word; word-break: break-all;"> Test </p> -->
            <div class="portfolio-links">
            <a   href='solars.php?solar_id=<?php echo $solar_id ?>' data-gallery="portfolioGallery"  class="" ><i class="bx bx-plus"></i></a>
          </div>
          </div>
        </div>
        </div>
        
  
        
        <?php $cnt=$cnt+1;  } ?>  
        
      
                 
      </div>

    </div>
  </section><!-- End Portfolio Section -->
  <?php include "footer.php" ?>