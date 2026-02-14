/* ============================================================
   PAYMENT MODAL — JavaScript Logic (Safe Version)
   Works on HTTP + HTTPS
   ============================================================ */

(function () {
  "use strict";

  /* ── Config ─────────────────────────────────────────────── */
  const ACCOUNT_NUMBER  = "1304464251";
  const WHATSAPP_NUMBER = "2348135719117";

  /* ── Selectors ───────────────────────────────────────────── */
  const overlay   = document.getElementById("paymentModalOverlay");
  if (!overlay) return; // Modal not present

  const closeBtn  = document.getElementById("paymentModalClose");
  const copyBtn   = document.getElementById("paymentCopyBtn");
  const copyIcon  = document.getElementById("paymentCopyIcon");
  const copyText  = document.getElementById("paymentCopyText");
  const planLabel = document.getElementById("paymentModalPlanLabel");
  const planPrice = document.getElementById("paymentModalPlanPrice");
  const waBtn     = document.getElementById("paymentWhatsappBtn");

  /* ── Helpers ─────────────────────────────────────────────── */

  function showCopiedState() {
    if (!copyBtn) return;

    copyBtn.classList.add("is-copied");
    if (copyIcon) copyIcon.className = "ph ph-check";
    if (copyText) copyText.textContent = "Copied!";

    setTimeout(resetCopyBtn, 2500);
  }

  function resetCopyBtn() {
    if (!copyBtn) return;

    copyBtn.classList.remove("is-copied");
    if (copyIcon) copyIcon.className = "ph ph-copy";
    if (copyText) copyText.textContent = "Copy";
  }

  function fallbackCopy() {
    const textarea = document.createElement("textarea");
    textarea.value = ACCOUNT_NUMBER;
    textarea.style.position = "fixed";
    textarea.style.opacity  = "0";
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();

    try {
      document.execCommand("copy");
      showCopiedState();
    } catch (err) {
      alert("Copy failed. Please copy manually: " + ACCOUNT_NUMBER);
    }

    document.body.removeChild(textarea);
  }

  /* ── Copy Logic (Safe Detection) ─────────────────────────── */

  if (copyBtn) {
    copyBtn.addEventListener("click", function () {

      // Use modern API only if available
      if (navigator.clipboard && typeof navigator.clipboard.writeText === "function") {

        navigator.clipboard.writeText(ACCOUNT_NUMBER)
          .then(showCopiedState)
          .catch(fallbackCopy);

      } else {
        // HTTP or older browsers
        fallbackCopy();
      }

    });
  }

  /* ── Modal Controls ──────────────────────────────────────── */

  function openModal(plan, price) {

    if (planLabel) planLabel.textContent = plan || "Mentorship";
    if (planPrice) planPrice.textContent = price || "";

    if (waBtn) {
      const msg = encodeURIComponent(
        "Hello! I have made payment for the " +
        (plan || "Mentorship") +
        (price ? " (" + price + ")" : "") +
        ". Please find my receipt attached."
      );

      waBtn.href = "https://wa.me/" + WHATSAPP_NUMBER + "?text=" + msg;
    }

    overlay.classList.add("is-open");
    overlay.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";

    setTimeout(function () {
      if (closeBtn) closeBtn.focus();
    }, 50);
  }

  function closeModal() {
    overlay.classList.remove("is-open");
    overlay.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    resetCopyBtn();
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", closeModal);
  }

  overlay.addEventListener("click", function (e) {
    if (e.target === overlay) closeModal();
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && overlay.classList.contains("is-open")) {
      closeModal();
    }
  });

  /* ── Trigger Binding ─────────────────────────────────────── */

  document.addEventListener("click", function (e) {
    const trigger = e.target.closest("[data-payment-modal]");
    if (!trigger) return;

    e.preventDefault();

    const plan  = trigger.getAttribute("data-plan")  || "Mentorship Plan";
    const price = trigger.getAttribute("data-price") || "";

    openModal(plan, price);
  });

  /* ── Optional Global Access ───────────────────────────────── */

  window.paymentModal = {
    open:  openModal,
    close: closeModal
  };

})();
