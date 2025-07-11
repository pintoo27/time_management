



Trainer Timetable Application with Calendar View:-

1. 📌 Project Title & Description
Trainer Timetable Application with Calendar View:- is a web-based trainer scheduling platform that allows trainers and admins to manage client sessions efficiently. Trainers can create, edit, and track recurring and one-time sessions, while admins oversee session utilization and trainer performance through a calendar interface. The system also includes email verification, password reset, and session reminders.
----------------------------------------------------------------------------
2. 👥 Team Details
Team Name: Codezilla

Members:

[1].Pintoo Prajapati
[2].smeet sathavara 

3. 🧰 Tech Stack
---------------------------------------------------------------------------
Frontend	HTML, CSS, JavaScript, FullCalendar.js
Backend	        PHP
Database	     MySQL
Email System	PHPMailer
Local Server	XAMPP
----------------------------------------------------------------------------
4. 📝 Project Description
This project is designed for training centers or individual trainers to efficiently manage their daily schedules and client sessions:

Trainers can:

Sign up and verify via email

Log in and view a personalized calendar

Create recurring or one-time sessions

Track status (Missed, Started, Ended)

Receive email reminders for upcoming sessions

Admins can:

View all trainers’ sessions

monitor calendar entries

The system uses smart tagging, status coloring, and session history logging for complete trainer productivity analysis.
-------------------------------------------------------------------------------
5. ⚙️ Setup Instructions
Prerequisites:
XAMPP installed (Apache + MySQL)

Composer (for PHPMailer installation)




Import the Database:

Open phpMyAdmin

Create database: project1

Import project.sql file from the project folder

Configure Database in Code:






------------------------------------------------------------------------
6. 📖 Usage Guide
🧑 Trainer:
Register account → verify via email link

Login → Create new session

Choose date, time, recurrence (optional)

View session in calendar

Click to edit or start/complete session

Email reminder sent before session

👨‍💼 Admin:
Login → Access dashboard

View all trainers and their schedules


---------------------------------------------------------------
7. 🔁 API Endpoints / Architecture
🔑 PHP Files (Endpoints / Logic)
File	Purpose
register_trainer.php	Handles trainer signup & email token generation
verify.php	Activates account via token
login.php	Trainer login logic
create_session.php	Saves session (recurring & one-time)

update_session.php	Edits existing session
email_reminder.php	Sends email notification before session
reset_password.php	Resets trainer password via email link

📊 Architecture:
plaintext
Copy
Edit
Frontend (HTML/JS/FullCalendar)
    ⬇️ AJAX
Backend (PHP Scripts)
    ↔️ MySQL (trainer, sessions, admin)
PHPMailer → SMTP → Email
----------------------------------------------------------------------
