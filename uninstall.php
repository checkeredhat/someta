<?php
// Uninstall Script for So Meta for Wordpress 1.0 //

/* This file is part of So Meta for Wordpress 1.0

So Meta for Wordpress is free software: 
you can redistribute it and/or modify it under the terms of the 
GNU General Public License as published by the Free Software Foundation,
either version 2 of the License, or any later version.
 
So Meta for Wordpress is distributed in the hope that it will
be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with So Meta for Wordpress. If not, see <https://www.gnu.org/licenses/>.

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
        exit; 
    }
    
// Find all the files
$badlotHome = ABSPATH .'/wp-content/plugins/so-meta/';
$badlotfiles = array ( 
    "metatag.config",
    "so-meta.php",
    "admin.php",
    "uninstall.php",
    ""
    );
    
// Unlink each file
foreach ($badlotFiles as $badlotFile) {
    $badlotFile = $badlotHome .$badlotFile;
    unlink($badlotFile);
}
