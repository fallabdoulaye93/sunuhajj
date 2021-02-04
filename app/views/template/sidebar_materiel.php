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
                                <a href="<?= WEBROOT; ?>materiels/kitspelerin">
                                    <i data-icon="/" class="fa fa-hotel fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['kitspelerin']; ?></span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>materiels/kitsencadreur">
                                    <i data-icon="/" class="fa fa-hotel fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['kitsencadreur']; ?></span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/lecteurqr">
                            <i data-icon="/" class="fa fa-qrcode fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['lecteurqr']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/tabletteencadreur">
                            <i data-icon="/" class="fa fa-mobile-phone fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['tabletteencadreur']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/badges">
                            <i data-icon="/" class="fa fa-user fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['badges']; ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/panicbutton">
                            <i data-icon="/" class="fa fa-forumbee fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['panicbutton']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/pucesbagages">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['pucesbagages']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/cartesim">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['cartesim']; ?></span>
                        </a>
                    </li>




                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/carteid">
                            <i data-icon="/" class="fa fa-gears fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['carteid']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/cartewallet">
                            <i data-icon="/" class="fa fa-google-wallet fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['cartewallet']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>materiels/restitution">
                            <i data-icon="/" class="fa fa-backward fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['restitution']; ?></span>
                        </a>
                    </li>

                </ul>
            </li>





        </ul>
    </div>
</div>
