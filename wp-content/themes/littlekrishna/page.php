<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LittleKrishna
 */

get_header();
?>
<div class="breadcrumb-header py-5 width-100">
    <div class="container-fluid d-flex flex-column flex-lg-row align-items-lg-center justify-content-between px-4">
    
    <!-- Left Side (Breadcrumb + Title + Date) -->
    <div>
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
          <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
          <li class="breadcrumb-item"><span itemprop="name"><?php echo get_the_title(); ?></span></li>
        </ol>
      </nav>
    </div>
    
  </div>
</div>

<div class="container my-5">
  <div class="row g-5">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Content -->
        <div class="single-content mb-5">
          	<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
			?>
        </div>
    </div>
    <!-- Sidebar -->
    <?php get_sidebar();?>
    <!--sidebar ends-->
  </div>
</div>
<?php
get_footer();
