<?php
session_start();

$opened_card_id = $_GET['card_id'];
$card_found = false;

include("scripts/db_connect.php");

$get_card_sql = "SELECT * FROM all_cards WHERE card_id=$opened_card_id";
$result = mysqli_query($conn, $get_card_sql);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //open generated image

    //read data from json and display
    $json_file = file_get_contents("json_cards/test_card". $opened_card_id . ".json");
    $json_file_data = json_decode($json_file,1);

    $card_found = true;
}
else{
    $card_found = false;
}

if($card_found && isset($_GET['local_json'])){
    download_json_file_locally();
}

function download_json_file_locally(){
    $filename = 'json_cards/test_card' . $_GET['card_id'] .'.json';
    echo $filename;

    if (file_exists($filename)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($filename));
	    readfile($filename);
	exit;
}
}

?>


<!DOCTYPE html>
<html lang="en">

<script type="text/javascript" src="js/openCard.js"></script> 

<?php include('header.php'); ?>
<?php if($card_found){ ?>
<section class="container bg-black text-light">
    <h1 class="text-center">Opened Card: <?php echo $row['card_title'];?></h1>
    <h2 class="text-center">Made by: <?php echo $row['card_author'];?></h2>  
    <div class="row p-5 ">
        <div class="col">
            <p>Image loaded from server generatedImages/usernameId.jpg</p>
            <img src="res/cards/cardPlaceholder.png" alt="Generated image through canvas">
        </div>

        <div class="col">
        <!--<form name="forma" action="#" method="get">
        <input type="text" name="card_sub_card" id="card_sub_card" value="<?php echo $json_file_data['card_sub_card']; ?>">
        <input type="text" name="card_card_type" id="card_card_type" value="<?php echo $json_file_data['card_card_type']; ?>">
        </form>-->
            <div id="" class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Title</span>
                <span class=""><?php echo $json_file_data['card_title']; ?></span>
            </div>

            <div id="div-atk-def" class="m-3 p-2 row bg-dark text-light">
                <div id="div-atk" class="col">
                    <span class="text-secondary">ATK</span>
                    <span class="openCardText"><?php echo $json_file_data['card_ATK']; ?></span>
                </div>
                <div d="div-def" class="col">
                    <span class="text-secondary">DEF</span>
                    <span class="openCardText"><?php echo $json_file_data['card_DEF']; ?></span>
                </div>
                

                
            </div>

            <div class="m-3 p-2 bg-dark text-light row">
                <div class="col">
                    <span class="text-secondary">Serial Number</span>
                    <span class="openCardText"><?php echo $json_file_data['card_serial_number']; ?></span>
                </div>
                <div class="col">
                    <span class="text-secondary">Set</span>
                    <span class="openCardText"><?php echo $json_file_data['card_set_id']; ?></span>
                </div>
                    

                    
            </div>

            <div class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Card Text</span>
                <p class="openCardText"><?php echo $json_file_data['card_text']; ?></p>
            </div>

            <div id="div-monster-type" class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Monster Type</span>
                <span class="openCardText"><?php echo $json_file_data['card_monster_type']; ?></span>
            </div>

            <div id="div-level-attribute" class="m-3 p-2 bg-dark text-light row">
                <div id="div-level" class="col">
                    <span class="text-secondary">Level/Rank</span>
                    <span class="openCardText"><?php echo $json_file_data['card_level_rank']; ?></span>
                </div>
                <div id="div-attribute" class="col">
                    <span class="text-secondary">Card Attribute</span>
                    <span class="openCardText"><?php echo $json_file_data['card_attribute']; ?></span>
                </div>
                

                
            </div>

            <div class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Card Type</span>
                <span id="csc" class="openCardText"><?php echo $json_file_data['card_sub_card']; ?></span>
                <span id="cct" class="openCardText"><?php echo $json_file_data['card_card_type']; ?></span>
            </div>

            <div id="div-pendulum-text" class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Card Pendulum Text</span>
                <p class="openCardText"><?php echo $json_file_data['card_pendulum_text']; ?></p>
            </div>

            <div id="div-link-scale" class="m-3 p-2 bg-dark text-light row">
                <div id="div-link-rating" class="col">
                    <span class="text-secondary">Link Rating</span>
                    <span class="openCardText"><?php echo $json_file_data['card_link_rating']; ?></span>
                </div>
                <div id="div-left-scale" class="col">
                    <span class="text-secondary">Left Scale</span>
                    <span class="openCardText"><?php echo $json_file_data['card_pscale_left']; ?></span>
                </div>
                <div id="div-right-scale" class="col">
                    <span class="text-secondary">Right Scale</span>
                    <span class="openCardText"><?php echo $json_file_data['card_pscale_right']; ?></span>
                </div>
                
                
            </div>
            <div class="m-3 p-2 bg-dark text-light">
                <span class="text-secondary">Copyright</span>
                <span class="openCardText"><?php echo $json_file_data['card_copyright']; ?></span>
            </div>

            <!-- zašto ova forma? zbog get metode, tako da nije error kada proba ponovo refresh stranicu zato što bez id ne može prikazati podatke-->
            <form enctype="multipart/form-data" action="http://localhost/UltraCardMaker/openCard.php?card_id=<?php echo $opened_card_id;?>" method="get">
            <div class="m-3 p-2">
                <div class="m-3">
                    <input type="submit" name="local_json" value="DOWNLOAD LOCAL JSON" class="btn btn-info">
                    <input type="number" name="card_id" value="<?php echo $opened_card_id ?>" hidden/>
                </div>
                <!--<div class="m-3">
                    <input type="submit" name="local_image" value="DOWNLOAD LOCAL IMAGE" class="btn btn-success" disabled>
                </div>-->
            </div>

            

        
    </div>
</section>
<script> showCard(); </script>
<?php }else{?>
    <div class="container text-center">
        <p>Sorry, we weren't able to find the card you were looking for.</p>
        <p>No such card exists with Card id: <?php echo $_GET['card_id']; ?></p>
    </div>
<?php } ?>

<?php include('footer.php'); ?>
    

</html>