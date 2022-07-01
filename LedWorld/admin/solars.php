<?php

session_start();
include'dbconnection.php'; 
include("projectActions.php");
// checking session is valid for not 
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

// for deleting user
; 

 if(!empty($_GET['delid'])) 
 { 
 $id=$_GET['delid']; 
 $image_file_path = "uploads/solars/";
 $dele=deletedata("solars",$id,'',''); 
/*
 $condition = array('solar_id' => $id); 
 $delete = deleteImage($condition); 
 $uploadDir = "uploads/solars/"; 
 $query = "select * from solar_images where solar_id = ".$id;
 $results = mysqli_query($GLOBALS['con'], $query['']);
 if(!empty($results['image'])){ 
     foreach($results['image'] as $img){ 
         @unlink($uploadDir.$img['file_name']); 
     } 
    }
*/








 $query = "select * from solar_images where solar_id = ".$id;
    $results = mysqli_query($GLOBALS['con'], $query);
    $imgData = array();
    
    //$results['image'] = $imgData;
    while($row = $results->fetch_assoc()) {
        $imgData[] = $row; 
            $temp = explode(',',$row['image'] );
            foreach($temp as $image){
                    $images[]="uploads/solars/".trim( str_replace( array('[',']') ,"" ,$image ) );
            }
            foreach($images as $file) {
                    // Delete given images
                    if(unlink($file))
                    {
                    $del_image = "delete from solar_images where id = ".$row['id'];
			        $rsDelete = mysqli_query($GLOBALS['con'], $del_image);
                    if($rsDelete)
                    {
                        header('location:solars.php?success=true');
                       // exit();
                    }
                }
                else
                {
                    echo "Unable to delete Image";
                }
                
                

                }
        }

    






/*


		$querySelect = "select * from solar_images where solar_id = ".$id;
		$ResultSelectStmt = mysqli_query($GLOBALS['con'],$querySelect);
		$fetchRecords = mysqli_fetch_assoc($ResultSelectStmt);
		
		$fetchImgTitleName = $fetchRecords['image'];
		
		$createDeletePath = "uploads/solars/".$fetchImgTitleName;
		
		if(unlink($createDeletePath))
		{
			$liveSqlQQ = "delete from solar_images where id = ".$fetchRecords['id'];
			$rsDelete = mysqli_query($GLOBALS['con'], $liveSqlQQ);	
			
			if($rsDelete)
			{
				header('location:solars.php?success=true');
				exit();
			}
		}
		else
		{
			$displayErrMessage = "Sorry, Unable to delete Image";
		}
		



*/




   /*  if($dele){

    $select="SELECT * FROM solar_images where solar_id= $id"; 
   $select_rows=mysqli_query($GLOBALS['con'],$select); 
    $row= mysqli_fetch_assoc($select_rows); 
    if(!empty($row)){ 
        $delete_solar_image=("DELETE FROM solar_images WHERE solar_id=$id");
      foreach($row as $img){ 
        
      
        
          @unlink($image_file_path.$img); 
      } 
     
    }
  } 
   */
  



 
 } 



include'header.php';
?>
     
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Solars</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                      <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All Solar Details  
                              <a href="addSolar.php" class="btn_new btn btn-success pull-right" >
                                    <i class=" fa fa-angle-right"></i> New Solar</a></h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Title</th>
                                  <th class="hidden-phone">Description</th>
                                  <th class="hidden-phone">Image</th>
                                  <th>created Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                
                              <?php
                             
                            
           $select="SELECT solars.id,solars.title,solars.description,solars.created_at, solar_images.image FROM solars  JOIN solar_images ON 
           solars.id=solar_images.solar_id GROUP BY solars.id"; 
         $results=mysqli_query($GLOBALS['con'],$select);  
                              $cnt=1;
                              while($rows = mysqli_fetch_array($results)) 
                              { 
                                $imageURL = 'uploads/solars/'.$rows["image"];
                              //  $ret=mysqli_query($con,"select * from projects");
							
							 // while($row=mysqli_fetch_array($ret))
							 // {
                              ?>
                              
                                
                              <tr>
                              <td><?php echo $cnt;?></td>
                              <td><?php echo $rows['title'];?></td>
                              <td><?php echo $rows['description'];?></td>
                                  <td><img src='<?php echo $imageURL;?>'  class='rounded-circle' alt='' width="60px"></td>
                                    <td><?php echo $rows['created_at'];?></td>
                                  <td>
                                     
                                     <a href="editSolar.php?solar_id=<?php echo $rows['id'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                     <a href="solars.php?delid=<?php echo $rows['id'];?>"> 
                                     <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                              <?php if( mysqli_num_rows( $results )<1){ ?>
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