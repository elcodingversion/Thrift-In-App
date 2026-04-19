<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Sage Minimalist</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sage-primary: #C9D9C3;
            --sage-secondary: #B7C8B5;
            --sage-dark: #6E7C6F;
            --sage-border: #E6EEE4;
            --cream-bg: #F6F5F2;
            --charcoal: #2F2F2F;
            --white: #FFFFFF;
            --soft-yellow: #F5E6B8;
            --soft-red: #F4D4D4;
            --spacing-xs: 8px;
            --spacing-sm: 16px;
            --spacing-md: 24px;
            --spacing-lg: 32px;
            --radius: 12px;
            --shadow-sm: 0 2px 8px rgba(110, 124, 111, 0.08);
            --shadow-md: 0 4px 16px rgba(110, 124, 111, 0.12);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--cream-bg);
            color: var(--charcoal);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout Structure */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--white);
            border-right: 1px solid var(--sage-border);
            padding: var(--spacing-md);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-md);
            border-bottom: 1px solid var(--sage-border);
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--sage-primary), var(--sage-secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--sage-dark);
        }

        .logo-text {
            font-size: 18px;
            font-weight: 600;
            color: var(--charcoal);
        }

        .nav-menu {
            list-style: none;
            flex: 1;
        }

        .nav-item {
            margin-bottom: var(--spacing-xs);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--sage-dark);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: rgba(201, 217, 195, 0.15);
            color: var(--charcoal);
        }

        .nav-link.active {
            background: var(--sage-primary);
            color: var(--charcoal);
            font-weight: 600;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 1.5;
            fill: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: var(--spacing-md);
        }

        /* Header */
        .header {
            background: var(--white);
            border-radius: var(--radius);
            padding: var(--spacing-md);
            box-shadow: var(--shadow-sm);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-md);
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 4px;
        }

        .header-subtitle {
            font-size: 14px;
            color: var(--sage-dark);
            font-weight: 400;
        }

        .header-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--cream-bg);
            border-radius: 100px;
            border: 1px solid var(--sage-border);
        }

        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sage-secondary), var(--sage-primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--white);
            font-size: 14px;
        }

        .profile-info {
            text-align: left;
        }

        .profile-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--charcoal);
            display: block;
        }

        .profile-role {
            font-size: 12px;
            color: var(--sage-dark);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-md);
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--sage-border);
            border-radius: var(--radius);
            padding: var(--spacing-md);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        .stat-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-sm);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--sage-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: var(--cream-bg);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 22px;
            height: 22px;
            stroke: var(--sage-dark);
            stroke-width: 1.5;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 4px;
        }

        .stat-change {
            font-size: 12px;
            color: var(--sage-dark);
            font-weight: 500;
        }

        .stat-change.positive {
            color: #5A8F5A;
        }

        /* Activity Section */
        .activity-section {
            background: var(--white);
            border: 1px solid var(--sage-border);
            border-radius: var(--radius);
            padding: var(--spacing-md);
            box-shadow: var(--shadow-sm);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-md);
            padding-bottom: var(--spacing-sm);
            border-bottom: 1px solid var(--sage-border);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--charcoal);
        }

        .view-all-btn {
            font-size: 13px;
            color: var(--sage-dark);
            text-decoration: none;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .view-all-btn:hover {
            background: var(--cream-bg);
            color: var(--charcoal);
        }

        /* Table */
        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .activity-table thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--sage-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 12px 12px;
            border-bottom: 1px solid var(--sage-border);
        }

        .activity-table tbody tr {
            transition: all 0.2s ease;
            opacity: 0;
            transform: translateX(-10px);
        }

        .activity-table tbody tr.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .activity-table tbody tr:hover {
            background: rgba(201, 217, 195, 0.08);
        }

        .activity-table tbody td {
            padding: 16px 12px;
            font-size: 14px;
            color: var(--charcoal);
            border-top: 1px solid var(--sage-border);
            border-bottom: 1px solid var(--sage-border);
        }

        .activity-table tbody td:first-child {
            border-left: 1px solid var(--sage-border);
            border-radius: var(--radius) 0 0 var(--radius);
        }

        .activity-table tbody td:last-child {
            border-right: 1px solid var(--sage-border);
            border-radius: 0 var(--radius) var(--radius) 0;
        }

        .claim-id {
            font-weight: 600;
            color: var(--sage-dark);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background: var(--soft-yellow);
            color: #8B7B3F;
        }

        .status-approved {
            background: var(--sage-primary);
            color: var(--sage-dark);
        }

        .status-rejected {
            background: var(--soft-red);
            color: #8B4F4F;
        }

        .date-text {
            font-size: 13px;
            color: var(--sage-dark);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: var(--spacing-sm);
                align-items: flex-start;
            }

            .activity-table {
                font-size: 13px;
            }

            .activity-table thead {
                display: none;
            }

            .activity-table tbody tr {
                display: block;
                margin-bottom: var(--spacing-sm);
                border: 1px solid var(--sage-border);
                border-radius: var(--radius);
            }

            .activity-table tbody td {
                display: block;
                text-align: right;
                padding: 12px;
                border: none !important;
                border-radius: 0 !important;
            }

            .activity-table tbody td:before {
                content: attr(data-label);
                float: left;
                font-weight: 600;
                color: var(--sage-dark);
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @stack('styles')
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            @include('layouts.partials.header')

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <script>
        // Animate stat cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible');
                }, index * 150);
            });

            // Animate table rows
            const tableRows = document.querySelectorAll('.activity-table tbody tr');
            tableRows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('visible');
                }, 300 + (index * 100));
            });

            // Smooth hover effects
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.borderColor = 'var(--sage-secondary)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.borderColor = 'var(--sage-border)';
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>