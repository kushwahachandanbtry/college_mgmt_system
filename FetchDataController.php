<?php
/**
 * This page is used to fetch all the website data dynamically
 *
 * @package college-management-system
 */

// Include the database configuration
include 'config.php';

/**
 * FetchDataController class used to fetch data. 
 */
class FetchDataController
{
    private $conn;

    /**
     * Constructor to initialize the database connection.
     *
     * @param mysqli $conn - Database connection object
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Fetch courses from the database
     *
     * @return array - Array of course data
     */
    public function getCourses()
    {
        return $this->FetchDataController("SELECT * FROM courses");
    }

    /**
     * Fetch testimonials from the database
     *
     * @return array - Array of testimonials data
     */
    public function getTestimonials()
    {
        return $this->FetchDataController("SELECT * FROM what_people_say");
    }

    /**
     * Fetch features from the database
     *
     * @return array - Array of features data
     */
    public function getFeatures()
    {
        return $this->FetchDataController("SELECT * FROM features");
    }

    /**
     * Fetch FAQs from the database
     *
     * @return array - Array of FAQs data
     */
    public function getFAQs()
    {
        return $this->FetchDataController("SELECT * FROM faq");
    }

    /**
     * Fetch gallery form databse
     * 
     * @return array -Array of gallery data
     */
    public function getGallery() {
        return $this->FetchDataController("SELECT * FROM gallery");
    }

    /**
     * Fetch staff from database
     * 
     * @return array - Array of staffs data
     */
    public function getStaff() {
        return $this->FetchDataController("SELECT * FROM staff");
    }

    /**
     * Fetch services from database
     * 
     * @return array - Array of services data
     */
    public function getService() {
        return $this->FetchDataController("SELECT * FROM services");
    }

    /**
     * Fetch notice from database
     * 
     * @return array - Array of notice data
     */
    public function getNotice(){
        return $this->FetchDataController('SELECT * FROM notice ORDER BY id DESC limit 3');
    }

    /**
     * Fetch class routine from database
     * 
     * @return array - Array of class routine data
     */
    public function getClassRoutine(){
        return $this->FetchDataController('SELECT * FROM routines');
    }

    /**
     * Fetch exam schedule from database
     * 
     * @return array - Array of exam schedule data
     */
    public function getExamSchedule(){
        return $this->FetchDataController('SELECT * FROM exam_routine');
    }

    /**
     * Fetch video and contents from database
     * 
     * @return array - Array of video and contents data
     */
    public function getVideoandContents(){
        return $this->FetchDataController('SELECT * FROM video_and_content');
    }

    /**
     * Fetch the college logo
     *
     * @return string|null - The logo image or null if not found
     */
    public function getLogo()
    {
        $query = "SELECT * FROM home_logo ORDER BY id DESC LIMIT 1";
        $result = $this->fetchSingleRow($query);
        return $result['image'] ?? null;
    }

    /**
     * Fetch the college name
     *
     * @return string|null - The college name or null if not found
     */
    public function getCollegeName()
    {
        $query = "SELECT college_name FROM college_info ORDER BY id DESC LIMIT 1";
        $result = $this->fetchSingleRow($query);
        return $result['college_name'] ?? null;
    }

    /**
     * Fetch the college address
     *
     * @return string|null - The college address or null if not found
     */
    public function getCollegeAddress()
    {
        $query = "SELECT college_address FROM college_info ORDER BY id DESC LIMIT 1";
        $result = $this->fetchSingleRow($query);
        return $result['college_address'] ?? null;
    }

    /**
     * Fetch the college phone
     *
     * @return string|null - The college phone or null if not found
     */
    public function getCollegePhone()
    {
        $query = "SELECT college_phone FROM college_info ORDER BY id DESC LIMIT 1";
        $result = $this->fetchSingleRow($query);
        return $result['college_phone'] ?? null;
    }

    /**
     * Fetch the college email
     *
     * @return string|null - The college email or null if not found
     */
    public function getCollegeEmail()
    {
        $query = "SELECT college_email FROM college_info ORDER BY id DESC LIMIT 1";
        $result = $this->fetchSingleRow($query);
        return $result['college_email'] ?? null;
    }

    /**
     * Fetch website status
     * 
     * @return string|null
     */
    public function getStatus() {
        $query = "SELECT status FROM status_table WHERE id = 1";
        $result = $this->fetchSingleRow($query);
        return $result['status'] ?? null;
    }

    /**
     * Generic method to fetch a single row of data
     *
     * @param string $query - SQL query
     * @return array|null - The fetched row or null if no data found
     */
    private function fetchSingleRow($query)
    {
        $result = mysqli_query($this->conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    /**
     * Generic method to fetch multiple rows of data
     *
     * @param string $query - SQL query
     * @return array - Array of fetched data
     */
    private function FetchDataController($query)
    {
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

// Instantiate the class and fetch data
$FetchDataController = new FetchDataController($conn);

// Fetch specific information
$logo = $FetchDataController->getLogo();
$collegeName = $FetchDataController->getCollegeName();
$collegeAddress = $FetchDataController->getCollegeAddress();
$collegePhone = $FetchDataController->getCollegePhone();
$collegeEmail = $FetchDataController->getCollegeEmail();
$collegeStatus = $FetchDataController->getStatus();


//Fetch bulks data
$courses = $FetchDataController->getCourses();
$testimonials = $FetchDataController->getTestimonials();
$features = $FetchDataController->getFeatures();
$faqs = $FetchDataController->getFAQs();
$gallerys = $FetchDataController->getGallery();
$staffs = $FetchDataController->getStaff();
$services = $FetchDataController->getService();
$notices = $FetchDataController->getNotice();
$exam_schedules = $FetchDataController->getExamSchedule();
$class_routines = $FetchDataController->getClassRoutine();
$videos_and_contents = $FetchDataController->getVideoandContents();
