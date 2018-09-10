<?php


namespace Central\TaskManagement\Block\Adminhtml\Task;


use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);

    }

    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_objectId = 'task_id';
        $this->_blockGroup = 'Central_TaskManagement';
        $this->_controller = 'adminhtml_task';
        parent::_construct();

        if ($this->_isAllowedAction('Central_TaskManagement::save')) {
            $this->buttonList->update('save', 'label', __('Save Task'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Central_TaskManagement::task_delete')) {
            $this->buttonList->update('delete', 'label', __('Delete Task'));
        } else {
            $this->buttonList->remove('delete');
        }

    }


    /**
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('taskmanagement_task')->getId()) {
            return __("Edit Task");
        } else {
            return __('New Task');
        }

    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('task/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }

}