<?php include "header.php" ?>
 

 
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">
    <div class="section-title" id="solar">
        
        <p>Solars</p>
      </div>
 
      
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200" style="word-wrap: break-word;">
       
        <div class="col-lg-4 col-md-6 portfolio-item filter-sd" style="margin-top:5%;">

        <?php
        include("../admin/dbconnection.php"); 
        include("../admin/projectActions.php"); 
                              $result = selectalldata("solar_images"); 
                              $cnt=1;
                              while($data = mysqli_fetch_array($result)) 
                              { 
                                $imageURL = '../admin/uploads/solars/'.$data["image"];
                                ?>

        <div class="portfolio-wrap">
          <img id="portimg" width="50px" height="50px" src="<?php echo $imageURL; ?>" alt="" class="img-fluid">
          <div class="portfolio-info">
            <h4>SPD</h4>
            <!-- <p style=" word-wrap: break-word; word-break: break-all;">  </p> -->
            <div class="portfolio-links">
            <a  href="" data-gallery="portfolioGallery"  class="portfolio-lightbox preview-link" ><i class="bx bx-plus"></i></a>
          </div>
          </div>
        </div>

        <?php $cnt=$cnt+1; } ?>

      <?php  $images =getRows();
        
       if(!empty($images)){ $i=0; 
           foreach($images as $row){ $i++; 
               $defaultImage = !empty($row['default_image'])?'<img src="uploads/solars/'.$row['default_image'].'" alt="" width="70" />':''; 
               
               echo  $defaultImage;
           
           }
        }
      ?>
        </div>
                 
      </div>
 
    </div>
  </section><!-- End Portfolio Section -->
 
 
 

 
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6200bd44b9e4e21181bdc67e/1fr9e6lea';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<?php include "footer.php" ?>