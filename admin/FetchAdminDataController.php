<?php 
/**
 * This page is used to fetch all the admin related data dynamically
 *
 * @package college-management-system
 */

//Including database connection file
include dirname(__DIR__, 1). '/config.php';

/**
 * FetchAdminDataController class is used to fetch admin related data.
 */
class FetchAdminDataController {
    private $conn;
    private $limit;
    private $page;
    private $offset;

    /**
     * Constructor to initialize the database connection and pagination parameters.
     * 
     * @param mysqli $conn - Database connection object
     * @param int $limit - Number of records per page
     * @param int $page - Current page number
     */
    public function __construct($conn, $limit = 10, $page = 1) {
        $this->conn = $conn;
        $this->setPagination($limit, $page);
    }

    /**
     * Sets pagination parameters.
     * 
     * @param int $limit - Number of records per page
     * @param int $page - Current page number
     */
    public function setPagination($limit, $page) {
        $this->limit = $limit;
        $this->page = $page;
        $this->offset = ($this->page - 1) * $this->limit;
    }

    /**
     * Fetch books with pagination.
     * 
     * @return array - List of books
     */
    public function getBooks() {
        $sql = "SELECT * FROM books LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch classes with pagination.
     * 
     * @return array - List of classes
     */
    public function getClasses() {
        $sql = "SELECT * FROM classes LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch parents with pagination.
     * 
     * @return array - List of parents
     */
    public function getParents() {
        $sql = "SELECT * FROM parents LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch student with pagination.
     * 
     * @return array - List of student
     */
    public function getStudents() {
        $sql = "SELECT * FROM students LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch teachers with pagination.
     * 
     * @return array - List of teachers
     */
    public function getTeachers() {
        $sql = "SELECT * FROM teachers LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch users with pagination.
     * 
     * @return array - List of users
     */
    public function getUsers() {
        $sql = "SELECT * FROM users LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch exam schedules with pagination.
     * 
     * @return array - List of exam schedules
     */
    public function examSchedules() {
        $sql = "SELECT * FROM exam_routine ORDER BY id DESC LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch notices with pagination.
     * 
     * @return array - List of notices
     */
    public function getNotices() {
        $sql = "SELECT * FROM notice ORDER BY id DESC LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }

    /**
     * Fetch notices with pagination.
     * 
     * @return array - List of notices
     */
    public function getTeacherPaymentLists() {
        $sql = "SELECT * FROM teachers LIMIT {$this->offset}, {$this->limit}";
        return $this->fetchData($sql);
    }


    /**
     * Executes the given query and fetches data.
     * 
     * @param string $query - SQL query string
     * @return array - Query result as an associative array
     */
    private function fetchData($query) {
        $data = [];
        $result = mysqli_query($this->conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}

// Instantiate the class and fetch datas
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$FetchAdminDataController = new FetchAdminDataController($conn, $limit, $page);

$books = $FetchAdminDataController->getBooks();
$classes = $FetchAdminDataController->getClasses();
$parents = $FetchAdminDataController->getParents();
$students = $FetchAdminDataController->getStudents();
$teachers = $FetchAdminDataController->getTeachers();
$users = $FetchAdminDataController->getUsers();
$exam_schedules = $FetchAdminDataController->examSchedules();
$notices = $FetchAdminDataController->getNotices();
$teacher_payment_lists = $FetchAdminDataController->getTeacherPaymentLists();
