
<?php 
// Start session 
session_start(); 
include'dbconnection.php'; 
include "header.php" ;
include("projectActions.php"); 
   
 if(isset($_POST['submit'])) 
 { 
    

              $data=array( 
                                                 "name"=>"'".$_POST['name']."'",
                                                 "image"=>"'".$filename."'",
                                                 "position"=>"'".$_POST['position']."'",
                                                 "description"=>"'".$_POST['description']."'",
                                               
                                                
                                                 ); 

               
           insert($data,'directors'); 


           if(!empty($_FILES['file']['name'])){
             $last_id = $con->insert_id;;
            //File uplaod configuration
            $result = 0;
            $uploadDir = "uploads/director_images/";
            $fileName = $last_id.'_'.basename($_FILES['file']['name']);
            $targetPath = $uploadDir. $fileName;
        
            //Upload file to server
            if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)){
                 
               
                $update = $con->query("UPDATE directors SET image = '$fileName' WHERE id = '$last_id'");
        
                //Update status
                if($update){
                    $result = 1;
                }
            }
        
            //Load JavaScript function to show the upload status
            echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>  ';
        }




             header('location:directors.php'); 
             
 } 
   

?>


<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Directors</h3>
				<div class="row">
				
				
                  
	                  
                <div class="col-md-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> All Director Details  
                              </h4>
                     <hr>
    
    
                   
                         
                         <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                      
                      
                        
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;"> Name</label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="name" required class="form-control" placeholder="Enter Name" value="" >
                            </div>
                        </div>
                        
                            
                        
                             <div class="form-group">
                            <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Profile Picture </label>
                            <div class="col-sm-10 col-md-8">
                            <input type="file" name="file"  class="form-control" >
                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Designation </label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="position" placeholder="Enter Designation"  class="form-control" >
                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;"> Description</label>
                            <div class="col-sm-10 col-md-8">
                            <textarea  name="description" required class="form-control" placeholder="Enter Description" value="" >
                            </textarea>
                        </div>
                        </div>

                        <div style="margin-left:100px;">
                         <a href="directors.php" class="btn btn-theme">Back</a>
                        
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