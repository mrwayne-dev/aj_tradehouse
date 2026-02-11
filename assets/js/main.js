/* =========================================================
   MAIN.JS – COMPLETE SITE FUNCTIONALITY
   Richie Forex Trading Academy
========================================================= */

document.addEventListener("DOMContentLoaded", () => {

  /* =====================================
     MOBILE MENU TOGGLE
  ===================================== */
  const hamburger = document.querySelector(".hamburger");
  const mobileNav = document.querySelector(".mobile-nav");
  const mobileNavLinks = document.querySelectorAll(".mobile-nav a");

  if (hamburger && mobileNav) {
    hamburger.addEventListener("click", (e) => {
      e.stopPropagation();
      mobileNav.classList.toggle("open");
      hamburger.classList.toggle("active");
      document.body.classList.toggle("nav-open");
    });

    mobileNavLinks.forEach(link => {
      link.addEventListener("click", () => {
        mobileNav.classList.remove("open");
        hamburger.classList.remove("active");
        document.body.classList.remove("nav-open");
      });
    });

    document.addEventListener("click", (e) => {
      if (mobileNav.classList.contains("open") && 
          !mobileNav.contains(e.target) && 
          !hamburger.contains(e.target)) {
        mobileNav.classList.remove("open");
        hamburger.classList.remove("active");
        document.body.classList.remove("nav-open");
      }
    });
  }

  /* =====================================
     PAGE LOAD ANIMATION
  ===================================== */
  setTimeout(() => {
    document.body.classList.add("is-loaded");
  }, 120);

  /* =====================================
     SCROLL REVEALS
  ===================================== */
  const revealSections = document.querySelectorAll(".scroll-reveal");

  const sectionObserver = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          sectionObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  revealSections.forEach(section => {
    sectionObserver.observe(section);
  });

  /* =====================================
     HERO IMAGE SLIDER
  ===================================== */
  const slides = document.querySelectorAll(".hero-slide");
  const prevBtn = document.querySelector(".hero-nav-prev");
  const nextBtn = document.querySelector(".hero-nav-next");

  let currentIndex = 0;
  let sliderInterval;

  function showSlide(index) {
    slides.forEach(slide => slide.classList.remove("active"));
    slides[index].classList.add("active");
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
  }

  function startAutoSlide() {
    sliderInterval = setInterval(nextSlide, 5000);
  }

  function resetAutoSlide() {
    clearInterval(sliderInterval);
    startAutoSlide();
  }

  if (slides.length > 1) {
    startAutoSlide();
    nextBtn?.addEventListener("click", () => {
      nextSlide();
      resetAutoSlide();
    });
    prevBtn?.addEventListener("click", () => {
      prevSlide();
      resetAutoSlide();
    });
  }

  /* =====================================
     TRADINGVIEW WIDGET
  ===================================== */
  const tvContainer = document.querySelector(".tradingview-widget-container__widget");

  if (tvContainer) {
    const tvScript = document.createElement("script");
    tvScript.src = "https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js";
    tvScript.async = true;

    tvScript.innerHTML = JSON.stringify({
      symbols: [
        { proName: "FX:EURUSD", title: "EUR/USD" },
        { proName: "FX:GBPUSD", title: "GBP/USD" },
        { proName: "FX:USDJPY", title: "USD/JPY" },
        { proName: "OANDA:XAUUSD", title: "Gold" },
        { proName: "NASDAQ:NAS100", title: "NASDAQ 100" },
        { proName: "FOREXCOM:US30", title: "US30" },
        { proName: "BITSTAMP:BTCUSD", title: "BTC/USD" },
        { proName: "BITSTAMP:ETHUSD", title: "ETH/USD" }
      ],
      showSymbolLogo: false,
      isTransparent: true,
      displayMode: "adaptive",
      colorTheme: "light",
      locale: "en"
    });

    tvContainer.appendChild(tvScript);
  }

  /* =====================================
     SOLUTION ITEMS INTERACTION
  ===================================== */
  const items = document.querySelectorAll(".solution-item");
  const visuals = document.querySelectorAll(".solution-visual");

  if (items.length > 0 && visuals.length > 0) {
    items.forEach(item => {
      item.addEventListener("mouseenter", () => {
        const target = item.dataset.solution;
        items.forEach(i => i.classList.remove("active"));
        visuals.forEach(v => v.classList.remove("active"));
        item.classList.add("active");
        const targetVisual = document.querySelector(`.solution-visual[data-visual="${target}"]`);
        if (targetVisual) {
          targetVisual.classList.add("active");
        }
      });
    });
  }

  /* =====================================
     PAYMENT MODAL
  ===================================== */
  const paymentModal = document.getElementById("paymentModal");
  const paymentModalClose = document.querySelector(".payment-modal-close");
  const paymentOverlay = document.querySelector(".payment-modal-overlay");
  const mentorshipBtn = document.getElementById("mentorshipBtn");
  const signalsBtn = document.getElementById("signalsBtn");
  const copyButtons = document.querySelectorAll(".payment-copy-btn");
  const whatsappBtn = document.getElementById("whatsappBtn");

  function openPaymentModal(planType) {
    if (!paymentModal) {
      console.error("Payment modal not found!");
      return;
    }

    if (whatsappBtn) {
      let message = "Hello, I just completed my payment for ";
      if (planType === "mentorship") {
        message += "Lifetime Mentorship ($1000)";
      } else if (planType === "signals") {
        message += "Lifetime VIP Signals ($500)";
      }
      const whatsappUrl = `https://wa.me/2348161262960?text=${encodeURIComponent(message)}`;
      whatsappBtn.setAttribute("href", whatsappUrl);
    }

    paymentModal.classList.add("active");
    document.body.classList.add("modal-open");
  }

  function closePaymentModal() {
    if (!paymentModal) return;
    paymentModal.classList.remove("active");
    document.body.classList.remove("modal-open");
  }

  if (mentorshipBtn) {
    mentorshipBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openPaymentModal("mentorship");
    });
  }

  if (signalsBtn) {
    signalsBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openPaymentModal("signals");
    });
  }

  if (paymentModalClose) {
    paymentModalClose.addEventListener("click", closePaymentModal);
  }

  if (paymentOverlay) {
    paymentOverlay.addEventListener("click", (e) => {
      if (e.target === paymentOverlay) {
        closePaymentModal();
      }
    });
  }

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && paymentModal?.classList.contains("active")) {
      closePaymentModal();
    }
  });

  copyButtons.forEach(button => {
    button.addEventListener("click", async () => {
      const targetId = button.getAttribute("data-copy");
      const targetInput = document.getElementById(targetId);
      if (!targetInput) return;

      try {
        await navigator.clipboard.writeText(targetInput.value);
        const icon = button.querySelector("i");
        const originalClass = icon.className;
        button.classList.add("copied");
        icon.className = "ph ph-check";
        setTimeout(() => {
          button.classList.remove("copied");
          icon.className = originalClass;
        }, 2000);
      } catch (err) {
        targetInput.select();
        document.execCommand("copy");
      }
    });
  });

  /* =========================================================
     CONTACT FORM HANDLER
  ========================================================= */

  const contactForm = document.querySelector(".contact-form");
  
  if (contactForm) {
    const submitButton = contactForm.querySelector('button[type="submit"]');
    const originalButtonText = submitButton ? submitButton.textContent : 'Submit';

    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      console.log('📧 Form submitted');
      
      clearMessages();
      
      if (!validateContactForm()) {
        console.log('❌ Validation failed');
        return;
      }
      
      const formData = getContactFormData();
      console.log('📦 Form data:', formData);
      
      setContactButtonState(true, 'Sending...');
      
      try {
        console.log('🚀 Sending to API...');
        
        const response = await fetch('/api/contact.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData)
        });
        
        console.log('📡 Response status:', response.status);
        console.log('📡 Response headers:', response.headers.get('content-type'));
        
        // Get response text first
        const responseText = await response.text();
        console.log('📄 Raw response:', responseText);
        
        // Try to parse as JSON
        let data;
        try {
          data = JSON.parse(responseText);
        } catch (parseError) {
          console.error('❌ JSON parse error:', parseError);
          console.error('📄 Response was:', responseText);
          throw new Error('Server returned invalid response. Please try again.');
        }
        
        console.log('✅ Parsed data:', data);
        
        if (data.success) {
          showContactSuccess(data.message);
          contactForm.reset();
          trackContactSubmission(formData.inquiry_type);
        } else {
          showContactError(data.message, data.errors);
        }
        
      } catch (error) {
        console.error('❌ Form submission error:', error);
        showContactError(
          'Unable to send your message. Please try again or email us directly at support@richieforextradingacademy.com'
        );
      } finally {
        setContactButtonState(false, originalButtonText);
      }
    });

    addContactInputValidation();

    /* HELPER FUNCTIONS */

    function getContactFormData() {
      const formData = new FormData(contactForm);
      return {
        first_name: formData.get('first_name')?.trim() || '',
        last_name: formData.get('last_name')?.trim() || '',
        email: formData.get('email')?.trim() || '',
        company: formData.get('company')?.trim() || '',
        inquiry_type: formData.get('inquiry_type')?.trim() || ''
      };
    }

    function validateContactForm() {
      let isValid = true;
      const inputs = contactForm.querySelectorAll('input[required], select[required]');
      
      inputs.forEach(input => {
        if (!validateContactField(input)) {
          isValid = false;
        }
      });
      
      return isValid;
    }

    function validateContactField(field) {
      const value = field.value.trim();
      let isValid = true;
      let errorMessage = '';
      
      if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required';
      }
      
      if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
          isValid = false;
          errorMessage = 'Please enter a valid email address';
        }
      }
      
      if (field.tagName === 'SELECT' && (!value || value === '')) {
        isValid = false;
        errorMessage = 'Please select an option';
      }
      
      if (!isValid) {
        showContactFieldError(field, errorMessage);
      } else {
        clearContactFieldError(field);
      }
      
      return isValid;
    }

    function addContactInputValidation() {
      const inputs = contactForm.querySelectorAll('input, select');
      
      inputs.forEach(input => {
        input.addEventListener('blur', () => {
          if (input.value.trim()) {
            validateContactField(input);
          }
        });
        
        input.addEventListener('input', () => {
          clearContactFieldError(input);
        });
      });
    }

    function showContactFieldError(field, message) {
      const formGroup = field.closest('.form-group');
      if (!formGroup) return;
      
      clearContactFieldError(field);
      formGroup.classList.add('has-error');
      
      const errorDiv = document.createElement('div');
      errorDiv.className = 'field-error';
      errorDiv.textContent = message;
      errorDiv.style.cssText = `
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
      `;
      
      field.style.borderColor = '#dc3545';
      formGroup.appendChild(errorDiv);
    }

    function clearContactFieldError(field) {
      const formGroup = field.closest('.form-group');
      if (!formGroup) return;
      
      formGroup.classList.remove('has-error');
      
      const errorDiv = formGroup.querySelector('.field-error');
      if (errorDiv) {
        errorDiv.remove();
      }
      
      field.style.borderColor = '';
    }

    function showContactSuccess(message) {
      const messageDiv = createContactMessageDiv('success', message);
      contactForm.insertBefore(messageDiv, contactForm.firstChild);
      messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      
      setTimeout(() => {
        messageDiv.remove();
      }, 10000);
    }

    function showContactError(message, errors = null) {
      let fullMessage = message;
      
      if (errors && Array.isArray(errors)) {
        fullMessage += '<ul style="margin: 10px 0 0 20px; padding: 0;">';
        errors.forEach(error => {
          fullMessage += `<li>${error}</li>`;
        });
        fullMessage += '</ul>';
      }
      
      const messageDiv = createContactMessageDiv('error', fullMessage);
      contactForm.insertBefore(messageDiv, contactForm.firstChild);
      messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function createContactMessageDiv(type, message) {
      const div = document.createElement('div');
      div.className = `form-message form-message-${type}`;
      
      const bgColor = type === 'success' ? '#d4edda' : '#f8d7da';
      const textColor = type === 'success' ? '#155724' : '#721c24';
      const borderColor = type === 'success' ? '#c3e6cb' : '#f5c6cb';
      
      div.style.cssText = `
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid ${borderColor};
        border-radius: 0.375rem;
        background-color: ${bgColor};
        color: ${textColor};
        font-size: 0.95rem;
        line-height: 1.5;
      `;
      
      div.innerHTML = message;
      
      return div;
    }

    function clearMessages() {
      const messages = contactForm.querySelectorAll('.form-message');
      messages.forEach(msg => msg.remove());
    }

    function setContactButtonState(disabled, text) {
      if (!submitButton) return;
      
      submitButton.disabled = disabled;
      submitButton.textContent = text;
      
      if (disabled) {
        submitButton.style.opacity = '0.6';
        submitButton.style.cursor = 'not-allowed';
      } else {
        submitButton.style.opacity = '1';
        submitButton.style.cursor = 'pointer';
      }
    }

    function trackContactSubmission(inquiryType) {
      if (typeof gtag !== 'undefined') {
        gtag('event', 'form_submission', {
          'event_category': 'Contact Form',
          'event_label': inquiryType,
          'value': 1
        });
      }
      
      if (typeof fbq !== 'undefined') {
        fbq('track', 'Contact', {
          inquiry_type: inquiryType
        });
      }
      
      console.log('✅ Contact form submitted:', inquiryType);
    }
  }

  console.log("✅ Richie Forex Academy - All scripts loaded");

});