<?php 
   
  function selectalldata($table) 
  { 
                $select="SELECT * FROM $table"; 
    $select1=mysqli_query($GLOBALS['con'],$select); 
    return $select1; 
  } 
   
   function selectdatabyid($table,$id) 
    { 
    $select="SELECT * FROM $table where id= $id"; 
    $select1=mysqli_query($GLOBALS['con'],$select); 
    return mysqli_fetch_array($select1); 
   
    } 
   
  function insert($data,$table) 
    { 
        
         $columns = ""; 
                         $values = ""; 
                         
                         foreach ($data as $column => $value) { 
                                     
                                     $columns .= ($columns == "") ? "" : ", "; 
                                     
                                     $columns .= $column; 
                                     
                                     $values .= ($values == "") ? "" : ", "; 
                                     $values .= $value; 
                         } 
                         
                         //echo $columns; 
                        // echo $values; 
                         
             $insert=("INSERT INTO $table ($columns) VALUES ($values)"); 
           //  echo $insert; 
             mysqli_query($GLOBALS['con'],$insert); 
    } 
    
    
     function update($data,$table,$where) 
    { 
             foreach ($data as $coloum => $value) 
     { 
     $update=("UPDATE $table SET $coloum = $value WHERE id= '$where'"); 
             //echo $update; 
             mysqli_query($GLOBALS['con'],$update); 
     } 
             return true; 
    } 
    
    function deletedata($table,$where,$image_file_path,$brochure_file_path) 
    { 
    
      
    $delete=("DELETE FROM $table WHERE id=$where"); 

     if (!empty($image_file_path)) {
     $data = selectdatabyid($table,$where); 
      $image_delete =  $image_file_path .$data['image'];
   
      if (!empty($data['image'])) {
      
        /* Delete */
        if (unlink($image_delete) ) { 
          if (!empty($brochure_file_path) && !empty($data['brochure']) ) {
            $brochure_delete=$brochure_file_path.$data['brochure'];
            unlink($brochure_delete);
             
           }
           else {
            echo "<b>{$image_delete }</b> error deleting ";  
                                                     
          }
          } 
        } 
                                          
        } 
        mysqli_query($GLOBALS['con'],$delete) or die(mysqli_error()); 
          return true;  // echo "<b>{$image_delete}</b> has been deleted";       
        //
    } 
     function deleteImage($conditions){
      $imgTbl     = "solar_images";  
      $whereSql = ''; 
      if(!empty($conditions)&& is_array($conditions)){ 
          $whereSql .= ' WHERE '; 
          $i = 0; 
          foreach($conditions as $key => $value){ 
              $pre = ($i > 0)?' AND ':''; 
              $whereSql .= $pre.$key." = '".$value."'"; 
              $i++; 
          } 
      } 
      $query = "DELETE FROM ".$imgTbl.$whereSql; 
      $delete = mysqli_query($GLOBALS['con'],$query) ;
      return $delete?true:false; 
  }

  

    ?>