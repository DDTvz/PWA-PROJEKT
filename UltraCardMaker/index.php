<?php
session_start();
include("scripts/db_connect.php");
//session_regenerate_id()

//rastaviti sekcije na nekoliko funkcija (create_section_new, _my_cards, _popular)

function display_new_cards($conn){
	$limit = 12;
	$sql = "SELECT * FROM all_cards ORDER BY card_created_at DESC LIMIT $limit";

	$result = mysqli_query($conn, $sql);

	if(!$result){
		echo "Query error: " . mysqli_error($conn);
		return;
	}

	//$cards_new = mysqli_fetch_all($result, MYSQLI_ASSOC);
	//return $cards_new;
	$i = 0;
//<img src='http://localhost/UltraCardMaker/res/placeholder/" . $row['card_img'] . "' class='' width='250px' height='250px'/>
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

function display_my_cards($conn, $user_id){
	$sql = "SELECT * FROM all_cards WHERE card_author = '$user_id'";

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

function display_popular_cards($conn){
	$sql = "SELECT * FROM all_cards ORDER BY likes LIMIT 5";

	$result = mysqli_query($conn, $sql);

	$cards_popular = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

}



?>




<!DOCTYPE html>
<html lang="en">

	<?php include('header.php') ?>


	<div class="container">
		<section>
			<div id="Naslov">
				<img src="" alt="">
				<h1>NEW</h1>
			</div>
			<div class="container justify-content-start text-center">
				<div class="row">
					<?php display_new_cards($conn); ?>
				</div>
			</div>
			<div class="container-fluid justify-content-end">
				<a href="explore.php" class="btn btn-info">View all</a>
			</div>
		</section>
		<section>
			<div id="Naslov">
				<img src="" alt="">
				<h1>My Cards if login</h1>
			</div>
			<div class="container justify-content-start text-center">
				<div class="row">
					<?php if(isset($_SESSION['username'])){
                        display_my_cards($conn, $_SESSION['username']); 
                    }else{
                        echo "<h2>You need to login in order to see your cards</h2>";
                    }
                        
                        ?>
				</div>
		</section>
		<!--<section>
			<div id="Naslov">
				<img src="" alt="">
				<h1>Popular/Community favorite</h1>
			</div>
			<div id="Konekcija sa bazom i render karata"></div>
			<div id="neki button poravnat desno koji je link na istraži više sa nekim novim upitom na bazu"></div>
		</section>-->
	</div>
	
	
	<?php include('footer.php') ?>
	<?php mysqli_close($conn); ?>
</html>