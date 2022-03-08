# Modern Business Template (CMS) by ### Accesco.co

**Modern Business** template is made from scractch mainly using PHP, jQuery, AJAX, JavaScript, HTML5, CSS3 and Bootstrap 5.. It's open source project (software) that anyone can use, it also comes with a few great featuers that after installing you can find out more about them..

### Features:
- Admin dashboard
- Canging mode with status message
- Update name, logo and initalizing custom settings
- Option for managing every page that exists and it's content
- etc..

## How to setup/install the software?
1. First you need to jump into *include* folder then locate *mysql.php* file. 
2. Change ```$mysql_hostname = ""; //To your local server
$mysql_username = "root"; //To your local user
$mysql_password = ""; //If you don't have password, then leave it blank
$mysql_database = "modern_business"; //To your database name.. (modern_business) -recommended```
3. After settng the right properties save the file and create the database in your **DBMS**.


### Also another tip/recommendation
Because you don't want if any error occurs to be shown, you will need to change a few things inside your *config.php* file. 
``` ini_set('display_errors', 1); ```  *//Set this value 0 to disable displying errors..*

```	ini_set('display_startup_errors', 1); ```  *//Set this value 0 to disable displying errors..*

```	error_reporting(E_ALL); ```  *//Commet this line or you can keep it..*



*Please if you find any errors or bugs reprot them or open issue, so I can fix them and provide you with the best version of this software.*
