
<!--sign up -->




<?php

if(isset($_POST['eml'])&&isset($_POST['phn'])&&isset($_POST['uname1'])&&isset($_POST['pword1'])&&isset($_POST['pword11'])&&isset($_POST['namef1'])&&isset($_POST['namel1'])&&isset($_FILES['proim']['name']))/*to check that user has submitted the signup form*/
    {$usern1=$_POST['uname1'];//getting values from fields using post method
      $passw=$_POST['pword1'];
      $fname=$_POST['namef1'];
      $lname=$_POST['namel1'];
      $eml=$_POST['eml'];
      $phn=$_POST['phn'];
      $tomatch=$_POST['pword11'];
      $impronm=$_FILES['proim']['name'];//getting file name
      $improtmp=$_FILES['proim']['tmp_name'];//getting its temporary location
      $hashed=md5($passw);
      echo $usern1;
      echo $passw;
      echo $fname;
      echo $lname;
      echo $eml;
      echo $phn;
      echo $tomatch;
      echo $impronm;
      echo $improtmp;
      echo $hashed;
      if(!empty($usern1) && !empty($passw)&& !empty($fname) && !empty($lname)&&!empty($impronm) && !empty($eml) && !empty($phn))/*to see the values are not empty*/
        {
          if($tomatch==$passw)/*matching password and re-enter password*/
            {
              $query1="SELECT username from user_in where username='$usern1';";/*query to check username already exists*/
              $reslt=mysql_query($query1);/*running the query*/
              if(mysql_num_rows($reslt)==1)/*checking that same username exists*/
              {
                echo "<div class=\"alert alert-danger fade in signup\">Username already Exists<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";//producing error if same username exists 
              }
              else
              {$location='imgprof/'.$impronm;
                echo $location;
                echo $improtmp;/*moving the profile picture onto our server*/
                if(move_uploaded_file($improtmp,$location))
                {
                    $query="INSERT INTO `oj`.`user_in` (`id`, `fname`, `srname`, `pword`, `username`, `email`, `phone`, `score`,`imgln`) VALUES (NULL,'".mysql_real_escape_string($fname)."','".mysql_real_escape_string($lname)."','".mysql_real_escape_string($hashed)."','".mysql_real_escape_string($usern1)."','".mysql_real_escape_string($eml)."','".mysql_real_escape_string($phn)."','1000','".mysql_real_escape_string($location)."');";//query to upload our data on server database
                    if($result=mysql_query($query))//run the query
                    {
                      echo "<br><br><br><br><div class=\"alert alert-success signup\">Your account has been created successfully<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";/*giving notification about successful creation of account*/
                       $query="SELECT id from user_in where username='".mysql_real_escape_string($usern1)."' AND pword='".mysql_real_escape_string($hashed)."';";//finding the id of newly made account
                        $result=mysql_query($query);//run the query

                        $us_id=mysql_result($result,0,'id');
                          //getting the user id
                        //$t=time(); 
                        //$query1="CREATE TABLE `oj`.`$us_id` ( `id` INT NOT NULL AUTO_INCREMENT ,  `msgto` INT NOT NULL ,  `type` VARCHAR(10) NOT NULL ,  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `content` VARCHAR(1000) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB";
                          //if(!mysql_query($query1)) echo 'error';
          
                $_SESSION['user_id']=$us_id;//starting the session for the user
                      header('Location: index1.php');
                    }
              }
              else {echo "<div class=\"alert alert-danger fade in signup\">error uploading image<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";}//display error about image
            }
            }
        else
        {
        echo "<div class=\"alert alert-danger fade in signup\">Passwords do not match<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";//display error about password
        }

      }
      else echo "<div class=\"alert alert-danger fade in signup\">Please fill in all the fields<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";//display error about empty fields

    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>OJ</title>
  <link rel="shortcut icon" href="https://maxcdn.icons8.com/Color/PNG/24/Computer_Hardware/under_computer-24.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.2.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.2.0/material.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/weldes.css" type="text/css">
  <style>
    .lg {font-size:100px;}
    
    
      .bg-grey{background-color: "grey";}
      .enterlogin{width:250px;}
      
       
body {
    text-align: center;
    background: #e9ebee;
    padding-top: 12px;
    line-height: 2;
}

#login{height:678px;width:70%;
background-size:100%;border:1px solid white;margin:auto;
padding-top:200px;}
.page{height:678px;width:70%;
background-size:100%;border:1px solid white;margin:auto;overflow:auto;}
  *{color:black;}
  #file { display: none;}
  nav{padding:0px;}

