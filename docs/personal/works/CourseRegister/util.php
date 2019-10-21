<?php
class Role extends SplEnum {
    const __default = self::Student;
    
    const Admin = 1;
    const StudentAffairs = 2;
    const FacultyMember = 3;
    const Student = 4;
}
?>