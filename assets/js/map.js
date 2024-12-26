// Inisialisasi peta
var map = L.map('map').setView([-6.5971, 110.9931], 14);

// Tambahkan layer OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Icon untuk marker
var tempatIbadahIcon = L.icon({
    iconUrl: '../../assets/images/mosque.png',
    iconSize: [32, 32]
});

var pendidikanIcon = L.icon({
    iconUrl: '../../assets/images/school.png',
    iconSize: [32, 32]
});

var tempatUmumIcon = L.icon({
    iconUrl: '../../assets/images/public.png',
    iconSize: [32, 32]
});

// Fungsi untuk menambah marker
function addMarker(lat, lng, title, type) {
    var icon;
    switch(type) {
        case 'ibadah':
            icon = tempatIbadahIcon;
            break;
        case 'pendidikan':
            icon = pendidikanIcon;
            break;
        case 'umum':
            icon = tempatUmumIcon;
            break;
    }
    
    L.marker([lat, lng], {icon: icon})
        .bindPopup(title)
        .addTo(map);
} 