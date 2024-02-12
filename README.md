# Simple course website

The material was developed during the course [Internet Educational Environments
[NET-07-01]](https://elearning.auth.gr/course/view.php?id=8120) (2023/24) of the
Department of Computer Science at Aristotle University of Thessaloniki.<br/> 

## Static website

The static version of this website, consists only HTML files (and CSS for 
styling). It implements the general view of what the students see, such as
announcements, documents, homework etc.

## Dynamic website

Here a LAMP stack is implemented, to be more precise Linux (Arch), Apache Server,
MariaDB and PHP. 

All the website files are written in PHP while containing HTML code. The default
page (index.php) acts as a login page. There are two types of users (Tutor,
Student) with their credentials shown bellow:


| Email | Password | Role |
| ------------- | ------------- | ------------- |
| kork@auth.gr | 123  | Tutor  |
| stergio@auth.gr | 123 | Tutor |
| tsagkar@auth.gr | 123  | Student  |
| tzoun@auth.gr | 123 | Student |

The website, uses an SQL DB which stores all the users. Additionally, the DB 
contains homeworks, announcements and documents. 