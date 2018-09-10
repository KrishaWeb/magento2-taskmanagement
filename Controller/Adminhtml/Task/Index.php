<?php

namespace Central\TaskManagement\Controller\Adminhtml\Task;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }


    /**
     * Index Action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Central_Task::task');
        $resultPage->addBreadcrumb(__('Tasks'), __('Tasks'));
        $resultPage->addBreadcrumb(__('Manage Tasks'), __('Manage Tasks'));
        $resultPage->getConfig()->getTitle()->set(__('Manage Tasks'));

        return $resultPage;
    }

    /**
     * Is the user allowed to view the task grid.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Central_TaskManagement::task');
    }

}