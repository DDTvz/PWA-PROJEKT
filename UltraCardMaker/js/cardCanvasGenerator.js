//document.getElementById("BODY").addEventListener("load", generateCardText());
//window.onload = generateMonsterCard();


//NOT WORKING FOR SOME REASON????
//LEVEL and MONSTER TYPE
const divCardLevelAttribute = document.getElementById("div-card-level-attribute");
const divCardLevelRank = document.getElementById("div-card-level-rank");
const divCardLevelRankImage = document.getElementById("CardLevelRank");

divCardMonsterType = document.getElementById("div-card-monster-type");
divCardMonsterTypeImage = document.getElementById("CardMonsterType");

//PENDULUM and LINK
divPendulumScaleLinkRating = document.getElementById("div-pendulum-scale-link-rating");

divCardPendulumText = document.getElementById("div-card-pendulum-text");
divCardPendulumTextImage = document.getElementById("CardPendulumText");

divCardPendulumLeft = document.getElementById("div-pendulum-scale-left");
divCardPendulumLeftmage = document.getElementById("CardPendulumLeft");

divCardPendulumRight= document.getElementById("div-pendulum-scale-right");
divCardPendulumRightImage = document.getElementById("CardPendulumRight");

divLinkRating = document.getElementById("card_link_rating");
divLinkRatingImage = document.getElementById("CardLinkRating");

//ATK and DEF
divCardATKDEF = document.getElementById("div-card-atk-def");

divCardATK= document.getElementById("div-card-atk");
divCardATKImage = document.getElementById("CardATK");

divCardDEF = document.getElementById("div-card-def");
divCardDEFImage = document.getElementById("CardDEF");

//Sub-types
let divSubCardMonster = document.getElementById("div-card-sub-card-monster");
let divSubCardPendulum = document.getElementById("div-card-sub-card-pendulum");
let divSubCardSpell = document.getElementById("div-card-sub-card-spell");
let divSubCardTrap = document.getElementById("div-card-sub-card-trap");


var varURLtoPHP = "";

function generateCardText(){

    document.getElementById("CardSet").innerHTML = document.getElementById("card_set_id").value;

    document.getElementById("CardMonsterType").innerHTML = document.getElementById("card_monster_type").value;

    document.getElementById("CardText").innerHTML = document.getElementById("card_text").value;

    document.getElementById("CardTitle").innerHTML = document.getElementById("card_title").value;

    document.getElementById("CardPendulumText").innerHTML = document.getElementById("card_pendulum_text").value;

    document.getElementById("CardPendulumLeft").innerHTML = document.getElementById("card_pscale_left").value;

    document.getElementById("CardPendulumRight").innerHTML = document.getElementById("card_pscale_right").value;

    document.getElementById("CardATK").innerHTML = document.getElementById("card_ATK").value;

    document.getElementById("CardDEF").innerHTML = document.getElementById("card_DEF").value;

    document.getElementById("CardLinkRating").innerHTML = document.getElementById("card_link_rating").value;

    document.getElementById("CardSerialNum").innerHTML = document.getElementById("card_serial_number").value;

    document.getElementById("CardCopyright").innerHTML = document.getElementById("card_copyright").value;

}

function generateCardAttribute(){
    var attribute = document.getElementById("card_attribute").value;

    switch (attribute){
        case "dark":
            document.getElementById('CardAttribute').src = "res/other/Dark.png";
            break;

        case "divine":
            document.getElementById('CardAttribute').src = "res/other/Divine.png";
            break;

        case "earth":
            document.getElementById('CardAttribute').src = "res/other/Earth.png";
            break;

        case "fire":
            document.getElementById('CardAttribute').src = "res/other/Fire.png";
            break;

        case "light":
            document.getElementById('CardAttribute').src = "res/other/Light.png";
            break;

        case "water":
            document.getElementById('CardAttribute').src = "res/other/Water.png";
            break;

        case "wind":
            document.getElementById('CardAttribute').src = "res/other/Wind.png";
            break;

        default:
            document.getElementById('CardAttribute').src = "res/other/Divine.png";
            break;
    }
}





//generate canvas image and download on user computer
function PrintDiv()
{   
    html2canvas(document.getElementById("GENERATEDCARD")).then(function(canvas) {
            var myImage = canvas.toDataURL();
            downloadURI(myImage, "UltraCardMakerImage.jpg");});
}

