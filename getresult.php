<?php
$q = $_GET['q'];
$searchby = $_GET['searchby'];
$con = mysqli_connect('localhost','root','root','ppc');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ppc");
$sql = "";
$sql_poem = "";
if($searchby == "author") {
	$sql="SELECT * FROM poet WHERE poet_id = '" . $q . "%'";
}
else if ($searchby == "keyword") {
	$sql="SELECT * FROM poet WHERE poet_fullname LIKE '%".$q."%'";
	$sql .= " OR poet_birth = '".$q."' OR poet_death = '".$q."' OR poet_biography LIKE '%".$q."%'";
	$sql .= " OR poet_work_achived LIKE '%".$q."%'";
}
$result = mysqli_query($con,$sql);
if($searchby == "title" || $searchby == "keyword") {
	$sql_poem="SELECT * FROM poet INNER JOIN poem ON poet.poet_id = poem.poet_id WHERE poem_id = '".$q."'";
}
else if($searchby == "keyword") {
	$sql_poem="SELECT * FROM poet INNER JOIN poem ON poet.poet_id = poem.poet_id WHERE poet_fullname LIKE '%".$q."%'";
	$sql_poem .= " OR poet_birth = '".$q."' OR poet_death = '".$q."' OR poet_biography LIKE '%".$q."%'";
	$sql_poem .= " OR poet_work_achived LIKE '%".$q."%' OR poem_title LIKE '%".$q."%' OR poem_context LIKE '%".$q."%'";
}
$result_poem = mysqli_query($con,$sql_poem);

if ((mysqli_num_rows($result) == 0) && (mysqli_num_rows($result_poem) == 0)){
	echo "<p class='result'>Result not found.</p>";
}
else {
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			//$id = $row['poet_firstname'] . $row['poet_lastname'];
			$id = "poet" . $row['poet_id'];
			$fullname = $row['poet_fullname'];
		  	$date = $row['poet_birth'];
		  	if($row['poet_death'] != '') {
		  		$date .= "-" . $row['poet_death'];
		  	}
		  	$highlight = $row['poet_highlight'];
		  	$biography = $row['poet_biography'];
		  	$work_achived = $row['poet_work_achived'];
		  	$images = $row['poet_images'];

		  	echo "<div class='showPoet'>";
		  	echo "<a href='#".$id."'>" . $fullname . "</a>";

		  	echo "<p>" . $date . "</p>";
		  	echo "<p>" . $highlight . "</p>";
		  	echo "</div>";
		  	echo "<div class='modal' id='" . $id . "'>";
		  	echo "<article>";
			echo "<img src='" . $images . "' style= 'width: 100px; height: 100px'>";
			echo "<h1>" . $fullname . "</h1>";
			echo "<h3>" . $date . "</h3>";
			echo "<br><br>";
			echo "<section>";
			echo "<h2>Biography</h2>";
		    echo $biography;
			echo "</section>";
			echo "<section id='archive'>";
			echo "<h2>Works Archived</h2>";
			echo "<p>$work_achived</p>";
			echo "</section>";
			echo "<section>";
			echo "<h2>Images Gallery for Carl Sandburg</h2>";
			echo "<p>Thumbnails Go HERE!</p>";
			echo "</section>";
			echo "</article>";
			echo "</div>";
		}
	}
	if(mysqli_num_rows($result_poem) > 0) {
		while($row = mysqli_fetch_array($result_poem)) {
			$id = "poem" . $row['poem_id'];
			$title = $row['poem_title'];
			$author = 'by ' . $row['poet_fullname'];
		  	$highlight = $row['poem_highlight'];
		  	$context = $row['poem_context'];

		  	echo "<div class='showPoem'>";
		  	echo "<a href='#".$id."'>" . $title . "</a>";
		  	echo "<p>" . $author . "</p>";
		  	echo "<p>" . $highlight . "</p>";
		  	echo "</div>";
		  	echo "<div class='modal' id='" . $id . "'>";
		  	echo "<section>";
     		echo "<h2 style='margin-bottom:1px;'>" . $title . "</h2>";
     		echo "<h3>" . $author . "</h3></section>";
     
			echo "<section>" . $context . "</section>";   
			echo "</div>";
		}
	}
}

mysqli_close($con);
?>