<?php
/*
Plugin Name: Add post seo metadata
Plugin URI: TODO
Description: This plugin allow you to add post meta data on wordpress post to optimize your wordpress webiste seo.
Version: 1.0
Author: Pierre FERROLLIET
Author URI: pierre.ferrolliet@idci-consulting.fr
License: GPL2
*/

// Retrieve all enabled languages in qtranslate plugin if activated
function get_seo_enabled_languages()
{
  global $q_config;

  if($GLOBALS['wp_version'] != QT_SUPPORTED_WP_VERSION)
    return array(get_seo_default_language());
  else
    return $q_config['enabled_languages'];
}

// Retrieve the default language in case either disabled qtranslate plugin
function get_seo_default_language()
{
  if (WPLANG != '') 
    return substr(WPLANG, 0, strpos(WPLANG,'_')); // get the WP language
  else 
    return 'fr'; // default language: French
}

// Retrieve default keywords : post categories separated coma by default
function get_default_keywords()
{
  $keywords = "";
  $categories = get_the_category();
  foreach($categories as $key => $category)
  {
    $keywords .= $category->name;
    // Display coma only if the category isn't the last
    if($key != count($categories)-1)
      $keywords .= ', ';
  }
  return $keywords;
}

// Generate html input by lang, metakey and metavalue
function generate_seo_meta_input_by_lang($lang, $metakey, $metavalue)
{
  return 
  '<div class="input">
    <span class="lang">('.$lang.') <img src="'.plugins_url().'/add-post-seo-meta/flags/'.$lang.'.png" alt="'.$lang.'" /></span>
    <input class="'.$metakey.'" type="text" tabindex="1" size="30" name="'.$metakey.'_'.$lang.'" value="'.$metavalue.'" />
   </div>';
}

// Generate html inputs by metakey for each enabled languages
function generate_seo_meta_inputs($metakey)
{
  $inputs = "";
  foreach(get_seo_enabled_languages() as $lang)
  {
    // Retrieve metavalue
    $metavalue = get_post_meta(get_the_ID(), '_seo_'.$metakey.'_'.$lang, true);

    // Generate html inputs
    $inputs .= generate_seo_meta_input_by_lang($lang, $metakey, $metavalue);
  }
  return $inputs;
}

// Add seo meta fields on a post
add_action('edit_form_advanced', 'add_post_seo_meta_fields');
add_action('simple_edit_form', 'add_post_seo_metat_fields');
add_action('edit_page_form', 'add_post_seo_meta_fields');
function add_post_seo_meta_fields()
{
?>
  <div id="seometadiv" class="postbox">
    <h3 class="hndle">SEO Meta</h3>
    <div class="inside">
      <fieldset id="seo_title_<?php echo $v; ?>">
        <legend><?php _e('Title'); ?></legend>
        <?php echo generate_seo_meta_inputs('title'); ?>
      </fieldset>
      <fieldset id="seo_description_<?php echo $v; ?>">
        <legend><?php _e('Meta Description'); ?></legend>
        <?php echo generate_seo_meta_inputs('description'); ?>
      </fieldset>
      <fieldset id="seo_keywords_<?php echo $v; ?>">
        <legend><?php _e('Meta Keywords'); ?></legend>
        <?php echo generate_seo_meta_inputs('keywords'); ?>
      </fieldset>
    </div>
  </div>
<?php
}

// Add CSS for display seo meta fields on a post
add_action('admin_head', 'add_post_seo_meta_css');
function add_post_seo_meta_css() {
  ?>
  <style type="text/css">
  #seometadiv .inside fieldset
  {
    width: 100%;
    margin: 0;
    padding: 4px 3px;
    font-size: 13px;
  }

  #seometadiv .inside fieldset .input
  {
    height: 35px;
  }

  #seometadiv .inside fieldset legend
  {
    font-weight: bold;
    height: 20px;
  }

  #seometadiv .inside fieldset .input .lang
  {
    float: left;
    width: 64px;
    line-height: 30px;
  }

  #seometadiv .inside fieldset .input .lang img
  {
    padding: 9px 5px;
    float: left;
  }

  #seometadiv .inside fieldset .input input
  {
    border: 0 none;
    padding: 5px;
    color: #666;
    font-size: 11px;
    border: 1px solid #CCCCCC;
    width: 92%;
  }
  </style>
  <?php
}

// Persist seo meta in database
add_action('save_post', 'update_post_seo_meta');
function update_post_seo_meta()
{
  if (isset($_POST))
  {
    foreach(get_seo_enabled_languages() as $v)
    {
      if (isset($_POST['title_'.$v]))
      {
        // Add seo title in the database
        if (!update_post_meta(get_the_ID(), '_seo_title_'.$v, $_POST['title_'.$v])) 
          add_post_meta(get_the_ID(), '_seo_title_'.$v, $_POST['title_'.$v], true);
      }
      if (isset($_POST['description_'.$v]))
      {
        // Add seo description in the database
        if (!update_post_meta(get_the_ID(), '_seo_description_'.$v, $_POST['description_'.$v])) 
          add_post_meta(get_the_ID(), '_seo_description_'.$v, $_POST['description_'.$v], true);
      }
      if (isset($_POST['keywords_'.$v]))
      {
        // Add seo keywords in the database
        if (!update_post_meta(get_the_ID(), '_seo_keywords_'.$v, $_POST['keywords_'.$v])) 
          add_post_meta(get_the_ID(), '_seo_keywords_'.$v, $_POST['keywords_'.$v], true);
      }
    }
  }
}

// Retrieve seo title if existing, otherwise retrieve default title
add_filter('wp_title','get_post_seo_meta_title');
function get_post_seo_meta_title()
{
  $seo_title = get_post_meta(get_the_ID(), '_seo_title_'.get_seo_default_language(), true);
  $default_title = get_the_title(get_the_ID());

  return !($seo_title) ? $default_title : $seo_title;
}

// Retrieve seo description if existing, otherwise retrieve default description
function get_post_seo_meta_description()
{
  $seo_description = get_post_meta(get_the_ID(), '_seo_description_'.get_seo_default_language(), true);
  $default_description = get_the_title(get_the_ID());

  return !($seo_description) ? $default_description : $seo_description;
}

// Retrieve seo keywords if existing, otherwise retrieve default keywords
function get_post_seo_meta_keywords()
{
  $seo_keywords = get_post_meta(get_the_ID(), '_seo_keywords_'.get_seo_default_language(), true);
  $default_keywords = get_default_keywords();
  return !($seo_keywords) ? $default_keywords : $seo_keywords;
}

// Display meta in head block
add_filter('wp_head', 'add_post_seo_meta');
function add_post_seo_meta()
{
  echo '
  <meta name="keywords" content="'.get_post_seo_meta_keywords().'" />
  <meta name="description" content="'.get_post_seo_meta_description().'" />';
}
?>
