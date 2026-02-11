<?php
session_start();
include '../connection/connect.php'; // Tabbatar path din connection dinka daidai ne

// 1. Check Admin Session: Idan babu session, a mayar da shi login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Fetch Admin Details (Optional: don nuna sunan admin a dashboard)
$admin_email = $_SESSION['admin_email'];
$admin_name = $_SESSION['admin_name'];

// 3. Fetch All Students from free_class_applications
$query = "SELECT * FROM contacts ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | WaheemTech</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    .sidebar-link.active { background: #2563eb; color: white; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
    .glass-header { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
  </style>
</head>
<body class="overflow-x-hidden">

  <div class="flex min-h-screen">
    <aside class="w-64 bg-white border-r border-slate-200 hidden lg:flex flex-col sticky top-0 h-screen">
      <div class="p-6 border-b border-slate-50 flex items-center gap-3">
        <div class="bg-blue-600 p-2 rounded-lg text-white">
          <i class="fas fa-shield-halved"></i>
        </div>
        <span class="font-black text-slate-800 tracking-tighter uppercase text-sm">Waheem<span class="text-blue-600">Tech</span></span>
      </div>

      <nav class="flex-1 p-4 space-y-2 mt-4">
        <a href="dashboard.php"
          class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-slate-500 hover:bg-slate-50 transition font-medium">
          <i class="fas fa-columns w-5"></i> Dashboard
        </a>
        <a href="students.php" class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-users w-5"></i> Students
        </a>
        <a href="add_news.php" class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-newspaper w-5"></i>Add News
        </a>
        <a href="contact_message.php"
          class="sidebar-link  flex items-center  gap-3 p-3 rounded-xl transition font-medium active">
          <i class="fas fa-users w-5"></i> Contact Messages
        </a>

      </nav>

      <div class="p-4 border-t border-slate-100 bg-slate-50/50">
    
        <a href="../logout.php" class="flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition font-bold text-sm">
          <i class="fas fa-sign-out-alt w-5"></i> Logout
        </a>
      </div>
    </aside>

    <main class="flex-1">
        <header class="glass-header border-b border-slate-200 p-6 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight"> Contact Messages</h2>
                 
                </div>
                
            
            </div>
        </header>

        <div class="p-6 lg:p-10 space-y-6">
          

            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Name</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Subject</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Message</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Created At</th>
                                <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="p-6 font-medium text-slate-900 tracking-tight"><?= htmlspecialchars($row['full_name']) ?></td>
                                    <td class="p-6 font-medium text-slate-900 tracking-tight"><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="p-6 font-medium text-slate-900 tracking-tight"><?= htmlspecialchars($row['subject']) ?></td>
                                    <td class="p-6 font-medium text-slate-900 tracking-tight"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                    <td class="p-6 font-medium text-slate-900 tracking-tight"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td class="p-6 text-center">
                               <form method="POST" action="delete_contact.php" onsubmit="return confirmDelete(this);">


                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                    </table>
                </div>
                
                <div class="p-8 border-t border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">&copy; 2026 WaheemTech Systems</p>
                    <div class="flex gap-2">
                        <button class="w-10 h-10 flex items-center justify-center border border-slate-200 rounded-xl text-slate-400 hover:bg-white transition shadow-sm cursor-not-allowed"><i class="fas fa-chevron-left text-xs"></i></button>
                        <button class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 transition">1</button>
                        <button class="w-10 h-10 flex items-center justify-center border border-slate-200 rounded-xl text-slate-400 hover:bg-white transition shadow-sm"><i class="fas fa-chevron-right text-xs"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(form) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    return false;
}
</script>

</body>
</html>