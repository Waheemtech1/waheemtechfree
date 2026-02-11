<?php
include '../connection/connect.php'; // Saka sunan file din connection dinka anan

// Jawo dukkan aikace-aikace daga table
$sql = "SELECT * FROM free_class_applications ORDER BY created_at DESC";
$result = $conn->query($sql);

// Don kididdigar boxes na sama
$total_students = $result->num_rows;

// Kididdigar news posts
$news_result = $conn->query("SELECT COUNT(*) as total FROM news_posts");
$news_row = $news_result->fetch_assoc();
$total_news = $news_row['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | WaheemTech</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }

    .sidebar-link.active {
      background: #2563eb;
      color: white;
      box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
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
          class="sidebar-link active flex items-center gap-3 p-3 rounded-xl text-slate-500 hover:bg-slate-50 transition font-medium">
          <i class="fas fa-columns w-5"></i> Dashboard
        </a>
        <a href="students.php" class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
          <i class="fas fa-users w-5"></i> Students
        </a>
        <a href="add_news.php" class="sidebar-link  flex items-center gap-3 p-3 rounded-xl transition font-medium">
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
      <header class="bg-white border-b border-slate-200 p-4 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800">Overview</h2>
        <div class="flex items-center gap-4">
          <div class="text-right hidden sm:block">
            <p class="text-xs font-bold text-slate-400 uppercase">System Admin</p>
            <p class="text-sm font-bold text-slate-800">Admin User</p>
          </div>
          <img src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff"
            class="w-10 h-10 rounded-full border-2 border-blue-100">
        </div>
      </header>

      <div class="p-6 lg:p-10 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4"><i
                class="fas fa-user-graduate"></i></div>
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Students</p>
            <h4 class="text-3xl font-black text-slate-800 mt-1">
              <?php echo $total_students; ?>
            </h4>
          </div>
          <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4"><i
                class="fas fa-newspaper"></i></div>
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total News</p>
            <h4 class="text-3xl font-black text-slate-800 mt-1">
              <?php echo $total_news; ?>
            </h4>
          </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
          <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Recent Course Applications</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-slate-50">
                  <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Student</th>
                  <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Course</th>
                  <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Date</th>
                  <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                  <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Dauko harafin farko na sunan sa don Avatar
                        $initial = strtoupper(substr($row['fullname'], 0, 2));
                        $status_color = ($row['status'] == 'Approved') ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600';
                        
?>
                <tr class="hover:bg-slate-50 transition">
                  <td class="p-4">
                    <div class="flex items-center gap-3">
                      <div
                        class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs">
                        <?php echo $initial; ?>
                      </div>
                      <div>
                        <p class="font-bold text-slate-800 text-sm">
                          <?php echo htmlspecialchars($row['fullname']); ?>
                        </p>
                        <p class="text-xs text-slate-400">
                          <?php echo htmlspecialchars($row['email']); ?>
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="p-4 text-sm font-medium text-slate-600">
                    <?php echo htmlspecialchars($row['course']); ?>
                  </td>
                  <td class="p-4 text-xs text-slate-500">
                    <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                  </td>
                  <td class="p-4">
                    <span class="px-3 py-1 <?php echo $status_color; ?> text-[10px] font-black uppercase rounded-full">
                      <?php echo htmlspecialchars($row['status']); ?>
                    </span>
                  </td>
                  <td class="p-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <a href="view-student.php?id=<?= $row['id']; ?>"
                        class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm group relative"
                        title="View Details">
                        <i class="fas fa-eye text-sm"></i>
                        <span
                          class="absolute bottom-10 scale-0 group-hover:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded">View</span>
                      </a>

                      <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"
                        class="w-9 h-9 flex items-center justify-center bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-200 hover:text-slate-600 transition-all shadow-sm group relative">
                        <i class="fas fa-envelope text-sm"></i>
                        <span
                          class="absolute bottom-10 scale-0 group-hover:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded">Email</span>
                      </a>

                      <button onclick="confirmDelete(<?php echo $row['id']; ?>)"
                        class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm group relative"
                        title="Delete Student">
                        <i class="fas fa-trash-alt text-sm"></i>
                        <span
                          class="absolute bottom-10 scale-0 group-hover:scale-100 transition-all bg-slate-800 text-white text-[10px] px-2 py-1 rounded">Delete</span>
                      </button>
                    </div>
                  </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='p-4 text-center text-slate-500'>Babu dalibi ko daya.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ef4444',
      cancelButtonColor: '#64748b',
      confirmButtonText: 'Yes, delete it!',
      borderRadius: '2rem'
    }).then((result) => {
      if (result.isConfirmed) {
        // Zaka iya tura shi zuwa file din delete.php
        window.location.href = `delete_student.php?id=${id}`;
      }
    })
  }
</script>

</html>