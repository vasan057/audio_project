 <?php
$servername = "localhost";
$username = "root";
$password = "password";
$db1="stressfit_live";
$db2="stressfit_live_new";
$con1=mysqli_connect("localhost",$username,$password,$db1);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$con2=mysqli_connect("localhost",$username,$password,$db2);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //read old db 
  	$sql = "SELECT * FROM sf_articles";
	$result = $con1->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        
	        $row['category'] = ucwords($row['category']);
	        $chk = "SELECT * FROM `article_category` WHERE `title` = '".$row['category']."'";
	        $article_category = $con2->query($chk);
	        if ($article_category->num_rows <= 0)
	        {
		        $ins = "INSERT INTO `article_category` (`id`, `title`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '".$row['category']."', '1', '1', '1', now(), now(), NULL)";
		        mysqli_query($con2,$ins);
		        $chk = "SELECT * FROM `article_category` WHERE `title` = '".$row['category']."'";
	        	$article_category = $con2->query($chk);
	    	}


	    	$row['essence'] = ucwords($row['essence']);
	        $chk = "SELECT * FROM `article_essence` WHERE `title` = '".$row['essence']."'";
	        $article_essence = $con2->query($chk);
	        if ($article_essence->num_rows <= 0)
	        {
		        $ins = "INSERT INTO `article_essence` (`id`, `title`, `active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '".$row['essence']."', '1', '1', '1', now(), now(), NULL)";
		        mysqli_query($con2,$ins);
		        $chk = "SELECT * FROM `article_essence` WHERE `title` = '".$row['essence']."'";
	        	$article_essence = $con2->query($chk);
	    	}
	    	//print_r($article_category->fetch_assoc()['id']);

	        $chk = "SELECT * FROM `articles` WHERE `title` = '".$row['title']."'";
	        $articles = $con2->query($chk);
	        if ($articles->num_rows <= 0)
	        {
	        	$slug=str_replace(' ', '_', strtolower($row['title']));
	        	$short_description = mysqli_real_escape_string($con2, $row['short_description']);
	        	$description = mysqli_real_escape_string($con2, $row['description']);
	        	 $ins =  "INSERT INTO `articles` (`id`, `title`, `slug`, `active`, `approved`, `short_description`, `description`, `author`, `isfree`, `recommended`, `category_id`, `essence_id`, `cover_img`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) 
	        	VALUES (NULL, 
	        		'".$row['title']."', 
	        		'".$slug."', 
	        		'1', 
	        		'1', 
	        		'".$short_description."', 
	        		'".$description."', 
	        		'".$row['author']."', 
	        		'1', 
	        		'1', 
	        		'".$article_category->fetch_assoc()['id']."', 
	        		'".$article_essence->fetch_assoc()['id']."', 
	        		'dfbdfb', 
	        		'1', 
	        		'1', 
	        		now(), 
	        		now(), 
	        		NULL)";

		        mysqli_query($con2,$ins);

		        //echo $ins; die;
		        $article_id = mysqli_insert_id($con2);
	    	}
	    	//echo $article_id;
	    	$chk = "SELECT * FROM `sf_articles_cover` WHERE `article_id` = '".$row['id']."'";
	        $articles_cover = $con1->query($chk);
	        if ($articles_cover->num_rows > 0)
	        {
	        	$update = "UPDATE `articles` SET `cover_img` = '".$articles_cover->fetch_assoc()['image_url']."', `deleted_at` = NULL WHERE `articles`.`id` = '".$article_id."'";
		        mysqli_query($con2,$update);	        	
	    	}


	    }
	} else {
	    echo "0 results";
	}
	echo "done";
?> 