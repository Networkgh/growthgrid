<!-- theme.php -->
<button class="theme-toggle" id="theme-toggle" onclick="toggleTheme()">🌙</button>

<script>
  // Function to toggle between light and dark themes
  function toggleTheme() {
    const body = document.body;
    const currentTheme = body.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    body.setAttribute('data-theme', newTheme);

    // Change the button icon
    const themeToggleBtn = document.getElementById('theme-toggle');
    themeToggleBtn.textContent = newTheme === 'light' ? '🌙' : '☀️';

    // Store theme preference in localStorage
    localStorage.setItem('theme', newTheme);
  }

  // On page load, apply the saved theme if available
  window.onload = function () {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.setAttribute('data-theme', savedTheme);
    document.getElementById('theme-toggle').textContent = savedTheme === 'light' ? '🌙' : '☀️';
  };
</script>
