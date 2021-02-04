<div id="page-wrapper">
    <div class="container-fluid">
        <?php require_once (ROOT . 'app/views/template/notify.php'); ?>
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['administration']; ?></h4> </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?php echo WEBROOT ?>menu/menu"><?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['administration']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- ============= Blocs du menu ========= -->
        <div class="row">

            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 big_team_grid">
                <a href="<?php /*echo WEBROOT */?>administration/listeModule">
                    <div class="big_text text1-big">
                        <h3><i class="mdi mdi-wrench fa-fw icones-big"></i></h3>
                        <p><?php /*echo $this->lang['parametrage']; */?> <br>_</p>
                    </div>
                </a>
            </div>
-->
            <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 big_team_grid">
                <a href="<?php /*echo WEBROOT */?>administration/listeGroupe">
                    <div class="big_text text1-big">
                        <h3><i class="mdi mdi-account-multiple fa-fw icones-big"></i></h3>
                        <p><?php /*echo $this->lang['user_profil']; */?><br>_</p>
                    </div>
                </a>
            </div>-->


            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listehotels">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-hotel fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['listehotels']; ?><br>_</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listeagencevoyage">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-building-o fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['listeagencevoyage']; ?><br> _</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listecompagnie">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-building fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['listecompagnie']; ?><br> _</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listevols">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-plane fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['listevols']; ?><br>_</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listesites">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-map-marker fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['listesites']; ?><br>_</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/messagesaudio">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-file-sound-o fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['messagesaudio']; ?><br>_</p>
                    </div>
                </a>
            </div>

        </div>
        <br />
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/messagestexte">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-file-word-o fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['messagestexte']; ?><br>_</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/messagesvideos">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-file-movie-o fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['messagesvideos']; ?><br>_</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/group">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-user fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['group']; ?><br>_</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/profils">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-user fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['profils']; ?><br>_</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <a href="<?php echo WEBROOT ?>administration/listeUtilisateur">
                    <div class="big_text text1-big">
                        <h3><i class="fa fa-user fa-fw icones-big"></i></h3>
                        <p><?php echo $this->lang['utilisateur']; ?><br>_</p>
                    </div>
                </a>
            </div>
        </div>
        <!-- ============= Blocs du menu ========= -->
    </div>
    <!-- /.container-fluid -->

</div>
