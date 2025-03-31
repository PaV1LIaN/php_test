document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('portalSearch');
    const portalCards = document.querySelectorAll('.portal-card');
    
    if(searchInput && portalCards.length) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            portalCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const desc = card.querySelector('p').textContent.toLowerCase();
                const category = card.getAttribute('data-category').toLowerCase();
                
                if(name.includes(searchTerm) || desc.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});