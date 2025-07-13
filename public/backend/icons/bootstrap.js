const icons = [
  "bi-alarm", "bi-archive", "bi-arrow-up", "bi-bag", "bi-bar-chart", "bi-bell", "bi-bootstrap",
  "bi-calendar", "bi-camera", "bi-chat", "bi-check-circle", "bi-clipboard", "bi-cloud", "bi-gear",
  "bi-globe", "bi-house", "bi-image", "bi-inbox", "bi-info-circle", "bi-lightning", "bi-link", "bi-list",
  "bi-lock", "bi-map", "bi-person", "bi-search", "bi-shield", "bi-star", "bi-trash", "bi-upload", "bi-x-circle"
  
];

const container = document.getElementById("icon-grid");
const searchInput = document.getElementById("searchInput");

// Function to display icons
function renderIcons(filter = "") {
  container.innerHTML = "";
  const filteredIcons = icons.filter(icon => icon.toLowerCase().includes(filter.toLowerCase()));

  if (filteredIcons.length === 0) {
    container.innerHTML = `<div class="col text-center text-muted">No icons found</div>`;
    return;
  }

  filteredIcons.forEach(icon => {
    const col = document.createElement("div");
    col.className = "col text-center";
    col.innerHTML = `
      <i class="bi ${icon} fs-6"></i>
      <div class="small mt-2">${icon}</div>
    `;
    container.appendChild(col);
  });
}

// Initial render
renderIcons();

// Search listener
searchInput.addEventListener("input", () => {
  const searchTerm = searchInput.value.trim();
  renderIcons(searchTerm);
});