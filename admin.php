<?php
// Admin Page for So Meta for Wordpress 1.0 //

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
    
// Begin admin page html
?>
	<div class="wrap">
      <!-- FONT
      –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    
      <!-- CSS
      –––––––––––––––––––––––––––––––––––––––––––––––––– -->
      <link rel="stylesheet" href="https://someta.sourcepassive.com/css/normalize.css">
      <link rel="stylesheet" href="https://someta.sourcepassive.com/css/skeleton.css">

  <div class="container">
    <div class="row">

      <div class="one-half column" style="margin-top:none;text-align: center;" id="top">
        <img src="https://sourcepassive.com/ads/so-meta.png" style="margin: auto;width: 50%;"></br>
        <h4>Easy Meta Tags for Wordpress</h4>
       
      </div>
      
        <div class="one-half column" style="margin-top: 8%">
            <h3>Directions</h3>
            <li>Add your default description.</li>
            <li>Add your keywords.</li>
            <li>Add your thumbnail image url.</li>
            <li>Click "update" and you're done.</li>
      </div>
      
    </div>
    <!-- Begin Configuration Form -->
    <form method="post">
    <div class="row">
        <div class="one-half column" style="margin-top: 5%;text-align: left;">
            <label for="Description"><h3>Description</h3></label>
                <textarea style="float:left;width:100%;min-height:75px;outline:none;resize:none;border:1px solid grey;" name="description" id="description" placeholder="<?php echo $metatag_config[0];?>" required /><?php echo $metatag_config[0];?></textarea>
                <li>Google truncates snippets to about 160 characters.</li>
                <li>We recommend descriptions between 60 and 160 characters.</li>
            </div>
            <div class="one-half column" style="margin-top: 5%;text-align: left;">
                <label for="keywords"><h3>Keywords</h3></label>
                <textarea style="float:left;width:100%;min-height:75px;outline:none;resize:none;border:1px solid grey;" name="keywords" id="keywords" placeholder="<?php echo $metatag_config[1];?>" required /><?php echo $metatag_config[1];?>
                </textarea>
               <li>Use about ten meta keywords.</li> 
               <li>Separate keywords with a comma.</li>
            </div>
        </div>
        <div class="row"> 
        <div class="one-half column" style="margin-top: 5%;text-align: left;" id="features">
            <label for="thumbnailURL"><h3>Thumbnail URL</h3></i></label>
                <input style="float:left;width:100%;outline:none;resize:none;border:1px solid grey;" type="url" name="thumbnailURL" id="thumbnailURL" value="<?php echo $metatag_config[2];?>" required />
               <li>The thumbnail url should link to a valid image: 1200 pixels x 627 pixels (1.91/1 ratio).</li>
               <li>This image will be used for the OG image and Twitter card.</li>
               <input type="submit" name="submit" id="submit" value="Update">
          </form>
		<!-- End Configuration Form -->
		</div>
            <div class="one-half column" style="margin-top: 5%;text-align: left;">
            <h3>Need Help?</h3>
            You can get help or leave feature requests by email: 
                <a href="mailto:james@checkeredhat.com">james@checkeredhat.com</a></br></br><p>
            <i><a href="https://someta.sourcepassive.com/">So Meta for Wordpress</a> is Free and Open Source.</br> If you find this plugin useful <b>please consider donating.</b> Donate using <a href="https://www.paypal.com/paypalme/jamesschweda" target="_blank">PayPal</a>, <a href="bitcoin:bc1q65l5kprrwd7x98np0w4gj5qsjlkud0jstkd0a8">Bitcoin</a>, or <a href="monero:472wiubkM76K1yGUkKgXqYFNjsMQigzGwiMFc7nyfNvCKhE4oq3MGy74ahbdRAFtgEj68daU75kK3SVmWYJrsBGoBRxMteo">Monero</a></i></p>.
        </div>
    </div>
  </div>
</div>