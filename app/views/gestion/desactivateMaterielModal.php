<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>gestion/updateMateriel" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['desable_device']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <p><?php echo $this->lang['message_desable_device']; ?></p>
                </div>
                <input type="hidden" name="rowid" value="<?= base64_encode($materiel) ?>">
                <input type="hidden" name="etat" value="<?= base64_encode('0') ?>">

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


