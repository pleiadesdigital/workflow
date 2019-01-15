import $ from 'jquery';

class Search {
  // 1. CONSTRUCTOR: describe and create/initiate our object

  constructor() {
    this.openButton = document.querySelector(".js1-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector("#search-term");
    this.resultsDiv = document.querySelector("#search-overlay__results");
    this.typingTimer;
    this.isOverlayOpen == false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.events();

  }

  // 2. EVENTS
  events() {
    this.openButton.addEventListener("click", this.openOverlay.bind(this));
    this.closeButton.addEventListener("click", this.closeOverlay.bind(this));
    document.addEventListener("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }


  // 3. METHODS

  // search input logic
  typingLogic() {
    if(this.searchField.value !== this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div';
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false;
      }

    }
    this.previousValue = this.searchField.value;
  }

  // method: get results
  getResults() {

    $.getJSON(jsData.root_url + "/wp-json/wp/v2/posts?search=" + this.searchField.value, data => {

      this.resultsDiv.innerHTML = `
      <h2 class="search-overlay__section-title">General Information</h2>
      ${data.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
        ${data
          .map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`)
          .join("")}
      ${data.length ? '</ul>' : ''}

    `}, this.isSpinnerVisible = false);

  }
  // finds the s and scape keys to make overlay work
  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
      this.openOverlay();
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }
  // opens the overlay
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    // $("body").addClass('body-no-scroll');
    document.querySelector('body').classList.add('body-no-scroll');
    this.isOverlayOpen = true;
  }
  // closes the overlay
  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    // $("body").removeClass("body-no-scroll");
    document.querySelector("body").classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }



} // class Search

export default Search;
