<?php
session_start();
include '../connection/connect.php';

if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit(); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `free_class_applications` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) { echo "Student not found!"; exit(); }
} else {
    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile | <?= htmlspecialchars($student['fullname']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
    .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    .status-badge { transition: all 0.3s ease; }
  </style>
</head>
<body class="p-4 md:p-10">

    <div class="max-w-6xl mx-auto">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
            <a href="students.php" class="flex items-center gap-2 bg-white px-5 py-3 rounded-2xl shadow-sm text-slate-600 hover:text-blue-600 transition font-bold text-sm border border-slate-100">
                <i class="fas fa-chevron-left"></i> Back to List
            </a>
            
            <div class="flex items-center gap-3">
                <?php if($student['status'] == 'Approved'): ?>
                    <span class="bg-green-100 text-green-600 px-5 py-2.5 rounded-2xl font-black text-xs uppercase tracking-widest border border-green-200">
                        <i class="fas fa-check-circle mr-1"></i> Already Approved
                    </span>
                <?php else: ?>
                    <span class="bg-orange-100 text-orange-600 px-5 py-2.5 rounded-2xl font-black text-xs uppercase tracking-widest border border-orange-200">
                        <i class="fas fa-clock mr-1"></i> Pending Review
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[3rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6">
                        <i class="fas fa-id-card text-slate-50 text-6xl"></i>
                    </div>
                    
                    <div class="relative z-10 text-center">
                        <div class="w-28 h-28 bg-gradient-to-tr from-blue-600 to-blue-400 rounded-[2rem] mx-auto mb-6 flex items-center justify-center text-4xl text-white font-black shadow-2xl shadow-blue-200 uppercase">
                            <?= substr($student['fullname'], 0, 1) ?>
                        </div>
                        <h2 class="text-2xl font-extrabold tracking-tight text-slate-800"><?= htmlspecialchars($student['fullname']) ?></h2>
                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mt-2">Verified Applicant</p>
                        
                        <div class="mt-8 space-y-3 text-left">
                            <div class="bg-slate-50 p-5 rounded-3xl border border-slate-100 group hover:border-blue-200 transition">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Direct Contact</p>
                                <p class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                    <i class="fab fa-whatsapp text-green-500 text-lg"></i> <?= $student['phone'] ?>
                                </p>
                            </div>
                            <div class="bg-slate-50 p-5 rounded-3xl border border-slate-100 group hover:border-blue-200 transition">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Email Address</p>
                                <p class="text-sm font-bold text-slate-700 truncate"><?= $student['email'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-slate-100">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center justify-between">
                        Social Proofs <i class="fas fa-camera"></i>
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <?php 
                        $proofs = ['youtube', 'tiktok', 'instagram', 'twitter', 'telegram', 'whatsapp'];
                        foreach($proofs as $p): 
                            if(!empty($student[$p])):
                        ?>
                            <a href="../uploads/proofs/<?= $student[$p] ?>" target="_blank" class="group relative block aspect-square bg-slate-100 rounded-2xl overflow-hidden border border-slate-200">
                                <img src="../uploads/proofs/<?= $student[$p] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white text-xl"></i>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 bg-white/90 py-1 text-[8px] font-black text-center uppercase"><?= $p ?></div>
                            </a>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-3">Targeted Skill</h3>
                                <p class="text-3xl font-extrabold text-slate-800 leading-none"><?= $student['course'] ?></p>
                            </div>
                            <div class="flex gap-10">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Resident Location</p>
                                    <p class="font-bold text-slate-700 flex items-center gap-2">
                                        <i class="fas fa-location-dot text-red-400"></i> <?= $student['location'] ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Applied On</p>
                                    <p class="font-bold text-slate-700"><?= date('M d, Y', strtotime($student['created_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block bg-blue-50 p-6 rounded-[2rem]">
                            <i class="fas fa-graduation-cap text-4xl text-blue-500"></i>
                        </div>
                    </div>
                </div>

                <form method="POST" action="update-status.php" class="bg-slate-900 rounded-[3rem] p-10 shadow-2xl shadow-blue-900/20 text-white">
                    <h3 class="font-black uppercase tracking-widest text-xs mb-8 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center"><i class="fas fa-pen text-[10px]"></i></span>
                        Administrative Decision
                    </h3>
                    
                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                    <input type="hidden" name="student_email" value="<?= $student['email'] ?>">
                    <input type="hidden" name="student_name" value="<?= $student['fullname'] ?>">

                    <div class="mb-8">
                        <label class="text-[10px] font-black text-slate-400 uppercase mb-4 block">Personalized Notification Email</label>
                   <textarea
    id="admin_message"
    name="admin_message"
    rows="6"
    class="w-full p-6 bg-white/5 border border-white/10 rounded-[2rem]
           focus:ring-4 focus:ring-blue-500/20 focus:bg-white/10
           focus:border-blue-500/50 outline-none transition
           font-medium text-slate-200 text-sm leading-relaxed">

Hi <?= htmlspecialchars($student['fullname']) ?>,

Congratulations! Your application for the <?= htmlspecialchars($student['course']) ?> has been approved. Welcome to WaheemTech.

Further instructions will be sent to your WhatsApp.

</textarea>

                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <button type="submit" name="status" value="Rejected" onclick="updateMessage('Rejected')" class="w-full sm:flex-1 py-5 bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 rounded-2xl font-black text-xs transition uppercase tracking-widest">
                           <i class="fas fa-times-circle mr-2"></i> Reject Applicant
                        </button>
                        <button type="submit" name="status" value="Approved" onclick="updateMessage('Approved')" class="w-full sm:flex-[2] py-5 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-black text-xs shadow-xl shadow-blue-600/30 hover:scale-[1.02] active:scale-95 transition uppercase tracking-widest">
                           <i class="fas fa-paper-plane mr-2"></i> Approve & Dispatch Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
let messageTouched = false;

const textarea = document.getElementById('admin_message');

// gano idan admin ya gyara da hannu
textarea.addEventListener('input', () => {
    messageTouched = true;
});

function updateMessage(status) {
    // idan admin ya riga ya gyara, kada a overwrite
    if (messageTouched) return;

    const name = "<?= htmlspecialchars($student['fullname'], ENT_QUOTES) ?>";
    const course = "<?= htmlspecialchars($student['course'], ENT_QUOTES) ?>";

    if (status === 'Rejected') {
        textarea.value =
`Hi ${name},

Thank you for your interest in WaheemTech.
Unfortunately, your application for the ${course} was not successful at this time.

Best regards,
WaheemTech Academy`;
    } else {
        textarea.value =
`Hi ${name},

Congratulations! 🎉
Your application for the ${course} has been approved.
Welcome to WaheemTech Academy.

Further instructions will be sent to your WhatsApp.

Best regards,
WaheemTech Academy`;
    }
}
</script>


</body>
</html>