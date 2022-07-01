<?php include "header.php" ?>
	<!--================Header Menu Area =================-->
	<!-- ======= Hero Section ======= -->
	<section id="contact" class="contact section-bg">
		<div class="container" data-aos="fade-up">
			<div class="section-title" style="margin-bottom: 1em;margin-top:4em">
				<h3><span>About Us</span></h3>

			</div>
		</div>
	</section>
	<section id="about1" class="about1">
		<div class="container-fluid">

			<div class="row">

				<div class="col-lg-5 align-items-stretch video-box" style='background-image: url("../images/led9.webp");'>
					<a href="../images/videos/ledworld v1.mp4" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
				</div>

				<div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch">

					<div class="content">
						<h3><strong>Led World</strong></h3>
						<p class="fst-italic" style="text-align: justify;">
							LED World was established in 2016 at PAYYANUR Kerala, India by a NRE Mohamed Jamaluddin STP who is an Electrical Engineer by Profession. He established LED WORLD, A Modern Lighting Showroom to bring international standard Quality lighting to the region. LED World showcases massive lighting Varieties which impacts modern interior lighting designs.
						</p>
						<p class="fst-italic" style="text-align: justify;">
							Our Vast variety lighting demonstrate how a carefully selected lighting can bring aesthetic and harmony to the feel of a space crafted to bring vibrant life to a living space.
						</p>
						<p class="fst-italic" style="text-align: justify;">
							Our carefully selected lighting fixtures can transform any normal room to vibrant to any room if you have a perfect product and interiors in place
							We at LED World provide the customers with extensive range of designer. Decorative and Architectural lighting products which suits the spaces and mood within your budget.
						</p>
						<p class="fst-italic" style="text-align: justify;">
							We also stock a variety of solar lighting, Decorative Fans, Electrical Switches and other electrical accessories.
							Lastly, we are a tech based dealer continuously inspiring and always lookout the state of art technology innovative ideas that will provide our customers with a great shopping experience.
						</p>
					</div>

				</div>

			</div>

		</div>
	</section><!-- End About Section -->


	<div class="section-title" style="margin-top:4em;padding:20px;">
				<h3><span>Board Of Directors</span></h3>

			</div>
	<section class="consulting pt-4">
	
   
	<?php

include("../admin/dbconnection.php"); 
include("../admin/projectActions.php"); 
$select="SELECT * FROM directors "; 
$result=mysqli_query($GLOBALS['con'],$select); 
  
$cnt=1;
while($data = mysqli_fetch_array($result)) 
{ 
  $imageURL = '../admin/uploads/director_images/'.$data["image"];
  


?>

	   <div class="container " >
		 <div class="row mb-5 justify-content-center mt-5">
			 <div class="col-lg-6 pt-5">
				 <h3 style="text-align: center;"><?php echo $data['name'];?></h3>
				 <h5 style="text-align: center;"> <?php echo $data['position'];?></h5>
				 <hr class="new3">
				 <p style="text-align:justify;"><?php echo $data['description'];?>
				 </p>
				

			 </div >
			 <div style="margin-top: 2em;" class="col-lg-2 text-center"><img src="<?php echo $imageURL; ?>" class=" image-size" height="200px" width="170px"></div>
		 </div>
	 </div>



	 <?php $cnt=$cnt+1; }?>

	  
  
   </section>
   
















   
   <?php include "footer.php" ?>