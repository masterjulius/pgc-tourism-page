<!-- CSS Fonts -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/single-advisories.min.css" />
<?php
  /**
   * Variables
   */
  $post_title = get_the_title();
  $thumbnail = get_the_post_thumbnail_url();
  $post_permalink  = get_the_permalink();
  $post_date = get_the_date( 'h:i A, F j, Y' );

  $post_thumbnail = !empty($thumbnail) ? $thumbnail : get_stylesheet_directory_uri() . "/images/others/no-thumbnail_1366x800.png";

  // Author Details
  $author_id = get_the_author_meta( 'ID' );
  $author_post_links = get_author_posts_url( $author_id );

?> 
<!-- PAGE -->
<div class="cag-page-advisory">

  <div class="parallax-container">
    <div class="parallax-advisory"><img src="<?php echo $post_thumbnail; ?>"></div>
    <div class="advisory-header-title valign-wrapper">
      <a href="#advisory-container" class="page-scroll"><h2>PCCDRRMO Advisory</h2></a>
    </div>
  </div>


  <div class="advisory-container" id="advisory-container">

    <div class="container">

      <div class="row">

        <div class="col s12">

          <div class="card">

            <div class="card-content">

              <h3><?php $post_title; ?></h3>

            <?php echo get_the_content(); ?>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/single-advisories.min.js"></script>

</div><!-- END PAGE -->  