function downloadURI(uri, name) {
    var link = document.createElement("a");

    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();   
    //after creating link you should delete dynamic link
    clearDynamicLink(link); 
}

//render image file from user computer
function previewFile() {
    const preview = document.getElementById("CardImage");
    const file = document.getElementById("card_image").files[0];
    const reader = new FileReader();
  
    reader.addEventListener(
      "load",
      () => {
        // convert image file to base64 string
        preview.src = reader.result;
      },
      false,
    );
  
    if (file) {
      reader.readAsDataURL(file);
    }
  }



function generateCardLevelRank(){

    var level = document.getElementById("card_level_rank").value;
    var divLevelRank = document.getElementById("CardLevelRank");
    divLevelRank.replaceChildren();

    if(document.getElementById("card_sub_card_monster").value == "xyz" || document.getElementById("card_sub_card_pendulum").value == "xyz"){
        imgSrc = "res/other/Rank.png";
        divLevelRank.classList.remove("justify-content-end");
        divLevelRank.classList.add("justify-content-start");
    }else{
        imgSrc = "res/other/Star.png";
        divLevelRank.classList.remove("justify-content-start");
        divLevelRank.classList.add("justify-content-end");
    }

    for (let i = 0; i < level; i++) {
        var levelImg = document.createElement("img");
        levelImg.src = imgSrc;
        levelImg.classList.add("STAR");
        var insideDiv = document.createElement("div");
        insideDiv.classList.add("col-1");

        divLevelRank.appendChild(insideDiv).appendChild(levelImg);
      }
}

function fixImageStyle(){

    if(document.getElementById("card_card_type").value == "pendulum"){
        document.getElementById("CardImage").style.width = "369px";
        document.getElementById("CardImage").style.height = "274px";
        document.getElementById("CardImage").style.top = "110px";
        document.getElementById("CardImage").style.left = "26px";
    }
    else{
        document.getElementById("CardImage").style.width = "325px";
        document.getElementById("CardImage").style.height = "323px";
        document.getElementById("CardImage").style.top = "111px";
        document.getElementById("CardImage").style.left = "48px";
    }
}

function fixTitleColor(color){
    document.getElementById("CardTitle").classList.remove("text-light");
    document.getElementById("CardTitle").classList.remove("text-dark");
    document.getElementById("CardTitle").classList.add(color);
}

function fixCardText(){
    var cardType = document.getElementById("card_card_type").value;

    if(cardType == "spell" || cardType == "trap"){
        document.getElementById("CardText").style.height = "95px";
        document.getElementById("CardText").style.top= "460px";
    }
    else{
        document.getElementById("CardText").style.height = "75px";
        document.getElementById("CardText").style.top= "480px";
    }
    
}

function fixCardSetText(isPendulum){
    if(isPendulum){
        document.getElementById("CardSet").style.top = "560px";
        document.getElementById("CardSet").style.left = "34px";
    }
    else{
        document.getElementById("CardSet").style.top = "439px";
        document.getElementById("CardSet").style.left = "306px";
    }
}


function generateCardType(){
    var cardType = document.getElementById("card_card_type").value;

    switch (cardType){
        case "monster":
            generateMonsterCard();
            fixImageStyle();
            fixCardSetText(false);
            break;

        case "pendulum":
            generatePendulumMonsterCard();
            fixImageStyle();
            fixCardSetText(true);
            break;

        case "spell":
            generateSpellCard();
            fixImageStyle();
            fixCardSetText(false);
            break;
        
        case "trap":
            generateTrapCard();
            fixImageStyle();
            fixCardSetText(false);
            break;

        default:
            generateMonsterCard();
            fixImageStyle();
            fixCardSetText(false);
            break;
    }
    fixCardText();
}

