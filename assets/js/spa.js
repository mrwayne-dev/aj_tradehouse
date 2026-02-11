
if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}

// Single Page Application (SPA) Router

function initSpaRouter() {
  const app = document.querySelector('main.app');
  if (!app) return;

  function isInternalLink(link) {
    return (
      link.origin === window.location.origin &&
      !link.hasAttribute('target') &&
      !link.hasAttribute('download') &&
      !link.hasAttribute('data-no-spa')
    );
  }

  function resetScroll() {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'instant'
    });
  }

  function loadPage(url, pushState = true) {
    fetch(url, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.text())
      .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        const newMain = doc.querySelector('main.app');
        const newTitle = doc.querySelector('title');

        if (!newMain) {
          window.location.href = url;
          return;
        }

        resetScroll();

        app.innerHTML = newMain.innerHTML;

        if (newTitle) document.title = newTitle.innerText;

        if (pushState) history.pushState({ url }, '', url);

        requestAnimationFrame(() => {
          if (typeof initUI === 'function') {
            initUI();
          }
        });
      })
      .catch(() => {
        window.location.href = url;
      });
  }
  document.addEventListener('click', e => {
    const link = e.target.closest('a');
    if (!link || !isInternalLink(link)) return;

    e.preventDefault();
    loadPage(link.href);
  });
  window.addEventListener('popstate', e => {
    if (e.state?.url) {
      loadPage(e.state.url, false);
    }
  });
}
document.addEventListener('DOMContentLoaded', () => {
  initSpaRouter();
});
