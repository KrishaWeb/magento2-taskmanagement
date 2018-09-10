<?php

namespace Central\TaskManagement\Block\Adminhtml\Task\Edit;


use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Magento\Cms\Model\Wysiwyg\Config;

class Form extends Generic
{
    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @var Config
     */
    protected $_wysiwygConfig;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        Config $wysiwygConfig,
        array $data = []
    )
    {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('task_form');
        $this->setTitle(__('Task Information'));
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Central\TaskManagement\Model\Task $model */
        $model = $this->_coreRegistry->registry('taskmanagement_task');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('task_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Task Information'), 'class' => 'fieldset-wide']
        );
        if ($model->getId()) {
            $fieldset->addField('task_id', 'hidden', ['name' => 'task_id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Task Name'), 'title' => __('Task Name'), 'required' => true]
        );

        $fieldset->addField(
            'assigned_person',
            'text',
            ['name' => 'assigned_person', 'label' => __('Assigned Person'), 'title' => __('Assigned Person'), 'required' => true]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['0' => __('TODO'), '1' => __('In Progress'), '2' => __('Done')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', '0');
        }
        $fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'label' => __('Task Description'),
                'title' => __('Task Description'),
                'style' => 'height:36em',
                'required' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
                'wysiwyg' => true
            ]
        );
        $fieldset->addField(
            'start_time',
            'date',
            [
                'name' => 'start_time',
                'label' => __('Start Time'),
                'title' => __('Start Time'),
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $fieldset->addField(
            'end_time',
            'date',
            [
                'name' => 'end_time',
                'label' => __('End Time'),
                'title' => __('End Time'),
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);


        return parent::_prepareForm();
    }


}