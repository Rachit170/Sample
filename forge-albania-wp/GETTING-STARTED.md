# Getting Started Guide

## Quick Start

### Step 1: WordPress Setup

1. Install WordPress locally using:
   - **Local by Flywheel** (Recommended)
   - **Docker** (provided with docker-compose.yml)
   - **XAMPP/WAMP** with local database

### Step 2: Install Theme & Plugin

1. Copy the `forge-albania` theme folder to: `wp-content/themes/`
2. Copy the `forge-car-showcase` plugin folder to: `wp-content/plugins/`

### Step 3: Activate Theme & Plugin

**In WordPress Admin:**

1. **Activate Theme:**
   - Go to Appearance → Themes
   - Click "Activate" on "Forge Albania"

2. **Activate Plugin:**
   - Go to Plugins
   - Click "Activate" on "Forge Car Showcase"

### Step 4: Create Basic Pages

Create these pages in WordPress Admin → Pages → Add New:

1. **Home Page**
   - Title: "Home"
   - Content: Leave blank (uses home template)
   - In Settings → Homepage displays, set this as "Homepage"

2. **Cars Page**
   - Title: "Our Fleet"
   - Content: Leave blank
   - In Settings → Homepage displays, set this as "Posts page"

3. **Contact Page** (Optional)
   - Title: "Contact"
   - Add contact form shortcode: `[contact-form-7 id="contact-form"]`

### Step 5: Add Your First Cars

1. Go to WordPress Admin → Cars → Add New Car
2. Fill in the details:
   - **Title:** 2023 BMW X5
   - **Content:** Describe the vehicle
   - **Featured Image:** Upload car photo
   - **Category:** Select/Create (e.g., "SUV")
   - **Car Details:** Fill meta fields at bottom
     - Price: 85000
     - Year: 2023
     - Mileage: 5000
     - Transmission: Automatic
     - Fuel Type: Petrol
3. Click Publish

## File Structure Explanation

```
forge-albania/
├── style.css
│   └── Main theme styles (colors, layouts, responsive)
│
├── functions.php
│   └── Theme functions, custom post types, hooks
│
├── header.php
│   └── Header with navigation and logo
│
├── footer.php
│   └── Footer section
│
├── index.php
│   └── Main template router
│
├── template-parts/
│   ├── hero.php → Hero banner on home
│   ├── car-showcase.php → Featured cars grid
│   ├── features.php → Why choose us section
│   ├── contact.php → Contact form section
│   ├── car-archive.php → All cars listing
│   ├── car-single.php → Individual car details
│   └── content.php → Default page content
│
└── assets/
    └── js/
        └── main.js → AJAX filtering, interactivity
```

## Key Features

### 1. **Custom Post Type: Cars**
- Automatically created when theme is activated
- Supports custom fields: Price, Year, Mileage, etc.
- Supports featured images
- Can be organized by category

### 2. **Dynamic Filtering**
- Click on category buttons to filter cars
- Uses AJAX to load filtered results
- No page reload needed

### 3. **Responsive Design**
- Works on all devices (mobile, tablet, desktop)
- Automatically adjusts layout
- Touch-friendly buttons

### 4. **SEO Ready**
- Proper HTML structure
- Heading hierarchy
- Meta tag support

## Common Tasks

### Change Site Title & Tagline

Settings → General:
- Site Title: "Forge Albania"
- Tagline: "Premium Vehicles"

### Add Menu Items

Appearance → Menus:
1. Create new menu "Main Menu"
2. Add pages (Home, Our Fleet, Contact)
3. Assign to "Primary Menu"

### Change Colors

Edit `wp-content/themes/forge-albania/style.css`:

Find `:root {` and change:
```css
--primary-color: #d32f2f;    /* Change red to your color */
--secondary-color: #1a1a1a;  /* Change black to your color */
--accent-color: #ffd700;     /* Change gold to your color */
```

### Add Your Logo

Customize → Site Identity:
1. Click "Select logo"
2. Upload your logo image
3. Save

### Configure Company Info

Cars → Settings:
- Company Phone
- Company Email
- Company Address
- Cars per page

## Useful WordPress Tips

### Create Dynamic Home Page

1. Go to Pages → Add New
2. Add sections with shortcode: `[forge_cars count="6" category="suv"]`
3. Example: `[forge_cars count="12"]` shows 12 random cars

### Add Custom CSS

Dashboard → Customize → Additional CSS:
```css
/* Your custom CSS here */
body {
    background-color: #f9f9f9;
}
```

### Add Custom JavaScript

Add to `functions.php`:
```php
wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'));
```

## Troubleshooting

### Cars Not Showing
1. Check if plugin is activated
2. Go to Cars → Check if cars are published
3. Flush permalinks: Settings → Permalinks → Save

### Images Not Displaying
1. Check file permissions (755 for folders, 644 for files)
2. Verify wp-content/uploads folder exists
3. Upload images again

### Styling Issues
1. Clear browser cache (Ctrl+Shift+Delete)
2. Go to Customize → Publish to refresh
3. Check for conflicting plugins

## Next Steps

1. **Add More Cars** - Build your inventory
2. **Customize Colors** - Match your brand
3. **Add Logo** - Upload company logo
4. **Set Up Contact Form** - Install Contact Form 7 plugin
5. **Add More Pages** - About, Services, Testimonials
6. **Optimize Images** - Use Imagify or TinyPNG
7. **Setup Analytics** - Google Analytics integration
8. **Launch** - Deploy to production server

## Support Resources

- WordPress Documentation: https://wordpress.org/support/
- Theme Support: Check theme README
- Plugin Documentation: Check plugin pages
- Community Forums: wordpress.org/support/forums/

## Customization Tips for Portfolio

### Showcase Your Skills
1. **Code Organization** - Well-structured, maintainable code
2. **Responsive Design** - Mobile-first approach
3. **Performance** - Optimized queries and assets
4. **Functionality** - Dynamic features (filtering, AJAX)
5. **Documentation** - Clear code comments and guides
6. **Best Practices** - Following WordPress standards

### What This Demonstrates
✓ Theme development
✓ Custom post types
✓ Custom taxonomies
✓ Meta boxes
✓ AJAX implementation
✓ Responsive design
✓ WordPress hooks & filters
✓ Plugin development
✓ Database queries
✓ Admin customization

---

**Ready to showcase your skills!** This is a professional, fully functional WordPress portfolio site.
