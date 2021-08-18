<?php



require_once 'bootstrap.php';


if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $extension = explode('.',$_FILES['file']['name']);
    $file_ext=strtolower(end($extension));
    $file_name_new = time();
    $extensions= array("docx");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a DOCX file.";
    }
    $path = "temp/";
    $current_path = $path.$file_name_new.'.'.$file_ext;
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp, $current_path);

      //  $converter = new Converter();
      shell_exec('/Applications/LibreOffice.app/Contents/MacOS/soffice --headless --convert-to png '. $current_path);

       echo '<img src="'. $file_name_new.'.png"></img>';
   
    }else{
       print_r($errors);
    }
 }
