<?php
session_start();
include '../connection/connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

/* ===== DELETE NEWS ===== */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM news_posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: add_news.php?deleted=1");
    exit;
}

/* ===== ADD NEWS ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $platform = $_POST['platform'] ?? '';
    $link     = trim($_POST['post_link'] ?? '');
    $title    = trim($_POST['title'] ?? '');

    if ($platform && $link) {
        $stmt = $conn->prepare(
            "INSERT INTO news_posts (platform, title, post_link) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $platform, $title, $link);
        $stmt->execute();
        header("Location: add_news.php?success=1");
        exit;
    }
}

/* ===== FETCH NEWS ===== */
$result = $conn->query(
    "SELECT * FROM news_posts ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | WaheemTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .sidebar-link.active {
            background: #2563eb;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-slate-200 hidden lg:flex flex-col sticky top-0 h-screen">
            <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg text-white">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <span class="font-black text-slate-800 tracking-tighter uppercase text-sm">Waheem<span
                        class="text-blue-600">Tech</span></span>
            </div>
      <nav class="flex-1 p-4 space-y-2 mt-4">
        <a href="dashboard.php"
          class="sidebar-link flex items-center gap-3 p-3 rounded-xl text-slate-500 hover:bg-slate-50 transition font-medium">
          <i class="fas fa-columns w-5"></i> Dashboard
        </a>
        <a href="students.php" class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-users w-5"></i> Students
        </a>
        <a href="add_news.php" class="sidebar-link active  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-newspaper w-5"></i>Add News
        </a>
        <a href="contact_message.php"
          class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-users w-5"></i> Contact Messages
        </a>

      </nav>

            <div class="p-4 border-t border-slate-100 bg-slate-50/50">

                <a href="../logout.php"
                    class="flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition font-bold text-sm">
                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                </a>
            </div>
        </aside>

        <main class="flex-1">
            <header class="glass-header border-b border-slate-200 p-6 sticky top-0 z-30">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Student Directory</h2>

                    </div>


                </div>
            </header>

            <div class="p-6 lg:p-10 space-y-6">
<div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm mb-8">
    <h3 class="text-sm font-black uppercase tracking-widest mb-6 text-blue-600">
        Add News Post
    </h3>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <select name="platform" required class="p-4 rounded-xl border">
            <option value="">Select Platform</option>
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="youtube">YouTube</option>
            <option value="twitter">X (Twitter)</option>
        </select>

        <input type="url" name="post_link" required
               placeholder="Post link https://..."
               class="p-4 rounded-xl border">

        <input type="text" name="title"
               placeholder="Title (optional)"
               class="p-4 rounded-xl border">

        <button class="md:col-span-3 py-4 bg-blue-600 text-white rounded-xl font-black">
            Publish News
        </button>
    </form>
</div>


                <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                     <table class="w-full text-left">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400">Platform</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400">Title</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400">Link</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php while($row = $result->fetch_assoc()): ?>
            <tr class="hover:bg-blue-50/40">
                <td class="p-6 font-bold capitalize"><?= $row['platform'] ?></td>
                <td class="p-6">
                    <?= $row['title'] ?: '<span class="text-slate-400 italic">No title</span>' ?>
                </td>
                <td class="p-6 truncate max-w-xs">
                    <a href="<?= $row['post_link'] ?>" target="_blank"
                       class="text-blue-600 font-semibold">
                        View Post
                    </a>
                </td>
                <td class="p-6 text-center">
                    <a href="?delete=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this news?')"
                       class="text-red-500 font-bold">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
                    </div>

                    <div class="p-8 border-t border-slate-50 flex items-center justify-between bg-slate-50/30">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">&copy; 2026
                            WaheemTech Systems</p>
                        <div class="flex gap-2">
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-200 rounded-xl text-slate-400 hover:bg-white transition shadow-sm cursor-not-allowed"><i
                                    class="fas fa-chevron-left text-xs"></i></button>
                            <button
                                class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 transition">1</button>
                            <button
                                class="w-10 h-10 flex items-center justify-center border border-slate-200 rounded-xl text-slate-400 hover:bg-white transition shadow-sm"><i
                                    class="fas fa-chevron-right text-xs"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>