//handle collapse the side menu of admin panel
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});


// Handle user profile popup
function handleUserPopup() {
    const userName = document.querySelector('.user-name');
    const userPopup = document.querySelector('.user-popup');

    // Toggle popup on clicking the user name
    userName.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent click event from bubbling up
        userPopup.classList.toggle('show-user-popup');
    });

    // Hide popup on clicking outside
    document.addEventListener('click', function (event) {
        if (userPopup.classList.contains('show-user-popup') &&
            !userPopup.contains(event.target) && !userName.contains(event.target)) {
            userPopup.classList.remove('show-user-popup');
        }
    });
}

function handleMessage() {
    const messageSection = document.querySelector('.message-section');
    const messagePopup = document.querySelector('.message-popup');
    // Toggle popup on clicking the message section
    messageSection.addEventListener('click', function (event) {
        messagePopup.classList.toggle('show-message-popup');
        event.stopPropagation(); // Prevent event from bubbling up to document
    });

    // Hide popup on clicking outside
    document.addEventListener('click', function (event) {
        if (!messagePopup.contains(event.target) && !messageSection.contains(event.target)) {
            messagePopup.classList.remove('show-message-popup');
        }
    });
}

//handle notification list view
function handleNotification() {
    const notificationSection = document.querySelector('.notification-section');
    const notificationPopup = document.querySelector('.notification-popup');

    // Toggle popup on clicking the notification section
    notificationSection.addEventListener('click', function (event) {
        notificationPopup.classList.toggle('show-notification-popup');
        event.stopPropagation(); // Prevent event from bubbling up to document
    });

    // Hide popup on clicking outside
    document.addEventListener('click', function (event) {
        if (!notificationPopup.contains(event.target) && !notificationSection.contains(event.target)) {
            notificationPopup.classList.remove('show-notification-popup');
        }
    });
}


//handle search from table query
const searchByName = () => {
    const filterData = document.querySelector('.searchName').value.toUpperCase();

    const table = document.getElementById('smsTable');

    const tr = table.getElementsByTagName('tr');

    for (var i = 0; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td')[1];

        if (td) {
            const textValue = td.textContent || td.innerHTML;

            if (textValue.toUpperCase().indexOf(filterData) > -1) {
                tr[1].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}

//hanlde add new routine for class routine
// function handleAddNewRoutine() {
//     const routineBtn = document.querySelector('.add-routine');
//     const routineSection = document.querySelector('.main-routine');

//     if (routineBtn && routineSection) {
//         routineBtn.addEventListener('click', function () {
//             routineSection.style.display = 'flex';
//             document.body.classList.add('no-scroll');
//             console.log('hello');
//         });

//         const routineCloseBtn = document.querySelector('.routine_close');
//         if (routineCloseBtn) {
//             routineCloseBtn.addEventListener('click', function () {
//                 routineSection.style.display = 'none';
//                 document.body.classList.remove('no-scroll');
//                 console.log('hello');
//             });
//         }
//     }
// }

// Call the function when the DOM is ready
// document.addEventListener('DOMContentLoaded', handleAddNewRoutine);

//handle adding new routine for exam
document.addEventListener('DOMContentLoaded', function () {
    const addNewExamRoutineBtn = document.querySelector('.add-exam-routine');
    const examRoutineArea = document.querySelector('.exam-routine');

    if (addNewExamRoutineBtn && examRoutineArea) {
        addNewExamRoutineBtn.addEventListener('click', function () {
            examRoutineArea.style.display = 'block';
            document.body.classList.add('no-scroll');
        });

        const closeExamRoutineBtn = document.querySelector('.exam-routine-close');
        if (closeExamRoutineBtn) {
            closeExamRoutineBtn.addEventListener('click', function () {
                examRoutineArea.style.display = 'none';
                document.body.classList.remove('no-scroll');
            });
        }
    }
});






//handle for website manage section
document.addEventListener('DOMContentLoaded', function () {
    var menuLinks = document.querySelectorAll('#menu a');

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var page = this.getAttribute('href');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', page, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('content-container').innerHTML = xhr.responseText;
                } else {
                    alert('Error loading content.');
                }
            };
            xhr.send();
        });
    });
});

// Handle click to toggle actions
let currentActionsDiv = null;

function handleClick(event, element) {
    event.stopPropagation();

    const parentId = element.getAttribute('parent-id');
    const actionId = element.querySelector('.actions').getAttribute('action_id');
    const actionsDiv = element.querySelector('.actions');

    if (parentId === actionId) {
        if (currentActionsDiv && currentActionsDiv !== actionsDiv) {
            currentActionsDiv.style.display = 'none';
        }

        actionsDiv.style.display = actionsDiv.style.display === 'block' ? 'none' : 'block';
        currentActionsDiv = actionsDiv.style.display === 'block' ? actionsDiv : null;
    }
}

/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------- HANDLE VIEW OPERATON ---------------------------------------------------
--------------------------------------------------------------------------------------------------------------------*/

/**************************
 ******** USER ***********
 ************************/
function showUserDetails(user) {
    document.getElementById('modalName').value = user.username;
    document.getElementById('modalEmail').value = user.email;
    document.getElementById('modalRole').value = user.role;
    document.getElementById('viewModal').style.display = 'flex';
}

/**************************
 ******** BOOK ***********
 ************************/
function showBooksDetails(book) {
    document.getElementById('bName').value = book.bname;
    document.getElementById('wName').value = book.wname;
    document.getElementById('class').value = book.class;
    document.getElementById('pDate').value = book.pubdate;
    document.getElementById('uDate').value = book.uploade;
    document.getElementById('viewModal').style.display = 'flex';
}



