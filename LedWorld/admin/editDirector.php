<?php 
   
// Start session 
session_start(); 
include'dbconnection.php'; 
include "header.php" ;
include("projectActions.php"); 

   
 $id =$_GET['director_id']; 
 $data = selectdatabyid("directors",$id); 
 $created_at = date('Y-m-d H:i:s');
 if(isset($_POST['submit'])) 
 { 
   
    if(!empty($_FILES['file']['name'])){
       
       //File uplaod configuration
       $result = 0;
       $uploadDir = "uploads/director_images/";
       $fileName = $id.'_'.basename($_FILES['file']['name']);
       $targetPath = $uploadDir. $fileName;
     
       //Upload file to server
       if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)){
        @unlink($uploadDir.$data['image']);
     
        $data=array( 
            "name"=>"'".$_POST['name']."'",
            "image"=>"'".$fileName."'",
            "position"=>"'".$_POST['position']."'",
            "description"=>"'".$_POST['description']."'",

            "created_at"=>"'".$created_at."'"
           
            ); 
                   
            $update= update($data,'directors',$id);
           
           //Update status
           if($update){
               $result = 1;
           }
       }
   
       echo "ok";
   }

   
    
   $data=array( 
    "name"=>"'".$_POST['name']."'",  
    "position"=>"'".$_POST['position']."'",
    "description"=>"'".$_POST['description']."'",
    "created_at"=>"'".$created_at."'"
   
    ); 
        
               
               update($data,'directors',$id); 
             
             header("location:directors.php"); 
             
 } 
   
 ?> 
 <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Directors </h3>
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
                            <input type="text" name="name" required class="form-control" placeholder="Enter  Name" value="<?php echo $data['name'];?>" >
                            </div>
                        </div>
                        
                            
                        
                             <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Profile Picture </label>
                                <div class="col-sm-10 col-md-8">
                                <img src="<?php echo "uploads/director_images/".$data['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> 
                               
                                </div>
                            
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;"> </label>
                                <div class="col-sm-10 col-md-8">
                               
                                <input type="file" name="file"  class="form-control" >
                                </div>
                            
                            </div>
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Designation </label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="position" placeholder="Enter Designation"  class="form-control" value="<?php echo $data['position'];?>" >
                    
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;"> Description</label>
                            <div class="col-sm-10 col-md-8">
                            <textarea  name="description" required class="form-control" placeholder="Enter Description" value="" >
                            <?php echo $data['description'];?></textarea>
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