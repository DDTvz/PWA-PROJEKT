<?php

define('IMGSRCPATH','images/user_upload/');
session_start();

include("scripts/db_connect.php");

$cardData = $_POST;
if(isset($_POST['new_card'])){
    if(isset($_SESSION['card_id'])){
        new_card_creation($conn,$cardData);
    }
}

//kad je logout i želimo kreirati kartu Može se doraditi
if(!isset($_SESSION['card_id'])){
    new_card_creation($conn,$cardData);
}

$card_id = $_SESSION['card_id'];

//na refresh ostaju podaci forme DORADITI
if(isset($_POST['submit'])){
    //sve karte imaju ovo
    $card_title = $cardData['card_title'];
    $card_text = $cardData['card_text'];
    $card_serial_number = $cardData['card_serial_number'];
    $card_set_id = $cardData['card_set_id'];
    $card_copyright = $cardData['card_copyright'];

    $card_card_type = $cardData['card_card_type'];

    if($card_card_type == "monster" || $card_card_type == "pendulum"){
        $card_ATK = $cardData['card_ATK'];
        
        $card_attribute = $cardData['card_attribute'];
        $card_monster_type = $cardData['card_monster_type'];

        if($card_card_type == "monster"){
            $card_sub_card = $cardData['card_sub_card_monster'];

            if($card_sub_card == "link"){
                $card_link_rating = $cardData['card_link_rating'];
            }else{
                $card_level_rank = $cardData['card_level_rank'];
                $card_DEF = $cardData['card_DEF'];
            }
        }
        
        else{
            $card_DEF = $cardData['card_DEF'];   
            $card_sub_card = $cardData['card_sub_card_pendulum'];
            $card_level_rank = $cardData['card_level_rank'];

            $card_pscale_left = $cardData['card_pscale_left'];
            $card_pscale_right = $cardData['card_pscale_right']; 
            $card_pendulum_text = $cardData['card_pendulum_text'];
        }
    }
    elseif($card_card_type == "spell"){
        $card_sub_card = $cardData['card_sub_card_spell'];
    }
    else{
        $card_sub_card = $cardData['card_sub_card_trap'];
    }
    

}else{
    $card_title = "";
    $card_text = "";
    $card_serial_number = "";
    $card_set_id = "";
    $card_card_type = "";
    $card_copyright = "";

    $card_ATK = "";
    $card_DEF = "";
    $card_attribute = "";
    $card_monster_type = "";
    $card_sub_card = "";
    
    $card_level_rank = "";
    $card_link_rating = "";
    $card_pscale_left = "";
    $card_pscale_right = "";
    $card_pendulum_text = "";
}

if(isset($_POST['read_local_json'])){

}


//handle picture file
//$card_image = $_SESSION['username'] . $_FILES['card_image']['name'];
//$card_image_name = $_FILES['card_image']['name'];
//$card_image_type = $_FILES['card_image']['type'];
//$card_image_size = $_FILES['card_image']['size'];
//$card_image_tmp = $_FILES['card_image']['tmp_name'];
//$target_dir_user = 'images/user_upload/' . $card_image;
//move_uploaded_file($_FILES['card_image']['tmp_name'], $target_dir_user);



//exif_imagetype($target_dir_user); //returns constant value or false (2=JPEG,3=PNG,18=webp)

//pogledati AJAX na w3schools - Asynchronus JS and XML, to je za update stranice dok user upisuje podatke

////////    MASTER FUNKCIJE   ////////
function generate_card(){
    //generate card
    //generate stars
    //insert image
}
/* OVO MOŽE I SA JS, NEMA POTREBE SPAJANJA NA SERVER KADA ČITA SA RAČUNALA
function read_from_local_json(){ 
    $path_to_file = 
    $json_file = file_get_contents($path_to_file);
    $json_file_data = json_decode($json_file,1);
    return $json_file_data;
}*/

