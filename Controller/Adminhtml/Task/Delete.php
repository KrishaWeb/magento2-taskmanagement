<?php

namespace Central\TaskManagement\Controller\Adminhtml\Task;


use Central\TaskManagement\Model\Task;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Delete extends Action
{
    protected $task;

    public function __construct(Action\Context $context, Task $task)
    {
        $this->task = $task;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('task_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->task;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('The task has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['task_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a task to delete.'));
        return $resultRedirect->setPath('*/*/');
    }


    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Central_TaskManagement::task_delete');
    }
}