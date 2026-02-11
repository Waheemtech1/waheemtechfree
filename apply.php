<?php
session_start();
include 'connection/connect.php'; 

$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = mysqli_real_escape_string($conn, trim($_POST['fullName'] ?? ''));
    $email = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));
    $course = mysqli_real_escape_string($conn, trim($_POST['course'] ?? ''));
    $location = mysqli_real_escape_string($conn, trim($_POST['location'] ?? ''));
    $dob = mysqli_real_escape_string($conn, trim($_POST['dob'] ?? ''));

    if (empty($fullname) || empty($email)) {
        $error = "Full Name and Email are required!";
    } else {
        $upload_dir = 'uploads/proofs/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        function handle_upload($file_field) {
            global $upload_dir;
            if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES[$file_field]['name'], PATHINFO_EXTENSION);
                $filename = uniqid('WT_') . '_' . time() . '.' . $ext;
                $target = $upload_dir . $filename;
                if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $target)) {
                    return $filename;
                }
            }
            return null;
        }

        $youtube = handle_upload('youtubeProof');
        $tiktok = handle_upload('tiktokProof');
        $instagram = handle_upload('instagramProof');
        $twitter = handle_upload('twitterProof');
        $telegram = handle_upload('telegramProof');
        $whatsapp = "whatsappplaceholder.jpg"; // An gyara nan (ba sarari, ba karin rubutu)

        $stmt = $conn->prepare("INSERT INTO free_class_applications 
            (fullname, email, phone, course, location, dob, youtube, tiktok, instagram, twitter, telegram, whatsapp) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssssssssss", 
            $fullname, $email, $phone, $course, $location, $dob, 
            $youtube, $tiktok, $instagram, $twitter, $telegram, $whatsapp
        );

        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply | WaheemTech Free Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .input-focus { transition: all 0.3s ease; }
        .input-focus:focus { transform: translateY(-2px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

<?php if ($success): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Application Received!',
        text: 'Welcome to WaheemTech! Check your email shortly for joining instructions.',
        confirmButtonColor: '#2563EB',
        borderRadius: '20px'
    }).then(() => { window.location.href = 'index.php'; });
</script>
<?php endif; ?>

<section class="py-12 px-4 md:py-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
    <div class="max-w-4xl mx-auto">
        
        <div class="text-center mb-10">
            <a href="index.php" class="inline-flex items-center gap-2 text-blue-600 font-bold mb-6 hover:gap-3 transition-all">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 mb-4">
                Join the <span class="text-blue-600">WAHEEMTECH  CLASS</span>
            </h1>
            <p class="text-slate-500 font-medium">Fill the form below to verify your participation and secure your seat.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-100/50 border border-slate-100 overflow-hidden">
            <form action="" method="POST" enctype="multipart/form-data" class="p-8 md:p-12 space-y-10">
                
                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">1</span>
                        Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Full Name</label>
                            <input type="text" name="fullName" required placeholder="Enter your full name"
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                            <input type="email" name="email" required placeholder="name@example.com"
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Phone Number</label>
                            <input type="tel" name="phone" required placeholder="0901 234 5678"
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Date of Birth</label>
                            <input type="date" name="dob" required
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 transition-all text-slate-500">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <div>
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">2</span>
                        Program & Location
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Select Your Course</label>
                            <select name="course" required class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white transition-all appearance-none">
                                <option value="">Choose a program...</option>
                                <option>Software Development</option>
                                <option>Ethical Hacking</option>
                                <option>AI & Machine Learning</option>
                                <option>Web3 & Blockchain</option>
                                <option>Embedded Systems & Robotics</option>
                                <option>Online Money Making</option>
                                <option>Trending Financial Skills</option>
                                <option>Other (Specify in Location)</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Current Location</label>
                            <input type="text" name="location" required placeholder="City, State"
                                class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-slate-50/50 outline-none focus:border-blue-500 focus:bg-white transition-all">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <div class="bg-blue-50/30 p-8 rounded-[2rem] border border-blue-100">
                    <div class="text-center mb-8">
                        <h3 class="text-lg font-bold text-blue-900">Step 3: Social Verification</h3>
                        <p class="text-sm text-blue-600 font-medium">Upload screenshots showing you follow our handles.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php 
                        $platforms = [
                            ['name' => 'YouTube', 'icon' => 'fa-youtube', 'color' => 'bg-red-600', 'field' => 'youtubeProof'],
                            ['name' => 'TikTok', 'icon' => 'fa-tiktok', 'color' => 'bg-black', 'field' => 'tiktokProof'],
                            ['name' => 'Instagram', 'icon' => 'fa-instagram', 'color' => 'bg-pink-600', 'field' => 'instagramProof'],
                            ['name' => 'Twitter/X', 'icon' => 'fa-x-twitter', 'color' => 'bg-slate-900', 'field' => 'twitterProof'],
                            ['name' => 'Telegram', 'icon' => 'fa-telegram', 'color' => 'bg-blue-500', 'field' => 'telegramProof']
                           
                        ];
                        foreach($platforms as $p): ?>
                        <div class="p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="<?= $p['color'] ?> w-8 h-8 rounded-lg flex items-center justify-center text-white">
                                    <i class="fab <?= $p['icon'] ?> text-xs"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-700"><?= $p['name'] ?> Proof</span>
                            </div>
                            <input type="file" name="<?= $p['field'] ?>" required accept="image/*"
                                class="block w-full text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="space-y-6 pt-4">
                    <div class="flex items-center gap-4 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <input type="checkbox" id="agree" required class="w-6 h-6 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500">
                        <label for="agree" class="text-sm text-slate-500 leading-tight">
                            I confirm that the information provided is accurate and I agree to the <span class="text-blue-600 font-bold underline">WaheemTech</span> terms of service.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-2xl font-black text-xl shadow-xl shadow-blue-200 transition-all active:scale-[0.98] flex items-center justify-center gap-4">
                        <span>SUBMIT APPLICATION</span>
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </div>

            </form>
        </div>
        
        <p class="text-center text-slate-400 text-xs mt-10 font-medium">
            &copy; 2026 WaheemTech Innovation Lab. All Rights Reserved.
        </p>
    </div>
</section>

</body>
</html>