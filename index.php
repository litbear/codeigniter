<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 * 应用程序运行环境
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 * 根据当前运行环境，可以加载不同的配置文件。更改运行环境同样会影响
 * 日志和错误报告
 *
 * This can be set to anything, but default usage is:
 * 环境可以设置为任意值，默认用法是：
 *      开发环境
 *      测试环境
 *      生产环境
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 * 注意，假如你更改这里，同样会改变下面的错误报告代码
 */
        /** 
         * 如果设置了CI_ENV全局变量 则以CI_ENV的值为当前环境，
         * 否则指定为开发环境
         */
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 * 错误报告级别
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 * 不同的环境需要不同的错误报告级别。开发环境会显示错误，但测试环境和生产环境会
 * 隐藏错误
 */
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 * 系统文件夹名称
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same directory
 * as this file.
 * 本变量必须包含你项目的系统文件夹名称。假如系统文件夹与本脚本
 * 文件不在同一文件夹内，则要设为系统文件夹的路径。
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 * 应用文件夹名称
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder than the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server. If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 * 你可以将你的应用程序目录移动到除 Web 根目录之外的其他位置， 移到之后你
 * 需要打开 index.php 文件将 $application_folder 变量改成新的位置
 * （使用**绝对路径**）:
 *
 * NO TRAILING SLASH!
 * 注意：不能有右侧尾部文件夹分隔符
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW FOLDER NAME
 * 视图文件夹名称
 *---------------------------------------------------------------
 *
 * If you want to move the view folder out of the application
 * folder set the path to the folder here. The folder can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application folder. If you
 * do move this, use the full server path to this folder.
 * 假如你想将视图文件移动到其他地方，则需要重命名此变量。假如此变量为空
 * 则使用默认位置，即应用文件夹下的views文件夹。假如你移动了，则应将此变量
 * 指定为绝对路径。
 *
 * NO TRAILING SLASH!
 * 注意：不能有右侧尾部文件夹分隔符
 */
	$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * 默认控制器
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here. For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 * 通常情况下，应该在配置文件routes.php中设置默认控制器。你可以在此以class/function
 * 的形式强制指定一个用户路由。
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller. Leave the function name blank if you need
 * to call functions dynamically via the URI.
 * 注意：假如你在此指定了默认路由，则其他控制器将不会被调用。本质来说，
 * 这个变量限制了你的应用只能使用一个指定的控制器，假如你想动态指定控制器
 * 的方法你可以将方法段留空。
 *
 * Un-comment the $routing array below to use this feature
 * 取消下面代码的注释可以获得此功能。
 */
	// The directory name, relative to the "controllers" folder.  Leave blank
	// if your controller is not in a sub-folder within the "controllers" folder
        // 相对于控制器文件夹的文件夹名称，假如不像指定子文件夹，则可以将本变量留空。
	// $routing['directory'] = '';

	// The controller class file name.  Example:  mycontroller
        // 默认使用的控制器类文件名
	// $routing['controller'] = '';

	// The controller function you wish to be called.
        // 默认要调用的控制器方法名。
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 *  用户设置项
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 * 在初始化时，下面的$assign_to_config数组会动态地向配置类传递设置。因此
 * 你可以在这里指定覆盖config.php文件的配置项。
 *
 * Un-comment the $assign_to_config array below to use this feature
 * 取消注释即可使用本功能。
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// 不要更改下面这一行
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * 增加获取系统文件夹的可靠性
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
        // 将命令行模式设置为当前文件夹
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

        // 为系统文件夹加上右侧文件夹分隔符
	if (($_temp = realpath($system_path)) !== FALSE)
	{
		$system_path = $_temp.'/';
	}
	else
	{
		// Ensure there's a trailing slash
                // 确保系统文件夹有一个右侧文件夹分隔符
		$system_path = rtrim($system_path, '/').'/';
	}

	// Is the system path correct?
        // 看看文件夹是否是合法的
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 *  既然我们知道了一些主要的文件夹了，现在开始设置主要文件夹的常量
 * -------------------------------------------------------------------
 */
	// The name of THIS file
        // 获取当前文件名
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system folder
        // 设置系统文件夹常量
	define('BASEPATH', str_replace('\\', '/', $system_path));

	// Path to the front controller (this file)
        // 设置前台控制器路径（就是本文件所在路径。）
	define('FCPATH', dirname(__FILE__).'/');

	// Name of the "system folder"
        // 返回BASEPATH的文件夹名称（确实不能用dirname啊）
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

	// The path to the "application" folder
        // 算出应用文件夹的绝对路径
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}

		define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
	}
	else
	{
		if ( ! is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); // EXIT_CONFIG
		}

		define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
	}

	// The path to the "views" folder
        // is_dir('');结果为false
	if ( ! is_dir($view_folder))
	{
		if ( ! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
		{
			$view_folder = APPPATH.$view_folder;
		}
		elseif ( ! is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); // EXIT_CONFIG
		}
		else
		{
			$view_folder = APPPATH.'views';
		}
	}

        // 
	if (($_temp = realpath($view_folder)) !== FALSE)
	{
		$view_folder = $_temp.DIRECTORY_SEPARATOR;
	}
	else
	{
		$view_folder = rtrim($view_folder, '/\\').DIRECTORY_SEPARATOR;
	}

	define('VIEWPATH', $view_folder);
        /*
         * var_dump(get_defined_constants(true));die;部分结果
         *   ["user"]=>
         *      array(7) {
         *        ["ENVIRONMENT"]=>
         *        string(11) "development"
         *        ["SELF"]=>
         *        string(9) "index.php"
         *        ["BASEPATH"]=>
         *        string(40) "D:/amp/www/localhost/codeigniter/system/"
         *        ["FCPATH"]=>
         *        string(33) "D:\amp\www\localhost\codeigniter/"
         *        ["SYSDIR"]=>
         *        string(6) "system"
         *        ["APPPATH"]=>
         *        string(45) "D:\amp\www\localhost\codeigniter\application\"
         *        ["VIEWPATH"]=>
         *        string(51) "D:\amp\www\localhost\codeigniter\application\views\"
         *      }
         * P.S：realpath('')为当前文件夹
         */

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * 加载启动文件
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
