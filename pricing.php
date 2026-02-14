<?php
$pageTitle = 'AJ Tradehouse Forex Academy | Pricing';
$useTemplateAssets = true; 
?>
<?php require_once './includes/header.php'; ?>

<!-- <section class="page_header text-center section_decoration overflow-hidden">
  <div class="container">
    <h1 class="page_title text-dark">Our Pricing</h1>
  </div>
</section> -->

<section class="service_section section_space section_decoration">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="heading_block text-center text-dark">
          <h2 class="heading_text text-dark">
            Invest in Skill. Build Real Consistency.
          </h2>
          <p class="heading_description mb-0 text-dark">
            Structured mentorship designed for traders serious about mastering
            market structure, liquidity concepts, and disciplined execution.
          </p>
        </div>
      </div>
    </div>

    <div class="pricing_blocks_wrapper">

      <!-- Lifetime Mentorship -->
      <div class="pricing_block bg-dark style_2">
        <div class="pricing_amount bg-primary">
          <span>$1000</span>
          <small>One-Time Payment</small>
        </div>

        <div class="pricing_info">
          <h3 class="pricing_title text-white mb-0">
            Lifetime Mentorship Access
          </h3>
          <hr>
          <a class="btn bg-primary w-100 m-0" href="#" data-payment-modal data-plan="Lifetime Mentorship" data-price="$1000">
            <span class="btn_label">Apply for Mentorship</span>
            <span class="btn_icon">
              <i class="ph ph-arrow-up-right"></i>
            </span>
          </a>
        </div>

        <div class="pricing_features text-muted">
          <h3 class="features_title">Includes:</h3>
          <ul class="iconlist_block unordered_list_block">
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Full Market Structure</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text  text-white">Smart Money & Liquidity</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Weekly Live Market</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Private Community Access</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Trade Journaling</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Signal Channel -->
      <div class="pricing_block bg-dark style_2">
        <div class="pricing_amount bg-primary">
          <span>$500</span>
          <small>One-Time Access</small>
        </div>

        <div class="pricing_info">
          <h3 class="pricing_title text-white">
            Trade Signal Channel
          </h3>
          <hr>
          <a class="btn bg-primary w-100 m-0" href="#" data-payment-modal data-plan="Trade Signal Channel" data-price="$500">
            <span class="btn_label">Join Signal Channel</span>
            <span class="btn_icon">
              <i class="ph ph-arrow-up-right"></i>
            </span>
          </a>
        </div>

        <div class="pricing_features text-muted">
          <h3 class="features_title">Includes:</h3>
          <ul class="iconlist_block unordered_list_block">
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">High-Probability Trade Setups</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Entry, Stop-Loss & Target Levels</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Structured Trade Commentary</span>
            </li>
            <li>
              <span class="iconlist_icon"><i class="ph ph-check"></i></span>
              <span class="iconlist_text text-white">Risk-Based Execution Model</span>
            </li>
          </ul>
        </div>
      </div>

    </div>

  </div>
</section>

<?php include 'includes/payment-modal.php'; ?>
<?php require_once './includes/footer.php'; ?>