function generateMonsterCard(){
    
    document.getElementById("div-card-level-attribute").style.display = "flex";
    document.getElementById("div-card-level-rank").style.display = "flex";
    document.getElementById("CardLevelRank").style.visibility = "visible";
    document.getElementById("CardAttribute").style.visibility = "visible";

    document.getElementById("div-card-monster-type").style.display = "flex";
    document.getElementById("CardMonsterType").style.visibility = "visible";

    document.getElementById("div-pendulum-scale-link-rating").style.display = "none";

    document.getElementById("div-card-pendulum-text").style.display = "none";
    document.getElementById("CardPendulumText").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-left").style.display = "none";
    document.getElementById("CardPendulumLeft").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-right").style.display = "none";
    document.getElementById("CardPendulumRight").style.visibility = "hidden";

    document.getElementById("div-link-rating").style.display = "none";
    document.getElementById("CardLinkRating").style.visibility = "hidden";

    document.getElementById("div-card-atk-def").style.display = "flex";

    document.getElementById("div-card-atk").style.display = "flex";
    document.getElementById("CardATK").style.visibility = "visible";

    document.getElementById("div-card-def").style.display = "flex";
    document.getElementById("CardDEF").style.visibility = "visible";


//resetira sve vrijednosti drugih podtipova i postavlja onaj koji treba kao zadani
    document.getElementById("card_sub_card_monster").value = "normal";
    document.getElementById("card_sub_card_pendulum").value = "none";
    document.getElementById("card_sub_card_spell").value = "none";
    document.getElementById("card_sub_card_trap").value = "none";

    document.getElementById("div-card-sub-card-monster").style.display = "flex";
    document.getElementById("div-card-sub-card-pendulum").style.display = "none";
    document.getElementById("div-card-sub-card-spell").style.display= "none";
    document.getElementById("div-card-sub-card-trap").style.display = "none";

    generateMonsterCardSubType();
}

//dodati da xyz i vjv link imaju bijela slova naslov
function generateMonsterCardSubType(){
    var subType = document.getElementById("card_sub_card_monster").value;
    var image = document.getElementById("CardCardType");

    switch (subType){
        case "normal":
            image.src = "res/cards/cardNormalMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-dark");
            break;

        case "effect":
            image.src = "res/cards/cardEffectMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-dark");
            break;

        case "ritual":
            image.src = "res/cards/cardRitualMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-dark");
            break;
        
        case "fusion":
            image.src = "res/cards/cardFusionMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-dark");
            break;

        case "synchro":
            image.src = "res/cards/cardSynchroMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-dark");
            break;

        case "xyz":
            image.src = "res/cards/cardXYZMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_monster"));
            fixTitleColor("text-light");
            break;

        case "link":
            image.src = "res/cards/cardLinkMonster.png";
            fixTitleColor("text-light");
            //posebno funkcija za link stvorenja (bez def, link skala)
            break;

        default:
            image.src = "res/cards/cardNormalMonster.png";
            fixTitleColor("text-dark");
            break;
    }

    if(subType == "normal"){
        document.getElementById("CardText").style.fontStyle = "italic";
    }
    else{
        document.getElementById("CardText").style.fontStyle = "normal";
    }

    if(subType == "link"){
        document.getElementById("div-card-level-rank").style.display = "none";
        document.getElementById("CardLevelRank").style.visibility = "hidden";

        document.getElementById("div-pendulum-scale-link-rating").style.display = "flex";

        document.getElementById("div-link-rating").style.display = "flex";
        document.getElementById("CardLinkRating").style.visibility = "visible";

        document.getElementById("div-card-def").style.display = "none";
        document.getElementById("CardDEF").style.visibility = "hidden";

    }else{
        document.getElementById("div-card-level-rank").style.display = "flex";
        document.getElementById("CardLevelRank").style.visibility = "visible";

        document.getElementById("div-pendulum-scale-link-rating").style.display = "none";

        document.getElementById("div-link-rating").style.display = "none";
        document.getElementById("CardLinkRating").style.visibility = "hidden";

        document.getElementById("div-card-def").style.display = "flex";
        document.getElementById("CardDEF").style.visibility = "visible";
    }

    /*if(subType == "link"){
        divCardLevelAttribute.style.display = "none";
        divCardLevelRank.style.display = "none";
        divCardLevelRankImage.style.visibility = "hidden";

        divPendulumScaleLinkRating.style.display = "flex";

        divLinkRating.style.display = "flex";
        divLinkRatingImage.style.visibility = "visible";

        divCardDEF.style.display = "none";
        divCardDEFImage.style.visibility = "hidden";

    }else{
        divCardLevelAttribute.style.display = "flex";
        divCardLevelRank.style.display = "flex";
        divCardLevelRankImage.style.visibility = "visible";

        divPendulumScaleLinkRating.style.display = "none";

        divLinkRating.style.display = "none";
        divLinkRatingImage.style.visibility = "hidden";

        divCardDEF.style.display = "flex";
        divCardDEFImage.style.visibility = "visible";
    }*/
}

