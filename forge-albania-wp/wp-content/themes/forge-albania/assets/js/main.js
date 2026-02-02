/**
 * Main Theme JavaScript
 */

(function ($) {
    'use strict';

    // Car filtering
    function initializeFilters() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const carGrid = document.getElementById('carGrid');

        if (!filterBtns.length) return;

        filterBtns.forEach((btn) => {
            btn.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');

                // Update active button
                filterBtns.forEach((b) => b.classList.remove('active'));
                this.classList.add('active');

                // AJAX call to filter cars
                if (filter === 'all') {
                    location.href = window.location.pathname;
                } else {
                    $.ajax({
                        url: forgeAjax.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'forge_filter_cars',
                            nonce: forgeAjax.nonce,
                            category: filter,
                        },
                        success: function (response) {
                            if (response.success) {
                                let html = '';
                                response.data.forEach((car) => {
                                    html += `
                        <div class="car-card">
                            <div class="car-image">
                                ${car.image ? `<img src="${car.image}" alt="${car.title}">` : '<span>🚗</span>'}
                            </div>
                            <div class="car-content">
                                <h3 class="car-title">${car.title}</h3>
                                <div class="car-meta">
                                    ${car.year ? `<span class="meta-item">${car.year}</span>` : ''}
                                    ${car.mileage ? `<span class="meta-item">${car.mileage} km</span>` : ''}
                                </div>
                                <p>${car.excerpt}</p>
                                ${car.price ? `<div class="car-price">$${parseInt(car.price).toLocaleString()}</div>` : ''}
                                <a href="${car.link}" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    `;
                                });
                                carGrid.innerHTML = html;
                            }
                        },
                        error: function (error) {
                            console.error('Error filtering cars:', error);
                        },
                    });
                }
            });
        });
    }

    // Lightbox functionality
    function initializeLightbox() {
        const images = document.querySelectorAll('.car-card img');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.querySelector('.lightbox-content img');
        const lightboxClose = document.querySelector('.lightbox-close');

        if (!lightbox) return;

        images.forEach((img) => {
            img.addEventListener('click', function () {
                lightboxImg.src = this.src;
                lightbox.classList.add('active');
            });
        });

        lightboxClose?.addEventListener('click', function () {
            lightbox.classList.remove('active');
        });

        lightbox?.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
            }
        });
    }

    // Mobile menu toggle
    function initializeMobileMenu() {
        const header = document.querySelector('header');
        const nav = document.querySelector('.main-navigation');

        if (!header || !nav) return;

        // Add mobile menu button if needed
        if (window.innerWidth < 768) {
            const menuBtn = document.createElement('button');
            menuBtn.className = 'menu-toggle';
            menuBtn.setAttribute('aria-label', 'Toggle Menu');
            menuBtn.innerHTML = '☰';

            header.querySelector('.header-content').appendChild(menuBtn);

            menuBtn.addEventListener('click', function () {
                nav.classList.toggle('active');
            });
        }
    }

    // Smooth scroll
    function initializeSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    // Initialize on DOM ready
    $(document).ready(function () {
        initializeFilters();
        initializeLightbox();
        initializeMobileMenu();
        initializeSmoothScroll();
    });
})(jQuery);
