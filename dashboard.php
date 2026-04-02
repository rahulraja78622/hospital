<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospital_db"; // your correct database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect if not admin
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Helper function to safely get counts
function getCount($conn, $table) {
    $result = $conn->query("SELECT COUNT(*) as total FROM `$table`");
    if($result) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0; // fallback if table/query fails
    }
}

// Get dynamic counts
$totalPatients = getCount($conn, 'patients');

// If you have doctors and appointments tables, use these too
$totalDoctors = getCount($conn, 'doctors'); // Make sure table exists
$totalAppointments = getCount($conn, 'appointments'); // Make sure table exists
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin:0; font-family:Arial,sans-serif; display:flex; background:#f4f7f8; }
        .sidebar { width:220px; background:#2c3e50; color:#fff; min-height:100vh; padding:20px; }
        .sidebar h2 { margin-top:0; }
        .sidebar ul { list-style:none; padding:0; }
        .sidebar ul li { margin:15px 0; }
        .sidebar ul li a { color:#fff; text-decoration:none; padding:8px; display:block; border-radius:4px; transition:.3s; }
        .sidebar ul li a:hover { background:#1abc9c; }
        .main-content { flex:1; padding:20px; }
        .navbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .navbar h1 { margin:0; }
        .user-info { display:flex; align-items:center; }
        .user-info img { width:40px; height:40px; border-radius:50%; margin-right:10px; }
        .cards { display:flex; flex-wrap:wrap; gap:20px; }
        .card { background:#fff; flex:1; min-width:200px; padding:20px; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,.1); text-align:center; }
        .card h3 { margin-bottom:10px; color:#34495e; }
        .card p { font-size:24px; color:#1abc9c; margin:0; }
        .footer { margin-top:40px; text-align:center; color:#7f8c8d; }
        @media(max-width:768px){ .cards { flex-direction:column; } }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Hospital Admin</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="index.php">Patients</a></li>
        <li><a href="doctors.php">Doctors</a></li>
        <li><a href="appointments.php">Appointments</a></li>
        <li><a href="add.php">Add Patient</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">

    <!-- Navbar -->
    <div class="navbar">
        <h1>Dashboard</h1>
        <div class="user-info">
            <img src="/hospital/image/download.jpg" alt="Admin Logo">
            <span>Admin</span>
        </div>
    </div>

    <!-- Cards -->
    <div class="cards">
        <div class="card">
            <h3>Total Patients</h3>
            <p><?= $totalPatients ?></p>
        </div>
        <div class="card">
            <h3>Total Doctors</h3>
            <p><?= $totalDoctors ?></p>
        </div>
        <div class="card">
            <h3>Total Appointments</h3>
            <p><?= $totalAppointments ?></p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2026 Hospital Management System</p>
    </div>

</div>

</body>
</html>