<?php 
   
   // Start session 
   session_start(); 
   include'dbconnection.php'; 
   include "header.php" ;
   include("projectActions.php"); 
   
      
    $id =$_GET['product_id']; 
    $data = selectdatabyid("products",$id); 
    $created_at = date('Y-m-d H:i:s');
    if(isset($_POST['submit'])) 
    { 
      
        if(!empty($_FILES['file']['name']) || !empty($_FILES['brochure']['name'])){
          
          //File uplaod configuration
          $result = 0;
          $image_uploadDir = "uploads/products_images/";
       
          $image_fileName = $id.'_'.basename($_FILES['file']['name']);
         
          $image_targetPath = $image_uploadDir. $image_fileName;
        
        
          //Upload file to server
          if((@move_uploaded_file($_FILES['file']['tmp_name'], $image_targetPath))){
           @unlink($image_uploadDir.$data['image']);
         
        
           $data1=array( 
               "title"=>"'".$_POST['title']."'",
               "image"=>"'".$image_fileName."'",
               "description"=>"'".$_POST['description']."'",
               "type"=>"'".$_POST['type']."'",
               "created_at"=>"'".$created_at."'"
              
               ); 
                      
               $update= update($data1,'products',$id);
              
              //Update status
              if($update){
                  $result = 1;
              }
          }
          $brochure_uploadDir = "uploads/brochure/";
          $brochure_fileName = $id.'_'.basename($_FILES['brochure']['name']);
          $brochure_targetPath = $brochure_uploadDir. $brochure_fileName;
          if((@move_uploaded_file($_FILES['brochure']['tmp_name'], $brochure_targetPath))){
          

            @unlink($brochure_uploadDir.$data['brochure']);
         
            $data1=array( 
                "title"=>"'".$_POST['title']."'",
                "brochure"=>"'".$brochure_fileName."'",
                "description"=>"'".$_POST['description']."'",
                "type"=>"'".$_POST['type']."'",
                "created_at"=>"'".$created_at."'"
               
                ); 
                       
                $update= update($data1,'products',$id);
               
               //Update status
               if($update){
                   $result = 1;
               }
           }



      
          echo "ok";
      }
   
      
       
       $data1=array( "title"=>"'".$_POST['title']."'", 
                     "description"=>"'".$_POST['description']."'",
                     "type"=>"'".$_POST['type']."'",
                   "created_at"=>"'".$created_at."'" 
           ); 
                  
                  update($data1,'products',$id); 
                
                header("location:products.php"); 
                
    } 
      
    ?> 
    <section id="main-content">
             <section class="wrapper">
                 <h3><i class="fa fa-angle-right"></i> Manage Products </h3>
                   <div class="row">
                   
                   
                     
                         
                   <div class="col-md-12">
                       <div class="content-panel">
                       <h4><i class="fa fa-angle-right"></i><?php echo "  ddd". $data['brochure']; ?>All Product Details  
                                 </h4>
                        <hr>
       
       
                      
                            
                            <form  class="form-horizontal style-form"  method="post" action="" enctype="multipart/form-data">
                         
                         
                           
                               <div class="form-group">
                               <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Product Name</label>
                               <div class="col-sm-10 col-md-8">
                               <input type="text" name="title" required class="form-control" placeholder="Enter Project Name" value="<?php echo $data['title'];?>" >
                               </div>
                           </div>
                           <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Product Description</label>
                                    <div class="col-sm-10 col-md-8">
                                          <textarea rows="4" cols="50"  name="description" required class="form-control" placeholder="Enter Product Description" value="" ><?php echo $data['description'];?></textarea>
                                    </div>
                            </div>
                               
                           
                                <div class="form-group">
                                   <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Product Image </label>
                                   <div class="col-sm-10 col-md-8">
                                   <img src="<?php echo "uploads/products_images/".$data['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="90px" height="50px"> 
                                  
                                   </div>
                               
                               </div>
                               <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;"> </label>
                                <div class="col-sm-10 col-md-8">
                                <input type="file" name="file"  class="form-control" accept="image/*">
                    
                                </div>
                            </div>
                           
                               <div class="form-group">
                                   <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;">Brochure </label>
                                   <div class="col-sm-10 col-md-8">
                                   <iframe src="<?php echo "uploads/brochure/".$data['brochure']; ?>" width="60%" height="100px">
                                  </iframe>
                                  
                                   </div>
                               
                               </div>
                               <div class="form-group">
                                <label class="col-sm-2 col-sm-2  control-label" style="padding-left:40px;"> </label>
                                <div class="col-sm-10 col-md-8">
                                <input type="file" name="brochure"  class="form-control" accept=".pdf,.doc" >
                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Type</label>
                                    <div class="col-sm-10 col-md-8">
                                    <select name="type" id="type" class="form-control">
                                        <option value="1" <?php if ($data['type'] == 1) { echo ' selected="selected"'; } ?>>Lights</option>
                                        <option value="2" <?php if ($data['type'] == 2) { echo ' selected="selected"'; } ?>>Fans</option>
                                        <option value="3" <?php if ($data['type'] == 3) { echo ' selected="selected"'; } ?>>Heater</option>

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