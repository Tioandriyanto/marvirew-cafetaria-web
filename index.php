<?php
// Sample menu data - in a real application, this would come from a database
$menuItems = [
    [
        'id' => 1,
        'name' => 'Indomie Goreng',
        'price' => 8000,
        'image' => 'images/indomie-goreng.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 2,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 3,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 4,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 5,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 6,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 7,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ],
    [
        'id' => 8,
        'name' => 'Indomie',
        'price' => 7500,
        'image' => 'images/indomie.jpg',
        'address' => '4250 Salcedo Street, Suite 142/Coral Gables, FL 33146',
        'time' => '11:30 AM - 11:00 PM'
    ]
];

// Opening hours data
$openingHours = [
    'Senin' => '16:00 WIB - 23:00 WIB',
    'Selasa' => '16:00 WIB - 23:00 WIB',
    'Rabu' => '16:00 WIB - 23:00 WIB',
    'Kamis' => '16:00 WIB - 23:00 WIB',
    'Jumat' => '16:00 WIB - 23:00 WIB',
    'Sabtu' => '16:00 WIB - 23:00 WIB',
    'Minggu' => '16:00 WIB - 23:00 WIB'
];

// Online ordering options
$onlineOptions = [
    [
        'name' => 'Grab Food',
        'link' => '#'
    ],
    [
        'name' => 'Shopee Food',
        'link' => '#'
    ],
    [
        'name' => 'Cappucino American Dream',
        'link' => '#'
    ]
];

// Process order if form is submitted
if (isset($_POST['order'])) {
    $itemId = $_POST['item_id'];
    // In a real application, you would process the order here
    // For example, add to cart, save to database, etc.
    $orderMessage = "Item #$itemId has been added to your order!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marview Cafeteria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #ff3b30;
            --secondary-color: #ff8c00;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-brand span {
            color: var(--primary-color);
        }

        .tb-badge {
            background-color: #ff8c00;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .menu-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
        }

        .menu-image {
            height: 180px;
            object-fit: cover;
        }

        .order-btn {
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
        }

        .sidebar-card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .promo-card {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .location-title {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .online-order-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            margin-bottom: 10px;
        }

        .online-order-link i {
            margin-right: 10px;
        }

        .register-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/food-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .register-btn {
            background-color: var(--secondary-color);
            border: none;
            padding: 10px 30px;
            font-weight: bold;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 30px 0;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
        }

        .map-container {
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="tb-badge">TB</span> <span>Marview</span> Cafetaria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="#" class="btn btn-outline-danger me-3">Sign Out</a>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Tio Andhyanto</span>
                        <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        <?php if (isset($orderMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $orderMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Menu Items -->
            <div class="col-lg-8">
                <div class="row">
                    <?php foreach ($menuItems as $item): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card menu-card">
                                <img src="<?php echo $item['image']; ?>" class="card-img-top menu-image" alt="<?php echo $item['name']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                    <p class="card-text small text-muted"><?php echo $item['address']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php if (isset($item['price'])): ?>
                                            <p class="mb-0">Harga: Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                                        <?php endif; ?>
                                        <p class="mb-0 small"><?php echo $item['time']; ?></p>
                                    </div>
                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="order" class="btn btn-danger order-btn w-100">Pesan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Promo Card -->
                <div class="promo-card">
                    <h5>Automatically save 2% on your bill if you reserve your table With DINE IN FLORIDA</h5>
                </div>

                <!-- Location Info -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h5 class="location-title">Lokasi Marview Cafetaria</h5>
                        <p class="small">Oper layanan: Menyediakan tempat duduk di area terbuka - Ada menu</p>

                        <div class="mt-3">
                            <p class="mb-1"><i class="fas fa-map-marker-alt text-danger me-2"></i> <strong>Alamat:</strong> Jl Taman Kemirih Selatan No.83-85, Nalumsari, Kec. Jepara, Kabupaten Jepara, Jawa Tengah 59181</p>

                            <h6 class="mt-3 mb-2">Jam:</h6>
                            <?php foreach ($openingHours as $day => $hours): ?>
                                <div class="d-flex justify-content-between small">
                                    <span><?php echo $day; ?></span>
                                    <span><?php echo $hours; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Online Order -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h5 class="location-title">Pesan Online</h5>

                        <?php foreach ($onlineOptions as $option): ?>
                            <a href="<?php echo $option['link']; ?>" class="online-order-link">
                                <i class="fas fa-external-link-alt"></i>
                                <span><?php echo $option['name']; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Map -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h5 class="location-title">Here to Find</h5>
                        <div class="map-container">
                            <img src="images/map.jpg" alt="Location Map" class="img-fluid w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Section -->
    <section class="register-section">
        <div class="container">
            <h2>REGISTER FOR <span class="text-warning">FREE</span></h2>
            <p class="mb-4">Register with us and win amazing discount points on table bookings</p>
            <button class="btn register-btn">Register</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <h3 class="text-warning mb-4">Marview Cafetaria</h3>

            <div class="footer-links mb-4">
                <a href="#">Service</a>
                <a href="#">About Us</a>
                <a href="#">Contact Us</a>
                <a href="#">FAQs</a>
                <a href="#">Sign In</a>
            </div>

            <div class="social-icons mb-4">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            <p class="small text-muted">Marview.com | All rights reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>