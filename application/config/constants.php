<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


// Z Desk:
define('ADMIN_ACTIONS', 'actions/admin/');
define('USER_ACTIONS', 'actions/user/');
define('USER_PUBLIC_PAGES', ['login', 'register', 'forgot_password', 'change_password', '2f_authentication', 'logout']);

// @version 2.1
define('PREFIX_2FA', 'z_2fa_');

// @version 1.1
define('ALLOWED_IMG_EXT_ARRAY', ['gif', 'jpg', 'jpeg', 'png', 'bmp']);
define('ALLOWED_IMG_EXT', 'gif|jpg|jpeg|png|bmp');
define('ALLOWED_IMG_EXT_HTML', 'image/gif,image/jpg,image/jpeg,image/png,image/bmp');

define('ALLOWED_ATTACHMENTS_EXT', 'csv|gif|jpg|jpeg|png|bmp|pdf|xls|xlsx');
define(
    'ALLOWED_ATTACHMENTS_EXT_HTML',
    '.csv,image/jpeg,image/jpg,image/png,image/bmp,image/gif,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

// @version 2.2
define('ALLOWED_ATTACHMENTS_EMAIL_TO_TICKET', ['csv', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'xps', 'pdf', 'dxf', 'ai', 'psd', 'eps', 'ps', 'svg', 'ttf', 'zip', 'rar', 'tar', 'gzip', 'mp3', 'mpeg', 'wav', 'ogg', 'jpeg', 'jpg', 'png', 'gif', 'bmp', 'tif', 'webm', 'txt']);

// In Kilobytes e.g. 5 MB = 5 * 1024
define('MAX_ALLOWED_IMG_SIZE', 5120);
define('MAX_ALLOWED_ATTACHMENT_SIZE', 10240);

define('DEFAULT_DB_COLUMN', 'id');
define('Z_DESK_VERSION', '3.0');
define('PER_PAGE_RESULTS_PANEL', 20);
define('PER_PAGE_RESULTS', 10);

define('DEFAULT_USER_ROLE_ID', 3);
define('STATIC_DATE_FORMAT', 'Y-m-d');
define('DB_BACKUP_TABLES', ['tickets', 'tickets_replies', 'tickets_history', 'users', 'users_invites', 'users_rememberings', 'users_sent_emails', 'users_sessions']); // Specific database tables to backup

// Cookies:
define('LANG_COOKIE', 'z_site_language');
define('USER_TOKEN', 'z_user_token');
define('SIDEBAR_COOKIE', 'z_sidebar_collapsed');

// @version 1.4
define('CHAT_COOKIE', 'z_live_chat');

// @version 1.6
define('MAX_EMAIL_RESEND_LIMIT', 3);

define('MODALS_SUPPORTED_PARENT_AREAS', ['admin', 'user']);
define('NO_PERMISSION_MSG', '403 - You do not have permission of this area.');
define('DEFAULT_USER_IMG', 'default.png');

/**
 * Slugs to handle the parent and child menus of sidebar. Supports only parent and child.
 * Used to open and activate the parent dropdown menus.
 *
 * Related functions are declared in "helpers/z_pages_helper.php".
 */
define('PANEL_SLUGS', [
    'admin' => [
        'tickets'        => ['opened', 'closed', 'assigned', 'all', 'ticket', 'create_ticket', 'history', 'my_departments'],
        'chats'          => ['all', 'chat', 'assigned', 'active', 'ended'],
        'knowledge_base' => ['categories', 'subcategories', 'articles', 'new_article', 'edit_article'],
        'users'          => ['new_user', 'invites', 'manage', 'edit_user', 'sessions', 'sent_emails', 'tickets', 'chats'],
        'settings'       => ['general', 'support', 'users', 'roles', 'permissions', 'apis', 'email', 'modules', 'envato', 'imap']
    ]
]);

// @version 2.2
define('REGEX_FROM_1_ETT', '/From: (\w+) (\<[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\>|.+).*/s');
define('REGEX_FROM_2_ETT', '/(From: )?([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}) (\<[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\>|.+).*/s');
define('REGEX_ON_1_ETT', '/\b(On|Op|Mån|Vào|Luni|Ma|Le|Am|El|De)(, | )?(\w{2,9})(, | )?(\w{2,9})(, | |. )(\d{1,2}|\w{2,9})(, | )?(\d{2,4})(.*)?/su');
define('REGEX_ON_2_ETT', '/\b([\p{L} ]{2,4})\d{1,2}(\/|-|\.|\. | )\d{1,2}(\/|-|.|. )\d{2,4}(.*)?/siu'); // On Date
define('REGEX_START_WITH_ARROW_ETT', '/(?:^\w.+:\n)?(?:^>.*(\n|$))+/mi'); // Start with >
define('REGEX_REMOVE_PIPE_ETT', '/^(\|\s*)+|(\s\|)/m'); // For Pipe: "|"

/**
 * Use this if you want to add the new language(s). Once a language will be added, that will
 * be shown in the available languages list ( e.g. language switcher ). You will be required
 * to add the language related translations in the "language/*" directory.
 *
 * NOTE: Once you add a new language, don't forget to add the related email templates.
 */
define(
    'AVAILABLE_LANGUAGES',
    [
        'english' => ['display_label' => 'English']
    ]
);

define(
    'SITE_THEMES',
    [
        'default' => ['display_label' => 'Default']
    ]
);

define('BACKUPS_DIRECTORY', 'assets/backups/');
define('IMG_UPLOADS_DIR', 'uploads/images/');
define('ADMIN_LTE_ASSETS', 'assets/%s/panel/admin_lte/');
define('ASSETS_PATH', 'assets/%s/');

// @version 2.3
define('TASK_PENDING', 0);
define('TASK_COMPLETED', 1);

// @version 2.5
define('OPENAI_MODEL', [
    'chatgpt-4o-latest',
    'gpt-4o',
    'gpt-4o-2024-08-06',
    'gpt-4o-2024-05-13',
    'gpt-4o-mini',
    'gpt-4o-mini-2024-07-18',
    'gpt-4-turbo',
    'gpt-4-turbo-2024-04-09',
    'gpt-4',
    'gpt-4-0125-preview',
    'gpt-4-1106-preview',
    'gpt-3.5-turbo',
    'gpt-3.5-turbo-0125',
    'gpt-3.5-turbo-1106'
]);

define('AI_WRITE_FOR_FIELDS', [
    'tickets_canned_replies' => ['subject', 'message'],
    'create_ticket' => ['subject', 'message'],
    'view_ticket' => ['your_reply'],
    'view_chat' => ['your_reply'],
    'article' => ['title', 'content', 'meta_keywords', 'meta_description'],
    'faq' => ['question', 'answer'],
    'announcement' => ['subject', 'announcement']
]);

define('EXPAND_FIRST_FAQ', true);
define('DISPLAY_DATES_ON_VIEW', false);
