<?php
@session_start();
include 'config.php';
$vid = $_POST['idvideo'];
$kueri = mysqli_query($con, "select * from video_training where id_video='$vid'");
$baris = mysqli_fetch_array($kueri);
$url = $baris['url_video'];
$formatvid = substr($url, -4);
$namafile = "videos/".$vid.$formatvid;
unlink($namafile);
mysqli_query($con,"DELETE FROM video_training WHERE id_video='$vid'");
$_SESSION['del'] = "suc";
header('location:index.php');
?>