<?php

// Sanitize and validate the content
$allowed_pages = [
    'item0' => 'Add users',
    'item1' => 'All Student Data',
    'item2' => 'Add Student',
    'item3' => 'All Teachers Data',
    'item4' => 'Add Teachers Data',
    'item5' => 'Payment History of Teachers',
    'item6' => 'Class Routine',
    'add_subject' => 'Add Subject',
    'all_subject' => 'All Subjects',
    'item7' => 'All Parents Data',
    'item8' => 'Add New Parents',
    'item10' => 'All Books',
    'item11' => 'Add Books',
    'item12' => 'All Fee Collection',
    'item13' => 'Add New Expenses',
    'item14' => 'Notice Board',
    'item15' => 'All Classes',
    'item16' => 'Add New Classes',
    'item17' => 'Messaging',
    'item18' => 'Exam Schedule',
    'item19' => 'Examination',
    'item20' => 'Map',
    'item21' => 'Take Attendance',
    'item22' => 'View Class Attendance',
    'item23' => 'View Student Attendance',
    'download_attendance' => 'Download Attendance',
    'item24' => 'Message App',
    'allusers' => 'All Users',
    'college-website' => 'College Website',
    'add-routine' => 'Add Routine',
    'edit_user' => 'Edit User',
    'edit_student' => 'Edit Student',
    'edit_teacher' => 'Edit Teacher',
    'edit_parent' => 'Edit Parent',
    'edit_book' => 'Edit Book',
    'edit_class' => 'Edit Class',
    'edit_routine' => 'Edit Routine',
    'edit_exam_routine' => 'Edit Exam Routine',
    'checkout-khalti' => 'Khalti Checkout',
    'message' => 'Message',
    'notice' => 'Notice',
    'register_users' => 'Registered Users',
    'enquiry_users' => 'Enquiry Users'
];

// Check if 'content' is set and sanitize the input
if (isset($_GET['content'])) {
    $content = $_GET['content'];
    
    // Sanitize the content parameter to prevent XSS
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    
    // Check if the content is in the allowed pages
    if (array_key_exists($content, $allowed_pages)) {
        // Echo the heading based on the selected content
        echo "<h2>" . $allowed_pages[$content] . "</h2>";

        // Define the file path based on content
        switch ($content) {
            case 'item0':
                include("pages/add-users.php");
                break;

            case 'item1':
                include("pages/all-student.php");
                break;

            case 'item2':
                include("pages/admission-form.php");
                break;

            case 'item3':
                include("pages/all-teachers.php");
                break;

            case 'item4':
                include("pages/add-teachers.php");
                break;

            case 'item5':
                include("pages/teachers-payments.php");
                break;

            case 'item6':
                include("pages/class-routine.php");
                break;

            case 'add_subject':
                include("pages/add-subject.php");
                break;

            case 'all_subject':
                include("pages/all-subject.php");
                break;

            case 'item7':
                include("pages/all-parents.php");
                break;

            case 'item8':
                include("pages/add-parents.php");
                break;

            case 'item10':
                include("pages/all-books.php");
                break;

            case 'item11':
                include("pages/add-books.php");
                break;

            case 'item12':
                include("pages/all-fee-collection.php");
                break;

            case 'item13':
                include("pages/add-new-expenses.php");
                break;

            case 'item14':
                include("pages/notice.php");
                break;

            case 'item15':
                include("pages/all-classes.php");
                break;

            case 'item16':
                include("pages/add-new-classes.php");
                break;

            case 'item17':
                include("pages/message_app/index.php");
                break;

            case 'item18':
                include("pages/exam-schedule.php");
                break;

            case 'item19':
                include("pages/examination.php");
                break;

            case 'item20':
                include("pages/map.php");
                break;

            case 'item21':
                include("pages/attendance/takeAttendance.php");
                break;

            case 'item22':
                include("pages/attendance/viewAttendance.php");
                break;

            case 'item23':
                include("pages/attendance/viewStudentAttendance.php");
                break;

            case 'download_attendance':
                include("pages/attendance/download_attendance.php");
                break;

            case 'item24':
                include("pages/message_app/index.php");
                break;

            case 'allusers':
                include("pages/allusers.php");
                break;

            case 'college-website':
                include("pages/college-site/index.php");
                break;

            case 'add-routine':
                include("pages/add-routine.php");
                break;

            case 'edit_user':
                include("actions/edit_user.php");
                break;

            case 'edit_student':
                include("actions/edit_student.php");
                break;

            case 'edit_teacher':
                include("actions/edit_teacher.php");
                break;

            case 'edit_parent':
                include("actions/edit_parent.php");
                break;

            case 'edit_book':
                include("actions/edit_book.php");
                break;

            case 'edit_class':
                include("actions/edit_class.php");
                break;

            case 'edit_routine':
                include("actions/routine-edit.php");
                break;

            case 'edit_exam_routine':
                include("actions/edit-exam-routin.php");
                break;

            case 'checkout-khalti':
                include("khalti/checkout.php");
                break;

            case 'message':
                include("actions/message.php");
                break;

            case 'notice':
                include("actions/notice-content.php");
                break;

            case 'register_users':
                include("actions/registered_users.php");
                break;

            case 'enquiry_users':
                include("actions/enquiry_users.php");
                break;

            default:
                echo "<h2>Invalid Content</h2>";
                echo "<p>Sorry, the page you are looking for doesn't exist.</p>";
                break;
        }
    } else {
        echo '<h2>Invalid content</h2>';
        echo '<p>The requested content is not available or does not exist.</p>';
    }
} else {
    // If no content is provided, display a default message
    echo '<h2>Welcome to the Site</h2>';
    echo '<p>Please select an item from the sidebar to view its content.</p>';
}
