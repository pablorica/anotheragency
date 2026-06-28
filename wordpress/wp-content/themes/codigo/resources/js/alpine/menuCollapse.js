/**
 * Alpine component for #mainMenu (header) — mobile menu + search.
 * Registered as Alpine.data('menuCollapse', ...) in app.js, before Alpine.start().
 * Used in the blade template via x-data="menuCollapse".
 *
 * Ported from the old Vue MenuCollapse mixin. The open/close animation
 * keeps the original CSS keyframe classes (animate-appearsmenu /
 * animate-disappearsmenu) rather than switching to the collapse plugin,
 * since the mobile menu is a fixed inset-0 overlay rather than a panel
 * that grows from a height of 0 — x-collapse assumes the latter.
 */
export default () => ({
  search: '',
  isLoading: false,
  searchResults: [],
  noResults: false,
  menuCollapse: false,
  searchCollapse: false,

  get isSearchDisabled() {
    return this.search.trim().length < 3;
  },

  toggleMenu() {
    document.querySelector('body').classList.toggle('overflow-hidden');
    //console.log('toggleMenu', this.menuCollapse);

    if (this.menuCollapse) {
      const mobileMenu = document.querySelector('header .mobile-menu');
      mobileMenu.classList.add('animate-disappearsmenu');
      setTimeout(() => {
        mobileMenu.classList.remove('animate-disappearsmenu');
        this.menuCollapse = !this.menuCollapse;
      }, 600);
    } else {
      this.menuCollapse = !this.menuCollapse;
    }

    console.log('toggleMenu processed: ', this.menuCollapse);

    if (this.menuCollapse) {
      this.searchCollapse = false;
      this.searchResults = [];
      this.search = '';
      this.noResults = false;
    }
  },

  toggleSearch() {
    this.toggleMenu();
    this.searchCollapse = true;
  },

  handleSearch() {
    if (typeof ajaxObject === 'undefined') {
      return;
    }

    this.isLoading = true;

    fetch(ajaxObject.ajaxurl + '?action=search_posts&search=' + this.search, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-WP-Nonce': ajaxObject.nonce,
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data?.data.length === 0) {
          this.noResults = true;
          this.searchResults = [];
          return;
        }

        this.searchResults = data?.data;
      })
      .catch((error) => console.error(error))
      .finally(() => {
        this.isLoading = false;
      });
  },
});