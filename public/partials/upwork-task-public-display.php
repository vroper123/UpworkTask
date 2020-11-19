<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://lumenwp.com
 * @since      1.0.0
 *
 * @package    Upwork_Task
 * @subpackage Upwork_Task/public/partials
 */
?>


<div class="geo-container" id="geo-look">
<h1 class="geo-title">Geo Store Manager</h1>
    <div class="geo-container-image">
       <img class="geo-image" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/store-front-512.png'; ?>">
    </div>
    <p class="geo-text">
        Please provide your zip code or city to show store next to you
    </p>

    <form class="geo" action="/action_page.php|page not set yet">
        <input type="text" placeholder="Postcode/City" name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    
    <!--Map rendered here by Javascript-->
    <div id="geo-map"></div>
 
</div>