/**************************
 ******** PARENT ***********
 ************************/
function showParentDetails(parent) {
    document.getElementById('name').value = parent.name;
    document.getElementById('gender').value = parent.gender;
    document.getElementById('occupation').value = parent.occupation;
    document.getElementById('email').value = parent.email;
    document.getElementById('address').value = parent.address;
    document.getElementById('childrens_name').value = parent.childrens_name;
    document.getElementById('phone').value = parent.phone;
    document.getElementById('viewModal').style.display = 'flex';
}

/**************************
 ******** STUDENT *********
 ************************/
function showStudentDetails(student) {
    document.getElementById('fname').value = student.fname;
    document.getElementById('gender').value = student.gender;
    document.getElementById('lname').value = student.lname;
    document.getElementById('email').value = student.email;
    document.getElementById('dob').value = student.dob;
    document.getElementById('section').value = student.section;
    document.getElementById('phone').value = student.phone;
    document.getElementById('shortbio').value = student.shortbio;
    document.getElementById('religion').value = student.religion;
    document.getElementById('class').value = student.class;
    document.getElementById('blood').value = student.blood;
    document.getElementById('roll').value = student.admissionid;
    document.getElementById('viewModal').style.display = 'flex';
}

/**************************
 ******** TEACHER ********
 ************************/
function showTeacherDetails(teacher) {
    document.getElementById('fname').value = teacher.fname;
    document.getElementById('gender').value = teacher.gender;
    document.getElementById('lname').value = teacher.lname;
    document.getElementById('email').value = teacher.email;
    document.getElementById('Phone').value = teacher.Phone;
    document.getElementById('shortbio').value = teacher.shortbio;
    document.getElementById('religion').value = teacher.religions;
    document.getElementById('address').value = teacher.address;
    document.getElementById('viewModal').style.display = 'flex';
}


// Close the view modal
function closeModal() {
    document.getElementById('viewModal').style.display = 'none';
}

// Close view actions div when clicking outside
document.addEventListener('click', function (event) {
    if (currentActionsDiv) {
        if (!currentActionsDiv.contains(event.target) && !event.target.closest('.parent_actions')) {
            currentActionsDiv.style.display = 'none';
            currentActionsDiv = null;
        }
    }
});

/*-------------------------------------------------------------------------------------------------------------------
----------------------------------------------- END VIEW OPERATON ---------------------------------------------------
--------------------------------------------------------------------------------------------------------------------*/


/*-------------------------------------------------------------------------------------------------------------------
-----------------------------------------------HANDLE DELETE OPERATION ---------------------------------------------
--------------------------------------------------------------------------------------------------------------------*/
let deleteId = null;
let deleteCategory = "";

// Show the confirmation modal and set the category
function confirmDelete(id, category) {
    deleteId = id;
    deleteCategory = category;
    document.getElementById("confirmModal").style.display = "flex";
}

// Event listener for "No" button
document.getElementById("confirmNo").addEventListener("click", function () {
    document.getElementById("confirmModal").style.display = "none";
    deleteId = null;
    deleteCategory = "";
});

// Event listener for "Yes" button
document.getElementById("confirmYes").addEventListener("click", function () {
    if (deleteId !== null && deleteCategory !== "") {
        deleteRecord(deleteId, deleteCategory);
        document.getElementById("confirmModal").style.display = "none";
    }
});

// AJAX function to delete record based on category
function deleteRecord(id, category) {
    let deleteUrl = "";

    // Determine URL based on category
    switch (category) {
        case "teacher":
            deleteUrl = "actions/delete_teacher.php";
            break;
        case "class":
            deleteUrl = "actions/delete_classes.php";
            break;
        case "student":
            deleteUrl = "actions/delete_student.php";
            break;
        case "user":
            deleteUrl = "actions/delete_user.php";
            break;
        case "parent":
            deleteUrl = "actions/delete_parent.php";
            break;
        case "book":
            deleteUrl = "actions/delete_book.php";
            break;

        case "routine":
            deleteUrl = "actions/delete_routine.php";
            break;

        case "examRoutine":
            deleteUrl = "actions/delete_exam_routine.php";
            break;
        
        case "delete_service":
            deleteUrl = "actions/delete_service.php";
            break;

        default:
            console.error("Invalid category specified for deletion.");
            return;
    }

    // AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open("POST", deleteUrl, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                showNotification("Deleted successfully!");
            } else {
                showNotification("Failed to delete data.", "error");
            }
        }
    };
    xhr.send("id=" + id);
}

// Function to show custom notification and reload page after 2 seconds
function showNotification(message, type = "success") {
    const notificationBox = document.getElementById("notificationBox");
    notificationBox.innerText = message;
    notificationBox.style.backgroundColor = type === "success" ? "#D4EDDA" : "#dc3545";
    notificationBox.style.padding = "20px";
    notificationBox.style.marginBottom = "10px";
    notificationBox.style.display = "block";

    // Hide the notification and reload the page after 2 seconds
    setTimeout(() => {
        notificationBox.style.display = "none";
        if (type === "success") {
            location.reload();
        }
    }, 2000);
}

/*-------------------------------------------------------------------------------------------------------------------
-----------------------------------------------END DELETE OPERATION ---------------------------------------------
--------------------------------------------------------------------------------------------------------------------*/




window.addEventListener('load', function () {
    handleNotification();
});

