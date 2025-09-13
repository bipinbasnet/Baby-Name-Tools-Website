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
  <?php //if (function_exists('custom_breadcrumb')) custom_breadcrumb(); ?>
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
    <div class="col-lg-4">
      <aside class="sidebar">

        <!-- Search -->
        <div class="sidebar-widget mb-4">
          <h5 class="widget-title">Search</h5>
          <?php get_search_form(); ?>
        </div>

        <!-- Categories -->
        <div class="sidebar-widget mb-4">
          <h5 class="widget-title">Categories</h5>
          <ul class="list-unstyled">
            <?php wp_list_categories(['title_li' => '']); ?>
          </ul>
        </div>

        <!-- Recent Posts -->
        <div class="sidebar-widget mb-4">
          <h5 class="widget-title">Recent Posts</h5>
          <ul class="list-unstyled">
            <?php
              $recent_posts = wp_get_recent_posts(['numberposts' => 5]);
              foreach ($recent_posts as $post) :
            ?>
              <li>
                <a href="<?php echo get_permalink($post['ID']); ?>">
                  <?php echo esc_html($post['post_title']); ?>
                </a>
              </li>
            <?php endforeach; wp_reset_query(); ?>
          </ul>
        </div>

        <!-- Tags -->
        <div class="sidebar-widget mb-4">
          <h5 class="widget-title">Tags</h5>
          <div class="tag-cloud">
            <?php wp_tag_cloud(['smallest' => 12, 'largest' => 12, 'unit' => 'px', 'number' => 15]); ?>
          </div>
        </div>

      </aside>
    </div>
  </div>
</div>
<?php endwhile; endif;
//get_sidebar();
get_footer();
?>