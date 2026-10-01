/**
 * public/assets/js/api.js - Client Fetch API Helper
 */
const GarbaAPI = {
    get: async function(url) {
        const res = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        return await res.json();
    },

    post: async function(url, data) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return await res.json();
    }
};
