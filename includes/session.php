<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session
{
    private $coach_logged_in = false;
    private $participant_logged_in = false;
    public $coachid;
    public $participantid;
    public $isDevelop;
    public $participantName;

    function __construct()
    {
        session_start();
        $this->coach_check_login();
        $this->participant_check_login();
    }

    public function coach_is_logged_in()
    {
        return $this->coach_logged_in;
    }

    public function participant_is_logged_in()
    {
        return $this->participant_logged_in;
    }

    public function coach_login($coach)
    {
        // database should find user based on username/password
        if ($coach) {
            $this->coachid = $_SESSION['coachid'] = $coach->coachid;
            $this->coach_logged_in = true;
        }
    }

    public function participant_login($participant)
    {
        // database should find user based on email/password
        if ($participant) {
            $this->participantName = $_SESSION['participantName'] = $participant->first_name;
            $this->isDevelop = $_SESSION['isDevelop'] = $participant->isDevelop;
            $this->participantid = $_SESSION['participantid'] = $participant->participantid;
            $this->participant_logged_in = true;
        }
    }

    public function isEchoForDevelop()
    {
        if(isset($_SESSION['isDevelop'])) {
            if ($_SESSION['isDevelop'] == 1) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['coachid']);
        unset($this->coachid);
        unset($_SESSION['participantid']);
        unset($this->participantid);
        unset($_SESSION['participantName']);
        unset($this->participantName);
        unset($_SESSION['isDevelop']);
        unset($this->isDevelop);
        unset($_SESSION['current_step']);
        $this->coach_logged_in = false;
        $this->participant_logged_in = false;
    }

    private function coach_check_login()
    {
        if (isset($_SESSION['coachid'])) {
            $this->coachid = $_SESSION['coachid'];
            $this->coach_logged_in = true;
        } else {
            unset($this->coachid);
            $this->coach_logged_in = false;
        }
    }

    private function participant_check_login()
    {
        if (isset($_SESSION['participantid'])) {
            $this->participantid = $_SESSION['participantid'];
            $this->participantName = $_SESSION['participantName'];
            $this->isDevelop = $_SESSION['isDevelop'];
            $this->participant_logged_in = true;
        } else {
            unset($this->participantid);
            unset($this->participantName);
            unset($this->isDevelop);
            $this->participant_logged_in = false;
        }
    }

}

// It is an instance of the session class to be used throughout the application
$session = new Session();

?>