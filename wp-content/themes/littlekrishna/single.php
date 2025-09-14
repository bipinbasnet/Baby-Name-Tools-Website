<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LittleKrishna
 */

get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-header py-5 width-100">
    <div class="container-fluid d-flex flex-column flex-lg-row align-items-lg-center justify-content-between px-4">
    
    <!-- Left Side (Breadcrumb + Title + Date) -->
    <div>
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
          <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
          <?php  $categories = get_the_category();
          if ($categories) {
            $cat = $categories[0];
            echo '<li class="breadcrumb-item"><a href="' . get_category_link($cat->term_id) . '"><span itemprop="name">' . esc_html($cat->name) . '</span></a></li>';}
            ?>
          
          <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
        </ol>
      </nav>

      <!-- Title -->
      <h1 class="single-title mb-3"><?php wp_title(''); ?></h1>

      <!-- Last Updated -->
      <p class="last-updated text-muted">
        <span><i class="fas fa-user bi bi-person"></i> Author: <?php the_author(); ?></span> | <span><i class="far fa-calendar-alt"></i> Last Update: <?php the_modified_date('F j, Y'); ?></span>
      </p>
    </div>
    
  </div>
</div>
<div class="container my-5">
  <div class="row g-5">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Featured Image -->
        <?php if (has_post_thumbnail()): ?>
          <div class="single-featured">
            <?php the_post_thumbnail('full', ['class' => 'img-fluid w-100']); ?>
          </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="single-content mb-5">
          <?php the_content(); ?>
        </div>

        <!-- Tags -->
        <div class="single-tags mb-5">
          <?php the_tags('<span class="badge bg-light text-dark me-2">#','</span><span class="badge bg-light text-dark me-2">#','</span>'); ?>
        </div>

        <!-- Comments -->
        <div class="single-comments mt-5">
          <?php comments_template(); ?>
        </div>
    </div>

    <!-- Sidebar -->
    <?php get_sidebar();?>
    <!--sidebar ends-->
  </div>
</div>
<?php endwhile; endif;
get_footer();
?>