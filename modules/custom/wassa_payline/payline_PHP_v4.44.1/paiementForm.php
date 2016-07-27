<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
<!--    <link href="https://homologation-payment.payline.com/styles/widget-min.css" rel="stylesheet" />-->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<!--    <script src="https://homologation-payment.payline.com/scripts/widget-min.js"></script>-->
</head>
<body>
<form id="paymentForm" action="#" method="post">
    <label for="">Numéro de carte</label>
    <input type="text" name="cardNumber" id="cardNumber"/>
    <label for="">Date d'expiration</label>
    <input type="text" name="cardExpirationDate" id="cardExpirationDate"/>
    <label for="">Cryptogramme</label>
    <input type="text" name="cardCvx" id="cardCvx"/>
    <select name="cardType"	id="cardType">
        <option value="CB">CB</option>
        <option value="MAESTRO">MAESTRO</option>
        <option value="MASTERCARD">MASTERCARD</option>
        <option value="VISA">VISA</option>
    </select>
    <br/>
    <input type="submit" class="btn btn-primary" value="Payer" />
</form>

<script>
    // Requête AJAX pour appeler la fonction getToken de Payline
    $(document).ready( function () {
        $("#paymentForm").submit( function() { // à la soumission du formulaire
            jQuery.support.cors = true; // activer les requêtes ajax cross-domain
            $.ajax( {
                type: "POST",
//                url: "https://homologation-webpayment.payline.com/webpayment/getToken",
                url: "paiement.php",
                data: "cardNumber=" + $("#cardNumber").val() +
                "&cardExpirationDate=" + $("#cardExpirationDate").val() +
                "&cardCvx=" + $("#cardCvx").val() +
                "&cardType=" + $("#cardType").val(),
                success: function(msg){ // si l'appel a bien fonctionné
                    console.debug(msg);
//                    $.ajax({ // fonction permettant de faire de l'ajax
//                        type: "POST", // methode de transmission au site marchand
//                        url: "paymentAjax.php", // traitement serveur (appel local)
//                        data: "resultPayline="
//                        success: function(result){ // si l'appel a bien fonctionné
//                            // traitement du résultat OK (afficher les parametres dans cet exemple)
//                            var divMsg = $(result);
//                            divMsg.hide();
//                            $("#result").append(divMsg);
//                            divMsg.slideDown();
//                        }
//                    });
                },
                error:function (xhr, status, error){
                    console.log("Erreur lors de l'appel de Payline : " + xhr.responseText
                        + " (" + status + " - " + error + ")");
                }
            });
            return false; // pour rester sur la même page à la soumission du formulaire
        });
    });
</script>
</body>
</html>