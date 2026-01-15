<?php
// Récupération sécurisée des données de l'URL
$nom = $_GET['nom'] ?? 'Inconnu';
$prenom = $_GET['prenom'] ?? '';
$total = $_GET['total'] ?? '0.00';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture - <?= htmlspecialchars($nom) ?></title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; padding: 50px; }
        .invoice-card { 
            max-width: 450px; 
            margin: auto; 
            padding: 30px; 
            border: 2px solid #3b82f6; 
            border-radius: 10px;
        }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #3b82f6; margin-bottom: 5px; }
        .line { border-bottom: 1px solid #eee; padding: 10px 0; display: flex; justify-content: space-between; }
        .total-box { 
            margin-top: 25px; 
            padding: 15px; 
            background: #f0f7ff; 
            text-align: center; 
            font-size: 1.5rem; 
            font-weight: bold; 
            color: #1e40af; 
        }
        .footer { margin-top: 40px; text-align: center; font-size: 0.8rem; color: #777; }
        
        /* Masque les boutons lors de l'impression sur papier */
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()"> <div class="invoice-card">
        <div class="header">
            <h1>🎓 EduCenter</h1>
            <strong>REÇU DE PAIEMENT</strong>
        </div>

        <div class="line">
            <span>Étudiant :</span>
            <strong><?= htmlspecialchars(strtoupper($nom) . " " . $prenom) ?></strong>
        </div>

        <div class="line">
            <span>Date de paiement :</span>
            <strong><?= date('d/m/Y') ?></strong>
        </div>

        <div class="total-box">
            <?= number_format($total, 2) ?> DH
        </div>

        <div class="footer">
            <p>Merci pour votre confiance !<br>Ce reçu est généré automatiquement par EduCenter.</p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 8px 15px; cursor: pointer; background: #3b82f6; color: white; border: none; border-radius: 4px;">
            Imprimer à nouveau
        </button>
        <button onclick="window.close()" style="padding: 8px 15px; cursor: pointer; border: 1px solid #ccc; border-radius: 4px; margin-left: 10px;">
            Fermer
        </button>
    </div>

</body>
</html>