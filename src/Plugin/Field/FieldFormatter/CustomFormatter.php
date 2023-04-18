<?php

namespace Drupal\Formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Render\Markup;
use NumberFormatter; 

/**
 * Plugin implementation of the 'CustomFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "custom",
 *   label = @Translation("Custom Formatter"),
 *   field_types = {"integer"}
 * )
 */
class CustomFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    $number_formatter = new NumberFormatter($langcode, NumberFormatter::CURRENCY);

    foreach ($items as $delta => $item) {
      $currency_value = $number_formatter->formatCurrency($item->value , 'USD');
      $elements[$delta] = [
        '#markup' => Markup::create($currency_value),
      ];
    }

    return $elements;
  }

}
?>