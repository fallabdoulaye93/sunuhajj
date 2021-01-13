<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>gestion/ajoutMateriel" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutMateriel']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">


                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="marque" class="control-label"><?php echo $this->lang['marque']; ?></label>
                        <input type="text" id="manufacture" name="manufacture" class="form-control" placeholder="<?php echo $this->lang['Veuillezentrerunemarque']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="marque" class="control-label"><?php echo $this->lang['nom']; ?></label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="<?php echo $this->lang['Veuillezentrerlenomdumateriel']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="numIdentification" class="control-label"><?php echo $this->lang['numIdentification']; ?></label>
                        <input type="text" id="uuid" name="uuid" class="form-control" placeholder=" <?php echo $this->lang['Veuillezentrerlenumerodidentification']; ?> "
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="numIdentification" class="control-label"><?php echo $this->lang['descript']; ?></label>
                        <input type="text" id="model" name="model" class="form-control" placeholder=" <?php echo $this->lang['Veuillezentrerlemodel']; ?> "
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>

<!--                    <div class="form-group" style="width: 100%;padding: 10px;">-->
<!--                        <label for="module" class="control-label">Liste des Gie </label>-->
<!---->
<!--                        <select id="numGIE" name="numGIE" class="form-control" style="width: 100%">-->
<!--                            <option value=""> Selectionnez le Gie du bus</option>-->
<!---->
<!--                            --><?php //foreach ($gie as $oneTypep) { ?>
<!--                                <option value="--><?php //echo $oneTypep->id; ?><!--"> --><?php //echo $oneTypep->nomgie; ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!---->
<!--                    </div>-->


                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>


<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: '<?= $this->lang['default'];  ?>',
                replace: '<?= $this->lang['replace'];  ?>',
                remove:  '<?= $this->lang['remove'];  ?>',
                error:   '<?= $this->lang['error'];  ?>'
            },
            error: {
                'fileSize': 'The file size is too big ({{ value }} max).',
                'minWidth': 'The image width is too small ({{ value }}}px min).',
                'maxWidth': 'The image width is too big ({{ value }}}px max).',
                'minHeight': 'The image height is too small ({{ value }}}px min).',
                'maxHeight': 'The image height is too big ({{ value }}px max).',
                'imageFormat': 'The image format is not allowed ({{ value }} only).'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
<script>
    $('#validation').formValidation({
        framework: 'bootstrap',
        fields: {
            type: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['typeObligatoire']; ?>'
                    },

                }

            },
            marque: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['marqueObligatoire']; ?>'

                    },

                }

            }

        }
    });
</script>


<!--<script>-->
<!--    function getCategorie() {-->
<!---->
<!---->
<!--        var categorie = document.getElementById('categorie');-->
<!--        var valider = document.getElementById('idvalider');-->
<!--        if (categorie ==""){-->
<!--            valider.style.display="none";-->
<!--        }-->
<!---->
<!--        else {-->
<!--            valider.style.display="block";-->
<!--        }-->
<!---->
<!--    }-->
<!---->
<!--</script>-->

