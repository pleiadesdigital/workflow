$.getJSON("http://localhost:3000/~ronyortiz/learncode/rowebdev/wp-json/wp/v2/posts?search=" + this.searchField.value, data => {

  this.resultsDiv.innerHTML = `
      <h2 class="search-overlay__section-title">General Information</h2>
      ${data.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
        ${data
      .map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`)
      .join("")}
      ${data.length ? '</ul>' : ''}

    `}, this.isSpinnerVisible = false;
    );
