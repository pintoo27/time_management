<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage" class="login-container">
        <div class="login-card">
            <div class="login-header">
                <!-- <div class="logo">💪</div> -->
                     <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">

                <h1>Trainer Dashboard</h1>
                <p>Sign in to manage your training sessions</p>
            </div>
            <form id="loginForm" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div id="loginError" class="error-message" style="display: none;"></div>
                <button type="submit" class="login-btn">
                    <span id="loginBtnText">Sign In</span>
                    <div id="loginSpinner" class="spinner" style="display: none;"></div>
                </button>

                <div class="admin-login-link" style="text-align: center; margin-top: 10px;">
    <a href="admin.php" style="color: #3182ce; text-decoration: underline;">Are you an admin?</a> 
    </div>

          <div class="admin-login-link" style="text-align: center; margin-top: 10px;">
    <a href="forgot_password.php" style="color: #3182ce; text-decoration: underline;">Forgot password?</a> 
    </div>

                
            </form>
            <!-- <div class="demo-credentials">
                <p><strong>Demo Credentials:</strong></p>
                <p>Username: johnsmith | Password: password123</p>
                <p>Username: sarahj | Password: trainer456</p>
                <p>Username: mikew | Password: fitness789</p>
            </div> -->
        </div>
    </div>

    <!-- Dashboard -->
    <div id="dashboard" class="dashboard" style="display: none;">
        <!-- Header -->
        <header class="header">
            <!-- <div class="header-left">
                <h1>🗓️ Trainer Dashboard</h1>
            </div> -->

            <div class="header-left" style="display: flex; align-items: center;">
    <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: auto;">
    <!-- <h1 style="margin: 0 0 0 10px; font-size: 24px; color: #007BFF; font-family: Arial, sans-serif;">Anudip</h1> -->
     <h1 style="
  margin: 0 0 0 10px;
  font-size: 28px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: bold;
  letter-spacing: 1px;
  background: linear-gradient(to right, #F5FBFF, #BBDEFB); /* Extra light gradient */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0.5px 0.5px 1px rgba(0, 0, 0, 0.03);
">
  Anudip
</h1>

</div>


            <div class="header-right">
                <button id="createSessionBtn" class="create-btn">
                    ➕ Create Session
                </button>
                <button id="upcomingSessionsBtn" class="create-btn" style="background: #48bb78;">
                    📅 Upcoming Sessions
                </button>
                <div class="user-info">
                     <span id="trainerName" style="font-weight: bold; color:rgb(231, 237, 244); font-size: 18px; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);"></span>
                    <button id="logoutBtn" class="logout-btn" style="background-color: #e53e3e; color: white;">Logout</button> 
                </div>
            </div>
        </header>

        <div class="main-content">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="view-controls">
                    <!-- <h3>Calendar Views</h3>
                    <button class="view-btn active" data-view="month">📅 Monthly View</button>
                    <button class="view-btn" data-view="week">📊 Weekly View</button>
                    <button class="view-btn" data-view="day">📋 Daily View</button> -->

                    <h3 style="color: #ffffff;">Calendar Views</h3>
<button class="view-btn active" data-view="month" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📅 Monthly View</button>
<button class="view-btn" data-view="week" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📊 Weekly View</button>
<button class="view-btn" data-view="day" style="color: #fff; background: transparent; border: 1px solid #60a5fa; padding: 8px 12px; border-radius: 6px; margin: 4px;">📋 Daily View</button>

                    
                </div>
                <div class="stats">
                    <h3 style="color: #ffffff;">Quick Stats</h3>
                    <div class="stat-card">
                        <div class="stat-number" id="totalSessions">0</div>
                        <div class="stat-label">Total Sessions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="upcomingSessions">0</div>
                        <div class="stat-label">Upcoming</div>
                    </div>

   

                    
                </div>
            </aside>

            <!-- Calendar Content -->
            <main class="calendar-content">
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
            </main>
        </div>
    </div>

    <!-- Create Session Modal -->
    <div id="createSessionModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create Training Sessions</h2>
                <button id="closeModal" class="close-btn">&times;</button>
            </div>
            <form id="createSessionForm" class="session-form">
                <input type="hidden" id="session_id" name="session_id" />
                <div class="form-row">
                    <div class="form-group">
                        <label for="sessionTitle">Session Title *</label>
                        <input type="text" id="sessionTitle" name="title" placeholder="e.g., Personal Training - John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="clientName">Client Name *</label>
                        <input type="text" id="clientName" name="client" readonly>
                    </div>
                </div>

                <div class="form-group">
    <label for="sessionType">Session Type *</label>
    <select id="sessionType" name="type" required>
        <option value="">Select type</option>
        <option value="Online">Online</option>
        <option value="Offline">Offline</option>
    </select>
</div>


                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">Start Date *</label>
                        <input type="date" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date *</label>
                        <input type="date" id="endDate" name="endDate" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="startTime">Start Time *</label>
                        <input type="time" id="startTime" name="startTime" required>
                    </div>
                    <div class="form-group">
                        <label for="endTime">End Time *</label>
                        <input type="time" id="endTime" name="endTime" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Select Days *</label>
                    <div class="weekdays">
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="1"> Monday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="2"> Tuesday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="3"> Wednesday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="4"> Thursday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="5"> Friday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="6"> Saturday
                        </label>
                        <label class="weekday-label">
                            <input type="checkbox" name="weekdays" value="0"> Sunday
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea id="description" name="description" rows="3" placeholder="Additional notes about the session..."></textarea>
                </div>

                 <!-- ✅ INSERT THIS AFTER description -->
  <!-- <div class="form-group">
    <label for="meetingLink">Meeting Link (optional)</label>
    <input type="url" id="meetingLink" name="meeting_link" placeholder="https://zoom.us/..." />
  </div> -->

                

                

                <div class="modal-footer">
                    <button type="button" id="cancelBtn" class="cancel-btn">Cancel</button>
                    <button type="submit" class="submit-btn">
                        <span id="submitBtnText">Create Sessions</span>
                        <div id="submitSpinner" class="spinner" style="display: none;"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Upcoming Sessions Modal -->
    <div id="upcomingSessionsModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>📅 Upcoming Sessions</h2>
                <button id="closeUpcomingModal" class="close-btn">&times;</button>
            </div>
            <div id="upcomingSessionsList" class="upcoming-sessions-list">
                <!-- Sessions will be populated by JavaScript -->
            </div>
        </div>
    </div>

    
    

    <script>
        // Initialize dashboard when page loads
        let dashboard;
        document.addEventListener('DOMContentLoaded', function() {
            dashboard = new TrainerDashboard();
        });
    </script>
    <script src="script.js"></script>
</body>
</html>