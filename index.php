<!DOCTYPE html>
<html lang="en">
<head>
  <title>URL Shortner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
    
</head>
<body>



<div class="container">
  <h2 class="text-primary" style="text-align:center;">URL SHORTNER</h2>
  <div class="panel panel-default">
    
    <div class="panel-body">
    
    <p style="text-align:center;">Enter URL to create short URL</p>
    

    
    <p id="link" style="text-align:center;"></p><!--short link will display here--> 
    
    <!--input form-->
  <form method="post" action="index.php">
    
  <div class="input-group" style="margin:auto;max-width:500px">
    <input type="text" class="form-control" placeholder="Enter link" id="input_link" name="input_link">
    <div class="input-group-btn">
      <button class="btn btn-primary" type="submit" name="short_url">
          Create
      </button>
        
    
    </div>
  </div>
</form><!--form-->
   
   <?php
include("connection.php");


       /* code to increment count which is used to display most frequent accessed url*/
        
if(isset($_GET['id']))
{
	
	$id=$_GET['id'];
	$sql="SELECT * FROM bb WHERE short_url='$id'";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query))
	{
		
		$oldurl=$row['long_url'];
		$count=$row['count'];
		
	$countnew=$count+1;
	$count="UPDATE bb set count='$countnew' WHERE short_url='$id'";
	$que=mysql_query($count) or die ('error');
		
		if($que)
		{
			
					header("Location: http://$oldurl");
		
		}
	}
	
}

        /*end of counter updatation code*/

        
        /*acepting input link from user*/
if(isset($_POST['short_url']))
{
 $input_url=$_POST["input_link"];

	$sql="SELECT * FROM bb WHERE long_url='$input_url'"; // query to select input link from databse 
	$query=mysql_query($sql);
		while($row=mysql_fetch_array($query))
	{
		
		$oldurl=$row['long_url'];
		$short_url=$row['short_url'];
		
		
	}	
	
 global $oldurl;
 if($input_url==$oldurl) // here we are checking if input link is already present in the databse or not.if present already genereted code will diplay. otherwise else part will be executed.
 {
	$sql="SELECT * FROM bb WHERE long_url='$input_url'";
	$query=mysql_query($sql);
		while($row=mysql_fetch_array($query))
	{
		
		$l=$row['long_url']; 
		$s=$row['short_url']; 
		$c = $row['count']; 
		$b = $c+1;
		
		$countt="UPDATE bb set count='$b' WHERE long_url='$input_url'";
	$quee=mysql_query($countt) or die ('error');
	
		
            $full_url="localhost:10080/Url_shortner/index.php?id=".$l.$s;
         echo $full_url;
	}	
	 
		
 }
 else
 {
	 
	 $str=substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))),1,10);
  $count=0;
 $query ="insert into bb(long_url,short_url,count)values('$input_url','$str','$count')";
    
    mysql_query($query) or die(mysql_error());
     
     $sqll="SELECT * FROM bb WHERE long_url='$input_url'";
	$queryy=mysql_query($sqll);
     while($roww=mysql_fetch_array($queryy))
	{
		
		$ll=$roww['long_url'];
		$ss=$roww['short_url'];
		$cc = $roww['count'];
		$bb = $cc+1;
		
		$counttt="UPDATE bb set count='$bb' WHERE long_url='$input_url'";
	$queee=mysql_query($counttt) or die ('error');
	
		
            $url="localhost:8080/Url_shortner/index.php?id=".$ll.$ss;
         echo $url;
	}	
    
 }  

	
    
}
        /*end of if isset block*/
?>
</div>



   
    </div><!--end of panel body-->
  </div><!--end of container-->
  <h2>Top Accessed url</h2>
  <table class="table">
  <tr>
  <th>Url</th>
  <th>count</th>
  
  </tr>
  <?php 
  
  $select="SELECT * FROM bb ORDER BY count DESC";//query to dipslay database in descending order
  
  

  $query=mysql_query($select)or die('error in select');
  
while($row=mysql_fetch_array($query))
	{
	
		
		$oldurl=$row['short_url'];
		$count=$row['count'];
		
		$top_url="localhost:8080/Url_shortner/index.php?id=".$oldurl;
		
		
		
		?>
  		  <tr>
  <td><?php echo $top_url; ?></td>
  <td><?php echo $count; ?></td>
  

  
  </tr>
		
		<?php
	
		
		
	}
  ?>
  
  </table>


    



</body>
</html>