function generatePendulumMonsterCard(){
    document.getElementById("div-card-level-attribute").style.display = "flex";
    document.getElementById("div-card-level-rank").style.display = "flex";
    document.getElementById("CardLevelRank").style.visibility = "visible";
    document.getElementById("CardAttribute").style.visibility = "visible";

    document.getElementById("div-card-monster-type").style.display = "flex";
    document.getElementById("CardMonsterType").style.visibility = "visible";

    document.getElementById("div-pendulum-scale-link-rating").style.display = "flex";

    document.getElementById("div-card-pendulum-text").style.display = "inherit";
    document.getElementById("CardPendulumText").style.visibility = "visible";

    document.getElementById("div-pendulum-scale-left").style.display = "inherit";
    document.getElementById("CardPendulumLeft").style.visibility = "visible";

    document.getElementById("div-pendulum-scale-right").style.display = "inherit";
    document.getElementById("CardPendulumRight").style.visibility = "visible";

    document.getElementById("div-link-rating").style.display = "none";
    document.getElementById("CardLinkRating").style.visibility = "hidden";

    document.getElementById("div-card-atk-def").style.display = "flex";

    document.getElementById("div-card-atk").style.display = "flex";
    document.getElementById("CardATK").style.visibility = "visible";

    document.getElementById("div-card-def").style.display = "flex";
    document.getElementById("CardDEF").style.visibility = "visible";


//resetira sve vrijednosti drugih podtipova i postavlja onaj koji treba kao zadani - TREBA POPRAVITI
    document.getElementById("card_sub_card_monster").value = "none";
    document.getElementById("card_sub_card_pendulum").value = "normal";
    document.getElementById("card_sub_card_spell").value = "none";
    document.getElementById("card_sub_card_trap").value = "none";

    document.getElementById("div-card-sub-card-monster").style.display = "none";
    document.getElementById("div-card-sub-card-pendulum").style.display = "flex";
    document.getElementById("div-card-sub-card-spell").style.display= "none";
    document.getElementById("div-card-sub-card-trap").style.display = "none";

    generatePendulumMonsterCardSubType();
}

function generatePendulumMonsterCardSubType(){
    var subType = document.getElementById("card_sub_card_pendulum").value;
    var image = document.getElementById("CardCardType");

    switch (subType){
        case "normal":
            image.src = "res/cards/cardNormalPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-dark");
            break;

        case "effect":
            image.src = "res/cards/cardEffectPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-dark");
            break;

        case "ritual":
            image.src = "res/cards/cardRitualPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-dark");
            break;
        
        case "fusion":
            image.src = "res/cards/cardFusionPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-dark");
            break;

        case "synchro":
            image.src = "res/cards/cardSynchroPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-dark");
            break;

        case "xyz":
            image.src = "res/cards/cardXYZPendulumMonster.png";
            generateCardLevelRank();
            fixTitleColor("text-light");
            break;

        default:
            image.src = "res/cards/cardNormalPendulumMonster.png";
            generateCardLevelRank(document.getElementById("card_sub_card_pendulum"));
            fixTitleColor("text-dark");
            break;
    }

    if(subType == "normal"){
        document.getElementById("CardText").style.fontStyle = "italic";
    }
    else{
        document.getElementById("CardText").style.fontStyle = "normal";
    }
}

