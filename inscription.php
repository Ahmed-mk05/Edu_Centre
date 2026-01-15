<?php
include_once("connex.php");
// ajouter inscrip
function ajouter_inscrip($etudiant_id,$cours_id,$dateInscription  ,$statut ,$note ){
    try {
        // conneion a la base de donnees
    $cnx = conencter();
    $sr = $cnx-> prepare("INSERT INTO inscription (etudiant_id,cours_id,dateInscription ,statut ,note) VALUES (?, ?, ?, ?,?)");
     $sr-> execute(array($etudiant_id,$cours_id,$dateInscription ,$statut ,$note));
    } catch (\Throwable $e) {
        echo ("Error adding inscrip: " . $e->getMessage());
    }
}
function suprrimer_inscrip($id){
    try {
        // connexion a la base de donnees
             $cnx2 = conencter();
             // commend de data deletion
            $sr2 = $cnx2-> prepare("DELETE FROM inscription WHERE id = ?");
            $sr2-> execute(array($id)); 
            // throwable pour gere les grand erreurs
    }catch (\Throwable $e) {
        echo ("Error deleting inscrip: " . $e->getMessage());
    }
   
}
function modifier_inscrip($id, $etudiant_id,$cours_id,$dateInscription,$statut ,$note){
    try {
        // connexion a la base de donnees
        $cnx3 = conencter();
        // command de modification
        $sr3 = $cnx3-> prepare("UPDATE inscription SET  etudiant_id =?,cours_id =?,dateInscription =? ,statut =?,note=? WHERE id =?");
        // exucute la commande :
        $sr3-> execute(array($id,$etudiant_id,$cours_id,$dateInscription ,$statut ,$note));
    } catch (\Throwable $e) {
        echo ("Error updating inscrip: " . $e->getMessage());
    }
}
function all_inscrip(){
    try {
        // connexion a la base de donnees
        $cnx4 = conencter();
        // command de selection pour selecter tous les inscrip
        $sr4 = $cnx4-> prepare("SELECT * FROM inscription");
        // execute la command
        $sr4-> execute();
        // fetch all data katjib ga3 data dyl les inscrip
        $inscrip = $sr4-> fetchAll(PDO::FETCH_ASSOC);
        return $inscrip;
    } catch (\Throwable $e) {
        echo ("Error fetching inscrip: " . $e->getMessage());
    }
}
?>