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
                <a href="#" class="waves-effect"><i class="fa fa-gears fa-fw"></i> <span class="hide-menu"><?php echo $this->lang['parametrage']; ?>
                        <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listehotels">
                            <i data-icon="/" class="fa fa-hotel fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['listehotels']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listecompagnie">
                            <i data-icon="/" class="fa fa-building fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['listecompagnie']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listevols">
                            <i data-icon="/" class="fa fa-plane fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['listevols']; ?></span>
                        </a>
                    </li>


                    <li>
                        <a href="<?php echo WEBROOT; ?>administration/listesites">
                            <i data-icon="/" class="fa fa-map-marker fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['listesites']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-inbox fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['listemessages']; ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-third-level">

                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagesaudio">
                                    <i data-icon="/" class="fa fa-file-sound-o fa-fw icones-big"></i>
                                    <span class="hide-menu"><?php echo $this->lang['messagesaudio']; ?></span>
                                </a>

                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagestexte">
                                    <i data-icon="/" class="fa fa-file-word-o fa-fw icones-big"></i>
                                    <span class="hide-menu"><?php echo $this->lang['messagestexte']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= WEBROOT; ?>gestion/messagesvideos">
                                    <i data-icon="/" class="fa fa-file-movie-o fa-fw icones-big"></i>
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
                            <i data-icon="/" class="fa fa-user fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['group']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeProfil">
                            <i data-icon="/" class="fa fa-user fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['profils']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>administration/listeUtilisateur">
                            <i data-icon="/" class="fa fa-user fa-fw icones-big"></i>
                            <span class="hide-menu"><?php echo $this->lang['utilisateur']; ?></span>
                        </a>
                    </li>
                </ul>
            </li>





        </ul>
    </div>
</div>
