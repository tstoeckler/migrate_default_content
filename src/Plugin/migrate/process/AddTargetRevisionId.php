<?php

namespace Drupal\migrate_default_content\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * @MigrateProcessPlugin(
 *   id = "add_target_revision_id"
 * )
 */
class AddTargetRevisionId extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if ($value && is_array($value) && isset($value['target_id'])) {
      $storage = \Drupal::entityTypeManager()->getStorage($this->configuration['entity_type_id']);
      /* @var \Drupal\Core\Entity\RevisionableInterface $entity */
      if ($entity = $storage->load($value['target_id'])) {
        $value['target_revision_id'] = $entity->getRevisionId();
      }
    }
    return $value;
  }

}
