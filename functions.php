<?php
    /*
     * Function to logout.
     *
     */
    function logout()
    {
        setcookie('licapi[username]', '', time() - 3600);
        setcookie('licapi[useragent]', '', time() - 3600);
        header('Location: login.php');
        exit();
    }
    /*
     * Function to format Time
     *
     * @param string $v		 	The date to format
     */
    function dateTimeFormat($v)
    {
        $theDateTime = date('F d, Y g:i a', strtotime($v));        // September 5, 2016 9:14 pm
        return $theDateTime;
    }

    /*
     * Function to insert Recent Activity
     *
     * @param string $type		 	The Activity Type
     * @param string $title			The Activity Title
     */
    function updateActivity($type, $title)
    {
        global $mysqli;
        $activityIp = $_SERVER['REMOTE_ADDR'];
        $userAgnt = $_SERVER['HTTP_USER_AGENT'];
        $stmt = $mysqli->prepare('
							INSERT INTO
								activity(
									activityType,
									activityTitle,
									activityDate,
									ipAddress,
									userAgent
								) VALUES (
									?,
									?,
									NOW(),
									?,
									?
								)
		');
        $stmt->bind_param('ssss',
                            $type,
                            $title,
                            $activityIp,
                            $userAgnt
        );
        $stmt->execute();
        $stmt->close();
    }
    /*
     * Function to insert HEAD on all PHP pages.
     *
     * @param string $title		 	The title to set
     */
    function head($title)
    {
        echo '<head><title>'.$title."</title><link rel='stylesheet' type='text/css' href='css/style.css'></head>";
    }
