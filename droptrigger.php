<?php

require_once 'droptrigger.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function droptrigger_civicrm_config(&$config) {
  _droptrigger_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function droptrigger_civicrm_install() {
  _droptrigger_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function droptrigger_civicrm_enable() {
  _droptrigger_civix_civicrm_enable();
}

function droptrigger_civicrm_triggerInfo(&$info, $tableName) {
  // @TODO: move this to a setting
  $triggers_to_drop = [
    [
      'table' => '/^civicrm_activity$/',
      'when' => '/^BEFORE$/',
      'sql' => '/civicrm_case/',
    ],
  ];
  foreach ($info as $id => $triggerInfo) {
    $dropTrigger = FALSE;
    foreach ($triggers_to_drop as $trigger_to_drop) {
      foreach ($trigger_to_drop as $key => $pattern) {
        $value = $triggerInfo[$key];
        if (is_array($value)) {
          $value = implode(',', $value);
        }
        if (preg_match($pattern, $value)) {
          $dropTrigger = TRUE;
        }
        else {
          $dropTrigger = FALSE;
          break;
        }
      }
    }
    if ($dropTrigger) {
      unset($info[$id]);
    }
  }
}
