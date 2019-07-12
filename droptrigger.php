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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function droptrigger_civicrm_xmlMenu(&$files) {
  _droptrigger_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function droptrigger_civicrm_postInstall() {
  _droptrigger_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function droptrigger_civicrm_uninstall() {
  _droptrigger_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function droptrigger_civicrm_enable() {
  _droptrigger_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function droptrigger_civicrm_disable() {
  _droptrigger_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function droptrigger_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _droptrigger_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function droptrigger_civicrm_managed(&$entities) {
  _droptrigger_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function droptrigger_civicrm_caseTypes(&$caseTypes) {
  _droptrigger_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function droptrigger_civicrm_angularModules(&$angularModules) {
  _droptrigger_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function droptrigger_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _droptrigger_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function droptrigger_civicrm_entityTypes(&$entityTypes) {
  _droptrigger_civix_civicrm_entityTypes($entityTypes);
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
