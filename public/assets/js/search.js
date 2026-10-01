/**
 * public/assets/js/search.js - Instant Debounce Search
 */
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('search-input');
    const dropdown = document.getElementById('search-results-dropdown');
    let timer = null;

    if (!input || !dropdown) return;

    input.addEventListener('input', () => {
        clearTimeout(timer);
        const query = input.value.trim();

        if (query.length < 2) {
            dropdown.style.display = 'none';
            return;
        }

        timer = setTimeout(() => {
            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(r => r.json())
                .then(res => {
                    if (res.success && res.data) {
                        renderResults(res.data);
                    }
                });
        }, 250);
    });

    function renderResults(data) {
        let html = '';
        if (data.songs && data.songs.length > 0) {
            html += '<div style="padding: 10px 14px; font-size: 0.75rem; color: #94a3b8; font-weight:700;">SONGS</div>';
            data.songs.slice(0, 5).forEach(s => {
                html += `<div class="search-item" onclick="GarbaPlayer.playTrack(${s.id})" style="padding: 8px 14px; display:flex; align-items:center; gap:10px; cursor:pointer;">
                    <img src="${s.cover_image || '/assets/images/default-album.png'}" style="width:30px; height:30px; border-radius:4px;">
                    <div><strong style="font-size:0.88rem; color:#fff;">${s.title}</strong><div style="font-size:0.75rem; color:#94a3b8;">${s.artist_name}</div></div>
                </div>`;
            });
        }
        dropdown.innerHTML = html || '<div style="padding:14px; color:#94a3b8; font-size:0.85rem;">No direct matches found</div>';
        dropdown.style.display = 'block';
    }
});
