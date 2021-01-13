<form id="validation" class="form-inline form-validator" data-type="update" role="form"
      name="form" action="<?= WEBROOT ?>trajets/insertLignes" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['newligne']; ?></h4>
    </div>
    <div class="modal-body">
        <!-- --><?php /*var_dump($module); die(); */?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">


                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="libelle" class="control-label"><?php echo $this->lang['libelle']; ?></label>
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="libelle" style="width: 100%">
                        <span class="help-block with-errors"> </span>
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