function save_server_json($jsonCard, $card_id, $conn){

    /*if(isset($_SESSION['username'])){
        $json_path = "json_cards/" . $_SESSION['username'] . "_" . $card_id . ".json";
    }
    else{
        $json_path = "json_cards/test_card" . $card_id . ".json";
    }*/
    //generate img?
    //creates file on the server
    $json_path = "json_cards/test_card" . $card_id . ".json";
    $card_title =  $_POST['card_title'] ?? "Not YET entered";

    $sql = "UPDATE all_cards SET card_title = '$card_title', card_data = '$json_path' WHERE card_id = '$card_id'";
    mysqli_query($conn,$sql);

    file_put_contents($json_path, $jsonCard);

}

function save_on_server(){

    //generate JSON file
    //generate img
    //connect to database
    //write to database
    //echo to user that it is succesful

}

function publish_card(){

    //generate JSON file
    //generate img
    //validate, otherwise quit
    //connect to database
    //write to database
    //echo to user that it is succesful
    //header index.php?

}


////////    SUPPORT FUNKCIJE   ////////

//stvara novi zapis u bazi i samim time kreira novu kartu MOŽE SE POPRAVITI
function new_card_creation($conn, $cardData){
    $author = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest User";
    $jsonCard = generate_json_file($cardData);
    

    $insert_sql = "INSERT INTO all_cards(card_title, card_author) VALUES ('Not YET entered','$author')";
    $result = mysqli_query($conn, $insert_sql);

    if($result){
        $card_id = mysqli_insert_id($conn);
        save_server_json($jsonCard, $card_id, $conn);
        $_SESSION['card_id'] = $card_id;
        return; // $card_id;
    }
    else{
        echo "Query error: " . mysqli_error($conn);
    }
    
    
}


//generira json file na serveru
function generate_json_file($cardData){
    $card_author = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest User";


    $card_title = $cardData['card_title'] ?? "" ;
    $card_text = $cardData['card_text'] ?? "" ;
    $card_serial_number = $cardData['card_serial_number'] ?? "" ;
    $card_set_id = $cardData['card_set_id'] ?? "" ;
    $card_copyright = $cardData['card_copyright'] ?? "" ;

    $card_card_type = $cardData['card_card_type'] ?? "" ;

    if($card_card_type == "monster" || $card_card_type == "pendulum"){
        $card_ATK = $cardData['card_ATK'];
        
        $card_attribute = $cardData['card_attribute'];
        $card_monster_type = $cardData['card_monster_type'];

        if($card_card_type == "monster"){
            $card_sub_card = $cardData['card_sub_card_monster'];

            if($card_sub_card == "link"){
                $card_link_rating = $cardData['card_link_rating'];
            }else{
                $card_level_rank = $cardData['card_level_rank'];
                $card_DEF = $cardData['card_DEF'];
            }
        }
        
        else{
            $card_DEF = $cardData['card_DEF'];   
            $card_sub_card = $cardData['card_sub_card_pendulum'];
            $card_level_rank = $cardData['card_level_rank'];

            $card_pscale_left = $cardData['card_pscale_left'];
            $card_pscale_right = $cardData['card_pscale_right']; 
            $card_pendulum_text = $cardData['card_pendulum_text'];
        }
    }
    else if($card_card_type == "spell"){
        $card_sub_card = $cardData['card_sub_card_spell'];
    }
    else if($card_card_type == "trap"){
        $card_sub_card = $cardData['card_sub_card_trap'];
    }
    else{
        $card_sub_card = "none";
    }



    $arrayCard = array(
        'card_title' => $card_title ?? "",
        'card_text' => $card_text ?? "",
        'card_ATK' => $card_ATK ?? "",
        'card_DEF' => $card_DEF ?? "",
        'card_serial_number' => $card_serial_number ?? "",
        'card_set_id' => $card_set_id ?? "",
        'card_attribute' => $card_attribute ?? "",
        'card_monster_type' => $card_monster_type ?? "",
        'card_sub_card' => $card_sub_card ?? "",
        'card_card_type' => $card_card_type ?? "",
        'card_level_rank' => $card_level_rank ?? "",
        'card_link_rating' => $card_link_rating ?? "",
        'card_pendulum_text' => $card_pendulum_text ?? "",
        'card_pscale_left' => $card_pscale_left ?? "",
        'card_pscale_right' => $card_pscale_right ?? "",
        'card_copyright' => $card_copyright ?? "",
        'card_author' => $card_author
    );

    //generate JSON file
    $jsonCard = json_encode($arrayCard, JSON_PRETTY_PRINT);

    return $jsonCard;
}

