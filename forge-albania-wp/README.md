# Forge Albania WordPress Portfolio

A fully dynamic WordPress website showcasing car inventory for Forge Albania dealership. This is a professional portfolio site with modern design and dynamic features.

## Features

### 1. **Dynamic Car Showcase**
- Custom post type for cars with detailed specifications
- Dynamic filtering by category (SUV, Sedan, Coupe, etc.)
- AJAX-powered car filtering without page reload
- Responsive grid layout that adapts to all screen sizes

### 2. **Car Management System**
- Add/edit/delete cars from WordPress admin
- Custom meta fields: Price, Year, Mileage, Transmission, Fuel Type
- Featured image support for each car
- Category organization with taxonomy

### 3. **Modern Design**
- Responsive mobile-first design
- Gradient backgrounds and smooth animations
- Clean, professional UI with custom color scheme
- Hover effects on cards
- Smooth scrolling

### 4. **Dynamic Pages**
- **Home Page**: Hero section, featured cars, features, contact form
- **Cars Archive**: View all cars with filtering and pagination
- **Single Car Page**: Detailed view with all specifications
- **Contact Page**: Contact form integration (supports Contact Form 7)

### 5. **Built-in Functionality**
- Contact form for inquiries
- AJAX-based filtering
- Lightbox gallery support
- Pagination for car listings
- Company information management

## Project Structure

```
forge-albania-wp/
├── wp-content/
│   ├── themes/
│   │   └── forge-albania/
│   │       ├── assets/
│   │       │   └── js/
│   │       │       └── main.js
│   │       ├── template-parts/
│   │       │   ├── hero.php
│   │       │   ├── car-showcase.php
│   │       │   ├── features.php
│   │       │   ├── contact.php
│   │       │   ├── car-archive.php
│   │       │   ├── car-single.php
│   │       │   └── content.php
│   │       ├── style.css
│   │       ├── functions.php
│   │       ├── header.php
│   │       ├── footer.php
│   │       └── index.php
│   └── plugins/
│       └── forge-car-showcase/
│           └── forge-car-showcase.php
└── package.json
```

## Installation

### Local Setup (Using Local by Flywheel or Docker)

1. **Clone or copy this repository** to your WordPress installation
2. **Activate the theme**: Go to WordPress Admin → Appearance → Themes → Activate "Forge Albania"
3. **Activate the plugin**: Go to WordPress Admin → Plugins → Activate "Forge Car Showcase"
4. **Create pages**:
   - Home page (set as front page)
   - Cars page (for car archive)
   - Contact page (optional, for contact form)

### Docker Setup

```bash
docker-compose up -d
```

This will start a WordPress instance with the theme and plugin ready to use.

## Usage

### Adding Cars

1. Go to WordPress Admin → Cars → Add New Car
2. Fill in the car details:
   - Title (e.g., "2023 Mercedes-Benz C-Class")
   - Content (description)
   - Featured Image (car photo)
   - Add to Category
   - Fill in custom fields:
     - Price
     - Year
     - Mileage
     - Transmission
     - Fuel Type

### Managing Car Categories

1. Go to WordPress Admin → Cars → Car Categories
2. Add new categories (SUV, Sedan, Coupe, Truck, etc.)
3. Assign cars to categories

### Company Settings

1. Go to WordPress Admin → Cars → Settings
2. Configure:
   - Cars per page
   - Company phone
   - Company email
   - Company address

## Dynamic Features

### 1. Car Filtering
- Users can filter cars by category
- AJAX-based filtering without page reload
- Smooth animations

### 2. Responsive Design
- Mobile-friendly layout
- Adapts to tablet and desktop screens
- Touch-friendly buttons and navigation

### 3. SEO Friendly
- Proper heading hierarchy
- Meta tags support
- URL-friendly slugs for categories and cars

### 4. Performance Optimized
- Lazy loading support for images
- Minified CSS and JavaScript
- Efficient database queries

## Customization

### Change Color Scheme

Edit [style.css](forge-albania-wp/wp-content/themes/forge-albania/style.css) and modify the CSS variables:

```css
:root {
    --primary-color: #d32f2f;      /* Red */
    --secondary-color: #1a1a1a;    /* Black */
    --accent-color: #ffd700;       /* Gold */
}
```

### Add Custom Pages

Create a new template file in `template-parts/` directory and use it in `index.php` with:

```php
get_template_part('template-parts/your-template');
```

### Extend Functionality

Add custom code to [functions.php](forge-albania-wp/wp-content/themes/forge-albania/functions.php) or create additional functions in the plugin file.

## Plugins to Consider

For enhanced functionality, install these recommended plugins:

1. **Contact Form 7** - Advanced contact forms
2. **WP Optimize** - Performance optimization
3. **Yoast SEO** - SEO optimization
4. **WooCommerce** - If you want to add e-commerce features
5. **Elementor** - Page builder (optional)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Performance Tips

1. Enable caching with a plugin like WP Optimize
2. Compress images before uploading
3. Use a CDN for static assets
4. Regularly update WordPress, theme, and plugins

## Security

- Keep WordPress updated
- Use strong passwords
- Install a security plugin like Wordfence
- Regularly backup your database

## Deployment

### For Hosting Provider

1. Zip the entire `forge-albania-wp` folder
2. Upload to your hosting server
3. Extract and configure `wp-config.php`
4. Update database credentials
5. Run WordPress installation

### For GitHub

Add this to `.gitignore`:

```
wp-config.php
wp-content/uploads/
node_modules/
.env
```

## Support & Maintenance

- **Update Frequency**: Check for updates monthly
- **Backup**: Backup database weekly
- **Monitoring**: Use WordPress health check tool

## License

GPL v2 or later

## Author

Name - Rachit Rawat

---

**Note**: This is a sample portfolio site showcasing WordPress development skills. Customize it for your specific needs!
