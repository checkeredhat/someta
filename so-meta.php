<?php
/* Copyright 2021 So Meta for Wordpress 1.0 

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

Plugin Name: So Meta for Wordpress
Plugin URI: https://someta.sourcepassive.com
Description: So Meta is the easiest way to add meta tags to your Wordpress site. This plugin adds Open Graph Meta Tags for Facebook and Google. It also adds meta information for Twitter Cards.
Author: James Schweda 
Author URI: https://jamesschweda.com/
Version: 1.0
Donate link: https://someta.sourcepassive.com/#donate

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
        exit; 
    }
    
// Add the admin page to the admin menu
add_action( 'admin_menu', 'someta_admin_menu' );
// Add meta tags by hooking to wp_head
add_action( 'wp_head', 'someta_metatags', 10 );

// Required Functions

// Adds the menu to the admin section
function someta_admin_menu() {
	add_menu_page( 'So Meta', 'So Meta', 'manage_options', 'so-meta/index', 'someta_admin_page', 'dashicons-code-standards', 100  );
}

// shows the admin page
function someta_admin_page(){
    // if the form has been submitted 
    if (isset($_POST['submit'])) {
        // filter the input
        $metatag_config = someta_filter_input();
        // write to file
        someta_saveconfig($metatag_config[0], $metatag_config[1], $metatag_config[2]);
    }
    else {
        $metatag_config = someta_loadconfig();
    }
    include_once ABSPATH . 'wp-content/plugins/so-meta/admin.php';
}

// loads config data 
function someta_loadconfig() {
    $config_array = file(ABSPATH . 'wp-content/plugins/so-meta/metatag.config', FILE_SKIP_EMPTY_LINES);
    if ($config_array == false) {
        // if we come up empty display defaults
        $config_array = array (
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'Facebook, Youtube, Google, Gmail, Hotmail, how-to, blog, Amazon, translator, Monero',
            'https://someta.sourcepassive.com/images/thumbnail.jpg');
    }
    return $config_array;
}

// saves config data 
function someta_saveconfig($description, $keywords, $thumbnailURL) {
   $fopen = fopen(ABSPATH . 'wp-content/plugins/so-meta/metatag.config', 'w') or die("Can't open file.");
   fwrite($fopen, $description .PHP_EOL);
   fclose($fopen);
   $fopen = fopen(ABSPATH . 'wp-content/plugins/so-meta/metatag.config', 'a') or die("Can't open file.");
   fwrite($fopen, $keywords .PHP_EOL .$thumbnailURL .PHP_EOL);
   fclose($fopen);
}

// function to output meta description and keyword tags
function someta_show_metadescription($description, $keywords){
    // this part shows the title of the post as the decription on single posts
    ?>
    <!-- Meta tags added by So Meta for Wordpress -->
    <!-- Description -->
<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        // for everything else show the default description
        echo $description;
    }
    ?>" />
    <?php
    // this next part lists tags and uses them to generate meta keywords
    ?><!-- Keywords -->
<meta name="keywords" content="<?php
    $posttags = get_the_tags();
    // If we get tags 
    if ($posttags) {
        // turn tags into comma separated string
        $keyword_str = "";
        foreach($posttags as $tag) {
            $keyword_str = $keyword_str .$tag->name . ', ';
        }
        // trim off last comma and space then output
        echo substr($keyword_str, 0, -2);
    }
    else {
        // if no tags, output default keywords
        echo $keywords;
    }
    ?>" />
    <?php
}

// function to output Google Open Graph meta tags
function someta_output_googlemeta($thumbnailURL, $description){
    ?>
    <meta itemprop="description" content="<?php if ( is_single() ) {
            single_post_title('', true); 
        } else {
            // for everything else show the default description
            echo $description;
        }
        ?>">
    <meta itemprop="image" content="<?php echo "$thumbnailURL"; ?>">
        <?php
}

// function to output Facebook Open Graph meta tags
function someta_output_facebookmeta($thumbnailURL, $description){
    ?>
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo get_permalink(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php if ( is_single() ) {
            single_post_title('', true); 
        } else {
            // for everything else show the default description
            echo $description;
        }
        ?>">
    <meta property="og:image" content="<?php echo "$thumbnailURL"; ?>">
    <?php
}

// function to output Twitter meta tags
function someta_output_twittermeta($thumbnailURL, $description){
    ?>
        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="<?php if ( is_single() ) {
            single_post_title('', true); 
        } else {
            // for everything else show the default description
            echo $description;
        }
        ?>">
        <meta name="twitter:image" content="<?php echo "$thumbnailURL"; ?>">
    <?php
}

// Function to sanitize input and return metatag config array
function someta_filter_input() {
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
$keywords = filter_input(INPUT_POST, "keywords", FILTER_SANITIZE_STRING); 
$thumbnailURL = filter_input(INPUT_POST, "thumbnailURL", FILTER_SANITIZE_URL);
$metatag_config = array (
            trim($description),
            trim($keywords),
            trim($thumbnailURL)
            );
    return $metatag_config;
}

// main function to output meta tags
function someta_metatags() {
    $metatag_config = someta_loadconfig();
    $description = $metatag_config[0];
    $keywords = $metatag_config[1];
    $thumbnailURL = $metatag_config[2];
    someta_show_metadescription($description, $keywords);
    someta_output_googlemeta($thumbnailURL, $description);
    someta_output_facebookmeta($thumbnailURL, $description);
    someta_output_twittermeta($thumbnailURL, $description);
}

?>
