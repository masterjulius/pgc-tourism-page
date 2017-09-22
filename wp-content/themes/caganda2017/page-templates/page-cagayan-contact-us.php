<?php 
/*
 * Template Name: Cagayan Contact Us Page
 * The Contact Us page template file
 */
get_header();
$theme_dir = get_stylesheet_directory_uri();
$page_id = get_the_ID();
?>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir; ?>/css/page-contact-us.min.css" />

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

    <!-- Leaflet library for maps -->
<link rel="stylesheet" type="text/css" href="//unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<script type="text/javascript" src="//unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

<!-- PAGE -->
    <div class="cag-page-contactus">

      <div class="contact-header">
        <div class="parallax-container">
          <div class="contact-parallax"><img src="<?php echo get_the_post_thumbnail_url( $page_id ); ?>"></div>
        </div>
      </div>

      <div class="contact-body">

        <div class="row contact-title">
          <div class="col s12">
            <h4 class="animated tada">Provincial Planning and Development Office -<br>Information Technology Division Staffs</h4>
          </div>
        </div>
        <div class="contact-staff">
          <div class="row">

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Rholando B. Calabazaron Jr.</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Abigail C. Pineda</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Julius B. Palcong</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Daniel L. Ramones</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Mark Maynard A. Guzman</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Nathaniel B. Gumangan</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Oliver S. De Leon</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- <div class="col l3 m6 s12">
              <div class="card">
                <div class="card-content">
                  <table class="">
                    <thead>
                      <tr>
                        <th data-field="title" colspan="2">Juan Dela Cruz</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><i class="cagicon-phone"></i></td>
                        <td>09123456789</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>juandelacruz@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->

            <!-- // end Developers boxes -->


          </div>
        </div>

        <div class="row contact-separator">
          <div class="col s12">
            <hr>
          </div>
        </div>


        <div class="contact-bottom">
          <div class="row">
            <div class="col l6 m6 s12">
              <span class="contact-icon btn-floating btn-large">
                <i class="cagicon-email"></i>
              </span>
              <p class="contact-text">Leave A Message</p>

              <div class="card">
                <div class="card-content">
                  <form>
                    <div class="row">
                      <div class="input-field col s6">
                        <i class="cagicon-account prefix"></i>
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Last Name</label>
                      </div>
                      <div class="input-field col s12">
                        <i class="cagicon-email-outline prefix"></i>
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
                      </div>
                      <div class="input-field col s12">
                        <i class="cagicon-pencil prefix"></i>
                        <textarea id="message" class="materialize-textarea"></textarea>
                        <label for="message">Message</label>
                      </div>

                      <div class="col s12">
                        <button class="btn green waves-effect waves-light right" type="submit" name="action">Submit
                          <i class="cagicon-send right"></i>
                        </button>
                      </div>



                    </div>
                  </form>
                </div>
              </div>


            </div>
            <div class="col l6 m6 s12">
              <span class="contact-icon btn-floating btn-large">
                <i class="cagicon-earth"></i>
              </span>
              <p class="contact-text">Visit Us</p>

              <div class="card">
                <div class="cag-contact-address">
                  <table class="">
                    <tbody>
                      <tr>
                        <td><i class="cagicon-map-marker"></i></td>
                        <td>Provincial Planning &amp; Development Office - <span>Information Technology Division</span>, Capitol Hills, Tuguegarao City</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-phone-classic"></i></td>
                        <td>123-34-4434</td>
                      </tr>
                      <tr>
                        <td><i class="cagicon-email"></i></td>
                        <td>ppdolikesyou@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>

                  <!-- <p><i class="cagicon-map-marker"></i> PPDO IT Division, Capitol Hills, Tuguegarao City</p>
                  <p><i class="cagicon-phone-classic"></i> 123-34-4434</p>
                  <p><i class="cagicon-email"></i> ppdo-itdivision@gmail.com</p> -->
                </div>
                <div id="cag-map"></div>
              </div>


            </div>
          </div>
        </div>

      </div> <!--- End contact body -->

    </div><!-- END PAGE -->

    <!-- ============================================= -->

    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_dir; ?>/js/page-cagayan-contact-us.min.js"></script>

<?php
get_footer();
?>