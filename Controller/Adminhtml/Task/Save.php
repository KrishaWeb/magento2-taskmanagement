<?php

namespace Central\TaskManagement\Controller\Adminhtml\Task;

use Central\TaskManagement\Model\Task;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends Action
{

    protected $task;

    /**
     * Save constructor.
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, Task $task)
    {
        parent::__construct($context);
        $this->task = $task;
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
        $data = $this->getRequest()->getPostValue();

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->task;
            $id = $this->getRequest()->getParam('task_id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
            $this->_eventManager->dispatch(
                'taskmanagement_task_prepare_save',
                ['post' => $model, 'request' => $this->getRequest()]
            );
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved this Task.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['task_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the task.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['task_id' => $this->getRequest()->getParam('task_id')]);

        }
        return $resultRedirect->setPath('*/*/');

    }
}