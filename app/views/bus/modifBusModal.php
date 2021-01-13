<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>bus/updateBus" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modification_Bus']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="matricule" class="control-label"><?php echo $this->lang['matricule']; ?></label>
                        <input type="text" id="matricule" name="matricule" value="<?= $bus->matricule ?>" class="form-control"
                               placeholder="<?php echo $this->lang['bus']; ?>" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="couleur" class="control-label"><?php echo $this->lang['couleur']; ?></label>
                        <input type="text" id="couleur" name="couleur" value="<?= $bus->couleur ?>" class="form-control"
                               placeholder="b<?php echo $this->lang['bus']; ?>us" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="categorie" class="control-label"><?php echo $this->lang['categorie']; ?></label>
                        <input type="text" id="categorie" name="categorie" value="<?= $bus->categorie ?>" class="form-control"
                               placeholder="<?php echo $this->lang['bus']; ?>" style="width: 100%">

                    </div>

                </div>
                <input type="hidden" name="id" value="<?= base64_encode($bus->id) ?>">

                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>

