<?

class PageController
{
    public $pageName;
    public $pagg = 0;
    public $view;
    public $coutn;
    public $sort;
    public $order;
    public $data = array();
    function includePage($pageName)
    {
        $this->pageName = $pageName;
        include_once PAGE . 'content-page.php';
    }
    function mainPage()
    {
        $Task = new Task();
        $this->count = $Task->getTaskCount();
        if (ceil(($this->count + 1) / 3) >= ($this->pagg + 1) )
        {
            if ($this->sort && $this->order)
            {
                $this->data = $Task->getTaskList($this->pagg,$this->sort,$this->order);
            }
            else
            {
                $this->data = $Task->getTaskList($this->pagg);
            }
            $this->includePage('main');    
        }
        else
        {
            header('Location: /');
        }
    }
    public function __construct()
    {
        if ($_GET)
        {
            if ( preg_match('/^[a-z]+$/', $_GET['sort']) === 1 && preg_match('/^[A-Z]+$/', $_GET['order']) === 1)
            {
                $this->sort = $_GET['sort'];
                $this->order = $_GET['order'];
            }
            if ( preg_match('/^[0-9]+$/', $_GET['pagg']) === 1)
            {
                $this->pagg = $_GET['pagg'];
            }
            if ( preg_match('/^[a-z]+$/', $_GET['view']) === 1)
            {
                $this->view = $_GET['view'];
                switch ($this->view)
                {
                    case 'login':
                        if (!$_SESSION['admin'])
                        {
                            $this->includePage('login');
                        }
                        else
                        {
                            header('Location: /');
                        }
                        break;
                    case 'logout':
                        $User = new User();
                        $result['status'] = $User->logout();
                        header('Location: /');
                        break;
                    case 'change':
                        if ($_SESSION['admin'])
                        {
                            $Task = new Task();
                            if ($task = $Task->getTaskById($this->pagg))
                            {
                                $this->data = $task;
                                $this->includePage('change');
                            }
                            else
                            {
                                header('Location: /');
                            }
                        }
                        else
                        {
                            header('Location: /');
                        }
                        break;
                    default:
                        header('Location: /');
                        break;
                }
            }
            else
            {
                $this->mainPage();
            }
        }
        else
        {
           $this->mainPage();
        }
    }
}