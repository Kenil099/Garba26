/**
 * public/assets/js/favorites.js
 */
const GarbaFavorites = {
    toggle: async function(songId, btnEl) {
        try {
            const data = await GarbaAPI.post('/api/favorite/toggle', { song_id: songId });
            if (data.success) {
                if (btnEl) {
                    btnEl.textContent = data.isFavorited ? '❤️' : '🤍';
                }
                GarbaToast.show(data.message, 'success');
            } else {
                GarbaToast.show(data.message || 'Please log in to add favorites', 'error');
            }
        } catch (e) {
            GarbaToast.show('Action failed. Please sign in.', 'error');
        }
    }
};
