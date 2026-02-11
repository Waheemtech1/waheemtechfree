<?php
include 'connection/connect.php';
$query = "SELECT * FROM news_posts WHERE status = 'active' ORDER BY created_at DESC LIMIT 3";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>WAHEEMTECH | Nigeria's #1 Free Tech Learning Hub</title>
  <meta name="description"
    content="Learn Software Development, Ethical Hacking, AI, and Robotics for free at WAHEEMTECH. Empowering the next generation of Nigerian tech talent.">
  <meta name="keywords" content="Tech, Coding, Free Courses, Nigeria, AI, Hacking, WAHEEMTECH">

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brandBlue: '#2563eb',
            brandDark: '#0f172a',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
        }
      }
    }
  </script>

  <style>
    /* Smooth scrolling ga duka shafin */
    html {
      scroll-behavior: smooth;
    }

    @keyframes fade-in-down {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-down {
      animation: fade-in-down 0.3s ease-out forwards;
    }
  </style>
</head>

<body>
  <header id="navbar"
    class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">

        <a href="" class="flex items-center gap-3 group cursor-pointer">
          <div class="bg-blue-600 p-2 rounded-lg group-hover:rotate-12 transition-transform duration-300">
            <i class="fas fa-laptop-code text-white text-xl"></i>
          </div>
          <h1 class="font-extrabold text-2xl tracking-tighter text-slate-800 uppercase">
            Waheem<span class="text-blue-600">Tech</span>
          </h1>
        </a>

        <nav class="hidden md:flex items-center space-x-8">

          <a href="#home" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Home</a>

          <a href="#learning" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Courses</a>

          <a href="#headline" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Tech
            Headline</a>
          <a href="#about" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">About</a>
          <a href="#contact" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Contact</a>

          <a href="apply.php"
            class="ml-4 inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5 active:scale-95">
            <span>Apply Now</span>
            <i class="fas fa-paper-plane text-xs"></i>
          </a>
        </nav>

        <div class="lg:hidden flex items-center">
          <button id="mobile-menu-button"
            class="text-slate-600 p-2 hover:bg-slate-100 rounded-xl transition-all focus:outline-none">
            <i id="menu-icon" class="fas fa-bars text-2xl"></i>
          </button>
        </div>

      </div>
    </div>

    <div id="mobile-menu"
      class="hidden lg:hidden bg-white border-t border-slate-100 absolute w-full left-0 shadow-2xl animate-fade-in-down">
      <div class="px-4 pt-4 pb-8 space-y-2">
        <a href="#home"
          class="mobile-link block p-4 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 transition">Home</a>
        <a href="#learning"
          class="mobile-link block p-4 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 transition">Courses</a>
        <a href="#headline"
          class="mobile-link block p-4 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 transition">Tech
          Headlines</a>
        <a href="#about"
          class="mobile-link block p-4 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 transition">About
          Us</a>
        <a href="#contact"
          class="mobile-link block p-4 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 transition">Contact</a>
        <div class="pt-4">
          <a href="apply.php"
            class="block w-full text-center bg-blue-600 text-white py-4 rounded-2xl font-black shadow-lg shadow-blue-200">Apply
            Now</a>
        </div>
      </div>
    </div>
  </header>



  <div class="h-20"></div>

  <section id="home" class="relative h-[90vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img
        src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
        alt="Tech Background" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/40"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
      <div class="max-w-3xl">
        <span
          class="inline-block py-1 px-4 rounded-full bg-blue-600/20 border border-blue-400/30 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-sm">
          Next Generation Learning
        </span>

        <h2 class="text-4xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
          Welcome to <br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
            WAHEEMTECH
          </span>
        </h2>

        <p class="text-lg md:text-xl text-slate-300 mb-10 leading-relaxed max-w-2xl">
          Empowering Minds Through Free Tech Education in Nigeria.
          Master Software Engineering, AI, and Cybersecurity from the best industry experts.
        </p>

        <div class="flex flex-col sm:flex-row items-center gap-4 justify-center md:justify-start">
          <a href="#learning"
            class="group flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all shadow-xl shadow-blue-600/20 hover:-translate-y-1">
            <span>Explore Courses</span>
            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
          </a>

          <a href="#about"
            class="px-8 py-4 rounded-2xl font-bold text-lg text-white border border-white/20 hover:bg-white/10 backdrop-blur-md transition">
            About Us
          </a>
        </div>

        <div class="mt-12 flex items-center gap-8 justify-center md:justify-start">
          <div class="text-white">
            <p class="text-2xl font-bold">100%</p>
            <p class="text-slate-400 text-sm">Free Education</p>
          </div>
          <div class="w-px h-10 bg-slate-700"></div>
          <div class="text-white">
            <p class="text-2xl font-bold">5k+</p>
            <p class="text-slate-400 text-sm">Students Enrolled</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="learning" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-4">
          Free Portfolio Learning Services
        </h2>
        <div class="h-1.5 w-24 bg-blue-600 mx-auto rounded-full"></div>
        <p class="mt-4 text-slate-600 font-medium">
          Choose from our range of specialized tech courses designed to equip you with in-demand skills.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-code text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Software Development</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Learn full-stack development, build real-world apps and projects using modern frameworks.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-blue-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
            <i class="fas fa-shield-alt text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Ethical Hacking</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Understand cybersecurity, penetration testing, and master real-world hacking tools safely.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-red-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
            <i class="fas fa-brain text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">AI & Machine Learning</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Master AI models, datasets, and build intelligent systems that solve complex problems.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-purple-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition-colors">
            <i class="fas fa-robot text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Robotics & IoT</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Explore Arduino, ESP32, sensors, and the fundamentals of robotics programming.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-orange-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors">
            <i class="fas fa-chart-line text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Digital Income</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Learn crypto, forex, stocks, and build reliable digital income skills for the future.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-green-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

        <div
          class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <div
            class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
            <i class="fas fa-chart-line text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-slate-800 mb-3">Trending Financial Skills</h3>
          <p class="text-slate-600 mb-6 leading-relaxed text-sm">
            Master trending financial skills like crypto, forex, stocks, and build reliable digital income streams for
            the future.
          </p>
          <button onclick="window.location.href='apply.php'"
            class="w-full py-3 px-4 bg-slate-900 text-white rounded-xl font-semibold hover:bg-purple-600 transition-colors flex items-center justify-center gap-2">
            Apply Now <i class="fas fa-arrow-right text-xs"></i>
          </button>
        </div>

      </div>
    </div>
  </section>

  <section id="about" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col lg:flex-row items-center gap-16">

        <div class="w-full lg:w-1/2 relative">
          <div
            class="absolute -top-10 -left-10 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob">
          </div>
          <div
            class="absolute -bottom-10 -right-10 w-64 h-64 bg-cyan-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000">
          </div>

          <div
            class="relative bg-white p-12 rounded-[3rem] shadow-2xl border border-slate-50 flex flex-col items-center text-center">
            <div
              class="w-24 h-24 bg-gradient-to-br from-blue-600 to-blue-400 rounded-3xl flex items-center justify-center shadow-lg mb-6 transform -rotate-6">
              <i class="fas fa-laptop-code text-white text-5xl"></i>
            </div>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter uppercase mb-2">
              WAHEEM<span class="text-blue-600">TECH</span>
            </h3>
            <p class="text-blue-600 font-bold text-xs uppercase tracking-[0.3em] mb-6">Nigeria's Innovation Hub</p>

            <div class="flex gap-4">
              <span
                class="px-4 py-2 bg-slate-50 rounded-full text-xs font-bold text-slate-500 border border-slate-100 italic">#TechForGood</span>
              <span
                class="px-4 py-2 bg-slate-50 rounded-full text-xs font-bold text-slate-500 border border-slate-100 italic">#EmpowerNigeria</span>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-1/2 space-y-8">
          <div>
            <h2 class="text-blue-600 font-bold text-sm uppercase tracking-widest mb-3">Who We Are</h2>
            <h3 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">
              Building the Future of <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 text-6xl">African
                Talent.</span>
            </h3>
            <p class="text-lg text-slate-600 leading-relaxed">
              WAHEEMTECH is an innovative Nigerian tech brand dedicated to bridging the digital divide. We believe that
              world-class education should be accessible to everyone, regardless of their background.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex gap-4">
              <div class="text-blue-600 mt-1"><i class="fas fa-check-circle"></i></div>
              <p class="text-sm font-semibold text-slate-700">Expert-led Curriculum</p>
            </div>
            <div class="flex gap-4">
              <div class="text-blue-600 mt-1"><i class="fas fa-check-circle"></i></div>
              <p class="text-sm font-semibold text-slate-700">Hands-on Robotics Labs</p>
            </div>
            <div class="flex gap-4">
              <div class="text-blue-600 mt-1"><i class="fas fa-check-circle"></i></div>
              <p class="text-sm font-semibold text-slate-700">Cybersecurity & AI focus</p>
            </div>
            <div class="flex gap-4">
              <div class="text-blue-600 mt-1"><i class="fas fa-check-circle"></i></div>
              <p class="text-sm font-semibold text-slate-700">100% Free Scholarship</p>
            </div>
          </div>

          <div class="pt-6">
            <a href="#learning"
              class="inline-flex items-center gap-2 font-bold text-blue-600 hover:gap-4 transition-all">
              Learn more about our mission <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="contact" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-4">Get In Touch</h2>
        <div class="h-1.5 w-20 bg-blue-600 mx-auto rounded-full"></div>
        <p class="mt-4 text-slate-600 font-medium">Have questions? We'd love to hear from you.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

        <div class="space-y-8">
          <div class="bg-blue-600 rounded-3xl p-8 md:p-10 text-white shadow-xl shadow-blue-200">
            <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
            <p class="text-blue-100 mb-8 leading-relaxed">Fill out the form and our team will get back to you within 24
              hours.</p>

            <div class="space-y-6">
              <div class="flex items-center gap-4 group">
                <div
                  class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition">
                  <i class="fas fa-phone-alt text-xl"></i>
                </div>
                <div>
                  <p class="text-xs text-blue-200 uppercase font-bold tracking-wider">Call Us</p>
                  <p class="font-semibold text-lg">+234-9061764966</p>
                </div>
              </div>

              <div class="flex items-center gap-4 group">
                <div
                  class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition">
                  <i class="fas fa-envelope text-xl"></i>
                </div>
                <div>
                  <p class="text-xs text-blue-200 uppercase font-bold tracking-wider">Email Us</p>
                  <p class="font-semibold text-lg">waheemtech@gmail.com</p>
                </div>
              </div>

              <div class="flex items-center gap-4 group">
                <div
                  class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition">
                  <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                  <p class="text-xs text-blue-200 uppercase font-bold tracking-wider">Location</p>
                  <p class="font-semibold text-lg">Nigeria (Virtual Hub)</p>
                </div>
              </div>
            </div>

            <div class="mt-12 flex gap-4">
              <a href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-600 transition duration-300">
                <i class="fab fa-whatsapp"></i>
              </a>
              <a href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-600 transition duration-300">
                <i class="fab fa-telegram-plane"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-3xl p-8 md:p-10 border border-slate-100 shadow-sm">
          <h3 class="text-xl font-bold text-slate-800 mb-8 uppercase tracking-tight">Send Us Your Feedback</h3>
          <form id="contactForm" class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <input type="text" placeholder="Full Name" required
                class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition duration-200">
              <input type="email" placeholder="Email Address" required
                class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition duration-200">
            </div>
            <input type="text" placeholder="Subject" required
              class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition duration-200">
            <textarea placeholder="Your Message" rows="5" required
              class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-transparent focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition duration-200 resize-none"></textarea>

            <button type="submit"
              class="w-full bg-slate-900 hover:bg-blue-600 text-white py-4 rounded-2xl font-bold text-lg shadow-lg transition-all duration-300 transform active:scale-95 flex items-center justify-center gap-2">
              <span>SUBMIT NOW</span>
              <i class="fas fa-paper-plane text-xs"></i>
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>

  <section id="headline" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-xs font-bold uppercase tracking-widest mb-4">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Latest Updates
            </div>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6">
                Tech Headlines & <span class="text-blue-600">Free Jobs</span>
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                We are building a hub for the latest tech news, high-paying job opportunities, and verified online gigs 
                specifically for the Nigerian tech community.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <a href="<?php echo $row['post_link']; ?>" target="_blank" class="block group">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 h-full flex flex-col gap-4 transition hover:bg-white hover:shadow-xl">
                        
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-white rounded-xl shadow-sm group-hover:scale-110 transition">
                                <?php 
                                    // Canza Icon dangane da Platform
                                    if(strtolower($row['platform']) == 'facebook') echo '<i class="fab fa-facebook text-blue-600 text-xl"></i>';
                                    elseif(strtolower($row['platform']) == 'twitter') echo '<i class="fab fa-twitter text-blue-400 text-xl"></i>';
                                    else echo '<i class="fas fa-newspaper text-purple-600 text-xl"></i>';
                                ?>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                <?php echo $row['platform']; ?>
                            </span>
                        </div>

                        <div>
                            <h4 class="font-bold text-slate-800 text-lg mb-2 group-hover:text-blue-600 transition">
                                <?php echo $row['title']; ?>
                            </h4>
                            <p class="text-sm text-slate-500 line-clamp-3">
                                Click to read the full update on <?php echo $row['platform']; ?>.
                            </p>
                        </div>
                        
                        <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-400"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                            <span class="text-blue-600 text-xs font-bold italic">Check it out →</span>
                        </div>
                    </div>
                </a>
            <?php 
                }
            } else {
                // Idan babu komai a Database
                echo '<div class="col-span-full text-center p-12 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 text-slate-400">No news posted yet. Stay tuned!</div>';
            }
            ?>
        </div>

     

    </div>
