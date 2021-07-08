<?php
/**
 * The template for displaying all single posts
 *
 * @package madrabbit
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="single-wrapper">

  <div class="containeri-fluid" id="content" tabindex="-1">

    <main class="site-main" id="main">

      <div class="row">

        <?php
        while ( have_posts() ) {
          the_post();
        ?>

        <div class="col-md-8 bg-primary">
          <div class="ms-5">
            <?php $image = get_attached_media( 'image' ); ?>
            <video
              class="video-js"
              controls preload="auto"
              width="1280" height="720"
              poster="<?php echo array_shift($image)->guid; ?>"
              data-setup='{"fluid": true}'
            >
            <?php $video = get_attached_media( 'video/mp4' ); ?>
            <source src="<?php echo array_shift($video)->guid; ?>" type="video/mp4">
            </video>
            <?php the_content(); ?>
          </div>
        </div>

        <div class="col-md-4 bg-info">
          <?php print_related_posts( get_the_ID() );?>
        </div>

        <?php
        }
        ?>

      </div><!-- .row -->

    </main><!-- #main -->

  </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
