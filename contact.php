<!DOCTYPE html>
<html lang="en">

<?php
        include("head.php");
    ?>

<body>
    <?php
        include("header.php");
    ?>

    <div class="container-fluid contact-form">
        <div style="padding-top: 80px;">
            <h2 class="text-center pt-3 pb-4 title-h2">Contactez-nous</h2>
        </div>
        <div>
            <?php
            if (isset($_GET["sent"]) && $_GET["sent"] == "1") {
                $message = "Mail envoyé avec succes.";
            } else {
                $message = "Une erreur est survenue lors de l'envoi du mail.";
            }

            echo "<strong>$message</strong>"
            ?>
        </div>
        <form method="POST" class="form-anim" action="mail.php">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="txtName" class="form-control" placeholder="Votre Nom *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtEmail" class="form-control" placeholder="Votre Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtPhone" class="form-control" placeholder="Votre Téléphone *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="Envoyer" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea name="txtMsg" class="form-control" placeholder="Message *" style="width: 100%; height: 150px;"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
