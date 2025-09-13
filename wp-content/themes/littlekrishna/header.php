<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LittleKrishna
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<title>
<?php
if ( is_front_page() || is_home() ) {
    // Homepage: show site title + tagline
    echo get_bloginfo('name') . ' | ' . get_bloginfo('description');
} elseif ( is_singular() ) {
    // Single post or page: show post/page title + site title
    the_title();
    echo ' | ' . get_bloginfo('name');
} elseif ( is_category() ) {
    // Category archive
    single_cat_title();
    echo ' | ' . get_bloginfo('name');
} elseif ( is_tag() ) {
    // Tag archive
    single_tag_title();
    echo ' | ' . get_bloginfo('name');
} elseif ( is_archive() ) {
    // Other archives (author, date)
    wp_title('');
    echo ' | ' . get_bloginfo('name');
} else {
    // Fallback
    wp_title('');
    echo ' | ' . get_bloginfo('name');
}
?>
</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <!--link rel="stylesheet" href="style.css"/-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="main-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'container' => false,
                'menu_class' => 'navbar-nav ms-auto gap-3',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
    </div>
</nav>