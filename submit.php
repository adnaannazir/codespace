<?php
require 'core.inc.php';
require 'connect.inc.php';
if(!loggedin()) {header('Location:index.php');}

$id=getfield('id');
  $qcode=$_GET['q'];


$qry="select count(*) from submissions where qid='".$qcode."'";
$rslt=mysql_query($qry);
$cnt=mysql_result($rslt,0);
$cnt++;
?>
 <html>
 <head>
   <title>Submit <?php echo $qcode;?></title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  
  #sample5{height:400px;}
  a{color:white;}
  h6{display:inline;}
  .contain{width:90%;margin: auto;}

  </style>
</head>
<body>
  
 <?php
include 'navbar.php'
 ?>
 <div class=contain>

<?php
echo "<h6>Problem Code:".$qcode."</h6>";


if(isset($_POST['ln'])) {
$code=$_POST['ln'];

if(!empty($code)&&!empty($qcode)){
$my_file = 'adminaccess/codes/'.$qcode.$id.$cnt.".c";
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, $code);
//exec("./o", $output, $status);
          $status=0;
          $output="Hello World";
          echo "<br>status: " . $status;
          if($status==0) $res="AC";
          else if($status==1) $res="TLE";
          else if($status==2) $res="CE";
          else if($status==3) $res="RE";
          else if($status==4) $res="WA";
          else if($status==5) $res="MLE";
          //echo "<br>output: " . implode("<br>", $output);

          $queryins="INSERT INTO `oj`.`submissions` (`id`, `result`, `qid`, `user_id`, `subln`) VALUES (NULL, '".$res."','".$qcode."','".$id."','".$my_file."');";
          $resultqu=mysql_query($queryins);
          
}
}

else if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name']))
{   $name=$_FILES['file']['name'];
 
    $tmpname=$_FILES['file']['tmp_name'];
    $location = 'adminaccess/codes/'.$qcode.$id.$cnt.".c";
    if(move_uploaded_file($tmpname,$location))
    {
        
        //exec("./o", $output, $status);
                    $status=0;
          $output="Hello World";
          echo "<br>status: " . $status;
          if($status==0) $res="AC";
          else if($status==1) $res="TLE";
          else if($status==2) $res="CE";
          else if($status==3) $res="RE";
          else if($status==4) $res="WA";
          
          //echo "<br>output: " . implode("<br>", $output);

          $queryins="INSERT INTO `oj`.`submissions` (`id`, `result`, `qid`, `user_id`, `subln`) VALUES (NULL, '".$res."','".$qcode."','".$id."','".$location."');";
          $resultqu=mysql_query($queryins);
          echo $resultqu;

    }
    else
    {
        echo 'Problem Uploading';
    }
}


?>



<!-- Floating Multiline Textfield -->



<form action="submit.php?q=<?php echo $qcode;?>" method=post>
  
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="sample5" name=ln></textarea>
    <br><br>
   Language &nbsp;:&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked>
  <span class="mdl-radio__label">C</span>&nbsp;&nbsp;&nbsp;
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
  <span class="mdl-radio__label">C++</span>
</label><br><br>
<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">SUBMIT</button>
</form>
<br><br>
 OR
 <br><br>

<form action="submit.php?q=<?php echo $qcode;?>" method="POST" enctype="multipart/form-data" >
            <input type="file" name="file" accept=".c,.cpp" required>
            <br><br>
   Language &nbsp;:&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked>
  <span class="mdl-radio__label">C</span>&nbsp;&nbsp;&nbsp;
</label>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
  <span class="mdl-radio__label">C++</span>
</label><br><br>
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">SUBMIT</button>
        </form>
        
    
  </div>

</body>
<script>
     

</script>
 </html>
