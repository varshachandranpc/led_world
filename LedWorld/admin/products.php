<?php

session_start();
include'dbconnection.php'; 
// checking session is valid for not 
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

// for deleting user
include("projectActions.php"); 
   
 if(!empty($_GET['delid'])) 
 { 
 $id=$_GET['delid']; 
 $image_file_path = "uploads/products_images/";
 $brochure_file_path = "uploads/brochure/";
 deletedata("products",$id,$image_file_path,$brochure_file_path); 
 
 } 
include'header.php';
?>
     
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Products</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All Products Details  
                              <a href="addProduct.php" class="btn_new btn btn-success pull-right" >
                                    <i class=" fa fa-angle-right"></i> New Product</a></h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Product Name</th>
                                  <th class="hidden-phone">Product Description</th>
                                  <th class="hidden-phone">Product Image</th>
                                  <th class="hidden-phone">Product Brochure</th>
                                  <th>created Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                
                              <?php
                              $result = selectalldata("products"); 
                              $cnt=1;
                              while($data = mysqli_fetch_array($result)) 
                              { 
                                $imageURL = 'uploads/products_images/'.$data['image'] ;
                                $fileURL = 'uploads/brochure/'.$data["brochure"];
                              //  $ret=mysqli_query($con,"select * from projects");
							
							 // while($row=mysqli_fetch_array($ret))
							 // {
                              ?>
                              
                              
                              
                              
                                
                              <tr>
                              <td><?php echo $cnt;?></td>
                              <td><?php echo $data['title'];?></td>
                              <td><?php echo $data['description'];?></td>
                                  <td><img src="<?php echo $imageURL; ?>" class='rounded-circle'  height="40px" width="50px"></td>
                                  <td><iframe src="<?php echo $fileURL; ?>" width="90%" height="100px">
                                  </iframe></td>
                                    <td><?php echo $data['created_at'];?></td>
                                  <td>
                                     
                                     <a href="editProduct.php?product_id=<?php echo $data['id'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                     <a href="products.php?delid=<?php echo $data['id'];?>"> 
                                     <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                              <?php if( mysqli_num_rows( $result )<1){ ?>
                              <tr><td colspan="6">No Products found...</td></tr><?php } ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
		</section>
      </section
  ></section>
  <?php include'footer.php'; } ?>