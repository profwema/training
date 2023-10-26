<?php

    require ("config.php");
class DBConnect
{

    private $db = NULL;

    const DB_SERVER = DBHOST;
    const DB_USER = DBUSER;
    const DB_PASSWORD = DBPASS;
    const DB_NAME = DBNAME;

    public function __construct() // connection
    {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_SERVER;
        try {
            $this->db = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
            $this->db->exec("set names utf8mb4");
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' .
                $e->getMessage());
        }
        //return $this->db;
    }

    public function legal_input($value)  // filter inpots
    {
        if (isset($value) && $value != '') {
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
        } else
            $value = NULL;
        return $value;
    }

    public function query($string, $data = [])    // execute query and return array or true or false
    {
        //echo $string;
        // $this->showArr($data);
        $stmt = $this->db->prepare($string);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result;
            }
            return $check;
        }
        /*         $arr = $stmt->errorInfo();
        $this->showArr($arr); */
        return false;
    }

    public function insert($table, $data)      // insert data into table 
    {
        $keys       = array_keys($data);
        $query      = "INSERT INTO $table (" . implode(' , ', $keys) . ") VALUES (:" . implode(' , :', $keys) . ")";
        return $this->query($query, $data);
    }

    public function delete($table, $cond)      // delete data from table 
    {
        $key      = array_keys($cond);
        $query    = "DELETE FROM $table WHERE $key[0] =:$key[0]";
        $result = $this->query($query, $cond);
        return $result;
    }
    public function update($table, $data, $cond)      // update data at table 
    {

        $query      = "UPDATE $table SET ";
        $keys       = array_keys($data);
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " , ";
        }
        $query = trim($query, ' , ');

        $condkey     = array_keys($cond);
        $query    .= " WHERE $condkey[0] = :$condkey[0]";
        $data[$condkey[0]] = $cond[$condkey[0]];

        return $this->query($query, $data);
    }





    public function select($table, $data = [], $data_not = [])  // select data  return array of data 
    {

        $query      = "SELECT * FROM $table";
        if (count($data) || count($data_not)) {
            $query  .= " WHERE ";
            $keys       = array_keys($data);
            $keys_not   = array_keys($data_not);
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
            foreach ($keys_not as $key) {
                $query .= $key . " != :" . $key . " AND ";
            }
            $query = trim($query, ' AND ');
        }
        //echo $query;
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        return $result;
    }

    public function customSelect($culomns, $tables,  $Conditions, $data = [])  // select data  return array of 
    {

        $query      = "SELECT $culomns FROM $tables WHERE $Conditions";
        $result = $this->query($query, $data);
        return $result;
    }

    public function isExist($table, $data = [])    //check if data is excist rturn true or false 
    {
        $result = $this->select($table, $data);
        //print_r($result);
        return (is_array($result)) ? true : False;
    }



    public function getCenters($data = [])
    {
        return $this->select('centers', $data);
    }
    public function getCenterName($data = [])
    {
        $result = $this->getCenters($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
        return 'المشرف العام';
    }
    public function getCenterUsers($data = [])
    {
        $data_not['Center_fk'] = '';
        $result =  $this->select('usersystem', $data, $data_not);
        return $result;
    }



    public function getCategories($data = [])
    {

        $result =  $this->select('categories', $data);
        return $result;
    }

    public function getCategoryName($data = [])
    {
        $result = $this->getCategories($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }



    public function getCourses($data = [])
    {
        //$this->showArr($data);
        $result =  $this->select('courses', $data);
        return $result;
    }
    public function getCourseName($data = [])
    {
        $result = $this->getCourses($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }
    public function getCourseShortName($data = [])
    {
        $result = $this->getCourses($data);
        if (is_array($result)) {
            return $result[0]['shortName'];
        }
    }
    public function getSubjects($data = [])
    {
        $result =  $this->select('course_subjects', $data);
        return $result;
    }

    public function getFaculties($data = [])
    {
        $result =  $this->select('faculties', $data);
        return $result;
    }

    public function getTrainFlds($data = [])
    {
        $result =  $this->select('sntf_fields', $data);
        return $result;
    }

    public function getTrainFldName($data = [])
    {
        $result = $this->getTrainFlds($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }

    public function getDegrees($data = [])
    {
        $result =  $this->select('sntf_degrees', $data);
        return $result;
    }

    public function getDegreeName($data = [])
    {
        $result = $this->getDegrees($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }


    public function getCoursesReg($data = [])
    {
        $result =  $this->select('users_registed', $data);
        return $result;
    }

    public function getInstractors($data = [])
    {
        $result =  $this->select('instractors', $data);
        return $result;
    }

    public function getInstractorName($data = [])
    {
        $result = $this->getInstractors($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }

    public function getGroups($data = [])
    {
        $result =  $this->select('groups', $data);
        return $result;
    }
    public function getGroupName($data = [])
    {
        $result = $this->getGroups($data);
        if (is_array($result)) {
            return $result[0]['name'];
        }
    }



    public function getRegGroups($courseId)
    {
        $currentDate = date('Y-m-d');

        $Conditions = 'course_id=:course_id AND Start_date > :Start_date ORDER BY Start_date DESC';
        $data['course_id'] = $courseId;
        $data['Start_date'] = $currentDate;
        $result =  $this->customSelect('*', 'groups',  $Conditions, $data);

        //>select('groups', $data);
        return $result;
    }

    public function getUsers($data = [])
    {
        $result =  $this->select('users', $data);
        return $result;
    }



    public function delCenter($cond = [])
    {
        $result = $this->delete('centers', $cond);
        if ($result) {
            header("Location: centers.php");
            exit(0);
        }
    }
    public function delUserCenter($cond = [])
    {
        $result = $this->delete('usersystem', $cond);
        if ($result) {
            header("Location: centerAdmins.php");
            exit(0);
        }
    }

    public function delCategory($cond = [])
    {
        $result = $this->delete('categories', $cond);
        if ($result) {
            header("Location: categories.php");
            exit(0);
        }
    }

    public function delCourse($cond = [])
    {
        $result = $this->delete('courses', $cond);
        if ($result) {
            header("Location: courses.php");
            exit(0);
        }
    }

    public function delSubject($p, $cond = [])
    {
        $result = $this->delete('course_subjects', $cond);
        if ($result) {
            @header('Location:' . $p);
            exit(0);
        }
    }

    public function delTrField($cond = [])
    {
        $result = $this->delete('sntf_fields', $cond);
        if ($result) {
            header("Location: trainingFields.php");
            exit(0);
        }
    }
    public function delInstractor($cond = [])
    {
        $result = $this->delete('instractors', $cond);
        if ($result) {
            header("Location: instractors.php");
            exit(0);
        }
    }

    public function delGroup($cond = [])
    {
        $result = $this->delete('groups', $cond);
        if ($result) {
            header("Location: groups.php");
            exit(0);
        }
    }

    public function delCourseReg($cond = [])
    {
        $result = $this->delete('users_registed', $cond);
        if ($result) {
            header("Location: dashboard.php");
            exit(0);
        }
    }



    public function addUserCenter($data = [])
    {
        $Array = [];
        $insert = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        $user['username'] = $data['username'];
        $user['Center_fk'] = $data['Center_fk'];
        if ($this->isExist('usersystem', $user)) {
            $insert['status'] = false;
            $insert['msg'] = "نأسف ولكن يوجد مشرف لهذا المركز بنفس اسم المستخدم من قبل";
            return $insert;
        } elseif ($this->insert('usersystem', $data)) {
            $insert['status'] = true;
            $insert['msg'] = "تم انشاء حساب المشرف بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }

    public function addIntractor($data = [])
    {
        $Array = [];
        $insert = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        $user['email'] = $data['email'];
        if ($this->isExist('instractors', $user)) {
            $insert['status'] = false;
            $insert['msg'] = "نأسف ولكن يوجد مدرب مسجل بنفس البريد الألكتروني من قبل";
            return $insert;
        } elseif ($this->insert('instractors', $data)) {
            $insert['status'] = true;
            $insert['msg'] = "تم انشاء حساب المدرب بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }





    public function addCategory($data = [])
    {

        $Array = [];
        $insert = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        $Array['Center_fk'] = $_SESSION['Center'];
        if ($this->insert('categories', $Array)) {
            $insert['status'] = true;
            $insert['msg'] = "تم انشاء الفئة بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }

    public function addCourse($data = [])
    {
        $Array = [];
        $insert = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        $Array['Center_fk'] = $_SESSION['Center'];
        if ($this->insert('courses', $Array)) {
            $insert['status'] = true;
            $insert['msg'] = "تم انشاء الدورة بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }

    public function addSubject($data = [])
    {
        $Array = [];
        $insert = [];
        $this->showArr($data);

        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        if ($this->insert('course_subjects', $Array)) {
            $insert['status'] = true;
            $insert['msg'] = "تم اضافة الموضوع بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }


    public function addGroup($data = [])
    {
        $Array = [];
        $insert = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        $Array['Center_fk'] = $_SESSION['Center'];
        if ($this->insert('groups', $Array)) {
            $insert['status'] = true;
            $insert['msg'] = "تم انشاء المجموعة الدراسية بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }

    public function addTrField($data = [])
    {
        $Array = [];
        $insert = [];
        $this->showArr($data);

        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }
        if ($this->insert('sntf_fields', $Array)) {
            $insert['status'] = true;
            $insert['msg'] = "تم اضافة مجال التدريب بنجاح";
            return $insert;
        } else {
            $insert['status'] = false;
            $insert['msg'] = "نأسف حدت مشكله فى عمليه الاضافة ";
            return $insert;
        }
    }



    public function editUserCenter($data = [], $cond = [])
    {
        $Array = [];
        $edit = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }

        if ($this->update('usersystem', $Array, $cond)) {
            $edit['status'] = true;
            $edit['msg'] = "تم تعديل حساب المشرف بنجاح";
            return $edit;
        } else {
            $edit['status'] = false;
            $edit['msg'] = "نأسف حدت مشكله فى عمليه التعديل ";
            return $edit;
        }
    }
    public function editCategories($data = [], $cond = [])
    {
        $Array = [];
        $edit = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }

        if ($this->update('categories', $Array, $cond)) {
            $edit['status'] = true;
            $edit['msg'] = "تم تعديل الفئه بنجاح";
            return $edit;
        } else {
            $edit['status'] = false;
            $edit['msg'] = "نأسف حدت مشكله فى عمليه التعديل ";
            return $edit;
        }
    }

    public function editCourses($data = [], $cond = [])
    {
        $Array = [];
        $edit = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }

        if ($this->update('courses', $Array, $cond)) {
            $edit['status'] = true;
            $edit['msg'] = "تم تعديل الدورة بنجاح";
            return $edit;
        } else {
            $edit['status'] = false;
            $edit['msg'] = "نأسف حدت مشكله فى عمليه التعديل ";
            return $edit;
        }
    }

    public function editGroups($data = [], $cond = [])
    {
        $Array = [];
        $edit = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }

        if ($this->update('groups', $Array, $cond)) {
            $edit['status'] = true;
            $edit['msg'] = "تم تعديل المجموعة الدراسية بنجاح";
            return $edit;
        } else {
            $edit['status'] = false;
            $edit['msg'] = "نأسف حدت مشكله فى عمليه التعديل ";
            return $edit;
        }
    }
    public function editInstractor($data = [], $cond = [])
    {
        $Array = [];
        $edit = [];
        foreach ($data as $key => $value) {
            $Array[$key] = $this->legal_input($value);
        }

        if ($this->update('instractors', $Array, $cond)) {
            $edit['status'] = true;
            $edit['msg'] = "تم تعديل المدرب بنجاح";
            return $edit;
        } else {
            $edit['status'] = false;
            $edit['msg'] = "نأسف حدت مشكله فى عمليه التعديل ";
            return $edit;
        }
    }
    public function editCourseReg($data = [], $cond = [])
    {
        $result = $this->update('users_registed', $data, $cond);
        if ($result) {
            header("Location: dashboard.php");
            exit(0);
        }
    }

    public function payCourseReg($cond = [])
    {
        $pay['pay'] = 1;
        $result = $this->update('users_registed', $pay, $cond);
        if ($result) {
            header("Location: dashboard.php");
            exit(0);
        }
    }

    public function success($msg, $sesion, $p)
    {
        $_SESSION[$sesion] = '<div class="errorHandler alert alert-success">		
        <i class="icon fa fa-ban" aria-hidden="true"></i>' . $msg . '</div>';
        @header('Location:' . $p);
        exit;
    }
    public function wrong($msg, $sesion, $p)
    {
        $_SESSION[$sesion] = '<div class="errorHandler alert alert-danger">		
        <i class="icon fa fa-ban" aria-hidden="true"></i>' . $msg . '</div>';
        @header('Location:' . $p);
        exit;
    }

    public function login($table, $data = [])    //check if data is excist rturn true or false 
    {
        return $this->select($table, $data);
    }
    

    public function goAhed($arr = [])
    {
        $_SESSION['user']   = $arr['id'];
        $_SESSION['ar_name']   = $arr['ar_name'];
        if (isset($_SESSION['comeFrom'])) {
            header("Location: " . $_SESSION['comeFrom']);
            exit(0);
        }

        header("Location: dashboard.php");
        exit(0);
    }

    public function goInsideAdmin($arr = [])
    {
        print_r($arr);
        $_SESSION['logged-in'] = $arr['username'];
        if ($arr['Center_fk'] != 0)
            $_SESSION['Center'] = $arr['Center_fk'];
        @header('Location: index.php');
        exit;
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit(0);
    }




    function image_validation($data)
    {
        $this->showArr($data);
        $image_name = $data['image']['name'];
        $image_size = $data['image']['size'];
        $image_temp = $data['image']['tmp_name'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $file_type = $finfo->file($image_temp);
        $allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed_image_types)) {
            return "لم تقل باضافة ملف صورة صحيح";
        }

        $upload_max_size = 2 * 1024 * 1024; // 2MB
        if ($image_size > $upload_max_size) {
            return "يجب ان لا يزيد حجم الصورة عن 2 ميجا";
        }

        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = $data['name'] . "." . $extension;
        $move_file = move_uploaded_file($image_temp, "uploads/" . $image_name);
        if ($move_file == false) {
            return "File not saved. Please try again";
        }
        return "success";
    }


    public function showArr($arr)
    {

        echo '<p> <h1>============</h1></p><pre>';
        print_r($arr);
        echo '</pre>';
    }





    /* 
        public function auth()
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: http://localhost/BDManagement");
        }
    }
    public function authLogin()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            header("Location: http://localhost/BDManagement/home.php");
        }
    }

    public function checkAuth()
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            return false;
        } else {
            return true;
        }
    }
    public function addDonor($fname,$mname,$lname,$sex,$bType,$dob,$hAddress,$city,$donationDate,$stats,$temp,
            $pulse,$bp,$weight,$hemoglobin,$hbsag,$aids,$malariaSmear,$hematocrit,$mobile,$phone){
        $stmt = $this->db->prepare("INSERT INTO donors (fname,mname,lname,sex,b_type,bday,h_address,city,don_date,stats,temp,pulse,bp,weight,"
                . "hemoglobin,hbsag,aids,malaria_smear,hematocrit,mobile,phone)"
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$fname,$mname,$lname,$sex,$bType,$dob,$hAddress,$city,$donationDate,$stats,$temp,$pulse,$bp,$weight,
            $hemoglobin,$hbsag,$aids,$malariaSmear,$hematocrit,$mobile,$phone]);
        return true;
        
    }
    
    public function searchDonorWithBloodGroup($bloodGroup){
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE b_type LIKE ?");
        $stmt->execute([$bloodGroup]);
        return $stmt->fetchAll();
    }
    
    public function searchDonorByCity($city){
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE city LIKE ?");
        $stmt->execute(["%".$city."%"]);
        return $stmt->fetchAll();
    } */



    /*     public function getDonorProfileById($id){
        $stmt = $this->db->prepare("SELECT * FROM donors WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
     */
}