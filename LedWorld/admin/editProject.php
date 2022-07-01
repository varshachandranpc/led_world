<?php 
   
// Start session 
session_start(); 
include'dbconnection.php'; 
include "header.php" ;
include("projectActions.php"); 

   
 $id =$_GET['project_id']; 
 $data = selectdatabyid("projects",$id); 
 $created_at = date('Y-m-d H:i:s');
 if(isset($_POST['submit'])) 
 { 
   
    if(!empty($_FILES['file']['name'])){
       
       //File uplaod configuration
       $result = 0;
       $uploadDir = "uploads/projects_images/";
       $fileName = $id.'_'.basename($_FILES['file']['name']);
       $targetPath = $uploadDir. $fileName;
     
       //Upload file to server
       if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)){
        @unlink($uploadDir.$data['image']);
     
        $data=array( 
            "title"=>"'".$_POST['title']."'",
            "image"=>"'".$fileName."'",
            "created_at"=>"'".$created_at."'"
           
            ); 
                   
            $update= update($data,'projects',$id);
           
           //Update status
           if($update){
               $result = 1;
           }
       }
   
       echo "ok";
   }

   
    
    $data=array( "title"=>"'".$_POST['title']."'", 
                "created_at"=>"'".$created_at."'" 
        ); 
               
               update($data,'projects',$id); 
             
             header("location:projects.php"); 
             
 } 
   
 ?> 
 <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Projects </h3>
				<div class="row">
				
				
                  
	                  
                <div class="col-md-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> All Projects Details  
                              </h4>
                     <hr>
    
    
                   
                         
                         <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                      
                      
                        
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Project Name</label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="title" required class="form-control" placeholder="Enter Project Name" value="<?php echo $data['title'];?>" >
                            </div>
                        </div>
                        
                            
                        
                             <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Project Image </label>
                                <div class="col-sm-10 col-md-8">
                                <img src="<?php echo "uploads/projects_images/".$data['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> 
                               
                                </div>
                            
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;"> </label>
                                <div class="col-sm-10 col-md-8">
                               
                                <input type="file" name="file"  class="form-control" >
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