<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <!-- Admin Login Page -->
    <div id="adminLoginPage" class="login-container">
        <div class="login-card">
            <div class="login-header">
                <!-- <div class="logo">👨‍💼</div> -->
                 <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">

  
                <h1>Admin Dashboard</h1>
                <p>Sign in to manage trainers and sessions</p>
            </div>
            <form id="adminLoginForm" class="login-form">
                <div class="form-group">
                    <label for="adminUsername">Username</label>
                    <input type="text" id="adminUsername" name="username" placeholder="Enter admin username" required>
                </div>
                <div class="form-group">
                    <label for="adminPassword">Password</label>
                    <input type="password" id="adminPassword" name="password" placeholder="Enter admin password" required>
                </div>
                <div id="adminLoginError" class="error-message" style="display: none;"></div>
                <button type="submit" class="login-btn">
                    <span id="adminLoginBtnText">Sign In</span>
                    <div id="adminLoginSpinner" class="spinner" style="display: none;"></div>
                </button>
                  <div class="admin-login-link" style="text-align: center; margin-top: 10px;">
    <a href="forgot_password.php" style="color: #3182ce; text-decoration: underline;">Forgot password?</a> 
    </div>
            </form>
            <!-- <div class="demo-credentials">
                <p><strong>Admin Credentials:</strong></p>
                <p>Username: admin | Password: admin123</p>
                <p>Username: superadmin | Password: super123</p>
            </div> -->
        </div>
    </div>

    <!-- Admin Dashboard -->
    <div id="adminDashboard" class="dashboard" style="display: none;">
        <!-- Header -->
        <header class="header">
            <!-- <div class="header-left">
                <h1>👨‍💼 Admin Dashboard</h1>
            </div> -->

            <div class="header-left">
    <img src="download.png" alt="Anudeep Logo" style="height: 40px; vertical-align: middle;">
    <h1 style="display: inline; margin-left: 8px;   background: linear-gradient(to right, #F5FBFF, #BBDEFB); /* Extra light gradient */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0.5px 0.5px 1px rgba(0, 0, 0, 0.03);">Anudip</h1>
</div>
            <div class="header-right">
                <div class="user-info">
                    <span id="adminName"></span>
                    <button onclick="window.location.href='add_trainer.php'" 
        style="
         background: linear-gradient(to right, #4facfe, #4a6e70ff);
   border: none;
   padding: 8px 14px;         /* Reduced padding */ 
   border-radius: 6px;        /* Slightly smaller curve */
   color: white;
font-size: 14px;           /* Smaller text */
cursor: pointer;
font-family: 'Poppins', sans-serif;
font-weight: 500;
        ">
  ➕ Add Trainer
</button>

                    <button id="adminLogoutBtn" class="logout-btn"style="background-color: #e53e3e; color: white;">Logout</button>
                </div>
            </div>
        </header>

        <div class="main-content">
            <!-- Admin Sidebar -->
            <aside class="sidebar">
                <!-- Trainer Search -->
                <div class="trainer-search">
                    <h3 style="color: #ffffff;">Select Trainer</h3>
                    <div class="dropdown-container">
                        <div class="dropdown-select" id="trainerDropdown">
                            <div class="dropdown-selected" id="dropdownSelected">
                                <span class="placeholder">Select a trainer...</span>
                                <span class="dropdown-arrow">▼</span>
                            </div>
                            <div class="dropdown-menu" id="dropdownMenu">
                                <div class="dropdown-search">
                                    <input type="text" id="trainerSearchInput" placeholder="Type to search trainers..." class="dropdown-search-input">
                                </div>
                                <div class="dropdown-options" id="dropdownOptions">
                                    <!-- Options will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="selectedTrainer" class="selected-trainer" style="display: none;">
                        <div class="trainer-info">
                            <h4 id="selectedTrainerName"></h4>
                            <p id="selectedTrainerEmail"></p>
                            <small id="selectedTrainerSessions"></small>
                        </div>
                        <button id="clearSelection" class="clear-btn">Clear</button>
                    </div>
                </div>

                <!-- View Controls -->
                <div class="view-controls">
                    <h3 style="color: #ffffff;">Calendar Views</h3>
                    <!-- <button class="view-btn active" data-view="month">📅 Monthly View</button>
                    <button class="view-btn" data-view="week">📊 Weekly View</button>
                    <button class="view-btn" data-view="day">📋 Daily View</button> -->
                    <button class="view-btn active" data-view="month" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📅 Monthly View</button>
<button class="view-btn" data-view="week" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📊 Weekly View</button>
<button class="view-btn" data-view="day" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📋 Daily View</button>

                </div>

                <!-- Stats -->
                <div class="stats">
                    <h3 style="color: #ffffff;">Session Stats</h3>
                    <div class="stat-card">
                        <div class="stat-number" id="totalTrainerSessions">0</div>
                        <div class="stat-label">Total Sessions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="upcomingTrainerSessions">0</div>
                        <div class="stat-label">Upcoming</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="completedTrainerSessions">0</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </aside>

            <!-- Calendar Content -->
            <main class="calendar-content">
                <div id="noTrainerSelected" class="no-trainer-message">
                    <div class="empty-state">
                        <div class="empty-icon">🔍</div>
                        <h3>No Trainer Selected</h3>
                        <p>Please search and select a trainer to view their sessions</p>
                    </div>
                </div>

                <div id="trainerCalendarView" style="display: none;">
                    <div class="calendar-header">
                        <div class="calendar-nav">
                            <button id="prevBtn" class="nav-btn">‹</button>
                            <h2 id="currentDate"></h2>
                            <button id="nextBtn" class="nav-btn">›</button>
                        </div>
                        <div class="view-tabs">
                            <button class="tab-btn active" data-view="month">Month</button>
                            <button class="tab-btn" data-view="week">Week</button>
                            <button class="tab-btn" data-view="day">Day</button>
                        </div>
                    </div>
                    <div id="calendarView" class="calendar-view"></div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize admin dashboard when page loads
        let adminDashboard;
        document.addEventListener('DOMContentLoaded', function() {
            adminDashboard = new AdminDashboard();
        });
    </script>
    <script src="admin-script.js"></script>
    <script>
// Add some debugging for admin login
document.addEventListener('DOMContentLoaded', function() {
    console.log("Admin page loaded");
    
    // Test if we can reach the admin login API
    fetch('admin-login.php', {
        method: 'OPTIONS'
    }).then(response => {
        console.log("Admin API reachable:", response.status);
    }).catch(error => {
        console.error("Admin API not reachable:", error);
    });
});
</script>
</body>
</html>