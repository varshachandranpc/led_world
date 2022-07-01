
<?php 
// Start session 
session_start(); 
include'dbconnection.php'; 
include "header.php" ;
include("projectActions.php"); 
$id =$_GET['solar_id']; 
$data = selectdatabyid("solars",$id); 
$created_at = date('Y-m-d H:i:s');
if(isset($_POST['submit'])) 
{ 
  
    if(!empty($_FILES['files']['name']) ){
        // Count total uploaded files
$totalfiles = count($_FILES['files']['name']);
      // Looping over all files
    for($i=0;$i<$totalfiles;$i++){
    $filename = $id.'_'.$_FILES['files']['name'][$i];
    
    // Upload files and store in database
    if(move_uploaded_file($_FILES["files"]["tmp_name"][$i],'uploads/solars/'.$filename)){
           // Image db insert sql
          
           // $update = $con->query("UPDATE solar_images SET image = '$fileName' WHERE solar_id = '$id'");     



           $insert = "INSERT into solar_images(solar_id,image) values('$id','$filename')";
          
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

   }

  
   
   $data1=array( "title"=>"'".$_POST['title']."'", 
                 "description"=>"'".$_POST['description']."'",
                   "created_at"=>"'".$created_at."'" 
       ); 
              
              update($data1,'solars',$id); 
            
            header("location:solars.php"); 
            
} 
$_POST['action_type']='img_delete';
if((!empty($_POST['action_type'] == 'img_delete')) && !empty($_POST['id'])){ 
    // Previous image data 
    $prevData =selectdatabyid("solars",$id); 
    $uploadDir = "uploads/solars/";           
    // Delete gallery data 
    $condition = array('id' => $_POST['id']); 
    $delete = deleteImage($condition); 
    if($delete){ 
        @unlink($uploadDir.$prevData['file_name']); 
        $status = 'ok'; 
    }else{ 
        $status  = 'err'; 
    } 
    echo $status;die; 
} 
      
 

?>
 <style>
   
   .edit_img {
       display: inline-flex !important;
   }
       </style>
   

<section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Solars</h3>
				<div class="row">
				
				
                  
	                  
                <div class="col-md-12">
                    <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Edit Solar Details  
                              </h4>
                     <hr>
    
    
                   
                         
                         <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                      
                      
                        
                            <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Title</label>
                            <div class="col-sm-10 col-md-8">
                            <input type="text" name="title" required class="form-control" placeholder="Enter Project Name" value="<?php echo $data['title'];?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Description</label>
                            <div class="col-sm-10 col-md-8">
                            <textarea  name="description" required class="form-control" placeholder="Enter description" cols="3" rows="2" value="" >
                            <?php echo $data['description'];?></textarea> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;"> Image </label>
                            <div class="col-sm-10 col-md-8">
                            <input type="file" name="files[]"  accept="image/*" class="form-control" multiple  >
                    
                        
                  
                            </div>
                        </div>
                        <?php 
           
           
           
           $select="SELECT * FROM  solar_images WHERE solar_id=$id"; 
          $results=mysqli_query($GLOBALS['con'],$select); 
          $cnt=1;  
         ?>
                        <div class="form-group">
                                   <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">  </label>
                                   <div class="col-sm-10 col-md-8 edit_img ">
                                <?php   while($row = mysqli_fetch_array($results)) 
                                  { 
      
                              $imageURL = 'uploads/solars/'.$row["image"];
      
      
        
                                    ?>
                        <div class="img-box thumbnail" id="imgb_<?php echo $row['id']; ?>">
                                <img src="<?php echo $imageURL; ?>" width="200px" height="200px">
                                <div class="caption"><p>
                                <a href="javascript:void(0);" class="badge badge-danger" onclick="deleteImage('<?php echo $row['id']; ?>')">delete</a></p></div>
                        </div>

                                
                                   <?php  $cnt=$cnt+1; } ?> 
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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
function deleteImage(id){
    var result = confirm("Are you sure to delete?");
    if(result){
        $.post("editSolar.php", {action_type:"img_delete",id:id}, function(resp) {
            if(resp =='ok'){
                $('#imgb_'+id).remove();
               // location.reload();
                alert('The image has been removed ..');
            }else{
                location.reload();
               
            }
        });
    }
}
</script>

<?php include "footer.php" ?>