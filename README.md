



Trainer Timetable Application with Calendar View:-

1. 📌 Project Title & Description
Trainer Timetable Application with Calendar View:- is a web-based trainer scheduling platform that allows trainers and admins to manage client sessions efficiently. Trainers can create, edit, and track recurring and one-time sessions, while admins oversee session utilization and trainer performance through a calendar interface. The system also includes email verification, password reset, and session reminders.
----------------------------------------------------------------------------
2. 👥 Team Details
Team Name: Codezilla

Members:

[1].Pintoo Prajapati
[2].smeet sathavara 
------------------------------------------------------------------------------
3. 🧰 Tech Stack
Frontend: HTML, CSS, JavaScript, FullCalendar.js  
Backend: PHP  
Database: MySQL  
Email System: PHPMailer  
Local Server: XAMPP
----------------------------------------------------------------------------
4. 📝 Project Description
This project is designed for training centers or individual trainers to efficiently manage their daily schedules and client sessions:

Trainers can:

Sign up and verify via email

Log in and view a personalized calendar

Create recurring or one-time sessions

Track status (Missed, Started, Ended)

Receive email reminders for upcoming sessions


-->Admins can:-

View all trainers’ sessions

monitor calendar entries

The system uses smart tagging, status coloring ,for complete trainer productivity analysis.
-------------------------------------------------------------------------------
5. ⚙️ Setup Instructions



Prerequisites:
- XAMPP installed (Apache + MySQL)
- Composer (for PHPMailer installation)

Steps:
1. Clone or move this project folder into `htdocs`:
   Example: `xampp/htdocs/project1/`
2. Start Apache and MySQL using XAMPP.
3. Open phpMyAdmin in your browser.
4. Create a new database: `project`
5. Import the `project.sql` file from the project folder.
6. Configure database connection inside `db_conn.php`.






------------------------------------------------------------------------
6. 📖 Usage Guide
🧑 Trainer:


Login → Create new session

Choose date, time, recurrence (optional)

View session in calendar

Click to  start/complete session

Email reminder sent before session

👨‍💼 Admin:
Login → Access dashboard

View all trainers and their schedules


---------------------------------------------------------------
7. 🔁 API Endpoints / Architecture
🔑 PHP Files (Endpoints / Logic)
File	Purpose
register_trainer.php	Handles trainer signup & email token generation--
login.php	        Trainer login logic--
create_session.php	Saves session (recurring & one-time)--
email_reminder.php	Sends email notification before session--
reset_password.php	Resets trainer password via email link--
-----------------------------------------------------------------------
📊 Architecture:

Frontend (HTML/JS/FullCalendar)  
Backend (PHP Scripts)  
  ↔️ MySQL (trainer, sessions, admin)  
PHPMailer → SMTP → Email
----------------------------------------------------------------------
