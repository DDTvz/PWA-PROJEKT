<?php
session_start();
include("scripts/db_connect.php");


function display_my_cards($conn){
	$sql = "SELECT * FROM all_cards ORDER BY card_created_at DESC ";

	$result = mysqli_query($conn, $sql);

    if(!$result){
		echo "Query error: " . mysqli_error($conn);
		return;
	}

	$i = 0;

	while($i < mysqli_num_rows($result)){
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo "<div class='col-2'>
			<a href='http://localhost/UltraCardMaker/openCard.php?card_id=" .$row['card_id']. "' style='text-decoration: none'>

				
				<img src='http://localhost/UltraCardMaker/res/placeholder/bls.jpg' class='img-fluid' width='250px' height='250px'/>
				<h3>Card Title: " . $row['card_title'] . "</h3>
				<p>Card Author: " . $row['card_author'] . "</p>
				<p>Card published at: " . $row['card_created_at'] . "</p>
				<p>Card likes: " . $row['card_likes'] . "</p>
				<p>Card id: " . $row['card_id'] . "</p>
			</a>
			</div>";

		$i++;
	}

	mysqli_free_result($result);

}

?>


<!DOCTYPE html>
<html lang="en">

<?php include('header.php'); ?>

<div class="container">
		<section>
			<div id="Naslov">
				<img src="" alt="">
				<h1>All Cards EVER MADE</h1>
			</div>
			<div class="container justify-content-start text-center">
				<div class="row">
					<?php display_my_cards($conn,); ?>
				</div>
			</div>
		</section>

	</div>

<?php include('footer.php'); ?>
<?php mysqli_close($conn); ?>
</html>