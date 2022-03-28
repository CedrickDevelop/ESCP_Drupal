<?php
namespace Drupal\cp22_escp_global\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\CurrentPathStack;
use http\Client\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 *  This Form can filter node and is used to sort nodes by date of modification
 *  This class is used inside the article list page, the search page and term page
 */
class GlobalNodeSortForm extends FormBase {

  /**
   * @var RequestStack
   */
  protected $requestStack;
  /**
   * @var Request
   */
  protected $request;


  /**
   * @param RequestStack $requestStack
   */
  public function __construct(
    RequestStack $requestStack)
  {
    $this->requestStack = $requestStack;

  }

  /** This name identificate the form */
  public function getFormId()
  {
    return 'node_sort_form';
  }

  /** We build a select form with 2 options : by  */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form_state->cleanValues();
    $form_state->setRebuild();
    $form_state->setMethod("GET");

    $form['node_sort_changed_date_form'] = [
        '#type' => 'select',
        '#title' => $this->t('Sort '),
        '#options' => [
          'DESC' => $this->t('du plus récent au plus ancien'),
          'ASC' => $this->t('du plus ancien au plus récent')
        ],
        '#default_value'  => $this->requestStack->getCurrentRequest()->query->get('node_sort_changed_date_form'),
        '#attributes' => array('onchange' => 'this.form.submit();')
    ];

    return $form;
  }

  public static function create(ContainerInterface $container){
    return new static(
      $container->get('request_stack')
    );
  }

  /** On submission of the form we get the value of filtering that we send to the current Request stack */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // We get the value from the form and we send to the request stack
    $date = $form_state->getValue('node_sort_changed_date_form');
    $this->requestStack->getCurrentRequest()->query->set('node_sort_changed_date_form',$date);
  }

  /** */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);

  }
}
