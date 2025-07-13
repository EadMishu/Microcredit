document.addEventListener("DOMContentLoaded", function () {
  const icons = [
    "fa-solid fa-bell", // bi-alarm
    "fa-solid fa-box-archive", // bi-archive
    "fa-solid fa-arrow-up", // bi-arrow-up
    "fa-solid fa-bag-shopping", // bi-bag
    "fa-solid fa-chart-bar", // bi-bar-chart
    "fa-solid fa-bell", // bi-bell
    "fa-brands fa-bootstrap", // bi-bootstrap
    "fa-regular fa-calendar", // bi-calendar
    "fa-solid fa-camera", // bi-camera
    "fa-regular fa-comments", // bi-chat
    "fa-regular fa-circle-check", // bi-check-circle
    "fa-regular fa-clipboard", // bi-clipboard
    "fa-solid fa-cloud", // bi-cloud
    "fa-solid fa-gear", // bi-gear
    "fa-solid fa-globe", // bi-globe
    "fa-solid fa-house", // bi-house
    "fa-regular fa-image", // bi-image
    "fa-solid fa-inbox", // bi-inbox
    "fa-solid fa-circle-info", // bi-info-circle
    "fa-solid fa-bolt", // bi-lightning
    "fa-solid fa-link", // bi-link
    "fa-solid fa-list", // bi-list
    "fa-solid fa-lock", // bi-lock
    "fa-solid fa-map", // bi-map
    "fa-regular fa-user", // bi-person
    "fa-solid fa-magnifying-glass", // bi-search
    "fa-solid fa-shield-halved", // bi-shield
    "fa-regular fa-star", // bi-star
    "fa-solid fa-trash", // bi-trash
    "fa-solid fa-upload", // bi-upload
    "fa-regular fa-circle-xmark", // bi-x-circle
  ];

  const container = document.getElementById("fontawesome-icon-grid");
  const searchInput = document.getElementById("searchInput");

  // Function to display icons
  function renderIcons(filter = "") {
    container.innerHTML = "";

    const filteredIcons = icons.filter((icon) =>
      icon.toLowerCase().includes(filter.toLowerCase())
    );

    if (filteredIcons.length === 0) {
      container.innerHTML = `<div class="col text-center text-muted">No icons found</div>`;
      return;
    }

    filteredIcons.forEach((iconClass) => {
      const col = document.createElement("div");
      col.className = "col text-center";
      col.innerHTML = `
          <i class="${iconClass} fs-2"></i>
          <div class="small mt-2">${iconClass}</div>
        `;
      container.appendChild(col);
    });
  }

  // Initial render
  renderIcons();

  // Search input listener
  searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.trim();
    renderIcons(searchTerm);
  });
});
