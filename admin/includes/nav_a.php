<?php
/*
TODO !!!!!!!!!!!!
*/
?>
<div class="menu">
                <a href="#"><i class="ion-ios-book-outline"></i> Library</a>
            </div>
            <div class="submenu" id="submenu1" >
                <a href="#" class="nav-click"><i class="ion-social-dropbox"></i> Themes <i class="ion-chevron-down right" id="icon"></i></a>
                <div class="sub-content hide" id="sub-content">
                    <?php list_themes('no_max'); ?>
                    <a href="add_book.php"> <i class="ion-ios-plus-empty"></i> Ajouter un livre </a>
                </div>
            </div>