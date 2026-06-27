<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> - Studio.mu Dashboard</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd',
                            300: '#7dd3fc', 400: '#38bdf8', 500: '#0ea5e9',
                            600: '#0284c7', 700: '#0369a1', 800: '#075985',
                            900: '#0c4a6e', 950: '#082f49',
                        },
                        accent: { gold: '#D4AF37' }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                        serif: ['Playfair Display', 'serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body { background-color: #f8fafc; }

        /* Sidebar transition */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Backdrop */
        #sidebar-backdrop {
            transition: opacity 0.3s ease;
        }

        /* Sidebar nav items */
        .sidebar-item-active {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            color: #ffffff !important;
            border-left: 4px solid #3b82f6 !important;
            border-top-left-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
            box-shadow: 0 4px 15px -3px rgba(15, 23, 42, 0.3) !important;
        }
        .sidebar-item {
            border: 1px solid transparent;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item:hover:not(.sidebar-item-active) {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
            color: #0f172a !important;
            transform: translateX(6px);
        }

        /* Customer Top Navbar Specific Overrides */
        .customer-nav .sidebar-item {
            display: flex;
            align-items: center;
            padding: 6px 12px !important;
            font-size: 10px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.15em !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .customer-nav .sidebar-item:not(.sidebar-item-active) {
            color: #0f172a !important;
        }
        .customer-nav .sidebar-item:hover:not(.sidebar-item-active) {
            transform: translateY(-2px) !important;
            background-color: #f0f9ff !important;
            border-color: #bae6fd !important;
            color: #0284c7 !important;
        }
        .customer-nav .sidebar-item-active {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
            color: #0c4a6e !important;
            border-left: none !important;
            border-bottom: 3px solid #0284c7 !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 10px -3px rgba(2, 132, 199, 0.15) !important;
            transform: none !important;
        }
        .customer-nav .sidebar-item svg {
            margin-right: 5px !important;
        }
        /* Force grey font classes to dark black/slate, excluding elements inside dark areas */
        .text-slate-400:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *):not(.admin-filter-card *):not(.admin-meta-info *):not(th),
        .text-slate-500:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *):not(.admin-filter-card *):not(.admin-meta-info *):not(th),
        .text-gray-400:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *):not(.admin-filter-card *):not(.admin-meta-info *):not(th),
        .text-gray-500:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *):not(.admin-filter-card *):not(.admin-meta-info *):not(th) {
            color: #0f172a !important;
        }

        /* 
           Card Clarity & Premium Styling for Admin Views (Black, Blue, White, Gold Theme)
        */
        /* Scope cards inside admin layout wrapper */
        .admin-layout .bg-white.rounded-2xl,
        .admin-layout .bg-white.rounded-3xl,
        .admin-layout .bg-white.rounded-\[2rem\],
        .admin-layout .bg-white.rounded-\[2\.5rem\],
        .admin-layout .bg-white.rounded-\[1\.5rem\] {
            /* Distinct, elegant shadow with gold and blue hints */
            --tw-shadow: 0 10px 30px -5px rgba(2, 132, 199, 0.08), 0 8px 20px -6px rgba(212, 175, 55, 0.08) !important;
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none !important;
        }

        /* Hover animation on these cards */
        .admin-layout .bg-white.rounded-2xl:hover,
        .admin-layout .bg-white.rounded-3xl:hover,
        .admin-layout .bg-white.rounded-\[2rem\]:hover,
        .admin-layout .bg-white.rounded-\[2\.5rem\]:hover {
            --tw-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.16), 0 12px 25px -8px rgba(212, 175, 55, 0.16) !important;
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow) !important;
            border: none !important;
        }

        /* 
           Dashboard Overview Stats Card Background Variations (All styled like Card 1)
        */
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15) !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div p {
            color: #cbd5e1 !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div h3 {
            color: #D4AF37 !important;
            font-family: 'Playfair Display', serif !important;
            font-style: italic !important;
            font-weight: 700 !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div svg {
            color: #D4AF37 !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div span {
            background-color: rgba(212, 175, 55, 0.1) !important;
            border-color: rgba(212, 175, 55, 0.25) !important;
            color: #D4AF37 !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div .w-12.h-12 {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            border-color: #fde68a !important;
        }
        .admin-layout .grid-cols-1.md\:grid-cols-2.lg\:grid-cols-4 > div .w-12.h-12 svg {
            color: #b45309 !important;
        }

        /* 
           Users & Bookings Index Filter Card Variations (Black background, Gold text)
        */
        .admin-layout .admin-filter-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border-width: 2px !important;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15) !important;
        }

        /* Default text/number styles for filter cards (all text is gold!) */
        .admin-layout .admin-filter-card p,
        .admin-layout .admin-filter-card span {
            color: #D4AF37 !important;
        }
        
        /* Default icon styles for filter cards (gold icon inside soft gold box) */
        .admin-layout .admin-filter-card svg {
            color: #D4AF37 !important;
        }

        .admin-layout .admin-filter-card .w-8.h-8 {
            background: rgba(212, 175, 55, 0.1) !important;
            border: 1px solid rgba(212, 175, 55, 0.25) !important;
        }

        /* Inactive states: Slate border */
        .admin-layout .admin-filter-card:not(.border-amber-400):not(.border-sky-400):not(.border-emerald-400):not(.border-rose-400):not(.border-violet-400) {
            border-color: #1e293b !important;
        }

        /* Active states: Gold border, bright gold text, solid gold icon box */
        .admin-layout .admin-filter-card.border-amber-400,
        .admin-layout .admin-filter-card.border-sky-400,
        .admin-layout .admin-filter-card.border-emerald-400,
        .admin-layout .admin-filter-card.border-rose-400,
        .admin-layout .admin-filter-card.border-violet-400 {
            border-color: #D4AF37 !important;
            border-width: 2.5px !important;
            box-shadow: 0 15px 30px -5px rgba(212, 175, 55, 0.25) !important;
        }

        .admin-layout .admin-filter-card.border-amber-400 p,
        .admin-layout .admin-filter-card.border-sky-400 p,
        .admin-layout .admin-filter-card.border-emerald-400 p,
        .admin-layout .admin-filter-card.border-rose-400 p,
        .admin-layout .admin-filter-card.border-violet-400 p,
        .admin-layout .admin-filter-card.border-amber-400 span,
        .admin-layout .admin-filter-card.border-sky-400 span,
        .admin-layout .admin-filter-card.border-emerald-400 span,
        .admin-layout .admin-filter-card.border-rose-400 span,
        .admin-layout .admin-filter-card.border-violet-400 span {
            color: #D4AF37 !important;
        }

        .admin-layout .admin-filter-card.border-amber-400 .w-8.h-8,
        .admin-layout .admin-filter-card.border-sky-400 .w-8.h-8,
        .admin-layout .admin-filter-card.border-emerald-400 .w-8.h-8,
        .admin-layout .admin-filter-card.border-rose-400 .w-8.h-8,
        .admin-layout .admin-filter-card.border-violet-400 .w-8.h-8 {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            border-color: #fde68a !important;
        }

        .admin-layout .admin-filter-card.border-amber-400 .w-8.h-8 svg,
        .admin-layout .admin-filter-card.border-sky-400 .w-8.h-8 svg,
        .admin-layout .admin-filter-card.border-emerald-400 .w-8.h-8 svg,
        .admin-layout .admin-filter-card.border-rose-400 .w-8.h-8 svg,
        .admin-layout .admin-filter-card.border-violet-400 .w-8.h-8 svg {
            color: #b45309 !important;
        }

        /* 
           Borders inside Admin Content Area (Standard Clean Borders)
        */

        /* 
           Table Premium Theme (Black background, Gold headers, Blue borders)
        */
        .admin-content table {
            border-collapse: collapse !important;
            border-color: #e2e8f0 !important;
        }

        /* Table header row: Solid black background with gold border */
        .admin-content thead tr,
        .admin-content tr.bg-slate-50 {
            background-color: #0f172a !important; /* Black */
            border-bottom: 3px solid #D4AF37 !important; /* Gold divider */
        }

        /* Table header cells: Gold text */
        .admin-content thead th,
        .admin-content tr.bg-slate-50 th {
            color: #D4AF37 !important; /* Metallic Gold */
            font-weight: 800 !important;
        }

        /* Table body row borders and dividers: Gold tint */
        .admin-content tbody tr,
        .admin-content tr.border-b {
            border-bottom: 1px solid #000000 !important; /* Black */
        }
        
        .admin-content tbody.divide-y > :not([hidden]) ~ :not([hidden]) {
            border-color: #000000 !important; /* Black */
        }

        /* Table row hover state: soft gold tint background */
        .admin-content tbody tr:hover {
            background-color: rgba(212, 175, 55, 0.05) !important;
        }

        /* 
           Inner Badges, Accents, and Buttons inside Admin Area
        */
        /* Gold indicator badges inside table cells */
        .admin-content td .bg-amber-50,
        .admin-content td .bg-amber-100 {
            background-color: #fef3c7 !important; /* Gold-50 */
            border-color: #fde68a !important; /* Gold-200 */
            color: #b45309 !important; /* Dark Gold */
        }

        /* Blue indicator badges inside table cells */
        .admin-content td .bg-sky-100,
        .admin-content td .bg-blue-100 {
            background-color: #eff6ff !important; /* Blue-50 */
            border-color: #bfdbfe !important; /* Blue-200 */
            color: #1d4ed8 !important; /* Blue-700 */
        }

        /* Price text: Gold highlight */
        .admin-content td .text-amber-800,
        .admin-content td.text-amber-800,
        .admin-content td .text-amber-700 {
            color: #b45309 !important; /* Gold text */
        }

        /* Table cell amber border */
        .admin-content td .border-amber-200,
        .admin-content td .border-amber-300 {
            border-color: #fde68a !important;
        }

        /* General primary buttons: Solid Black with Gold border & text, Blue hover */
        .admin-content .bg-amber-800,
        .admin-layout .bg-amber-800 {
            background-color: #0f172a !important; /* Black */
            color: #D4AF37 !important; /* Gold */
            border: 1px solid #D4AF37 !important;
        }
        .admin-content .bg-amber-800:hover,
        .admin-layout .bg-amber-800:hover {
            background-color: #3b82f6 !important; /* Blue hover */
            color: #ffffff !important;
            border-color: #3b82f6 !important;
        }

        /* Edit and Secondary action buttons in table */
        .admin-content td a.bg-amber-50,
        .admin-content td a.bg-slate-100 {
            background-color: #eff6ff !important; /* Blue-50 */
            border-color: #bfdbfe !important; /* Blue border */
            color: #2563eb !important; /* Blue text */
        }
        
        .admin-content td a.bg-amber-50:hover,
        .admin-content td a.bg-slate-100:hover {
            background-color: #D4AF37 !important; /* Gold hover */
            color: #0f172a !important; /* Black text */
            border-color: #D4AF37 !important;
        }

        /* Poin buttons inside tables */
        .admin-content td button.bg-amber-50 {
            background-color: #fef3c7 !important; /* Gold-50 */
            border-color: #fde68a !important; /* Gold border */
            color: #b45309 !important; /* Gold text */
        }
        .admin-content td button.bg-amber-50:hover {
            background-color: #3b82f6 !important; /* Blue hover */
            color: #ffffff !important;
            border-color: #3b82f6 !important;
        }

        /* Gold stars icons */
        .admin-content svg.text-amber-500 {
            color: #D4AF37 !important; /* Gold stars */
        }

        /* General Amber background mappings to Blue inside Admin Views */
        .admin-layout .bg-amber-600,
        .admin-content .bg-amber-600 {
            background-color: #3b82f6 !important; /* Blue-500 */
        }
        .admin-layout .bg-amber-700,
        .admin-content .bg-amber-700 {
            background-color: #2563eb !important; /* Blue-600 */
        }
        .admin-layout .bg-amber-900,
        .admin-content .bg-amber-900 {
            background-color: #1e3a8a !important; /* Blue-900 */
        }

        /* General Amber Text mappings to Gold or Blue */
        .admin-layout .text-amber-50,
        .admin-content .text-amber-50,
        .admin-layout .text-amber-100,
        .admin-content .text-amber-100,
        .admin-layout .text-amber-500,
        .admin-content .text-amber-500 {
            color: #D4AF37 !important; /* Gold */
        }
        .admin-layout .text-amber-600,
        .admin-content .text-amber-600 {
            color: #b45309 !important; /* Dark Gold */
        }
        .admin-layout .text-amber-900,
        .admin-content .text-amber-900 {
            color: #0f172a !important; /* Black */
        }

        /* Focus borders & rings */
        .admin-layout .focus\:border-amber-500:focus,
        .admin-content .focus\:border-amber-500:focus,
        .admin-layout .focus\:border-amber-600:focus,
        .admin-content .focus\:border-amber-600:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
        }

        .admin-layout .focus-within\:border-amber-600:focus-within,
        .admin-content .focus-within\:border-amber-600:focus-within {
            border-color: #3b82f6 !important;
        }

        /* Accent inputs (Radio inputs) */
        .admin-layout .accent-amber-700,
        .admin-content .accent-amber-700 {
            accent-color: #3b82f6 !important;
        }

        /* 
           Metallic Gold Headings in Admin Area
        */
        .admin-content h1.font-serif.italic,
        .admin-content h2.font-serif.italic,
        .admin-layout h1.font-serif.italic,
        .admin-layout h2.font-serif.italic {
            color: #D4AF37 !important;
            text-shadow: 0 1px 2px rgba(9, 13, 22, 0.15) !important;
        }

        /* 
           Restore Customer Top Navbar Link Active Overrides
        */
        .customer-nav .sidebar-item-active {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
            color: #0c4a6e !important;
            border-left: none !important;
            border-bottom: 3px solid #0284c7 !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 10px -3px rgba(2, 132, 199, 0.15) !important;
        }

        /* 
           Card Background Variations for Admin Views (with Glowing Shadows)
        */
        /* 1. Dark Card */
        .admin-layout .admin-card-dark,
        .admin-content .admin-card-dark {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            border: none !important;
            color: #ffffff !important;
            box-shadow: 0 15px 35px -5px rgba(9, 13, 22, 0.3) !important;
        }
        .admin-card-dark .w-full.h-64 {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%) !important;
            border-color: #334155 !important;
        }
        .admin-card-dark .w-full.h-64 line {
            stroke: #334155 !important;
        }
        .admin-card-dark .w-full.h-64 span,
        .admin-card-dark .w-full.h-64 div {
            color: #cbd5e1 !important;
        }
        .admin-card-dark h5 {
            color: #ffffff !important;
        }
        .admin-card-dark .border-l-2 {
            border-color: #334155 !important;
        }
        .admin-card-dark .rounded-full.border-4 {
            border-color: #0f172a !important;
        }
        .admin-card-dark .rounded-full.ring-4 {
            --tw-ring-color: rgba(255, 255, 255, 0.05) !important;
        }
        .admin-layout .admin-card-dark h2,
        .admin-layout .admin-card-dark h3,
        .admin-layout .admin-card-dark h4,
        .admin-content .admin-card-dark h2,
        .admin-content .admin-card-dark h3,
        .admin-content .admin-card-dark h4 {
            color: #D4AF37 !important;
        }
        .admin-layout .admin-card-dark label,
        .admin-layout .admin-card-dark p,
        .admin-layout .admin-card-dark span.text-slate-400,
        .admin-content .admin-card-dark label,
        .admin-content .admin-card-dark p,
        .admin-content .admin-card-dark span.text-slate-400 {
            color: #cbd5e1 !important;
        }
        .admin-layout .admin-card-dark input,
        .admin-layout .admin-card-dark textarea,
        .admin-layout .admin-card-dark select,
        .admin-content .admin-card-dark input,
        .admin-content .admin-card-dark textarea,
        .admin-content .admin-card-dark select {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #ffffff !important;
        }
        .admin-layout .admin-card-dark input:focus,
        .admin-layout .admin-card-dark textarea:focus,
        .admin-layout .admin-card-dark select:focus,
        .admin-content .admin-card-dark input:focus,
        .admin-content .admin-card-dark textarea:focus,
        .admin-content .admin-card-dark select:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25) !important;
        }
        .admin-layout .admin-card-dark button.border-amber-200,
        .admin-content .admin-card-dark button.border-amber-200 {
            background-color: #D4AF37 !important;
            color: #0f172a !important;
            border-color: #D4AF37 !important;
        }
        .admin-layout .admin-card-dark button.border-amber-200:hover,
        .admin-content .admin-card-dark button.border-amber-200:hover {
            background-color: #3b82f6 !important;
            color: #ffffff !important;
            border-color: #3b82f6 !important;
        }

        /* 2. Soft Blue Card */
        .admin-layout .admin-card-blue,
        .admin-content .admin-card-blue {
            background: linear-gradient(135deg, #dbeafe 0%, #bae6fd 100%) !important;
            border: none !important;
            box-shadow: 0 15px 35px -5px rgba(37, 99, 235, 0.08) !important;
        }

        /* 3. Soft Gold Card */
        .admin-layout .admin-card-gold,
        .admin-content .admin-card-gold {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            border: none !important;
            box-shadow: 0 15px 35px -5px rgba(217, 119, 6, 0.08) !important;
        }

        /* 4. Soft Slate Card */
        .admin-layout .admin-card-slate,
        .admin-content .admin-card-slate {
            background: linear-gradient(135deg, #f1f5f9 0%, #cbd5e1 100%) !important;
            border: none !important;
            box-shadow: 0 15px 35px -5px rgba(71, 85, 105, 0.08) !important;
        }

        /* 
           Table Header Row Gradients
        */
        .admin-content thead tr,
        .admin-content tr.bg-slate-50 {
            background: linear-gradient(90deg, #090d16 0%, #0c4a6e 100%) !important;
            border-bottom: 3px solid #D4AF37 !important;
        }

        /* 
           Card Headers Dark Styling with Gold Border divider
        */
        .admin-content div[class*="admin-card-"] > div:first-child,
        .admin-content div[class*="admin-card-"] > form > div:first-child {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            border-bottom: 2.5px solid #D4AF37 !important;
        }
        .admin-content div[class*="admin-card-"] > div:first-child h2,
        .admin-content div[class*="admin-card-"] > div:first-child h3,
        .admin-content div[class*="admin-card-"] > div:first-child h4,
        .admin-content div[class*="admin-card-"] > div:first-child p,
        .admin-content div[class*="admin-card-"] > form > div:first-child h2,
        .admin-content div[class*="admin-card-"] > form > div:first-child h3,
        .admin-content div[class*="admin-card-"] > form > div:first-child h4,
        .admin-content div[class*="admin-card-"] > form > div:first-child p {
            color: #ffffff !important;
        }
        .admin-content div[class*="admin-card-"] > div:first-child h2,
        .admin-content div[class*="admin-card-"] > form > div:first-child h2 {
            color: #D4AF37 !important; /* Gold main heading */
            font-family: 'Playfair Display', serif !important;
            font-style: italic !important;
            font-weight: 700 !important;
        }
        .admin-content div[class*="admin-card-"] > div:first-child h4,
        .admin-content div[class*="admin-card-"] > form > div:first-child h4 {
            color: #cbd5e1 !important; /* Muted subheader text */
        }
        .admin-content div[class*="admin-card-"] > div:first-child input,
        .admin-content div[class*="admin-card-"] > div:first-child select,
        .admin-content div[class*="admin-card-"] > form > div:first-child input,
        .admin-content div[class*="admin-card-"] > form > div:first-child select {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #ffffff !important;
        }
        .admin-content div[class*="admin-card-"] > div:first-child input::placeholder,
        .admin-content div[class*="admin-card-"] > form > div:first-child input::placeholder {
            color: #94a3b8 !important;
        }

        /* 
           Card Footer Dark Styling for cards containing tables
        */
        .admin-content div[class*="admin-card-"]:has(table)::after {
            content: " ";
            display: block;
            height: 40px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            border-top: 2.5px solid #D4AF37 !important;
        }

        /*
           Set outer border and background of cards containing tables to dark-gold theme (item & emas)
        */
        /*
           Set outer border of cards containing tables to gold, and background to premium black (#0f172a)
        */
        .admin-content div[class*="admin-card-"]:has(table) {
            background: #0f172a !important;
            border: 2.5px solid #D4AF37 !important;
        }

        /* Set white background and dark text inside the table components */
        .admin-content div[class*="admin-card-"]:has(table) table,
        .admin-content div[class*="admin-card-"]:has(table) tbody,
        .admin-content div[class*="admin-card-"]:has(table) tbody tr,
        .admin-content div[class*="admin-card-"]:has(table) tbody td,
        .admin-content div[class*="admin-card-"]:has(table) .bg-white {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        /* Set text colors for normal and bold content inside tables */
        .admin-content div[class*="admin-card-"]:has(table) td,
        .admin-content div[class*="admin-card-"]:has(table) td * {
            color: #0f172a !important;
        }

        .admin-content div[class*="admin-card-"]:has(table) td.font-bold,
        .admin-content div[class*="admin-card-"]:has(table) td .font-bold {
            color: #0f172a !important;
        }

        /* Hover row inside tables: soft gold tint background */
        .admin-content div[class*="admin-card-"]:has(table) tbody tr:hover {
            background-color: rgba(212, 175, 55, 0.05) !important;
        }

        /* Text colors for headings, descriptions, and labels inside card wrapper but outside the table element */
        .admin-content div[class*="admin-card-"]:has(table) h2,
        .admin-content div[class*="admin-card-"]:has(table) h3,
        .admin-content div[class*="admin-card-"]:has(table) h4,
        .admin-content div[class*="admin-card-"]:has(table) h5 {
            color: #ffffff !important;
        }
        .admin-content div[class*="admin-card-"]:has(table) h2.font-serif,
        .admin-content div[class*="admin-card-"]:has(table) h3.font-serif {
            color: #D4AF37 !important; /* Gold for main headings */
        }
        .admin-content div[class*="admin-card-"]:has(table) p:not(table *),
        .admin-content div[class*="admin-card-"]:has(table) label:not(table *),
        .admin-content div[class*="admin-card-"]:has(table) span:not(table *):not(.bg-white *):not(.rounded-full *) {
            color: #cbd5e1 !important; /* Muted slate white for description/sub text */
        }
        .admin-content div[class*="admin-card-"]:has(table) strong:not(table *) {
            color: #D4AF37 !important; /* Gold highlights outside table */
        }

        /* Result meta info header bar (Menampilkan X transaksi) */
        .admin-content div[class*="admin-card-"]:has(table) .admin-meta-info {
            background: #0f172a !important; /* Black background */
            border-bottom: 1.5px solid #D4AF37 !important; /* Gold line bottom divider */
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
        .admin-content div[class*="admin-card-"]:has(table) .admin-meta-info p {
            color: #ffffff !important; /* Text white */
        }
        .admin-content div[class*="admin-card-"]:has(table) .admin-meta-info strong {
            color: #D4AF37 !important; /* Highlight text gold */
        }

        /* Force gold row dividers (lines) inside tables */
        .admin-content div[class*="admin-card-"]:has(table) tbody tr,
        .admin-content div[class*="admin-card-"]:has(table) tr.border-b {
            border-bottom: 1px solid #000000 !important;
        }
        
        .admin-content div[class*="admin-card-"]:has(table) tbody.divide-y > :not([hidden]) ~ :not([hidden]) {
            border-color: #000000 !important;
        }
    </style>
</head>
 <body class="antialiased font-sans text-slate-800 bg-slate-50">
 
     <?php if(Auth::user()->role === 'customer'): ?>
         
         <div class="min-h-screen flex flex-col bg-slate-50 relative">
             
             <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-3xl opacity-20 -z-10 pointer-events-none"></div>
 
             
             <nav class="fixed top-0 left-0 right-0 h-20 bg-white/80 backdrop-blur-xl border-b border-white z-50 shadow-sm">
                 <div class="max-w-7xl mx-auto px-5 md:px-12 h-full flex items-center justify-between">
                     
                     <div class="flex items-center gap-8">
                         <a href="/" class="group">
                             <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Studio.mu Logo" class="h-9 sm:h-10 w-auto transition-transform group-hover:scale-105 duration-300">
                         </a>
                         
                         
                         <div class="hidden lg:flex items-center gap-1.5 customer-nav">
                             <?php echo $__env->yieldContent('sidebar'); ?>
                         </div>
                     </div>
 
                     
                     <div class="flex items-center gap-3">
                         
                         <div class="relative" id="notif-dropdown-wrapper-cust">
                             <button onclick="toggleNotifDropdown('cust')" class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 transition-all group" id="notif-bell-cust">
                                 <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                                 </svg>
                                 <span id="notif-badge-cust" class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white text-[9px] font-black rounded-full flex items-center justify-center hidden">0</span>
                             </button>
                             
                             <div id="notif-dropdown-cust" class="hidden absolute right-0 mt-3 w-80 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden">
                                 <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-slate-50">
                                     <p class="text-[10px] font-black uppercase tracking-widest text-slate-700">Notifikasi</p>
                                     <button onclick="markAllRead()" class="text-[9px] font-black text-primary-600 hover:text-primary-800 uppercase tracking-wider transition-colors">Tandai Semua</button>
                                 </div>
                                 <div id="notif-list-cust" class="max-h-72 overflow-y-auto divide-y divide-slate-100">
                                     <p class="text-center text-xs text-slate-400 py-8 font-semibold">Tidak ada notifikasi</p>
                                 </div>
                             </div>
                         </div>
 
                        
                        <div class="relative" id="user-dropdown-wrapper">
                            <button onclick="toggleUserDropdown()" class="flex items-center gap-3 focus:outline-none group">
                                <div class="text-right hidden sm:block">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-800 group-hover:text-primary-600 transition-colors"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest"><?php echo e(Auth::user()->role); ?></p>
                                </div>
                                <div class="relative">
                                    <?php if(Auth::user()->avatar_url): ?>
                                        <div class="w-10 h-10 rounded-2xl overflow-hidden shadow-md group-hover:scale-105 transition-transform">
                                            <img src="<?php echo e(Auth::user()->avatar_url); ?>" alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-800 text-white border border-primary-600/10 rounded-2xl flex items-center justify-center text-sm font-black shadow-md shadow-primary-950/20 group-hover:scale-105 transition-transform">
                                            <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                            </button>

                            
                            <div id="user-dropdown" class="absolute right-0 mt-3 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl py-2 hidden animate-fade-in-up z-50">
                                <div class="px-4 py-3 border-b border-slate-100 sm:hidden">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-800"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-[9px] font-black text-amber-700 uppercase tracking-widest"><?php echo e(Auth::user()->role); ?></p>
                                </div>
                                <a href="<?php echo e(route('welcome')); ?>" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-slate-700 hover:bg-slate-50 transition-colors sm:hidden">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                    </svg>
                                    Halaman Utama
                                </a>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-slate-700 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                    Edit Profil
                                </a>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                        
                        <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-650 transition-colors border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                
                <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 shadow-xl px-6 py-6 flex-col gap-2 customer-nav">
                    <?php echo $__env->yieldContent('sidebar'); ?>
                </div>
            </nav>

            
            <main class="flex-1 max-w-7xl w-full mx-auto px-5 md:px-12 pt-28 pb-12">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            
            <footer class="p-6 md:p-12 text-[10px] font-bold uppercase tracking-widest text-slate-600 border-t border-white bg-white">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                    <p>&copy; <?php echo e(date('Y')); ?> Studio.mu Visual Art.</p>
                    <div class="flex space-x-8">
                        <a href="#" class="hover:text-amber-700 transition-colors">Bantuan</a>
                        <a href="#" class="hover:text-amber-700 transition-colors">Privasi</a>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function toggleUserDropdown() {
                const dropdown = document.getElementById('user-dropdown');
                dropdown.classList.toggle('hidden');
            }

            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                } else {
                    menu.classList.remove('flex');
                    menu.classList.add('hidden');
                }
            }

            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                const dropdown = document.getElementById('user-dropdown');
                const wrapper = document.getElementById('user-dropdown-wrapper');
                if (dropdown && wrapper && !wrapper.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
    <?php else: ?>
        
        <div id="sidebar-backdrop"
             class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-40 hidden"
             onclick="closeSidebar()">
        </div>

        <div class="flex min-h-screen admin-layout">

            
            <aside id="sidebar"
                   class="w-72 bg-white border-r border-slate-200 fixed top-0 left-0 h-screen z-50 flex flex-col
                          -translate-x-full md:translate-x-0 shadow-sm">

                
                <div class="flex justify-end p-4 md:hidden">
                    <button onclick="closeSidebar()"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                
                <div class="px-8 pb-4 pt-4 md:pt-10">
                    <a href="/" class="group inline-block">
                        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Studio.mu Logo"
                             class="h-11 w-auto transition-transform group-hover:scale-105 duration-300">
                    </a>
                </div>

                
                <nav class="flex-1 px-5 space-y-1 mt-2 overflow-y-auto">
                    <p class="px-4 mb-3 text-[9px] font-extrabold text-slate-600 uppercase tracking-[0.25em]">Menu Utama</p>
                    <?php echo $__env->yieldContent('sidebar'); ?>
                </nav>


            </aside>

            
            <main class="flex-1 flex flex-col relative md:ml-72 admin-content">

                
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-3xl opacity-20 -z-10 pointer-events-none"></div>

                
                <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-white flex items-center justify-between px-5 md:px-12 sticky top-0 z-30">
                    <div class="flex items-center gap-3">
                        
                        <button onclick="openSidebar()"
                                class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-white hover:bg-slate-50 text-slate-655 transition-colors border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-500 mb-0.5">Halaman</p>
                            <h1 class="text-lg font-black text-slate-800 leading-none"><?php echo $__env->yieldContent('title'); ?></h1>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-3">
                        
                        <div class="relative" id="notif-dropdown-wrapper-admin">
                            <button onclick="toggleNotifDropdown('admin')" class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 transition-all">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                                </svg>
                                <span id="notif-badge-admin" class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white text-[9px] font-black rounded-full flex items-center justify-center hidden">0</span>
                            </button>
                            
                            <div id="notif-dropdown-admin" class="hidden absolute right-0 mt-3 w-80 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50 overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100 bg-slate-50">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-700">Notifikasi</p>
                                    <button onclick="markAllRead()" class="text-[9px] font-black text-primary-600 hover:text-primary-800 uppercase tracking-wider transition-colors">Tandai Semua</button>
                                </div>
                                <div id="notif-list-admin" class="max-h-72 overflow-y-auto divide-y divide-slate-100">
                                    <p class="text-center text-xs text-slate-400 py-8 font-semibold">Tidak ada notifikasi</p>
                                </div>
                            </div>
                        </div>

                        
                        <div class="relative" id="user-dropdown-wrapper-admin">
                            <button onclick="toggleUserDropdownAdmin()" class="flex items-center gap-3 focus:outline-none group">
                                <div class="text-right hidden sm:block">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-800 group-hover:text-primary-600 transition-colors"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest"><?php echo e(Auth::user()->role); ?></p>
                                </div>
                                <div class="relative">
                                    <?php if(Auth::user()->avatar_url): ?>
                                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl overflow-hidden shadow-md group-hover:scale-105 transition-transform">
                                            <img src="<?php echo e(Auth::user()->avatar_url); ?>" alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-10 h-10 sm:w-11 sm:h-11 bg-gradient-to-br from-primary-600 to-primary-800 text-white border border-primary-600/10 rounded-2xl flex items-center justify-center text-sm font-black shadow-md shadow-primary-950/20 group-hover:scale-105 transition-transform">
                                            <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                            </button>

                            
                            <div id="user-dropdown-admin" class="absolute right-0 mt-3 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl py-2 hidden animate-fade-in-up z-50">
                                <div class="px-4 py-3 border-b border-slate-100 sm:hidden">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-800"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-[9px] font-black text-amber-700 uppercase tracking-widest"><?php echo e(Auth::user()->role); ?></p>
                                </div>
                                <a href="<?php echo e(route('welcome')); ?>" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-slate-700 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                    </svg>
                                    Halaman Utama
                                </a>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-slate-700 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                    Edit Profil
                                </a>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                
                <div class="p-5 md:p-12 relative">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>

                
                <footer class="mt-auto p-6 md:p-12 text-[10px] font-bold uppercase tracking-widest text-slate-600 border-t border-white">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                        <p>&copy; <?php echo e(date('Y')); ?> Studio.mu Visual Art.</p>
                        <div class="flex space-x-8">
                            <a href="#" class="hover:text-primary-700 transition-colors">Bantuan</a>
                            <a href="#" class="hover:text-primary-700 transition-colors">Privasi</a>
                        </div>
                    </div>
                </footer>
            </main>
        </div>

        
        <script>
            const sidebar   = document.getElementById('sidebar');
            const backdrop  = document.getElementById('sidebar-backdrop');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Auto-close on resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    backdrop.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });

            function toggleUserDropdownAdmin() {
                const dropdown = document.getElementById('user-dropdown-admin');
                dropdown.classList.toggle('hidden');
            }

            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                const dropdown = document.getElementById('user-dropdown-admin');
                const wrapper = document.getElementById('user-dropdown-wrapper-admin');
                if (dropdown && wrapper && !wrapper.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('scripts'); ?>

    
    <script>
        const NOTIF_SUFFIX = '<?php echo e(Auth::user()->role === "customer" ? "cust" : "admin"); ?>';

        function toggleNotifDropdown(suffix) {
            const dropdown = document.getElementById('notif-dropdown-' + suffix);
            const wrapper  = document.getElementById('notif-dropdown-wrapper-' + suffix);
            dropdown.classList.toggle('hidden');
            if (!dropdown.classList.contains('hidden')) {
                fetchNotifications();
            }
        }

        function fetchNotifications() {
            fetch('/notifications', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                renderNotifications(data.notifications, data.unread_count);
            })
            .catch(() => {});
        }

        function renderNotifications(notifications, unreadCount) {
            const badge = document.getElementById('notif-badge-' + NOTIF_SUFFIX);
            const list  = document.getElementById('notif-list-' + NOTIF_SUFFIX);
            if (!badge || !list) return;

            if (unreadCount > 0) {
                badge.textContent = unreadCount > 99 ? '99+' : unreadCount;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            if (notifications.length === 0) {
                list.innerHTML = '<p class="text-center text-xs text-slate-400 py-8 font-semibold">Tidak ada notifikasi</p>';
                return;
            }

            const icons = {
                booking_new: '📋', booking_confirmed: '✅', booking_cancelled: '❌',
                booking_completed: '🎉', points_updated: '🌟'
            };

            list.innerHTML = notifications.map(n => {
                const icon = icons[n.type] || '🔔';
                const isRead = n.read_at !== null;
                const timeAgo = formatTimeAgo(n.created_at);
                return `
                    <div class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition-colors cursor-pointer ${ isRead ? 'opacity-60' : 'bg-blue-50/40' }" onclick="readNotif(${ n.id }, '${ n.link || '' }')">
                        <div class="text-lg flex-shrink-0 mt-0.5">${ icon }</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-black text-slate-800 leading-tight">${ escHtml(n.title) }</p>
                            <p class="text-[10px] text-slate-500 mt-0.5 leading-snug">${ escHtml(n.message) }</p>
                            <p class="text-[9px] text-slate-400 mt-1 font-semibold">${ timeAgo }</p>
                        </div>
                        ${ !isRead ? '<div class="w-2 h-2 bg-primary-500 rounded-full flex-shrink-0 mt-1.5"></div>' : '' }
                    </div>
                `;
            }).join('');
        }

        function readNotif(id, link) {
            fetch('/notifications/' + id + '/read', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                fetchNotifications();
                if (link) window.location.href = link;
            });
        }

        function markAllRead() {
            fetch('/notifications/read-all', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => fetchNotifications());
        }

        function escHtml(str) {
            const d = document.createElement('div');
            d.appendChild(document.createTextNode(str || ''));
            return d.innerHTML;
        }

        function formatTimeAgo(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            const now  = new Date();
            const diff = Math.floor((now - date) / 1000);
            if (diff < 60) return 'Baru saja';
            if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
            if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
            return Math.floor(diff / 86400) + ' hari lalu';
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            ['admin', 'cust'].forEach(suffix => {
                const dropdown = document.getElementById('notif-dropdown-' + suffix);
                const wrapper  = document.getElementById('notif-dropdown-wrapper-' + suffix);
                if (dropdown && wrapper && !wrapper.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });

        // Initial fetch + polling every 30s
        fetchNotifications();
        setInterval(fetchNotifications, 30000);
    </script>
</body>
</html>
<?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>