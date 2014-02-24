<?php
abstract class Page {

    /** Dynamic variables
     */
	private $data = array();
    private $template = array();
    protected $widget = array();
    protected $registry;
    protected $html;
    protected $params; 

	public final function __construct() {
		$this->registry = new Registry();
        $this->html = $this->registry->register('HtmlModule');
        $this->template['data'] = array();
        if(isset($_GET['url']))
            $this->params = $_GET['url'];
        else
            $this->params = null;
		$this->beforeLoad();
		$this->onLoad();
	}

    /**
     * The function that is called before the page is loaded (e.g, before the view)
     */
    protected function beforeLoad() {}

    /**
     * The function that is called when it is time to load the view
     */
    protected function onLoad() {}

    /** Redirects user to desired location
     * @param $location The url of the website desired to be redirected to
     */
    protected function redirect($location) {
        header('Location: ' . $location);
        die();
    }

    /**
     * @param $widget The name of the widget you wish to summon
     * @param array $args The arguments to be passed to the widget
     */
	public function initWidget($widget, $args = array()) {
		require_once ROOT . DS . 'widget' . DS . $widget . '.php';
		$widgetClass = ucfirst($widget).'Widget';
        $this->widget[$widget] = new $widgetClass($args);
	}

    /** Calls teh onLoad function of the widget to display on call time
     * @param $widget The name of the widget you wish to call
     */
    public function loadWidget($widget) {
        $this->widget[$widget]->onLoad();
    }

    /** Loads the view and sets the variables need for it
     * @param $view
     * @param string $data
     */
	public final function loadView($view, $data = '') {
		if(is_array($data))
			extract($data, EXTR_PREFIX_SAME, 'wddx');
		require_once ROOT . DS . 'display' . DS . 'view' . DS . $view . '.php';
	}

    /** Loads the template and sets the desired variables
     * @param $template The template name in which you would like to load, e.g, 'default'
     */
    public final function loadTemplate($template) {
        if(is_array($this->template))
            extract($this->template, EXTR_PREFIX_SAME, 'wddx');
        require_once ROOT . DS . 'display' . DS . 'template' . DS . $template . '.php';
    }

    /**
     * @param $key The value in which the value can be retrieved at in the template/view
     * @param $value The variable in which you would like to pass onto the view
     */
    public function set($key, $value, $display = '') {
        if($display == '')
            $this->template['data'][$key] = $value;
        else if($display == TEMPLATE)
            $this->template[$key] = $value;
    }

    /** Sets the view for the template to load.
     * @param $view The view file to be loaded
     */
    public function setView($view) {
        $this->template['view'] = $view;
    }

    /** The text to be display on top of the page
     * @param $flash The text in which you want to 'flash' onto the page.
     */
    public function setFlash($flash) {
        $this->template['flash'] = $flash;
    }

    /**
     * @param $key
     * @param $value
     */
	public function __set($key, $value) {
		$this->data[$key] = $value;
	}

    /**
     * @param $key
     * @return null
     */
	public function __get($key) {
		return (array_key_exists($key, $this->data)) ? $this->data[$key] : null;
	}
}
?>