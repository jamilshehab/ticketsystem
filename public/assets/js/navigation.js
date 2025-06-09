const navigation = document.getElementById('navigation');
    const menuItems = navigation.querySelectorAll('.menu-item');
    const menuLinks = navigation.querySelectorAll('.menu-item a');
    const sections = document.querySelectorAll('.restaurant-section');
    
    // Remove all active classes initially
    function removeActiveClasses() {
        menuItems.forEach(item => {
            item.classList.remove('active');
        });
    }
    
    // Set active class to corresponding menu item
    function setActiveMenuItem(id) {
        removeActiveClasses();
        menuLinks.forEach(link => {
            if (link.getAttribute('href') === `#${id}`) {
                link.parentElement.classList.add('active');
            }
        });
    }
    
    // Check scroll position to determine active section
    function onScroll() {
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (window.scrollY >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });
        
        setActiveMenuItem(current);
    }
    
    // Handle click events on menu items
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Skip for dashboard link
            if (this.getAttribute('href').startsWith('{{route')) {
                return;
            }
            
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop,
                    behavior: 'smooth'
                });
                
                // Update URL hash
                history.pushState(null, null, `#${targetId}`);
            }
        });
    });
    
    // Check hash on page load
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        setActiveMenuItem(hash);
    }
    
    // Add scroll event listener
    window.addEventListener('scroll', onScroll);
    
    // Add hashchange event listener
    window.addEventListener('hashchange', function() {
        const hash = window.location.hash.substring(1);
        setActiveMenuItem(hash);
    });