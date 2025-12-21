// script.js
function toggleSearchBar() {
  const searchBar = document.getElementById('searchBar');
  if (searchBar.style.display === 'flex') {
    searchBar.style.display = 'none';
  } else {
    searchBar.style.display = 'flex';
  }
}

function toggleCategory() {
  const categoryList = document.getElementById('categoryList');
  if (categoryList.style.display === 'block') {
    categoryList.style.display = 'none';
  } else {
    categoryList.style.display = 'block';
  }
}

function goToArticle(url) {
  window.location.href = url;
}
