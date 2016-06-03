<?php
  
include 'db.php';
$obj=new DB();
$sql= "SELECT nom, id_event, _id_photographe FROM evenement_individuel WHERE modif_en_cours=1";
$test = mysqli_query($obj->connection(),$sql);
while ($true=mysqli_fetch_object($test)) {
  $chaine = $true->nom;
  $id_event = $true->id_event;
  $id_photographe =$true->_id_photographe;
}
setlocale(LC_ALL, 'fr_FR');
$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
// filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);



while(strpos($chaine, '__') !== false)
{
  $chaine = str_replace('__', '_', $chaine);
}
$chaine = trim($chaine, '_');
echo $chaine;


$upload_dir = "myuploads/".$chaine;
// 'myuploads/'.$chaine;  

// echo $upload_dir;


function insert_data($ar){
$obj=new DB();
$key="(f_name , f_size, f_link,f_type,d_date, _id_event_ind, _id_photographe)";
$val="('{$ar['fname']}', '{$ar['fsize']}','{$ar['flink']}','{$ar['ftype']}','{$ar['fdate']}','{$ar['_id_event_ind']}','{$ar['_id_photographe']}')";
mysqli_query($obj->connection(),"INSERT INTO  file_upload ".$key." VALUES ".$val);
//mysqli_close($obj->con);
}

if (!empty($_FILES)) {    
    $tempFile = $_FILES['file']['tmp_name'];                    
      // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
    $targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;  
     // Adding timestamp with image's name so that files with same name can be uploaded easily.
  $fname =  $targetPath.$_FILES['file']['name'];  
  $file_name=$_FILES['file']['name'];
  $ftype=$_FILES["file"]["type"];
  $fsize=($_FILES["file"]["size"] / 1024);
  $tmpname=$_FILES["file"]["tmp_name"];
 $flink='dropzone/'.$upload_dir."/".$file_name;
 $id_event = $id_event;
 $id_photographe = $id_photographe;
  $arr= array('fname'=>$file_name,
    'fsize'=>$fsize,
    'flink'=>$flink,
    'ftype'=>$ftype,
    'fdate'=>date('Y-m-d h:i:s'),
    '_id_event_ind'=> $id_event,
    '_id_photographe'=> $id_photographe);
  insert_data($arr);
    move_uploaded_file($tempFile,$fname); 
    echo $file_name;
}




?> 