<?php
namespace John;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected $_app = null;

    public function setUp()
    {
	$this->_app = new Application();
    }

    /**
     * @dataProvider provider
     */

    public function testDispatch(
        $requestUri,
	$expectControllerName,
	$expectActionName,
	$expectResult
    )
    {
	$_SERVER['REQUEST_URI'] = $requestUri;
	ob_start();
	$this->_app->run(__DIR__ . '/config.ini');
	$result = ob_get_clean();
	$controllerName = $this->_app->getControllerName();
	$actionName = $this->_app->getActionName();
	
	$this->assertEquals($controllerName,$expectControllerName);
	$this->assertEquals($actionName,$expectActionName);
	
	$this->assertEquals($result,$expectResult);
    } 

    public function provider()
    {
	return [
	    ['/', 'INDEX', 'INDEX','INDEX'],
	    ['/Blog/Article', 'Blog', 'Article',''],
	];
    }

    /**
    *  expectedException  PHPUnit_Framework_Error
    */
    public function testError()
    {
	ob_start();
	$_SERVER['REQUEST_URI'] = "/index/error"; 
	echo $this->_app->run(__DIR__ . '/config.ini');
	$result = ob_get_clean();
	$this->assertEquals('ERROR!!!' . PHP_EOL , $result);
    }

    /**
    *  expectedException  Exception
    */
    public function testExpception()
    {
	ob_start();
	$_SERVER['REQUEST_URI'] = "/index/exception"; 
	echo $this->_app->run(__DIR__ . '/config.ini');
	$result = ob_get_clean();
	$this->assertEquals('EXCEPTION!!!' . PHP_EOL , $result);
    }
}
