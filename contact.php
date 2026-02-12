<?php
$pageTitle = 'AJ Tradehouse Forex Academy | Contact';
$useTemplateAssets = true; 
?>
<?php require_once './includes/header.php'; ?>

<section class="contact_section section_space bg-light">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <div class="comment_form p-lg-5">
                  <div class="heading_block">
                    <h2 class="heading_text">
                      Send us a Message
                    </h2>
                    <p class="heading_description mb-0">
                      Give us chance to serve and bring magic to your Finance.
                    </p>
                  </div>
                  <form action="contact.html#">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="input_title" for="input_name">Name<sup>*</sup></label>
                          <input id="input_name" class="form-control" type="text" name="name" placeholder="Carlo Castillo" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="input_title" for="input_email">Email<sup>*</sup></label>
                          <input id="input_email" class="form-control" type="email" name="email" placeholder="alma.lawson@example.com" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label class="input_title" for="input_phone">Phone<sup>*</sup></label>
                          <input id="input_phone" class="form-control" type="tel" name="phone" placeholder="+88 (0) 101 0000 000" required>
                        </div>
                        <div class="form-group">
                          <label class="input_title" for="input_message">Cover Letter<sup>*</sup></label>
                          <textarea id="input_message" class="form-control" name="message" placeholder="Write about your self..." required></textarea>
                        </div>
                        <button class="btn text-dark" type="submit">
                          <span class="btn_label">Send Message</span>
                          <span class="btn_icon ml-10"><svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7071 8.70711C20.0976 8.31658 20.0976 7.68342 19.7071 7.29289L13.3431 0.928932C12.9526 0.538408 12.3195 0.538408 11.9289 0.928932C11.5384 1.31946 11.5384 1.95262 11.9289 2.34315L17.5858 8L11.9289 13.6569C11.5384 14.0474 11.5384 14.6805 11.9289 15.0711C12.3195 15.4616 12.9526 15.4616 13.3431 15.0711L19.7071 8.70711ZM0 9H19V7H0V9Z" fill="#012A2B" />
                          </svg></span>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="contact_info_box p-5">
                  <h3 class="heading_text">Contact Info</h3>
                  <ul class="iconlist_block unordered_list_block">
                    <li>
                      <a href="tel:+8801010000000">
                        <span class="iconlist_icon">
                          <img src="assets/images/icons/icon_calling_3.svg" alt="Icon Calling">
                        </span>
                        <span class="iconlist_text">+88 (0) 101 0000 000</span>
                      </a>
                    </li>
                    <li>
                      <a href="mailto:synox@examplemail.com">
                        <span class="iconlist_icon">
                          <img src="assets/images/icons/icon_email_3.svg" alt="Icon Email">
                        </span>
                        <span class="iconlist_text">synox@examplemail.com</span>
                      </a>
                    </li>
                  </ul>
                  <ul class="social_icons_block unordered_list mb-0">
                    <li>
                      <a aria-label="Twitter X" href="contact.html#!">
                        <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                          <path d="M8.92704 6.35148L14.5111 0H13.1879L8.33921 5.5149L4.4666 0H0L5.85615 8.3395L0 15H1.32333L6.44364 9.17608L10.5334 15H15L8.92671 6.35148H8.92704ZM7.11456 8.41297L6.52121 7.58255L1.80014 0.974755H3.83269L7.64265 6.30746L8.236 7.13788L13.1885 14.0696H11.156L7.11456 8.41329V8.41297Z"></path>
                        </svg>
                      </a>
                    </li>
                    <li><a aria-label="Facebook" href="contact.html#!"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a aria-label="Linkedin" href="contact.html#!"><i class="fa-brands fa-linkedin-in"></i></a></li>
                  </ul>
                  <hr>
                  <ul class="office_location iconlist_block unordered_list_block mb-0">
                    <li>
                      <span class="iconlist_text">
                        <strong class="text-dark d-block">United states office:</strong> Sunshine Business park, Floor No 05A,Sector-94,
                      </span>
                    </li>
                    <li>
                      <span class="iconlist_text">
                        <strong class="text-dark d-block">United kingdom office:</strong> 12 Buckingham Rd, thorn Thwaite, HG3 4 TY, UK Contact
                      </span>
                    </li>
                  </ul>
                  <hr>
                  <ul class="iconlist_block unordered_list_block mb-0">
                    <li>
                      <span class="iconlist_text">
                        <strong class="text-dark d-block">Our Office Ppen Time:</strong> Mon - Sat : 8.00-5.00 <mark class="d-block text-danger">Sunday : Closed</mark>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
</section>

<?php require_once './includes/footer.php'; ?>