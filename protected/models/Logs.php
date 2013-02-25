<?php
class Logs extends CActiveRecord
{

    public static function model($className=__CLASS__) { return parent::model($className); }
    public function tableName() { return 'logs'; }
    
    /**
     * Define the log types-
     * 
     * - T_UNKNOWN:  No defined error type
     * - T_NOTICE:   Only a notice (i.e. login successfull)
     * - T_ERROR:    There was an error (i.e. Page not found)
     * - T_ALERT:    An alert that should be looked at (i.e. failed login)
     * - T_CRITICAL: A critical log that must be looked at
     * - T_COUNTER:  Used to count the number of failed attempts (i.e. login, registration)
     */
    const T_UNKNOWN = 0, T_NOTICE = 1, T_ERROR = 2, T_ALERT = 3,
                  T_CRITICAL = 4, T_COUNTER = 5;
                  
    
    /**
     * Defines important event types (ie. Login, Registration, ) that are used
     * primairly for traking and statistucal purposes.
     * 
     * - E_NONE:       There isn't a specific event to this log
     * - E_LOGIN:      The user made a login attempt
     * - E_REGISTER:   The user attempted to create a login attempt
     * - E_NEWEVENT:   The user created a new event
     * - E_CONTACTREQ: The user sent a contact request (use to prevent spam)
     * - E_ATTACHUPLD: The user uploaded a file
     */
    const E_NONE = 0, E_LOGIN = 1, E_REGISTER = 2, E_NEWEVENT = 3,
                  E_CONTACTREQ = 4, E_ATTACHUPLD = 5;
    
    
    /**
     * Create a new log entry in the database.
     * @param int $type The type of log it is (T_UNKNOW, T_NOTICE, etc)
     * @param string $details A description of the log entry
     * @param int $id_event An event ID to help identify the event (i.e. login attempt)
     * @param int $id_user Set a custom user ID. By default, it uses the current logged in user
     */
    public static function create($type, $details, $id_event = 0, $id_user = -1)
    {
        $log = new Logs;
        $log->ID_TYPE = $type;
        $log->ID_EVENT = $id_event;
        $log->ip = $_SERVER['REMOTE_ADDR'];
        $log->details = $details;
        $log->timestamp = time();
        
        if($id_user < 0)
            $log->ID_USER = (Yii::app()->user->isGuest ? 0 : Yii::app()->user->id);
        else
            $log->ID_USER = $id_user;
        
        $log->save();
    }
    
    /**
     * Search the log files with the given criteria
     * @param int $type the type of logs to retrieve
     * @param string $ip the IP address to search (defaults all IP's)
     * @param int $time the amount of time to seach backwards (default 15 mintues)
     * @param int $user the user ID to search (defaults the logged in user)
     * @param int $id_event the event ID to search (default no event ID)
     * @return array list of active records
     */
    public static function search($type, $ip = '*', $time = 900, $user = -1, $id_event = 0)
    {
        $criteria = new CDbCriteria;
        $criteria->select = '*, COUNT(*)';
        $criteria->condition = 'ID_USER=:iduser AND ID_TYPE=:idtype AND ip=:ip
                                AND ID_EVENT=:idevent AND timestamp>:time';
        $criteria->params = array(
                                ':ip'      => $ip,
                                ':iduser'  => $user < 0 ? $user : Yii::app()->user->id,
                                ':idtype'  => $type,
                                ':idevent' => $id_event,
                                ':time'    => time() - $time);
        
        return Logs::model()->findAll($criteria);
    }

}

?>