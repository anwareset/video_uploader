<?php
session_start();
include("config.php");
if(isset($_POST['tapi_upload'])){
  if($_POST['nama']==''){
    $_SESSION['stats'] = "err";
    header('location:index.php');
  } else {
    $qry = mysqli_query($con,'SELECT * FROM video_training ORDER BY id_video DESC');
    $row = mysqli_fetch_array($qry);
    $id_video = $_POST['idvideo'];
    $name = $_POST['nama'];
    $reference_video = str_replace(' ', '_', strtolower($name));
    $status = strtolower($_POST['status']);
    if($_FILES['fileupdate']['size']==0){
      mysqli_query($con, "UPDATE video_training SET nama_video='$name', referensi_video='$reference_video', status_aktif='$status' WHERE id_video=$id_video");
      $_SESSION['update'] = "suc";
      header('location:index.php');
    } else {
      include_once("delete_video.php");
      unset($_SESSION['stats']);
      $format = substr($_FILES['fileupdate']['name'], -4);
      $target_dir = "videos/";
      $target_file = $target_dir . $row['id_video'] . $format;
      $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $extensions_arr = array("mp4","avi","3gp","mov","mpeg");
      if(in_array($videoFileType,$extensions_arr) ){
        if(move_uploaded_file($_FILES['fileupdate']['tmp_name'],$target_file)){
          $url_video = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/video_uploader/$target_file";
          $query = "INSERT INTO video_training(nama_video,referensi_video,url_video,status_aktif) VALUES('".$name."','".$reference_video."','".$url_video."','".$status."')";

          mysqli_query($con,$query);
          $_SESSION['update'] = "suc";
          header('location:index.php');
        }

      } else {
        $_SESSION['stats'] = "err";
        header('location:index.php');
      }
    }
  }
}
?>