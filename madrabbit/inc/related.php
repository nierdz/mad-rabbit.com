<?php
/**
 * Custom function to print related posts
 *
 * @package madrabbit
 */

/**
 * Get related posts
 *
 * @param int id of the post.
 */
function print_related_posts( $post_id ) {
  global $wpdb;

  $max_related_posts = 20;

  $tags = wp_list_pluck( get_the_terms( $post_id, 'post_tag' ), 'term_id');
  $categories = wp_list_pluck( get_the_terms( $post_id, 'category' ), 'term_id');

  $related_args = array(
      'post_type'      => 'post',
      'posts_per_page' => $max_related_posts,
      'post_status'    => 'publish',
      'post__not_in'   => array( $post_id ),
      'orderby'        => 'rand',
      'tax_query'      => array(
        'relation' => 'OR',
        array(
          'taxonomy' => 'post_tag',
          'field'    => 'id',
          'terms'     => $tags
        ),
        array(
          'taxonomy' => 'category',
          'field'    => 'id',
          'terms'    => $categories,
        ),
      )
    );

  $related_query = new WP_Query( $related_args );
  while ( $related_query->have_posts() ) {
    $related_query->the_post();
    ?>

    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-4">
          <img src="..." class="img-fluid" alt="...">
        </div>';
        <div class="col-8">
          <div class="card-body">
            <?php the_title( sprintf( '<h5 class="card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
            <p class="card-text"><?php the_excerpt(); ?></p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>

  <?php
  }
  wp_reset_postdata();

}
?>
