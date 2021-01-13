<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <?php include("profil_user.php"); ?>
        <ul class="nav" id="side-menu">
            <li>
                <a href="#" class="waves-effect"><i class="fa fa-tv fa-fw"></i> <span class="hide-menu"><?php echo $this->lang['gestionmateriel']; ?>
                        <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" class="waves-effect"><i class="mdi mdi-responsive fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['kits']; ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-third-level">

                            <li>
                                <a href="<?= WEBROOT; ?>gestion/kitspelerin">
                                    <i data-icon="/" class="fa fa-hotel fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['kitspelerin']; ?></span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/kitsencadreur">
                                    <i data-icon="/" class="fa fa-hotel fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['kitsencadreur']; ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/lecteurqr">
                            <i data-icon="/" class="fa fa-qrcode fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['lecteurqr']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/tabletteencadreur">
                            <i data-icon="/" class="fa fa-mobile-phone fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['tabletteencadreur']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/badges">
                            <i data-icon="/" class="fa fa-user fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['badges']; ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/panicbutton">
                            <i data-icon="/" class="fa fa-forumbee fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['panicbutton']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/pucesbagages">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['pucesbagages']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/cartesim">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['cartesim']; ?></span>
                        </a>
                    </li>




                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/carteid">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['carteid']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/cartewallet">
                            <i data-icon="/" class="fa fa-google-wallet fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['cartewallet']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/restitution">
                            <i data-icon="/" class="fa fa-backward fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['restitution']; ?></span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="fa fa-gears fa-fw"></i> <span class="hide-menu"><?php echo $this->lang['parametrage']; ?>
                        <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-hand-paper-o fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listepartenaire']; ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-third-level">

                            <li>
                                <a href="<?= WEBROOT; ?>gestion/monetique">
                                    <i data-icon="/" class="fa fa-credit-card fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['monetique']; ?></span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/sponsor">
                                    <i data-icon="/" class="fa fa-star-o fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['sponsor']; ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listehotels">
                            <i data-icon="/" class="fa fa-hotel fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listehotels']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listecompagnie">
                            <i data-icon="/" class="fa fa-building fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listecompagnie']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listevols">
                            <i data-icon="/" class="fa fa-plane fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listevols']; ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listesites">
                            <i data-icon="/" class="fa fa-map-marker fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listesites']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-inbox fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listemessages']; ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-third-level">

                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagesaudio">
                                    <i data-icon="/" class="fa fa-file-sound-o fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['messagesaudio']; ?></span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagestexte">
                                    <i data-icon="/" class="fa fa-file-word-o fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['messagestexte']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagesvideos">
                                    <i data-icon="/" class="fa fa-file-sound-o fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['messagesvideos']; ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="mdi mdi-account-multiple fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['user_profil2']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeGroupe">
                            <i data-icon="/" class="fa fa-user fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['group']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeProfil">
                            <i data-icon="/" class="fa fa-user fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['profils']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeUtilisateur">
                            <i data-icon="/" class="fa fa-user fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['utilisateur']; ?></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="mdi mdi-account fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['gestiontier']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="<?= WEBROOT; ?>administration/listepelerins">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listepelerins']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeguide">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listeguide']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>administration/listefamilles">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listefamilles']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeformateurs">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listeformateurs']; ?></span>
                        </a>
                    </li>


                </ul>
            </li>

            <li>
                <a href="#" class="waves-effect"><i class="mdi mdi-responsive fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['bagages']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= WEBROOT; ?>bus/listebagages">
                            <i data-icon="/" class="fa fa-list fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listebagages']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>bus/monitoringbagage">
                            <i data-icon="/" class="fa fa-map fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['monitoringbagage']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>bus/reclamationbagage">
                            <i data-icon="/" class="fa fa-comment fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['reclamationbagage']; ?></span>
                        </a>
                    </li>


                </ul>
            </li>



        </ul>
    </div>
</div>
