<?php
/*
 * Template Name: Cagayan Economic Page
 * The Economic page template file under whats new or first 100 days
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
$page_thumbnail = get_the_post_thumbnail_url(get_the_ID());
$secondary_thumb_args = $dynamic_featured_image->get_featured_images($page_id);
$secondary_image = "";
foreach ($secondary_thumb_args as $secondary_thumb_args_value) {
  $secondary_image = $secondary_thumb_args_value['full'];
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-100-days.min.css" />
  <!-- PAGE -->
  <div class="cag-page-100days cag-page-template">

    <div class="cag-100days-header">
      <div class="parallax-container">
        <div class="parallax-100days">
          <img src="<?php echo $secondary_image; ?>" />
        </div>
      </div>
    </div>

    <div class="cag-100days-content" id="cag-100days-content">

        <div class="container">

          <!-- <div class="card">
            <div class="card-content">
              <div class="row valign-wrapper">
                <div class="col l6 m6 s12">
                  <img src="images/fiesta.png" alt="">
                </div>
                <div class="col l6 m6 s12">
                  <h4>FELLOWSHIP/PROVINCIAL NIGHT SA MGA TOWN FIESTA</h4>
                  <p>Nais ni Gobernador Manuel N. Mamba maging malakas at matatag ang ugnayan ng Pamahalaang Panlalawigan sa mga bayan at barangay sa probinsiya. Upang mapaigting ang magandang samahan, siya ay dumadalo sa mga pista ng iba’t ibang bayan at isang “Provincial Night” ang nakalaan sa ilang araw ng kasiyahan. Ito ay  pinapangunahan ng Gobernador, kasama ang iba’t ibang department heads ng Pamahalaang Panlalawigan.</p>
                  <p>Ang gabing ito ay nakalaan sa  kasiyahan, sayawan at pagpapakilala sa mithiin ng Gobernador para sa lalawigan. Nagbibigay siya ng mensahe at nag-iiwan ng magiliw at masayang pagbati. Para kay Gob. Mamba, mahalaga ang pagkakaroon ng magandang ugnayan upang matiyak na maayos ding maibaba ang mga serbisyo at proyekto ng pamahaaln para sa mga Cagayano.</p>
                  <p>Pagbubuklod, pagsasama at pagkakaisa. Ito ang mga hangarin ng Gobernador sa lahat ng bayan at lahat ng barangay. Para sa kanya, ang pagkakaisa para sa kapakanan ng mga mamamayan ay mahalaga.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-content">
              <div class="row valign-wrapper">
                <div class="col l6 m6 s12">
                  <h4>ESTABLISHMENT OF A NEW QUARRY SYSTEM</h4>
                  <p>Ititigil ng Provincial Natural Resources and Environment Office (PNREO) lahat ng katiwalian sa operasyon ng quarry sa probinsiya sa pamamagitan ng pagbabalangkas ng bagong sistema na magsasaayos sa mga nadiskubreng kamalian. Mula sa mga natuklasang anomalya sa kalakaran sa mga quarry operation sa lalawigan nitong nagdaang administrasyon, naghahanda ng mga rekomendasyon ang PNREO kay Gob. Manuel N. Mamba upang mapigilan na ang mga pananamantala sa operasyon ng quarry sa probinsiya.lan sa mga iregularidad na natuklasan ni Edwin Jesus Buendia Jr. ng Mines and Geoscience Bureau, ang itinalaga ni Gob. Mamba na magsiyasat sa mga quarry operation sa buong probinsiya ay ang pagkakaroon ng mga pasong quarry permit, kawalan ng permit ng ilang humahakot, pandaraya sa dami ng hinahakot na graba at buhangin, maling quarry operation at ang lubhang napakababang koleksyon ng buwis na nakukuha ng probinsiya mula rito.</p>
                  <p>Bagamat malaking hamon at hindi makukuha nang madalian ang mga nais na pagbabago, sinabi ni Buendia na sa pamamagitan ng mga rekomendasyong kanyang isusumite sa Gobernador ay magkakaroon na ng isang sistemang maayos ang operasyom ng quarry sa Cagayan at ang mga natuklasan niyang katiwalian ay masawata na nang tuluyan.</p>
                  <p>Samantala, inihayag naman ni Buendia na kagagaling lamang niya sa  lalawigan ng Pampanga upang pag-aralan ang sistema ng quarry doon.</p>
                  <p>Malaking tulong diumano ang kanilang mga natutunan sa mga nagpapatakbo ng operasyon ng quarry sa Pampanga sa mga panuntunang kanilang ipapatupad sa lalawigan.</p>
                  <p>“Ang pagnanais ni Gob. Mamba na masugpo ang katiwalian sa operasyon sa quarry ay magbubunga ng mas maayos at magbibigay ng mas magandang benepisyo para sa Cagayan,” sambit ni Buendia.</p>
                </div>
                <div class="col l6 m6 s12 valign-wrapper">
                  <img src="images/quarry.png" alt="" class="valign">
                </div>
              </div>
            </div>
          </div> -->
          
        <?php the_content(); ?>

        </div>

    </div>

  </div><!-- END PAGE -->

  <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-social.min.js"></script>
<?php get_footer(); ?>