.demo-card-square.mdl-card {
  width: 320px;
  height: 320px;
  margin: auto;
}
.demo-card-square > .mdl-card__title {
  color: #fff;
  background:
    url('../assets/demos/dog.png') bottom right 15% no-repeat #46B6AC;
}

  </style>

  <script>
    $(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
    });
  //alert($(window).height());
  //alert($(window).width());
    var h=$(window).height();
    var w=$(window).width();
    $('.page').height(h);
    $('.page').width(w);
    $('#login').height(h);
    $('#login').width(w); 
  </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">OnlineJudge</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a data-toggle="modal" data-target="#modl"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>



<button class="mdl-button mdl-js-button mdl-button--primary" data-toggle=modal data-target=#modl>
  Sign Up
</button>

<div class="modal fade" id="modl">
        
        <div class="modal-dialog">
            
            <div class="modal-content">

<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Sign Up</h4>
                </div>
                <div class="modal-body">
                 <form method="post" action="<?php echo $current_file;?>" enctype="multipart/form-data">
                    
                      <input type="file" id="file" accept='image/*' name="proim" required>
<label for="file" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
  <i class="material-icons">person_outline</i>
</label>

                    <div id="ustatus"> </div> <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type ="text" name="uname1" maxlength="40" value="<?php if(isset($usern1)) echo $usern1;?>" required id="nameuser">
    <label class="mdl-textfield__label" for="nameuser">Username:
  </div></label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" type="password" name="pword1" required id="p1">
    <label class="mdl-textfield__label" for="p1">Password:</label>
  </div>

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" name="pword11" required id="p2">
    <label class="mdl-textfield__label" for="p2">Retype Password:</label>
  </div>

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type ="text" name="namef1" maxlength="30" value="<?php if(isset($fname)) echo $fname;?>" id="fnm">
    <label class="mdl-textfield__label" for="fnm">First Name:</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type ="text" name="namel1" maxlength="30" value="<?php if(isset($lname)) echo $lname;?>" id="lnm">
    <label class="mdl-textfield__label" for="lnm">Last Name:</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type ="email" name="eml" maxlength="30" value="<?php if(isset($eml)) echo $eml;?>" required id="em">
    <label class="mdl-textfield__label" for="lnm">Email:</label>
  </div>

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="phn" maxlength="30" value="<?php if(isset($phn)) echo $phn;?>" id="ph">
    <label class="mdl-textfield__label" for="ph">Phone</label>
    <span class="mdl-textfield__error">Input is not a number!</span>
  </div>
  <br>




              
  </div>
                <div class="modal-footer">
                
                <button type="submit" class="btn btn-default">Create Account</button>
              </form></div>
            </div>

            </div>

                
<div class="page">
  <?php
if(!empty($_COOKIE['uid'])&&isset($_COOKIE['uid'])){$_SESSION['user_id']=$_COOKIE['uid'];
            header('Location: index1.php');}/*to directly login in case of preset cookies*/
