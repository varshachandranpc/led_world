
<?php 
// Start session 
session_start(); 
include'dbconnection.php'; 
include "header.php" ;
include("projectActions.php"); 
   
 if(isset($_POST['submit'])) 
 { 
    
  
              $data=array( 
                                                 "title"=>"'".$_POST['title']."'",
                                                 "description"=>"'".$_POST['description']."'",
                                                 "type"=>"'".$_POST['type']."'",
                                                 "image"=>"'".$image_fileName."'",
                                                 "brochure"=>"'".$brochure_fileName."'"
                                                 
                                                
                                                 ); 

               
           insert($data,'products'); 

     
         if(!empty($_FILES['file']['name']) && !empty($_FILES['brochure']['name'])){
             $last_id = $con->insert_id;
            //File uplaod configuration
            $result = 0;
            $image_uploadDir = "uploads/products_images/";
            $brochure_uploadDir = "uploads/brochure/";
            $image_fileName = $last_id.'_'.basename($_FILES['file']['name']);
            $brochure_fileName = $last_id.'_'.basename($_FILES['brochure']['name']);
            $image_targetPath = $image_uploadDir. $image_fileName;
            $brochure_targetPath = $brochure_uploadDir. $brochure_fileName;
        
            //Upload file to server
            if((@move_uploaded_file($_FILES['file']['tmp_name'], $image_targetPath))&&(@move_uploaded_file($_FILES['brochure']['tmp_name'], $brochure_targetPath))){
                 
               
                $update = $con->query("UPDATE products SET image ='$image_fileName',brochure='$brochure_fileName' WHERE id = '$last_id'");
        
                

                //Update status
                if($update){
                    $result = 1;
                }
            }
        
            //Load JavaScript function to show the upload status
            echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>  ';
        }



           header('location:products.php'); 
             
 } 
   

?>


<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Projects</h3>
				<div class="row">
				
				
                  
	                  
                <div class="col-md-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> All Projects Details  
                              </h4>
                     <hr>
    
    
                   
                         
                         <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                      
                      
                        
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Product Name</label>
                                    <div class="col-sm-10 col-md-8">
                                          <input type="text" name="title" required class="form-control" placeholder="Enter Project Name" value="" >
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Product Description</label>
                                    <div class="col-sm-10 col-md-8">
                                          <textarea rows="4" cols="50"  name="description" required class="form-control" placeholder="Enter Product Description" value="" ></textarea>
                                    </div>
                            </div>
                            
                        
                             <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Product Image </label>
                                <div class="col-sm-10 col-md-8">
                                <input type="file" name="file"  class="form-control" accept="image/*">
                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Brochure </label>
                                <div class="col-sm-10 col-md-8">
                                <input type="file" name="brochure"  class="form-control" accept=".pdf,.doc" >
                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Type</label>
                                    <div class="col-sm-10 col-md-8">
                                    <select name="type" id="type" class="form-control">
                                        <option value="1">Lights</option>
                                        <option value="2">Fans</option>
                                        <option value="3">Heater</option>
                                       
                                     </select>
                                    </div>
                            </div>

                        <div style="margin-left:100px;">
                         <a href="projects.php" class="btn btn-theme">Back</a>
                        
                        <input type="submit" name="submit" class="btn btn-success" value="SUBMIT">
                    
                        </div>

                       

                        </form>
                    </div>
                </div>
            </div>

                  
	                  
                
              
		</section>
      </section
  ></section>


<?php include "footer.php" ?>