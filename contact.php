<?php
$pageTitle = 'AJ Tradehouse Forex Academy | Contact';
$useTemplateAssets = true; 
?>
<?php require_once './includes/header.php'; ?>

<section class="contact_section section_space bg-light">
  <div class="container">
    <div class="row">

      <!-- CONTACT FORM -->
      <div class="col-lg-8">
        <div class="comment_form p-lg-5">
          <div class="heading_block">
            <h2 class="heading_text text-dark">
              Apply for Mentorship / Make an Inquiry
            </h2>
            <p class="heading_description mb-0">
              Tell us about your trading background and what you’re interested in.
              Our team will review your application and get back to you.
            </p>
          </div>

          <form action="#" method="post">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label class="input_title" for="first_name">First Name<sup>*</sup></label>
                  <input id="first_name" class="form-control" type="text" name="first_name" placeholder="John" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="input_title" for="last_name">Last Name<sup>*</sup></label>
                  <input id="last_name" class="form-control" type="text" name="last_name" placeholder="Doe" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="input_title" for="email">Email<sup>*</sup></label>
                  <input id="email" class="form-control" type="email" name="email" placeholder="you@example.com" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="input_title" for="level">Company / Trading Level<sup>*</sup></label>
                  <input id="level" class="form-control" type="text" name="trading_level" placeholder="Beginner / Intermediate / Advanced / Prop Firm Trader" required>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label class="input_title" for="inquiry_type">Inquiry Type<sup>*</sup></label>
                  <select id="inquiry_type" class="form-control" name="inquiry_type" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="physical">Physical Mentorship</option>
                    <option value="online">Online Mentorship</option>
                    <option value="one_on_one">One-on-One Mentorship</option>
                    <option value="robot">Forex Robot Automation</option>
                    <option value="vip_signal">VIP Signal</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="input_title" for="message">Additional Details</label>
                  <textarea id="message" class="form-control" name="message" placeholder="Briefly describe your trading experience or what you’re looking to achieve..."></textarea>
                </div>

                <button class="btn bg-primary text-white" type="submit">
                  <span class="btn_label">Submit Application</span>
                </button>

              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- CONTACT INFO -->
      <div class="col-lg-4">
        <div class="contact_info_box p-5">
          <h3 class="heading_text">Contact Info</h3>

          <ul class="iconlist_block unordered_list_block">

            <li>
              <a href="https://wa.me/2348135719117" target="_blank">
                <span class="iconlist_icon">
                  <i class="ph ph-whatsapp-logo text-primary"></i>
                </span>
                <span class="iconlist_text text-dark">
                  Whatsapp: 0813 571 9117
                </span>
              </a>
            </li>

            <li>
              <span class="iconlist_icon">
                <i class="ph ph-map-pin text-primary"></i>
              </span>
              <span class="iconlist_text">
                Blue Zodiac Complex,<br>
                Chief G U Ake Road, ELIOZU,<br>
                Port Harcourt 560011, Rivers
              </span>
            </li>

          </ul>

          <hr>

          <ul class="social_icons_block unordered_list mb-0">

            <li>
              <a href="https://www.instagram.com/aj_tradehouse?igsh=MWJybHYwaXc3azIzcw==" target="_blank">
                <i class="ph ph-instagram-logo"></i>
              </a>
            </li>

            <li>
              <a href="https://www.instagram.com/aj__forex?igsh=ZXB4MGxhdTd3Y2Vu" target="_blank">
                <i class="ph ph-instagram-logo"></i>
              </a>
            </li>

            <li>
              <a href="https://t.me/TradeHousecommunity" target="_blank">
                <i class="ph ph-telegram-logo"></i>
              </a>
            </li>

            <li>
              <a href="https://www.youtube.com/@Iam_Aj_fx" target="_blank">
                <i class="ph ph-youtube-logo"></i>
              </a>
            </li>

          </ul>

        </div>
      </div>

    </div>
  </div>
</section>


<?php require_once './includes/footer.php'; ?>