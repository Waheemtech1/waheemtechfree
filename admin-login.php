<?php
session_start();
include 'connection/connect.php'; // database connection

$alert_icon = $alert_title = $alert_text = "";

/**
 * Smart admin login function
 */
function admin_login($email, $password) {
    global $conn;

    if (empty($email) || empty($password)) {
        return ["icon" => "warning", "title" => "Missing Info", "text" => "Please provide both email and password."];
    }

    $stmt = $conn->prepare("SELECT admin_id, fullname, email, password FROM admins WHERE email = ? LIMIT 1");
    if (!$stmt) return ["icon" => "error", "title" => "System Error", "text" => $conn->error];

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        return ["icon" => "error", "title" => "Access Denied", "text" => "Admin account not found."];
    }

    $admin = $result->fetch_assoc();

    // Plain text password check (Ina baka shawara nan gaba ka koma password_hash)
    if ($password !== $admin['password']) {
        return ["icon" => "error", "title" => "Wrong Password", "text" => "The password you entered is incorrect."];
    }

    // Success: Set session
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['admin_name'] = $admin['fullname'];
    $_SESSION['admin_email'] = $admin['email'];

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $login_result = admin_login($email, $password);

    if ($login_result === true) {
        $alert_icon = "success";
        $alert_title = "Welcome Back!";
        $alert_text = "Redirecting to Dashboard...";
    } else {
        $alert_icon = $login_result['icon'];
        $alert_title = $login_result['title'];
        $alert_text = $login_result['text'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | WaheemTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .login-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4); }
    </style>
</head>
<body class="bg-slate-50 overflow-hidden">

<?php if($alert_icon !== ''): ?>
<script>
    Swal.fire({
        icon: '<?= $alert_icon ?>',
        title: '<?= $alert_title ?>',
        text: '<?= $alert_text ?>',
        showConfirmButton: <?= ($alert_icon === 'success' ? 'false' : 'true') ?>,
        timer: <?= ($alert_icon === 'success' ? '2000' : '5000') ?>,
        timerProgressBar: true,
        background: '#ffffff',
        color: '#1e293b',
        confirmButtonColor: '#2563eb',
        borderRadius: '24px'
    }).then(() => {
        <?php if($alert_icon === 'success'): ?>
            window.location.href = 'admin/dashboard.php';
        <?php endif; ?>
    });
</script>
<?php endif; ?>

<div class="min-h-screen flex items-center justify-center relative px-4">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1920&q=80" 
             alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-white/40 backdrop-blur-[3px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-[2rem] shadow-2xl shadow-blue-500/30 mb-5 transform -rotate-6">
                <i class="fas fa-shield-halved text-white text-4xl"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tighter">
                WAHEEM<span class="text-blue-600">TECH</span>
            </h1>
            <p class="text-slate-600 text-xs font-bold uppercase tracking-[0.3em] mt-2">Admin Command Center</p>
        </div>

        <div class="glass p-8 rounded-[3rem] shadow-2xl border border-white">
            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-2">Email Identity</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition">
                            <i class="fas fa-envelope text-sm"></i>
                        </div>
                        <input type="email" name="username" required
                               class="w-full pl-12 pr-5 py-4 bg-white/50 border border-slate-200 focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 rounded-[1.5rem] outline-none transition-all text-slate-800 placeholder-slate-400 font-medium"
                               placeholder="admin@waheemtech.com">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-2">Security Key</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition">
                            <i class="fas fa-lock-open text-sm"></i>
                        </div>
                        <input type="password" id="adminPass" name="password" required
                               class="w-full pl-12 pr-14 py-4 bg-white/50 border border-slate-200 focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 rounded-[1.5rem] outline-none transition-all text-slate-800 placeholder-slate-400 font-medium"
                               placeholder="••••••••">
                        <button type="button" onclick="togglePass()" class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-400 hover:text-blue-600 transition">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                        class="login-btn w-full bg-blue-600 text-white py-5 rounded-[1.5rem] font-bold text-lg flex items-center justify-center gap-3">
                    <span>Unlock Dashboard</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </button>

                <div class="pt-2 text-center">
                    <a href="index.php" class="text-xs text-slate-500 hover:text-blue-600 transition font-black uppercase tracking-widest">
                        <i class="fas fa-globe-africa mr-1"></i> Public Website
                    </a>
                </div>
            </form>
        </div>

        <p class="text-center text-slate-400 text-[10px] mt-8 font-bold uppercase tracking-[0.4em]">
            Secure Infrastructure &copy; 2026
        </p>
    </div>
</div>

<script>
function togglePass() {
    const passField = document.getElementById('adminPass');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passField.type === 'password') {
        passField.type = 'text';
        eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passField.type = 'password';
        eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

</body>
</html>