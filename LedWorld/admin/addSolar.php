
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
        "description"=>"'".$_POST['description']."'"
     
       
        ); 


insert($data,'solars'); 

$solar_id=$con->insert_id;
            

      
// Count total uploaded files
$totalfiles = count($_FILES['files']['name']);

// Looping over all files
for($i=0;$i<$totalfiles;$i++){
$filename = $solar_id.'_'.$_FILES['files']['name'][$i];

// Upload files and store in database
if(move_uploaded_file($_FILES["files"]["tmp_name"][$i],'uploads/solars/'.$filename)){
       // Image db insert sql
       $insert = "INSERT into solar_images(solar_id,image) values('$solar_id','$filename')";
       if(mysqli_query($con, $insert)){
         echo 'Data inserted successfully';
       }
       else{
         echo 'Error: '.mysqli_error($conn);
       }
   }else{
       echo 'Error in uploading file - '.$_FILES['files']['name'][$i].'<br/>';
   }

}

header('location:solars.php'); 
             
 } 
   

?>


<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Solars</h3>
				<div class="row">
				
				
                  
	                  
                <div class="col-md-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Add Solar Details  
                              </h4>
                     <hr>
    
    
                   
                         
                         <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                      
                      
                        
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Title</label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="title" required class="form-control" placeholder="Enter Title" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Description</label>
                            <div class="col-sm-10 col-md-8">
                            <textarea  name="description" required class="form-control" placeholder="Enter description" cols="3" rows="2" value="" >
                        </textarea> </div>
                        </div>
                        
                            
                        
                             <div class="form-group">
                            <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Project Image </label>
                            <div class="col-sm-10 col-md-8">
                            <input type="file" accept="image/*" name="files[]" class="form-control" multiple >
                            <p>Possible to choose multiple images..</p>
                        
                  
                            </div>
                        </div>

                        <div style="margin-left:100px;">
                         <a href="solars.php" class="btn btn-theme">Back</a>
                        
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