else {if(isset($_POST['uname'])&&isset($_POST['pword']))//check if the values are set i.e. form is submitted by user
{$usern=$_POST['uname'];//getting values using more secure post method

$passw=$_POST['pword'];

$hashed=md5($passw);

if(!empty($usern) && !empty($passw))/*check the fields are not empty*/
    {
    $query="SELECT id from user_in where username='".mysql_real_escape_string($usern)."' AND pword='".mysql_real_escape_string($hashed)."';";/*query to see any user is there with a given username and password*/

      if($result=mysql_query($query))/*run the query */
      {
        $num_rows=mysql_num_rows($result);
        if($num_rows==0)/*check if no rows are returned there is no such user*/
          echo "<div class=\"alert alert-danger fade in log\">Invalid Credentials<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";
        else if($num_rows==1)
          { /*get user id from mysql table*/
            $us_id=mysql_result($result,0,'id');
      $t=time();
       /*check if the checkbox is selected to make cookies*/  
       if(isset($_POST['rmmbr'])&&!empty($_POST['rmmbr'])) setcookie('uid',$us_id,$t+60*60*24*365);

      /*start a session and send to index1.php*/$_SESSION['user_id']=$us_id;
            
            $qry="INSERT INTO `oj`.`online` (`id`, `username`, `time`) VALUES (NULL, '$usern', CURRENT_TIMESTAMP);";
            if($res=mysql_query($qry));     
            {
            header('Location: index1.php');}
          }
      }
    }//check all fields are filled
else echo "<div class=\"alert alert-danger fade in log\">Please fill in all the fields<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a></div>";
}}
?>
        <div class="col-sm-8" id="imgp">
          Hello
        </div>

 

        <div class="demo-card-square mdl-card mdl-shadow--2dp">

  <div class="mdl-card__title mdl-card--expand">
    <h2 class="mdl-card__title-text">Sign In</h2>
  </div>
  <div class="mdl-card__supporting-text">
            <form method="post" action="<?php echo $current_file;?>" class="form-vertical col-sm-4">
            <div class=enterlogin>
            <input type="text" name="uname" maxlength="40" value="<?php if(isset($usern)) echo $usern;?>" placeholder="Username" required class="form-control">
      
      
            <input type="password" name="pword" required class="form-control" placeholder="Password">
       
        
          <div class="checkbox">
            <label><input type="checkbox" name=rmmbr> Remember me</label>
          </div>
        
          
        </div>
        
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" value="Log In" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
    </form>
  </div>
</div>
</div>
</div>
    
    <div class="page">
        <div class="col-sm-2 col-sm-offset-1"><h1>Practice</h1>
          <span class="glyphicon glyphicon-globe lg"></span>
        </div>
        <div class="col-sm-2 col-sm-offset-2"><h1>Competitions</h1>
          <span class="glyphicon glyphicon-leaf lg"></span>
        </div>
        <div class="col-sm-3 col-sm-offset-1 "><h1>Leaderboard</h1>
          <span class="glyphicon glyphicon-heart lg"></span>
        </div>
      
      </div>

    <div class="page bg-grey">
        <h3 class="text-center">CONTACT</h3>
        <div class=col-sm-6>
            <p><span class="glyphicon glyphicon-map-marker"></span> B6 Hostel,IIT Mandi</p>
            <a href=tel:9736260564><p><span class="glyphicon glyphicon-phone"></span> 9736260564</p>
             </a> <a href=mailto:vaibhavagarwal220@gmail.com><p>  <span class="glyphicon glyphicon-envelope"></span> vaibhavagarwal220@gmail.com
            </p></a></div>
        <div class=col-sm-6>
        <div class="col-sm-6 form-group">
            <input type="text" placeholder="Name" class="form-control"></div>
            
                <div class="col-sm-6 form-group">
                    <input type="text" placeholder="Email Address" class="form-control">
                </div>
            <div class="col-sm-12"><textarea class="form-control" rows=5 placeholder=Comment></textarea><br></div>
            
            
        <div class=col-sm-12>
            <button class="btn btn-default pull-right" type="submit">Send</button><br><br>
                </div>
        </div>     
        
        </div>
    
    
    <br><br>
    <br><br>
    <script type="text/javascript" src=js/check.js></script>
<a href="https://icons8.com">Icon pack by Icons8</a>
</body>
</html>
