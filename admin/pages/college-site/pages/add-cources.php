<?php include dirname(__DIR__, 4). '/constant.php'; ?>

<h3><i>Courses</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/course.php";?>"
    method="POST" enctype="multipart/form-data">
    <label for="card-title">Course Title: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Course Title" name="course_title" required>
    </div>
    <label for="duration">Course Duration (Year): </label>
    <div class="input-group flex-nowrap">
        <input type="number" class="form-control" id="duration" placeholder="Course Duration time" name="course_duration" required>
    </div>
    <label for="intake">Course Intake: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="intake" placeholder="Intake" name="course_intake" required>
    </div>
    <div class="form-floating py-3">
        <select id="country" name="categories" class="form-control col-12" required>
            <option value="" disabled>Select Categories</option>
            <option value="Graduate" data-code="Graduate" data-flag="🇳🇵">Graduate</option>
            <option value="Undergraduate" data-code="Undergraduate" data-flag="🇺🇸">Undergraduate</option>
            <option value="Proffessional" data-code="Proffessional" data-flag="🇨🇦">Proffessional</option>
            <!-- Add more countries as needed -->
        </select>
    </div>
    <label for="course_description">Course Description: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="10" placeholder="Leave about Course Description" id="course_description"
            name="course_description" required></textarea>
    </div>

    <label for="course_objectives">Course Objectives: </label>
    <div class="form-floating">
        <textarea class="form-control" cols="20" rows="10" placeholder="Course Objectives" id="course_objectives"
            name="course_objectives" required></textarea>
    </div>

    <label for="course_syllabus">Syllabus Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="course_syllabus" name="syllabus_image" accept="image/*" required>
    </div>
    
    <label for="inputGroupFile02">Course Image/icon: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="course_image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>
