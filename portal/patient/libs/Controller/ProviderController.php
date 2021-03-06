<?php




/** import supporting libraries */
require_once("AppBaseController.php");


class ProviderController extends AppBaseController
{
    /**
     * Override here for any controller-specific functionality
     */
    protected function Init()
    {
        parent::Init();

        // $this->RequirePermission(SecureApp::$PERMISSION_USER,'SecureApp.LoginForm');
    }

    /**
     * Display the home page for the application
     */
    public function Home()
    {
        $cpid=$cuser=0;
        if (isset($_SESSION['authUser'])) {
            $cuser = $_SESSION['authUser'];
        } else {
            header("refresh:5;url= ./provider");
            echo 'Shared session not allowed with Portal!!!  <br>Onsite portal is using this session<br>Waiting until Onsite Portal is logged out........';
            exit;
        }

        $this->Assign('cpid', $GLOBALS['pid']);
        $this->Assign('cuser', $cuser);

        $this->Render();
    }

    /**
     * Displayed when an invalid route is specified
     */
    public function Error404()
    {
        $this->Render();
    }

    /**
     * Display a fatal error message
     */
    public function ErrorFatal()
    {
        $this->Render();
    }

    public function ErrorApi404()
    {
        $this->RenderErrorJSON('An unknown API endpoint was requested.');
    }
}
