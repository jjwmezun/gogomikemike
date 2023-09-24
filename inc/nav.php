<?php

use WaughJ\WPAdminMenuManager\WPAdminMenuManager;
$menu = WPAdminMenuManager::getHeaderMenu();

if ( empty( $menu ) ) return;

?>
    <nav class="gomike-main-nav">
        <ul class="gomike-main-nav-list">
        <?php
            $list = $menu->getMenu();
            foreach ( $list as $item )
            {
                ?>
                    <li class="gomike-main-nav-list-item">
                        <a class="gomike-main-nav-list-link" href="<?= $item->getUrl(); ?>">
                            <?= $item->getTitle(); ?>
                        </a>
                    </li>
                <?php
            }
        ?>
        </ul>
    </nav>