</section>
  <section id="connect" class="py-24 bg-slate-950 text-white overflow-hidden relative">
    <div
      class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-50">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="text-center mb-16">
        <h2 class="text-blue-500 font-bold text-sm uppercase tracking-[0.3em] mb-4">Stay Connected</h2>
        <h3 class="text-4xl md:text-6xl font-black mb-6">Join the <span
            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-300">WaheemTech</span> Community
        </h3>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">Follow us on social media for daily tech updates, free
          tutorials, and job alerts.</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-20">

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-red-500/50 hover:bg-red-500/5 transition-all duration-300 text-center">
          <i class="fab fa-youtube text-3xl mb-4 text-slate-500 group-hover:text-red-500 transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">YouTube</p>
        </a>

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-blue-400/50 hover:bg-blue-400/5 transition-all duration-300 text-center">
          <i class="fab fa-telegram-plane text-3xl mb-4 text-slate-500 group-hover:text-blue-400 transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">Telegram</p>
        </a>

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-green-500/50 hover:bg-green-500/5 transition-all duration-300 text-center">
          <i class="fab fa-whatsapp text-3xl mb-4 text-slate-500 group-hover:text-green-500 transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">WhatsApp</p>
        </a>

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-pink-500/50 hover:bg-pink-500/5 transition-all duration-300 text-center">
          <i class="fab fa-tiktok text-3xl mb-4 text-slate-500 group-hover:text-white transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">TikTok</p>
        </a>

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-purple-500/50 hover:bg-purple-500/5 transition-all duration-300 text-center">
          <i class="fab fa-instagram text-3xl mb-4 text-slate-500 group-hover:text-purple-400 transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">Instagram</p>
        </a>

        <a href="#"
          class="group p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-slate-400 hover:bg-slate-400/5 transition-all duration-300 text-center">
          <i class="fab fa-x-twitter text-3xl mb-4 text-slate-500 group-hover:text-white transition-colors"></i>
          <p class="font-bold text-sm uppercase tracking-wider">Twitter</p>
        </a>
      </div>

      <div
        class="bg-blue-600 rounded-[3rem] p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-blue-500/20">
        <div class="text-center md:text-left">
          <h4 class="text-2xl md:text-3xl font-bold mb-2">Have a direct inquiry?</h4>
          <p class="text-blue-100 italic">Reach out to our support team directly via email.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
          <a href="mailto:waheemtech@gmail.com"
            class="flex items-center justify-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-2xl font-black hover:bg-slate-100 transition shadow-xl">
            <i class="fas fa-envelope"></i>
            <span>waheemtech@gmail.com</span>
          </a>
          <a href="tel:+2349061764966"
            class="flex items-center justify-center gap-3 bg-blue-700 text-white px-8 py-4 rounded-2xl font-black hover:bg-blue-800 transition border border-blue-500/50">
            <i class="fas fa-phone-alt"></i>
            <span>Call Support</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-slate-900 text-slate-300 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 text-center md:text-left">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
        <div class="space-y-4">
          <h4 class="text-white font-bold text-xl uppercase">WAHEEMTECH</h4>
          <p class="text-sm text-slate-400"><i class="fa fa-arrow-right" onclick="location.href='admin-login.php'"></i>
            Bridging the digital divide in Nigeria through high-quality, free technical education.</p>
        </div>
        <div>
          <h4 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Connect</h4>
          <div class="flex justify-center md:justify-start gap-4">
            <a href="#"
              class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 transition"><i
                class="fab fa-youtube"></i></a>
            <a href="#"
              class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-green-500 transition"><i
                class="fab fa-whatsapp"></i></a>
            <a href="#"
              class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-400 transition"><i
                class="fab fa-telegram"></i></a>
          </div>
        </div>
      </div>
      <div class="pt-8 border-t border-slate-800 text-center text-xs">
        <p>&copy; 2026 WAHEEMTECH. All rights reserved.</p>
      </div>
    </div>
  </footer>
<div id="fb-root"></div>
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1"></script>
<script async src="https://www.instagram.com/embed.js"></script>
<script async src="https://platform.twitter.com/widgets.js"></script>

  <script src="script.js"></script>
</body>

</html>