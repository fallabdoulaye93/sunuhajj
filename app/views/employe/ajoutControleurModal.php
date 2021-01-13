<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>employe/ajoutControleur" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutControleur']; ?></h4>
    </div>
    <div class="modal-body">
       <!-- --><?php /*var_dump($module); die(); */?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom']; ?></label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="<?php echo $this->lang['nom']; ?>" style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['prenom']; ?> </label>
                        <input type="text" id="prenom" name="prenom"  class="form-control" placeholder="<?php echo $this->lang['prenom']; ?>" style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="adresse" class="control-label"><?php echo $this->lang['adresse']; ?></label>
                        <input type="text" id="adresse" name="adresse"  class="form-control" placeholder="<?php echo $this->lang['adresse']; ?>" style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['email']; ?></label>
                        <input type="text" id="email" name="email"  class="form-control" placeholder="<?php echo $this->lang['email']; ?>" style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group">
                        <label for="input-file-events" class="col-sm-4 control-label"><?= $this->lang['photo'].' (*) :' ; ?></label>
                        <div class="col-md-12">
                            <input type="file" id="input-file-events" name="photo" required class="dropify-fr" data-show-errors="true"
                                   data-max-file-size="1M" data-allowed-file-extensions="png jpg jpeg" data-default-file="<?php echo WEBROOT ?>app/pictures/20180123151717.jpg" >
                            <span id="msg1"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['telephone']; ?></label>
                        <input type="telephone" id="telephone" name="telephone"  class="form-control" placeholder="<?php echo $this->lang['telephone']; ?>" style="width: 100%">
                        <span class="help-block with-errors"> </span>
                        <? //print $token;?>
                    </div>

                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?></button>
        <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>
<script>
    $('input[type="telephone"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });

    $('#validation').formValidation({
        framework: 'bootstrap' ,
        fields: {
            nom: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['nomObligatoire']; ?>'
                    }
                }
            },

            prenom: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['prenomObligatoire']; ?>'

                    }
                }
            },
            adresse: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['adresseObligatoire']; ?>'

                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['emailObligatoire']; ?>'
                    }
                }
            },
            telephone: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['telephoneObligatoire']; ?>'

                    }
                }
            }
        }
    });
</script>