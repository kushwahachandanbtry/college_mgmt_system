<?php

if( isset( $_GET['content'] ) ) {
    $content =  $_GET['content'] ;

switch ($content) {
    case 'item0':
        echo '<h2>Add users</h2>';
        include("pages/add-users.php");
        break;

    case 'item1':
        echo '<h2>All Student Data</h2>';
        include("pages/all-student.php");
        break;

    case 'item2':
        echo '<h2>Add Student</h2>';
        include("pages/admission-form.php");
        break;

    case 'item3':
        echo '<h2>All Teachers Data</h2>';
        include("pages/all-teachers.php");
        break;

    case 'item4':
        echo '<h2>Add Teachers Data</h2>';
        include("pages/add-teachers.php");
        break;

    case 'item5':
        echo '<h2>Payment History of Teachers</h2>';
        include("pages/teachers-payments.php");
        break;

    case 'item6':
        echo '<h2>Class Routine</h2>';
        include("pages/class-routine.php");
        break;

    case 'item7':
        echo '<h2>All Parents Data</h2>';
        include("pages/all-parents.php");
        break;

    case 'item8':
        echo '<h2>Add New Parents</h2>';
        include("pages/add-parents.php");
        break;

    case 'item10':
        echo '<h2>All Books</h2>';
        include("pages/all-books.php");
        break;

    case 'item11':
        echo '<h2>Add Books</h2>';
        include("pages/add-books.php");
        break;

    case 'item12':
        echo '<h2>All Fee Collection</h2>';
        include("pages/all-fee-collection.php");
        break;

    case 'item13':
        echo '<h2>Add New Expenses</h2>';
        include("pages/add-new-expenses.php");
        break;

    case 'item14':
        echo '<h2>Notice Board</h2>';
        include("pages/notice.php");
        break;

    case 'item15':
        echo '<h2>All Classes</h2>';
        include("pages/all-classes.php");
        break;

    case 'item16':
        echo "<h2>Add New Classes</h2>";
        include("pages/add-new-classes.php");
        break;

    case 'item17':
        echo '<h2>Messaging</h2>';
        include("pages/message_app/index.php");
        break;

    case 'item18':
        echo '<h2>Exam Schedule</h2>';
        include("pages/exam-schedule.php");
        break;

    case 'item19':
        echo '<h2>Examination</h2>';
        include("pages/examination.php");
        break;

    case 'item20':
        include("pages/map.php");
        break;

    case 'item21':
        echo "<h2>Take Attendance (Today's Date: " . date("Y-M-D") . ") </h2>";
        include("pages/attendance/takeAttendance.php");
        break;

    case 'item22':
        echo '<h2>View Class Attendance</h2>';
        include("pages/attendance/viewAttendance.php");
        break;

    case 'item23':
        echo '<h2>View Student Attendance</h2>';
        include("pages/attendance/viewStudentAttendance.php");
        break;

    case 'item24':
        include("pages/message_app/index.php");
        break;

    case 'allusers':
        echo '<h2>All Users</h2>';
        include("pages/allusers.php");
        break;

    case 'college-website':
        echo "<h2>".$collegeName."</h2>";
        include("pages/college-site/index.php");
        break;

    case 'add-routine':
        include("pages/add-routine.php");
        break;


    // Handle edit section
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
        
    // Handle payment section
    case 'checkout-khalti':
        include ("khalti/checkout.php");
        break;

    //handle messaging
    case 'message':
        include("actions/message.php");
        break;

    //handle notice
    case 'notice':
        echo '<h2>Notice</h2>';
        include("actions/notice-content.php");
        break;


    //handle website data
    case 'register_users':
        echo '<h2>Registerd Users</h2>';
        include("actions/registered_users.php");
        break;

    case 'enquiry_users':
        echo '<h2>Registerd Users</h2>';
        include("actions/enquiry_users.php");
        break;

    default:
        echo '<h2>Welcome to the Site</h2>';
        echo '<p>Please select an item from the sidebar to view its content.</p>';
        break;
}
}


?>
