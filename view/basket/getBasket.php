<?php 

mb_internal_encoding('UTF-8');
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

function response($status,$status_message,$data) {
    header("HTTP/1.1 ".$status);
    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;
    echo json_encode($response);
}
function loadBasket($id){
    include('../bdd.php');
    $req = "SELECT prix, designation, categorie, panier.quantite FROM produits JOIN panier on produits.id_produit = panier.id_produit  WHERE id_user = $id;";
    $res = $pdo->query($req);
    $myArray = [];
    while($row = $res->fetch()){
          array_push($myArray,$row);            
    }
    return json_encode($myArray);
}

$uri = strtok($_SERVER["REQUEST_URI"],"?");
if($uri === "/authExo/view/basket/getBasket.php/basket") { 
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['user_id'])){
            $data = loadBasket($_GET['user_id']);
            response(200,"",$data);
        }else{
            response(400,"Invalid Request",NULL);
        }
    }
}  
   


?>