<!-- app/Views/components/search-bar.php -->
<div class="component-search-bar">
    <form action="/search" method="GET" class="search-form">
        <img src="/assets/icons/search.svg" class="search-icon" alt="Search">
        <input type="text" name="q" placeholder="Search Garba songs, artists..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    </form>
</div>
