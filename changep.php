<?php
include 'core.inc.php';
include 'connect.inc.php';
if(!loggedin()) {header('Location:index1.php');}
$id=getfield('id');
$name_f=getfield('fname');
$name_sr=getfield('srname');
$ln_img=getfield('imgln');
$usern=getfield('username');
$pwd=getfield('pword');

?>

 <html>
 <head>

    <title>Change Your Password</title>   
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 

  <style type="text/css">

      *{font-family: "Acmeregular";}
    .artic {width:70%;color: black;}
    #slideNotice{background-color:#f0f0f0;display:none;height:50px;position:relative;top:0;left:0;width:100%;text-align:center;font-family: Aclonicaregular;font-size: 20px;font-weight: bold;padding: 8px;scroll-behavior: auto;color: black;}
    .upld,.btn-success,.pport{margin-left:40px;}
    input{border-radius: 5px;}
    button{font-family: Tahoma;}
  </style>

</head>
<body>

<?php
include 'navbar.php'
 ?>

    <div id="slideNotice"></div> 
                
    
                  <input type=password placeholder="enter old password" id="opwd" required maxlength="40">
                  <input type=password placeholder="enter new password" id="npwd" required maxlength="40">
                  <input type=password placeholder="re-enter new password" id="npwdc" required maxlength="40">
                  <input type=button id="save_btn" value="save" class="btn btn-success">
                
            </article>
        </section>
<br>
        
  </div>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/changep.js"></script>
</body>
 </html>
