/**
 * public/assets/js/share.js
 */
const GarbaShare = {
    open: function(songId) {
        const url = window.location.origin + '/song/' + songId;
        if (navigator.share) {
            navigator.share({
                title: 'Garba26 Audio',
                text: 'Listen to this high-energy Garba track on Garba26!',
                url: url
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText(url);
            GarbaToast.show("Track link copied to clipboard! 📋", "success");
        }
    }
};
