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
 $file_path = "uploads/projects_images/";
 deletedata("projects",$id,$file_path,''); 
 } 
include'header.php';
?>
     
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Projects</h3>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All Projects Details  
                              <a href="addProject.php" class="btn_new btn btn-success pull-right" >
                                    <i class=" fa fa-angle-right"></i> New Project</a></h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Project Name</th>
                                  <th class="hidden-phone">Project Image</th>
                                 
                                  <th>created Date</th>
                              </tr>
                              </thead>
                              <tbody>
                                
                              <?php
                              $result = selectalldata("projects"); 
                              $cnt=1;
                              while($data = mysqli_fetch_array($result)) 
                              { 
                                $imageURL = 'uploads/projects_images/'.$data["image"];
                              //  $ret=mysqli_query($con,"select * from projects");
							
							 // while($row=mysqli_fetch_array($ret))
							 // {
                              ?>
                              
                              
                              
                              
                                
                              <tr>
                              <td><?php echo $cnt;?></td>
                              <td><?php echo $data['title'];?></td>
                                  <td><img src='<?php echo $imageURL; ?>'  class='rounded-circle' alt='' width="60px"></td>
                                    <td><?php echo $data['created_at'];?></td>
                                  <td>
                                     
                                     <a href="editProject.php?project_id=<?php echo $data['id'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                     <a href="projects.php?delid=<?php echo $data['id'];?>"> 
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