document.addEventListener('DOMContentLoaded', () => {
    const addressBar = document.getElementById('address-bar');
    const sidebarLinks = document.querySelectorAll('#sidebar .list-group-item');
  
    sidebarLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Remove 'active' class from all links
        sidebarLinks.forEach(link => link.classList.remove('active'));
        
        // Add 'active' class to the clicked link
        e.target.classList.add('active');
        
        // Update the address bar
        addressBar.value = e.target.textContent.trim();
      });
    });
});
  