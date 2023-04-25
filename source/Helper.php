<?php
//This Class Contains the Helper Operations
class Helper{

    public function __construct()
    {
        
    }

    // Send Success Toast msg 
    public function SendSuccessToast( string $msg): void
    {
        unset($_SESSION['errmsg']);
        $_SESSION['sucmsg'] = $msg;
    }

    // Send Error Toast msg 
    public function SendErrorToast( string $msg): void
    {
        unset($_SESSION['sucmsg']);
        $_SESSION['errmsg'] = $msg;
    }

    // Redirect's the user
    public function Redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }

    public function IsAccessibleByAdmin(){

        if(!$this->IsAdminLogin()){

            $this->Redirect(BASE_URL . '404.php');

        }

    } 

    public function IsUserLogin(){

        return ($this->IsLogin() && $_SESSION['role'] == ROLE::USER);

    } 
    public function IsAdminLogin(){

        return ($this->IsLogin() && $_SESSION['role'] == ROLE::ADMIN);

    } 

    public function IsLogin(){

        return (isset($_SESSION['uid']) && !empty($_SESSION['uid']));

    } 

    // Return's Current Url
    public function getCurrentUrl(): string
    {
        $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
        $url = $base_url . $_SERVER["REQUEST_URI"];

        return $url;
    }

    // Echos Responsive Table CSS Files
    public function getResponsiveTableCss()
    {
        ?>
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=BASE_URL?>public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?=BASE_URL?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?=BASE_URL?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <?php
    }

    // Echos Responsive Table Script Files
    public function getResponsiveTableScript()
    {
        ?>
        <!-- DataTables  & Plugins -->
        <script src="<?=BASE_URL?>public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=BASE_URL?>public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?=BASE_URL?>public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=BASE_URL?>public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <?php
    }

    
    public function is_int_positive($num): bool
    {
        if(ctype_digit((string) $num)){
            return true;
        } else if (is_int($num)){
            return ($num > 0);
        } else {
            return false;
        }
    }

    

}