//download file na računalo kao user sa servera
function download_json_file_locally($cardData){
    generate_json_file($cardData);
    $filename = 'json_cards/test_card' . $_SESSION['card_id'] .'.json';
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

function showURLfromJS(){
    echo $_POST['urlfromjs'] ;
}

if(isset($_POST['urlfromjs'])){
    showURLfromJS();
}


////////    FUNKCIONALNOST: DOWNLOAD-SAVE-PUBLISH   ////////

//Nije još u funkciji
if(!empty($_SESSION['username'])){
    if(isset($_POST['save_on_server'])){
        save_on_server();
    }
    if(isset($_POST['publish'])){
        publish_card();
    }
}
//možda u else?
if(isset($_POST['save_on_server']) || isset($_POST['publish'])){
    echo "You need to be logged-in in order to save or publish your card on the server!" ;
}

//OVO RADI
//spremi na server JSON 
if(isset($_POST['submit'])){
    $jsonCard = generate_json_file($cardData);

    save_server_json($jsonCard, $card_id,$conn);
}

//preuzmi JSON sa servera
//header funkcija koja se nalazi unutar download funkcije MORA BITI ISPRED bilo kakvog ispisa na stranicu
if(isset($_POST['local_json'])){
    download_json_file_locally($cardData);
}

?>


<?php 
?>

<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="jquery-1.11.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="js/cardCreationValidation.js"></script> 
<script src="js/cardCanvasGenerator.js"></script> 
<script src="js/html2canvas.min.js"></script> 


<?php include('header.php'); ?>

<section class="container bg-black text-light">
    <h1 class="text-center">Create New Card</h1>
    <div class="row p-5">
        <div class="col text-dark">
            <p>Generated image through canvas with JavaScript - PHP is not necessary and is too slow</p>
            <div id="GENERATEDCARD">
                
                <img id="CardCardType" src="res/cards/cardNormalMonster.png" alt="Not able to load image">
                <img id="CardAttribute" src="res/other/Dark.png" alt="Not able to load image">
                <!--for loop-->
                <div id="CardLevelRank" class="row justify-content-end">
                </div>
                
                <span id="CardTitle"></span>
                <img id="CardImage" src="res/placeholder/mokey_mokey.jpg" alt="Not able to load image">
                <span id="CardSet"></span>
                <span id="CardMonsterType"></span>
                <span id="CardText"></span>
                <span id="CardPendulumText"></span>
                <span id="CardPendulumLeft"></span>
                <span id="CardPendulumRight"></span>
                <span id="CardATK"></span>
                <span id="CardDEF"></span>
                <span id="CardLinkRating"></span>
                <span id="CardSerialNum"></span>
                <span id="CardCopyright"></span>

            </div>
            
        </div>

        <div class="col bg-dark text-light">
        <form name="create_card" enctype="multipart/form-data" action="cardBuilder.php" method="post">
            <div class="m-3 p-2">
                <label for="card_title">Title</label>
                <input type="text" name="card_title" id="card_title" class="bg-dark-subtle" onkeyup="generateCardText()" value="<?php if(isset($card_title)){echo $card_title ;} ?>"/>
            </div>
            <div id="div-card-atk-def" class="m-3 p-2 row">
                <div id="div-card-atk" class="col">
                    <label for="card_ATK">ATK</label>
                    <input type="text" name="card_ATK" id="card_ATK" maxlength="4" class="bg-dark-subtle" onkeyup="generateCardText()" value="<?php if(isset($card_ATK)){echo $card_ATK ;} ?>" />
                </div>
                <div id="div-card-def" class="col">
                    <label for="card_DEF">DEF</label>
                    <input type="text" name="card_DEF" id="card_DEF" maxlength="4" class="bg-dark-subtle" onkeyup="generateCardText()" value="<?php if(isset($card_DEF)){echo $card_DEF ;} ?>" />
                </div>
            </div>
            <div class="m-3 p-2">
                <label for="card_serial_number">Serial Number</label>
                <input type="text" name="card_serial_number" class="bg-dark-subtle" maxlength="8" onkeyup="generateCardText()" id="card_serial_number" value="<?php if(isset($card_serial_number)){echo $card_serial_number ;} ?>" />

                <label for="card_set_id">Set</label>
                <input type="text" name="card_set_id" id="card_set_id" class="bg-dark-subtle" maxlength="10" onkeyup="generateCardText()" value="<?php if(isset($card_set_id)){echo $card_set_id ;} ?>" />
            </div>
            <div class="m-3 p-2">
                <p><label for="card_text">Card TEXT</label></p>
                <textarea  name="card_text" class="bg-dark-subtle" id="card_text" cols="50" rows="5" onkeyup="generateCardText()"><?php if(isset($card_text)){echo $card_text ;} ?></textarea>
            </div>
            <div id="div-card-monster-type" class="m-3 p-2">
                <label for="card_monster_type">Monster Type</label>
                <input type="text" name="card_monster_type" id="card_monster_type" class="bg-dark-subtle" onkeyup="generateCardText()" value="<?php if(isset($card_monster_type)){echo $card_monster_type ;} ?>"/>
            </div>
            <div class="m-3 p-2">
                <label for="card_image">Card Image</label>
                <input type="file" name="card_image" id="card_image" class="bg-dark-subtle" accept=".jpg, .jpeg, .png, .svg, .webp" onchange="previewFile()">
            </div>
            <div id="div-card-level-attribute" class="m-3 p-2 row">
                <div id="div-card-level-rank" class="col">
                    <label for="card_level_rank">Level/Rank </label>
                    <select name="card_level_rank" id="card_level_rank" class="bg-dark-subtle" onchange="generateCardLevelRank()">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4" selected>4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col">
                    <label for="card_attribute">Attribute</label>
                    <select name="card_attribute" id="card_attribute" class="bg-dark-subtle" onchange="generateCardAttribute()">
                        <option value="dark" selected>Dark</option>
                        <option value="divine">Divine</option>
                        <option value="earth">Earth</option>
                        <option value="fire">Fire</option>
                        <option value="light">Light</option>
                        <option value="water">Water</option>
                        <option value="wind">Wind</option>      
                    </select>
                </div>
            </div>

            <div class="m-3 p-2 row">
                <div class="col">
                    <label for="card_card_type">Card Type</label>
                    <select name="card_card_type" id="card_card_type" class="bg-dark-subtle" onchange="generateCardType()">
                        <option value="monster" selected>Monster</option>
                        <option value="pendulum">Pendulum</option>
                        <option value="spell">Spell</option>
                        <option value="trap">Trap</option>   
                    </select>
                </div>

                <div class="col" id="div-card-sub-card-spell">
                    <label for="card_sub_card_spell">Spell Sub-Type</label>
                    <select name="card_sub_card_spell" id="card_sub_card_spell"  class="bg-dark-subtle" onchange="generateSpellCardSubType()">
                        <option value="none" hidden>None</option>
                        <option value="normal" selected>Normal</option>
                        <option value="continuous">Continuous</option>
                        <option value="equip">Equip</option>
                        <option value="field">Field</option>
                        <option value="quick_play">Quick-Play</option>
                        <option value="ritual">Ritual</option>
                    </select>
                </div>

                <div class="col" id="div-card-sub-card-trap">
                    <label for="card_sub_card_trap">Trap Sub-Type</label>
                    <select name="card_sub_card_trap" id="card_sub_card_trap" class="bg-dark-subtle" onchange="generateTrapCardSubType()">
                        <option value="none" hidden>None</option>
                        <option value="normal" selected>Normal</option>
                        <option value="continuous">Continuous</option>
                        <option value="counter">Counter</option>
                    </select>
                </div>

                <div class="col" id="div-card-sub-card-monster">
                    <label for="card_sub_card_monster">Monster Sub-Type</label>
                    <select name="card_sub_card_monster" id="card_sub_card_monster" class="bg-dark-subtle" onchange="generateMonsterCardSubType()">
                        <option value="none" hidden>None</option>
                        <option value="normal" selected>Normal</option>
                        <option value="effect">Effect</option>
                        <option value="ritual">Ritual</option>
                        <option value="fusion">Fusion</option>
                        <option value="synchro">Synchro</option> 
                        <option value="xyz">XYZ</option>       
                        <option value="link">Link</option>   
                    </select>
                </div>

                <div class="col" id="div-card-sub-card-pendulum">
                    <label for="card_sub_card_pendulum">Pendulum Sub-Type</label>
                    <select name="card_sub_card_pendulum" id="card_sub_card_pendulum" class="bg-dark-subtle" onchange="generatePendulumMonsterCardSubType()">
                        <option value="none" hidden>None</option>
                        <option value="normal" selected>Normal</option>
                        <option value="effect">Effect</option>
                        <option value="ritual">Ritual</option>
                        <option value="fusion">Fusion</option>
                        <option value="synchro">Synchro</option> 
                        <option value="xyz">XYZ</option>
                    </select>
                </div>

            </div>
            
            <div id="div-card-pendulum-text" class="m-3 p-2">
                <p><label for="card_pendulum_text">Card Pendulum TEXT</label></p>
                <textarea  name="card_pendulum_text" id="card_pendulum_text" class="bg-dark-subtle" cols="50" rows="4" onkeyup="generateCardText()" ><?php if(isset($card_text)){echo $card_pendulum_text ;} ?></textarea>
            </div>
            <div id="div-pendulum-scale-link-rating" class="m-3 p-2 row">
                <div id="div-link-rating" class="col">
                    <label for="card_link_rating">Link Rating</label>
                    <input type="text" name="card_link_rating" id="card_link_rating" class="bg-dark-subtle" maxlength="1" onchange="generateCardText()" value="<?php if(isset($card_link_rating)){echo $card_link_rating ;} ?>"/>
                </div>

                <div id="div-pendulum-scale-left" class="col">
                    <label for="card_pscale_left">Left Scale</label>
                    <input type="text" name="card_pscale_left" id="card_pscale_left" class="bg-dark-subtle" maxlength="2" onchange="generateCardText()" value="<?php if(isset($card_pscale_left)){echo $card_pscale_left ;} ?>"/>
                </div>

                <div id="div-pendulum-scale-right" class="col">
                    <label for="card_pscale_right">Right Scale</label>
                    <input type="text" name="card_pscale_right" id="card_pscale_right" class="bg-dark-subtle" maxlength="2" onchange="generateCardText()" value="<?php if(isset($card_pscale_right)){echo $card_pscale_right ;} ?>"/>
                </div>
            </div>
            <div class="m-3 p-2">
                <label for="card_copyright">Copyright</label>
                <input type="text" name="card_copyright" id="card_copyright" class="bg-dark-subtle" onkeyup="generateCardText()" value="<?php // if(isset($card_monster_type)){echo $card_monster_type ;} ?>"/>
            </div>
            <div class="m-3 p-2">
                <input type="button" name="downloadjpg" value="DOWNLOAD IMAGE AS JPG" class="btn btn-primary text-light" onclick="PrintDiv()">
            </div>
            <div class="m-3 p-2">
                <div class="m-3">
                    <input type="submit" name="submit" value="GENERATE SERVER JSON" class="btn btn-warning">
                </div>
                <div class="m-3">
                    <input type="submit" name="local_json" value="DOWNLOAD LOCAL JSON" class="btn btn-success">
                </div>
               <!--Javascript <div class="m-3">
                    <input type="submit" name="read_local_json" value="READ FROM LOCAL JSON" class="btn btn-success">
                </div> -->
                <div class="m-3">
                    <input type="submit" name="new_card" value="CREATE BRAND NEW CARD" class="btn btn-danger">
                </div>
                <!-- Not done yet
                <div class="m-3">
                    <input type="file" name="loadLocalJSON" id="loadLocalJSON" onchange="test()" value="LOAD FROM LOCAL JSON" class="btn btn-info-subtle">
                </div>
                -->
            </div>

            

        </form>
    </div>
</section>

<!-- nakon što je forma napravljena pokrene se skripta koja postavlja kao default normal monster stvorenje, a ne učitava cijelu formu -->
<script>generateCardType();</script>

<?php include('footer.php'); ?>


</html>