function generateSpellCard(){
    document.getElementById("div-card-level-attribute").style.display = "none";
    document.getElementById("div-card-level-rank").style.display = "none";
    document.getElementById("CardLevelRank").style.visibility = "hidden";
    document.getElementById("CardAttribute").style.visibility = "hidden";

    document.getElementById("div-card-monster-type").style.display = "none";
    document.getElementById("CardMonsterType").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-link-rating").style.display = "none";

    document.getElementById("div-card-pendulum-text").style.display = "none";
    document.getElementById("CardPendulumText").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-left").style.display = "none";
    document.getElementById("CardPendulumLeft").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-right").style.display = "none";
    document.getElementById("CardPendulumRight").style.visibility = "hidden";

    document.getElementById("div-link-rating").style.display = "none";
    document.getElementById("CardLinkRating").style.visibility = "hidden";

    document.getElementById("div-card-atk-def").style.display = "none";

    document.getElementById("div-card-atk").style.display = "none";
    document.getElementById("CardATK").style.visibility = "hidden";

    document.getElementById("div-card-def").style.display = "none";
    document.getElementById("CardDEF").style.visibility = "hidden";


//resetira sve vrijednosti drugih podtipova i postavlja onaj koji treba kao zadani
    document.getElementById("card_sub_card_monster").value = "none";
    document.getElementById("card_sub_card_pendulum").value = "none";
    document.getElementById("card_sub_card_spell").value = "normal";
    document.getElementById("card_sub_card_trap").value = "none";

    document.getElementById("div-card-sub-card-monster").style.display = "none";
    document.getElementById("div-card-sub-card-pendulum").style.display = "none";
    document.getElementById("div-card-sub-card-spell").style.display= "flex";
    document.getElementById("div-card-sub-card-trap").style.display = "none";


    generateSpellCardSubType();
    fixTitleColor("text-white");
}

function generateSpellCardSubType(){
    var subType = document.getElementById("card_sub_card_spell").value;
    var image = document.getElementById("CardCardType");

    switch (subType){
        case "normal":
            image.src = "res/cards/cardSpell.png";
            break;

        case "continuous":
            image.src = "res/cards/cardSpellContinuous.png";
            break;

        case "equip":
            image.src = "res/cards/cardSpellEquip.png";
            break;
        
        case "field":
            image.src = "res/cards/cardSpellField.png";
            break;

        case "quick_play":
            image.src = "res/cards/cardSpellQuickPlay.png";
            break;

        case "ritual":
            image.src = "res/cards/cardSpellRitual.png";
            break;

        default:
            image.src = "res/cards/cardSpell.png";
            break;
    }

    document.getElementById("CardText").style.fontStyle = "normal";
}

function generateTrapCard(){
    document.getElementById("div-card-level-attribute").style.display = "none";
    document.getElementById("div-card-level-rank").style.display = "none";
    document.getElementById("CardLevelRank").style.visibility = "hidden";
    document.getElementById("CardAttribute").style.visibility = "hidden";

    document.getElementById("div-card-monster-type").style.display = "none";
    document.getElementById("CardMonsterType").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-link-rating").style.display = "none";

    document.getElementById("div-card-pendulum-text").style.display = "none";
    document.getElementById("CardPendulumText").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-left").style.display = "none";
    document.getElementById("CardPendulumLeft").style.visibility = "hidden";

    document.getElementById("div-pendulum-scale-right").style.display = "none";
    document.getElementById("CardPendulumRight").style.visibility = "hidden";

    document.getElementById("div-link-rating").style.display = "none";
    document.getElementById("CardLinkRating").style.visibility = "hidden";

    document.getElementById("div-card-atk-def").style.display = "none";

    document.getElementById("div-card-atk").style.display = "none";
    document.getElementById("CardATK").style.visibility = "hidden";

    document.getElementById("div-card-def").style.display = "none";
    document.getElementById("CardDEF").style.visibility = "hidden";


//resetira sve vrijednosti drugih podtipova i postavlja onaj koji treba kao zadani
//  document.getElementById("card_sub_card_monster").selectedIndex = "-1";
    document.getElementById("card_sub_card_monster").value = "none";
    document.getElementById("card_sub_card_pendulum").value = "none";
    document.getElementById("card_sub_card_spell").value = "none";
    document.getElementById("card_sub_card_trap").value = "normal";

    document.getElementById("div-card-sub-card-monster").style.display = "none";
    document.getElementById("div-card-sub-card-pendulum").style.display = "none";
    document.getElementById("div-card-sub-card-spell").style.display= "none";
    document.getElementById("div-card-sub-card-trap").style.display = "flex";


    generateTrapCardSubType();
    fixTitleColor("text-white");
}

function generateTrapCardSubType(){
    var subType = document.getElementById("card_sub_card_trap").value;
    var image = document.getElementById("CardCardType");

    switch (subType){
        case "normal":
            image.src = "res/cards/cardTrap.png";
            break;

        case "continuous":
            image.src = "res/cards/cardTrapContinuous.png";
            break;

        case "counter":
            image.src = "res/cards/cardTrapCounter.png";
            break;

        default:
            image.src = "res/cards/cardTrap.png";
            break;
    }
    document.getElementById("CardText").style.fontStyle = "normal";
}
