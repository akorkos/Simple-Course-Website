# Simple course website

The material was developed during the course [Internet Educational Environments
[NET-07-01]](https://elearning.auth.gr/course/view.php?id=8120) (2023/24) of the
Department of Computer Science at Aristotle University of Thessaloniki.<br/> 

The course website can be found here: 

<p align="center">
<a href="https://alexkork.webpages.auth.gr/3870partB"> https://alexkork.webpages.auth.gr/3870partB </a>
</p>

The static website directory, consists the website view for the students without
any functionality i.e. a draft of the basic website.

The dynamic directory, is the main implementation with all the necessary files.
In that note, the files contain specific data that need to be altered to test
the website locally (localhost).

## Key features

### User Authentication
- Access to the website is restricted to authorized users only.
- Certified users' information, such as name, surname, unique login (email), 
password, and role (Tutor or Student), is stored in the database.

### Course Announcements
- Announcements related to the course are stored in a dedicated database table.
- Essential announcement details, including serial number, date, subject, and 
main text, are recorded in the database.

### Course Documents
- Course-related documents are stored in a specific database table.
- Important document details, like serial number, document title, description, 
and file name/location, are stored in the database.

### Course Assignments
- Course assignments are saved in a dedicated database table.
- Key assignment details, including serial number, objectives, instructions 
(file name/location), deliverables, and submission deadline, are stored in the 
database.

### Tutor Management
- Tutors, assigned the tutor role, have website management capabilities:
    - Add/Edit/Delete Announcements
    - Add/Edit/Delete Users
    - Add/Edit/Delete Assignments
    - Add/Edit/Delete Documents
